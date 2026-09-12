```vue
<script setup>
import { computed } from "vue";

const props = defineProps({
  modelValue: {
    type: String,
    required: true,
  },

  tabs: {
    type: Array,
    required: true,
  },

  mobileBreakpoint: {
    type: Number,
    default: 700,
  },
});

const emit = defineEmits(["update:modelValue"]);

const currentTab = computed({
  get: () => props.modelValue,

  set: (value) => {
    emit("update:modelValue", value);
  },
});
</script>

<template>
  <div class="custom-tabs-wrapper">
    <VTabs v-model="currentTab" class="custom-tabs" hide-slider>
      <VTab
        v-for="tab in tabs"
        :key="tab.value"
        :value="tab.value"
        class="custom-tab"
      >
        <div class="tab-content">
          <div class="tab-icon">
            <VIcon :icon="tab.icon" size="20" />
          </div>

          <div class="tab-text">
            <span class="tab-title">
              {{ tab.title }}
            </span>

            <span v-if="tab.description" class="tab-description">
              {{ tab.description }}
            </span>
          </div>
        </div>
      </VTab>
    </VTabs>
  </div>
</template>

<style scoped>
/* =========================
   Tabs
========================= */

.custom-tabs {
  min-height: 64px;
  gap: 6px;
}

/* =========================
   Individual Tab
========================= */

.custom-tab {
  min-height: 62px !important;
  height: 62px !important;

  flex: 1;

  border-radius: 5px !important;

  opacity: 1 !important;

  transition:
    background-color 0.2s ease,
    transform 0.2s ease,
    box-shadow 0.2s ease;

  color: rgba(var(--v-theme-on-surface), 0.65);
}

/* Remove default Vuetify effects */

.custom-tab::before {
  display: none !important;
}

/* =========================
   Tab Content
========================= */

.tab-content {
  width: 100%;

  display: flex;
  align-items: center;
  justify-content: center;

  gap: 10px;

  text-align: left;
}

/* =========================
   Icon
========================= */

.tab-icon {
  width: 38px;
  height: 38px;

  display: flex;
  align-items: center;
  justify-content: center;

  border-radius: 10px;

  background: rgba(var(--v-theme-primary), 0.08);

  color: rgba(var(--v-theme-on-surface), 0.6);

  transition:
    background-color 0.2s ease,
    color 0.2s ease,
    transform 0.2s ease;
}

/* =========================
   Text
========================= */

.tab-text {
  display: flex;
  flex-direction: column;

  line-height: 1.2;
}

.tab-title {
  font-size: 14px;
  font-weight: 600;

  color: rgba(var(--v-theme-on-surface), 0.8);
}

.tab-description {
  margin-top: 3px;

  font-size: 11px;

  color: rgba(var(--v-theme-on-surface), 0.45);
}

/* =========================
   Hover
========================= */

.custom-tab:hover {
  background: rgba(var(--v-theme-primary), 0.04);
}

.custom-tab:hover .tab-icon {
  transform: translateY(-1px);

  background: rgba(var(--v-theme-primary), 0.12);

  color: rgb(var(--v-theme-primary));
}

/* =========================
   Selected
========================= */

.custom-tab.v-tab--selected {
  background: rgba(var(--v-theme-primary), 0.09);

  box-shadow: 0 2px 8px rgba(var(--v-theme-primary), 0.08);
}

.custom-tab.v-tab--selected .tab-icon {
  background: rgb(var(--v-theme-primary));

  color: rgb(var(--v-theme-on-primary));
}

.custom-tab.v-tab--selected .tab-title {
  color: rgb(var(--v-theme-primary));
}

.custom-tab.v-tab--selected .tab-description {
  color: rgba(var(--v-theme-primary), 0.7);
}

/* =========================
   Mobile
========================= */

@media (max-width: 700px) {
  .custom-tabs {
    overflow-x: auto;
    scrollbar-width: none;
  }

  .custom-tabs::-webkit-scrollbar {
    display: none;
  }

  .custom-tab {
    min-width: 150px !important;
    flex: 0 0 auto;
  }

  .tab-description {
    display: none;
  }

  .tab-icon {
    width: 34px;
    height: 34px;
  }

  .tab-title {
    font-size: 13px;
  }
}

/* =========================
   Small Phone
========================= */

@media (max-width: 600px) {
  .custom-tab {
    min-width: 135px !important;
  }

  .tab-content {
    gap: 7px;
  }

  .tab-icon {
    width: 32px;
    height: 32px;
  }
}
</style>
```
