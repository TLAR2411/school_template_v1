<script setup>
/**
 * School dashboard overview cards (curriculum-scoped).
 * Khmer curricula may also show education-level class counts.
 */
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { getSchoolDashboard } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";

const { t, locale } = useI18n();
const settingStore = useSettingStore();

const loading = ref(false);
const error = ref("");
const data = ref({
  students_total: 0,
  students_female: 0,
  teachers_total: 0,
  teachers_female: 0,
  classes_total: 0,
  grades_total: 0,
  show_education_levels: false,
  education_levels: [],
});

const mainStats = computed(() => [
  {
    key: "students_total",
    label: t("All students"),
    value: data.value.students_total,
    icon: "tabler-users",
    tone: "blue",
  },
  {
    key: "students_female",
    label: t("Female students"),
    value: data.value.students_female,
    icon: "tabler-gender-female",
    tone: "pink",
  },
  {
    key: "teachers_total",
    label: t("All teachers"),
    value: data.value.teachers_total,
    icon: "tabler-chalkboard",
    tone: "green",
  },
  {
    key: "teachers_female",
    label: t("Female teachers"),
    value: data.value.teachers_female,
    icon: "tabler-gender-female",
    tone: "teal",
  },
  {
    key: "classes_total",
    label: t("All classes"),
    value: data.value.classes_total,
    icon: "tabler-school",
    tone: "purple",
  },
  {
    key: "grades_total",
    label: t("All grades"),
    value: data.value.grades_total,
    icon: "tabler-layers-intersect",
    tone: "orange",
  },
]);

function eduLabel(item) {
  if (!item) return "";
  return locale.value === "km"
    ? item.name_kh || item.name_en || ""
    : item.name_en || item.name_kh || "";
}

async function load() {
  loading.value = true;
  error.value = "";
  try {
    const res = await getSchoolDashboard();
    data.value = {
      students_total: res?.students_total ?? 0,
      students_female: res?.students_female ?? 0,
      teachers_total: res?.teachers_total ?? 0,
      teachers_female: res?.teachers_female ?? 0,
      classes_total: res?.classes_total ?? 0,
      grades_total: res?.grades_total ?? 0,
      show_education_levels: Boolean(res?.show_education_levels),
      education_levels: res?.education_levels ?? [],
    };
  } catch (err) {
    error.value = err?.message || t("Failed to load dashboard");
  } finally {
    loading.value = false;
  }
}

watch(
  () => [
    settingStore.year_id,
    settingStore.branch_id,
    settingStore.curriculum_id,
  ],
  () => load(),
);

onMounted(load);

defineExpose({ load });
</script>

<template>
  <div class="dash-overview" :class="{ 'dash-overview--loading': loading }">
    <!-- <div class="dash-overview__head">
      <div>
        <h2 class="dash-overview__title">{{ t("Overview") }}</h2>
        <p class="dash-overview__sub text-medium-emphasis">
          {{ t("Counts for the selected curriculum, branch and year") }}
        </p>
      </div>
    </div> -->

    <VAlert v-if="error" type="error" variant="tonal" class="mb-3">
      {{ error }}
    </VAlert>

    <div class="dash-stat-grid">
      <div
        v-for="stat in mainStats"
        :key="stat.key"
        class="dash-stat"
        :class="`dash-stat--${stat.tone}`"
      >
        <div class="dash-stat__icon-wrap">
          <VIcon :icon="stat.icon" size="22" />
        </div>
        <div class="dash-stat__body">
          <div class="dash-stat__label">{{ stat.label }}</div>
          <div class="dash-stat__value">{{ stat.value }}</div>
        </div>
      </div>
    </div>

    <div
      v-if="data.show_education_levels && data.education_levels.length"
      class="dash-edu"
    >
      <div class="dash-edu__head text-primary">
        <VIcon icon="tabler-building-community" size="18" />
        <span>{{ t("By education level") }}</span>
      </div>
      <div class="dash-edu__grid">
        <div
          v-for="edu in data.education_levels"
          :key="edu.edu_id"
          class="dash-edu-card"
        >
          <div class="dash-edu-card__name">{{ eduLabel(edu) }}</div>
          <div class="dash-edu-card__nums">
            <div class="dash-edu-card__metric">
              <span class="dash-edu-card__num">{{ edu.classes_count }}</span>
              <span class="dash-edu-card__hint">{{ t("Classes") }}</span>
            </div>
            <div class="dash-edu-card__metric">
              <span class="dash-edu-card__num">{{ edu.grades_count }}</span>
              <span class="dash-edu-card__hint">{{ t("Grades") }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.dash-overview {
  margin-bottom: 20px;
}

.dash-overview__title {
  margin: 0;
  font-size: 1.15rem;
  font-weight: 700;
  line-height: 1.3;
}

.dash-overview__sub {
  margin: 2px 0 0;
  font-size: 0.82rem;
}

.dash-overview__head {
  margin-bottom: 12px;
}

.dash-overview--loading {
  opacity: 0.7;
  pointer-events: none;
}

.dash-stat-grid {
  display: grid;
  grid-template-columns: repeat(6, minmax(0, 1fr));
  gap: 10px;
}

.dash-stat {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 14px 14px;
  border-radius: 6px;
  min-height: 76px;
  border: 1px solid transparent;
}

.dash-stat__icon-wrap {
  width: 42px;
  height: 42px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex: none;
  background: rgba(255, 255, 255, 0.7);
}

.dash-stat__label {
  font-size: 0.78rem;
  font-weight: 600;
  opacity: 0.8;
  line-height: 1.2;
}

.dash-stat__value {
  margin-top: 2px;
  font-size: 1.35rem;
  font-weight: 800;
  line-height: 1.1;
}

.dash-stat--blue {
  background: #e6f1fb;
  color: #185fa5;
  border-color: #b5d4f4;
}
.dash-stat--pink {
  background: #fbeaf0;
  color: #993556;
  border-color: #f4c0d1;
}
.dash-stat--green {
  background: #e1f5ee;
  color: #0f6e56;
  border-color: #9fe1cb;
}
.dash-stat--teal {
  background: #e1fafa;
  color: #0e7c7b;
  border-color: #9ee0df;
}
.dash-stat--purple {
  background: #eeedfe;
  color: #534ab7;
  border-color: #cecbf6;
}
.dash-stat--orange {
  background: #faeeda;
  color: #854f0b;
  border-color: #fac775;
}

.dash-edu {
  margin-top: 14px;
  padding: 14px;
  border-radius: 6px;
  /* background: rgba(var(--v-theme-on-surface), 0.03); */
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
}

.dash-edu__head {
  display: flex;
  align-items: center;
  gap: 8px;
  font-weight: 700;
  font-size: 0.92rem;
  margin-bottom: 10px;
}

.dash-edu__grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
}

.dash-edu-card {
  background: rgb(var(--v-theme-surface));
  border-radius: 6px;
  padding: 12px 14px;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
}

.dash-edu-card__name {
  font-weight: 700;
  font-size: 0.9rem;
  margin-bottom: 10px;
}

.dash-edu-card__nums {
  display: flex;
  gap: 18px;
}

.dash-edu-card__metric {
  display: flex;
  flex-direction: column;
}

.dash-edu-card__num {
  font-size: 1.2rem;
  font-weight: 800;
  line-height: 1.1;
  color: rgb(var(--v-theme-primary));
}

.dash-edu-card__hint {
  font-size: 0.72rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
  font-weight: 600;
}

@media (max-width: 1280px) {
  .dash-stat-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 700px) {
  .dash-stat-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .dash-edu__grid {
    grid-template-columns: 1fr;
  }
}
</style>
