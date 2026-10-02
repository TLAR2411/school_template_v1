<script setup>
import { computed, onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import AppStatusChip from "@/components/AppStatusChip.vue";
import { getThumbUrl } from "@/utils/image/getImageUrl";
import formatNation from "@/utils/formater/formatNation";
import avatar1 from "@images/avatars/my-avatar-1.jpg";

const route = useRoute();
const router = useRouter();
const { t, locale } = useI18n();

const teacher = ref(null);
const isLoading = ref(false);

const pickLocale = (en, kh) =>
  (locale.value === "km" ? kh || en : en || kh) || "—";

const displayName = computed(() => {
  const d = teacher.value;
  if (!d) return "";
  return pickLocale(d.name_en, d.name_kh);
});

const displayNameSecondary = computed(() => {
  const d = teacher.value;
  if (!d) return "";
  if (locale.value === "km") {
    return d.name_en && d.name_en !== d.name_kh ? d.name_en : "";
  }
  return d.name_kh && d.name_kh !== d.name_en ? d.name_kh : "";
});

const genderLabel = computed(() => {
  const g = teacher.value?.gender;
  if (!g) return "—";
  if (g === "male") return locale.value === "km" ? "ប្រុស" : t("Male");
  if (g === "female") return locale.value === "km" ? "ស្រី" : t("Female");
  return g;
});

const photoSrc = computed(() => {
  const path = teacher.value?.photo_path;
  if (!path) return avatar1;
  return getThumbUrl(path, { w: 96, h: 96, fit: "cover", fmt: "webp", q: 70 });
});

const headerChips = computed(() => {
  const d = teacher.value;
  if (!d) return [];

  const chips = [];

  if (d.year_name) {
    chips.push({
      key: "year",
      label: d.year_name,
      bg: "#E6F1FB",
      color: "#185FA5",
    });
  }

  if (d.is_multi_branch || (d.branch_count ?? 0) > 1) {
    chips.push({
      key: "multi",
      label: t("Multiple Branches"),
      bg: "#F5E8FF",
      color: "#5B2B82",
    });
  } else if ((d.branches || []).length === 1) {
    chips.push({
      key: "branch",
      label: pickLocale(d.branches[0].name_en, d.branches[0].name_kh),
      bg: "#FAEEDA",
      color: "#633806",
    });
  }

  if (d.is_teaching != null) {
    chips.push({
      key: "teaching",
      label: d.is_teaching ? t("Teaching") : t("Not Teaching"),
      bg: d.is_teaching ? "#E1F5EE" : "#FCEBEB",
      color: d.is_teaching ? "#0F6E56" : "#A32D2D",
    });
  }

  return chips;
});

const stats = computed(() => {
  const s = teacher.value?.stats || {};
  return [
    {
      label: t("Classes"),
      value: s.class_total ?? 0,
      icon: "tabler-school",
      iconBg: "#E6F1FB",
      iconColor: "#185FA5",
    },
    {
      label: t("Subjects"),
      value: s.subject_total ?? 0,
      icon: "tabler-book",
      iconBg: "#E1F5EE",
      iconColor: "#0F6E56",
    },
    {
      label: t("Branches"),
      value: s.branch_total ?? teacher.value?.branch_count ?? 0,
      icon: "tabler-building",
      iconBg: "#F5E8FF",
      iconColor: "#5B2B82",
    },
    {
      label: t("Classload"),
      value: s.classload_total ?? 0,
      icon: "tabler-chalkboard",
      iconBg: "#FAEEDA",
      iconColor: "#633806",
    },
  ];
});

const infoRows = computed(() => {
  const d = teacher.value;
  if (!d) return [];

  return [
    { key: "gender", label: t("Gender"), value: genderLabel.value },
    { key: "nation", label: t("Nation"), value: formatNation(d.nation) || "—" },
    { key: "phone", label: t("phone"), value: d.phone || "—" },
    { key: "dob", label: t("Date of Birth"), value: d.dob || "—" },
  ];
});

const classes = computed(() => teacher.value?.classes || []);
const branches = computed(() => teacher.value?.branches || []);

/** Group year-scoped classes under each branch: Branch → Classes → Subjects */
const classesByBranch = computed(() => {
  const classList = classes.value;
  const assigned = branches.value;
  const map = new Map();

  const ensureBranch = (id, meta = {}) => {
    const key = id ?? "unknown";
    if (!map.has(key)) {
      map.set(key, {
        branch_id: id ?? null,
        name_en: meta.name_en || null,
        name_kh: meta.name_kh || null,
        abbr: meta.abbr || null,
        classes: [],
      });
    } else {
      const row = map.get(key);
      if (!row.name_en && meta.name_en) row.name_en = meta.name_en;
      if (!row.name_kh && meta.name_kh) row.name_kh = meta.name_kh;
      if (!row.abbr && meta.abbr) row.abbr = meta.abbr;
    }
    return map.get(key);
  };

  // Keep assigned branches visible even with 0 classes this year
  for (const branch of assigned) {
    ensureBranch(branch.id, branch);
  }

  for (const item of classList) {
    const group = ensureBranch(item.branch_id, {
      name_en: item.branch_name_en,
      name_kh: item.branch_name_kh,
      abbr: item.branch_abbr,
    });
    group.classes.push(item);
  }

  return Array.from(map.values()).map((group) => {
    const subjectTotal = group.classes.reduce(
      (sum, c) => sum + (c.subjects?.length || 0),
      0,
    );
    return {
      ...group,
      class_total: group.classes.length,
      subject_total: subjectTotal,
    };
  });
});

const fetchDetail = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("teachers-detail", { id: route.params.id });
    if (res.data?.status) {
      teacher.value = res.data.data;
    }
  } catch (error) {
    console.error("Failed to load teacher detail:", error);
  } finally {
    isLoading.value = false;
  }
};

const openClass = (classId) => {
  if (!classId) return;
  router.push({ name: "school-class-detail-id", params: { id: classId } });
};

const onEdit = () => {
  router.push({
    name: "school-teacher-edit-id",
    params: { id: route.params.id },
  });
};

onMounted(() => {
  fetchDetail();
});
</script>

<template>
  <AppCard
    :title="displayName || t('Teacher')"
    title-icon="tabler-user"
    :loading="isLoading"
  >
    <template #card-header>
      <VBtn
        variant="tonal"
        color="primary"
        size="small"
        prepend-icon="tabler-edit"
        @click="onEdit"
      >
        {{ t("Edit") }}
      </VBtn>
    </template>

    <VCard v-if="isLoading" class="pa-5 mb-4">
      <div class="d-flex align-center justify-center py-10">
        <VProgressCircular indeterminate color="primary" />
      </div>
    </VCard>

    <template v-else-if="teacher">
      <!-- Identity -->
      <VCard class="pa-5 mb-4">
        <div class="d-flex align-start justify-space-between flex-wrap ga-3">
          <div class="d-flex align-center ga-3">
            <VAvatar size="56" rounded="lg">
              <VImg :src="photoSrc" :alt="displayName" />
            </VAvatar>
            <div>
              <div class="d-flex align-center ga-2 flex-wrap">
                <p class="text-h6 font-weight-medium mb-0">
                  {{ displayName }}
                </p>
                <AppStatusChip
                  :color="teacher.is_active ? 'success' : 'error'"
                  :label="teacher.is_active ? t('Active') : t('Inactive')"
                />
              </div>
              <p
                v-if="displayNameSecondary"
                class="text-body-2 text-medium-emphasis mb-0"
              >
                {{ displayNameSecondary }}
              </p>
            </div>
          </div>

          <div class="d-flex ga-2 flex-wrap align-center">
            <VChip
              v-for="chip in headerChips"
              :key="chip.key"
              size="small"
              :style="{ background: chip.bg, color: chip.color }"
            >
              {{ chip.label }}
            </VChip>
          </div>
        </div>

        <VDivider class="my-4" />

        <!-- <VRow>
          <VCol v-for="stat in stats" :key="stat.label" cols="12" sm="6" md="3">
            <div class="pa-3 rounded-lg border">
              <div class="d-flex align-center justify-space-between mb-2">
                <span class="text-caption text-medium-emphasis">
                  {{ stat.label }}
                </span>
                <div
                  class="d-flex align-center justify-center rounded"
                  :style="{
                    width: '38px',
                    height: '38px',
                    background: stat.iconBg,
                  }"
                >
                  <VIcon size="22" :color="stat.iconColor">
                    {{ stat.icon }}
                  </VIcon>
                </div>
              </div>
              <p class="text-h4 font-weight-medium mb-0">
                {{ stat.value }}
              </p>
            </div>
          </VCol>
        </VRow> -->

        <!-- <VDivider class="my-4" /> -->

        <VRow>
          <VCol v-for="row in infoRows" :key="row.key" cols="3" sm="6" md="3">
            <p class="text-caption text-medium-emphasis mb-1">
              {{ row.label }}
            </p>
            <p class="text-body-1 mb-0">
              {{ row.value }}
            </p>
          </VCol>
        </VRow>
      </VCard>

      <!-- Branch → Classes → Subjects (year scoped) -->
      <VCard class="pa-5 mb-4">
        <div
          class="d-flex align-center justify-space-between mb-4 flex-wrap ga-2"
        >
          <div>
            <!-- <p class="text-h6 font-weight-medium mb-0">
              {{ t("Teaching by branch") }}
            </p> -->
            <!-- <p v-if="teacher.year_name" class="mb-0">
              {{ t("Year") }}: {{ teacher.year_name }}
            </p> -->
            <VChip v-if="teacher.year_name" color="primary">
              {{ t("Year") }}: {{ teacher.year_name }}</VChip
            >
          </div>
          <VChip
            v-if="teacher.is_multi_branch || classesByBranch.length > 1"
            size="small"
            color="secondary"
            variant="tonal"
          >
            {{ t("Multiple Branches") }}
          </VChip>
        </div>

        <div v-if="!classesByBranch.length" class="text-center py-8">
          <VIcon size="40" class="text-medium-emphasis mb-2">
            tabler-building-off
          </VIcon>
          <p class="text-body-2 text-medium-emphasis mb-0">
            {{ t("No classes assigned for this year") }}
          </p>
        </div>

        <div v-else class="d-flex flex-column ga-4">
          <div
            v-for="branch in classesByBranch"
            :key="branch.branch_id ?? 'unknown'"
            class="rounded-lg border pa-4"
          >
            <!-- Branch header + class count for this year -->
            <div
              class="d-flex align-center justify-space-between flex-wrap ga-2 mb-3"
            >
              <div class="d-flex align-center ga-2">
                <div
                  class="d-flex align-center justify-center rounded"
                  style="width: 36px; height: 36px; background: #f5e8ff"
                >
                  <VIcon size="20" color="#5B2B82">tabler-building</VIcon>
                </div>
                <div>
                  <p class="text-body-1 font-weight-medium mb-0">
                    <span v-if="branch.abbr" class="me-1">{{
                      branch.abbr
                    }}</span>
                    {{
                      pickLocale(branch.name_en, branch.name_kh) === "—"
                        ? t("Unknown branch")
                        : pickLocale(branch.name_en, branch.name_kh)
                    }}
                    <span class="text-caption text-medium-emphasis mb-0"
                      >({{ branch.class_total }} {{ t("Classes") }} ·
                      {{ branch.subject_total }} {{ t("Subjects") }})</span
                    >
                  </p>
                  <!-- <p class="text-caption text-medium-emphasis mb-0">
                    {{ branch.class_total }} {{ t("Classes") }} ·
                    {{ branch.subject_total }} {{ t("Subjects") }}
                  </p> -->
                </div>
              </div>
              <VChip size="small" color="primary" variant="tonal">
                {{ branch.class_total }} {{ t("Classes") }}
              </VChip>
            </div>

            <div
              v-if="!branch.classes.length"
              class="text-caption text-medium-emphasis py-2"
            >
              {{ t("No classes assigned for this year") }}
            </div>

            <div v-else class="d-flex flex-column ga-3">
              <div
                v-for="item in branch.classes"
                :key="item.class_id"
                class="pa-3 rounded-lg border class-row"
                role="button"
                tabindex="0"
                @click="openClass(item.class_id)"
                @keydown.enter="openClass(item.class_id)"
              >
                <div
                  class="d-flex align-start justify-space-between flex-wrap ga-2 mb-2"
                >
                  <div class="d-flex align-center ga-3">
                    <div
                      class="d-flex align-center justify-center rounded-lg text-body-1 font-weight-medium bg-primary"
                      style="
                        width: 40px;
                        height: 40px;
                        color: white;
                        flex-shrink: 0;
                      "
                    >
                      {{ pickLocale(item.name_en, item.name_kh) }}
                    </div>
                    <div>
                      <!-- <p class="text-body-1 font-weight-medium mb-0">
                        {{ pickLocale(item.name_en, item.name_kh) }}
                      </p> -->
                      <p class="text-caption text-medium-emphasis mb-0">
                        <template v-if="item.grade_level != null">
                          {{ t("Grade") }} {{ item.grade_level }}
                        </template>
                        <template
                          v-else-if="item.grade_name_en || item.grade_name_kh"
                        >
                          {{
                            pickLocale(item.grade_name_en, item.grade_name_kh)
                          }}
                        </template>
                        <template v-if="item.room_number">
                          · {{ t("Room") }} {{ item.room_number }}
                        </template>
                        <template
                          v-if="item.shift_name_en || item.shift_name_kh"
                        >
                          ·
                          {{
                            pickLocale(item.shift_name_en, item.shift_name_kh)
                          }}
                        </template>
                      </p>
                    </div>
                  </div>

                  <div class="d-flex ga-2 flex-wrap">
                    <VChip
                      v-if="item.is_classload"
                      size="small"
                      color="success"
                      variant="tonal"
                    >
                      {{ t("Classload") }}
                    </VChip>
                    <VChip
                      v-if="item.is_assisstant"
                      size="small"
                      color="warning"
                      variant="tonal"
                    >
                      {{ t("Assistant") }}
                    </VChip>
                  </div>
                </div>

                <!-- <p class="text-caption text-medium-emphasis mb-2">
                  {{ t("Subjects") }}
                  ({{ item.subjects?.length || 0 }})
                </p> -->
                <div v-if="item.subjects?.length" class="d-flex flex-wrap ga-2">
                  <VChip
                    v-for="subject in item.subjects"
                    :key="subject.id || subject.subject_id"
                    size="small"
                    variant="outlined"
                  >
                    <span v-if="subject.symbol" class="me-1 font-weight-medium">
                      {{ subject.symbol }}
                    </span>
                    {{ pickLocale(subject.name_en, subject.name_kh) }}
                  </VChip>
                </div>
                <p v-else class="text-caption text-medium-emphasis mb-0">
                  {{ t("No subjects") }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </VCard>
    </template>

    <VCard v-else class="pa-5 mb-4">
      <p class="text-medium-emphasis mb-0 text-center py-6">
        {{ t("No data available") }}
      </p>
    </VCard>
  </AppCard>
</template>

<style scoped>
.class-row {
  cursor: pointer;
  transition: background-color 0.15s ease;
}

.class-row:hover {
  background-color: rgba(var(--v-theme-on-surface), 0.03);
}
</style>
