<script setup>
import { storeToRefs } from "pinia";
import { computed, onMounted, watch } from "vue";
import { useDisplay } from "vuetify";
import { useAppStore } from "@/stores/appStore";
import { useSettingStore } from "@/stores/settingStore";

const { smAndDown } = useDisplay();
const appStore = useAppStore();
const settingStore = useSettingStore();

const { years } = storeToRefs(appStore);
const { year_id } = storeToRefs(settingStore);

const currentYear = computed(() =>
  years.value.find((item) => item.id == year_id.value) || null,
);

const resolveDefaultYearId = () => {
  if (!years.value?.length) return null;

  const savedId = settingStore.year_id;
  const stillValid = years.value.some((item) => item.id == savedId);
  if (stillValid) return savedId;

  const today = new Date().toISOString().slice(0, 10);
  const active = years.value.find(
    (item) => item.start_date <= today && item.end_date >= today,
  );

  return active?.id || years.value[0]?.id || null;
};

const syncYear = () => {
  const id = resolveDefaultYearId();
  if (!id) {
    settingStore.setYearId(null);
    settingStore.setYearName(null);
    return;
  }

  const year = years.value.find((item) => item.id == id);
  settingStore.setYearId(id);
  settingStore.setYearName(year?.name || null);
};

const switchYear = (id) => {
  const year = years.value.find((item) => item.id == id);
  settingStore.setYearId(id);
  settingStore.setYearName(year?.name || null);
  window.location.reload()
};

watch(years, () => syncYear(), { deep: true });

onMounted(async () => {
  if (!years.value?.length) {
    await appStore.getYears();
  }
  syncYear();
});
</script>

<template>
  <!-- Mobile: calendar icon only -->
  <IconBtn
    v-if="smAndDown"
    class="navbar-year-icon-btn flex-shrink-0"
    :aria-label="currentYear?.name || $t('Academic Year')"
  >
    <VIcon size="24" icon="tabler-calendar" />
    <VMenu activator="parent" location="bottom start" offset="6" class="pa-0">
      <VList size="small" class="py-1 navbar-year-menu">
        <VListItem
          v-for="item in years"
          :key="item.id"
          size="small"
          :active="item.id === year_id"
          @click="switchYear(item.id)"
        >
          <VListItemTitle>{{ item.name }}</VListItemTitle>
        </VListItem>
      </VList>
    </VMenu>
  </IconBtn>

  <!-- Desktop: year label chip -->
  <VBtn
    v-else
    size="small"
    variant="tonal"
    color="primary"
    class="navbar-year-btn"
  >
    <span class="font-weight-bold text-truncate">
      {{ currentYear?.name }}
    </span>
    <VMenu activator="parent" location="bottom end" offset="6" class="pa-0">
      <VList size="small" class="py-1">
        <VListItem
          v-for="item in years"
          :key="item.id"
          size="small"
          class="pa-0"
          :active="item.id === year_id"
          @click="switchYear(item.id)"
        >
          <VListItemTitle>{{ item.name }}</VListItemTitle>
        </VListItem>
      </VList>
    </VMenu>
  </VBtn>
</template>

<style scoped>
.navbar-year-btn {
  flex-shrink: 1;
  max-inline-size: 130px;
  min-inline-size: 0;
  margin-inline-end: 8px;
}

.navbar-year-icon-btn {
  margin-inline-end: 4px;
}
</style>
