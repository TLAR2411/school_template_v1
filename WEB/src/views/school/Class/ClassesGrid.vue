<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRouter } from "vue-router";
import { api } from "@/utils/api";
import { useSettingStore } from "@/stores/settingStore";
import AppCard from "@/components/AppCard.vue";

const { t, locale } = useI18n();
const router = useRouter();
const settingStore = useSettingStore();

const classes = ref([]);
const isLoading = ref(false);
const search = ref("");

const fetchData = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("classes-teacher");
    classes.value = res.data?.status ? res.data.data || [] : [];
  } catch (error) {
    console.error(error);
    classes.value = [];
  } finally {
    isLoading.value = false;
  }
};

const className = (item) => {
  if (locale.value === "km") {
    return item.name_kh || item.name_en || "—";
  }
  return item.name_en || item.name_kh || "—";
};

const gradeName = (item) => {
  const g = item.grade;
  if (!g) return null;
  const name = locale.value === "km" ? g.name_kh : g.name_en;
  return [g.grade_level, name].filter(Boolean).join(" ");
};

const filteredClasses = computed(() => {
  const q = (search.value || "").toLowerCase().trim();
  if (!q) return classes.value;
  return classes.value.filter((item) =>
    [
      className(item),
      gradeName(item),
      item.room?.room_number,
      item.shift?.name_kh,
      item.shift?.name_en,
    ]
      .filter(Boolean)
      .some((v) => String(v).toLowerCase().includes(q)),
  );
});

const openClass = (item) => {
  router.push({
    name: "school-teacher-action-id",
    params: { id: item.id },
  });
};

watch(
  () => [
    settingStore.year_id,
    settingStore.branch_id,
    settingStore.curriculum_id,
  ],
  () => fetchData(),
);

onMounted(fetchData);
</script>

<template>
  <AppCard
    title="My Classes"
    title-icon="tabler-chalkboard"
    :is-back="false"
    :loading="isLoading"
  >
    <VRow class="mb-4">
      <VCol cols="12" sm="6" md="4">
        <VTextField
          v-model="search"
          :label="t('Search')"
          prepend-inner-icon="tabler-search"
          clearable
          hide-details
        />
      </VCol>
    </VRow>

    <div
      v-if="!isLoading && !filteredClasses.length"
      class="text-center py-12 text-medium-emphasis"
    >
      <VIcon icon="tabler-chalkboard-off" size="48" class="mb-3" />
      <div>{{ t("No classes assigned") }}</div>
    </div>

    <VRow>
      <VCol
        class="cursor-pointer"
        v-for="item in filteredClasses"
        :key="item.id"
        cols="12"
        sm="6"
        md="4"
        lg="3"
      >
        <VCard
          class="class-card h-100"
          hover
          rounded="lg"
          role="button"
          tabindex="0"
          @click="openClass(item)"
          @keydown.enter="openClass(item)"
        >
          <VCardText>
            <div class="d-flex align-center justify-center ga-3 mb-4">
              <VAvatar color="primary" size="55">
                <!-- <VIcon icon="tabler-school" /> -->
                <span class="font-weight-bold" style="font-size: 15px">{{
                  className(item)
                }}</span>
              </VAvatar>
              <!-- <div class="min-w-0">
                <div class="text-h6 text-truncate">{{ className(item) }}</div>
                <div class="text-body-2 text-medium-emphasis">
                  {{ gradeName(item) || t("No grade") }}
                </div>
              </div> -->
            </div>

            <div class="d-flex flex-wrap justify-center ga-2 mb-4">
              <VChip
                v-if="item.classtype"
                size="small"
                color="primary"
                variant="tonal"
              >
                {{
                  locale === "km"
                    ? item.classtype.name_kh
                    : item.classtype.name_en
                }}
              </VChip>
              <VChip v-if="item.room?.room_number" size="small" variant="tonal">
                {{ t("Room") }} {{ item.room.room_number }}
              </VChip>
              <VChip v-if="item.shift" size="small" variant="tonal">
                {{ locale === "km" ? item.shift.name_kh : item.shift.name_en }}
              </VChip>
            </div>

            <!-- <VBtn
              block
              color="primary"
              variant="tonal"
              prepend-icon="tabler-arrow-right"
              @click.stop="openClass(item)"
            >
              {{ t("Open") }}
            </VBtn> -->
          </VCardText>
        </VCard>
      </VCol>
    </VRow>
  </AppCard>
</template>

<style scoped>
.class-card {
  cursor: pointer;
  transition: transform 0.15s ease;
}
</style>
