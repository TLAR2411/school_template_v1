<script setup>
import { computed } from "vue";
import { useRoute } from "vue-router";
import { useSettingStore } from "@/stores/settingStore.js";
import ScoreEntryKhmer from "./ScoreEntryKhmer.vue";
import ScoreEntryEnglish from "./ScoreEntryEnglish.vue";

const props = defineProps({
  /** Class from Teacher Action URL — hide Grade/Class filters. */
  classId: { type: [Number, String], default: null },
  lockClass: { type: Boolean, default: false },
});

const route = useRoute();
const settingStore = useSettingStore();

const resolvedClassId = computed(() => props.classId ?? route.params.id);

const isKhmer = computed(
  () => String(settingStore.curriculum_symbol || "").toUpperCase() === "KH",
);
</script>

<template>
  <ScoreEntryKhmer
    v-if="isKhmer"
    :class-id="resolvedClassId"
    :lock-class="lockClass"
  />
  <ScoreEntryEnglish
    v-else
    :class-id="resolvedClassId"
    :lock-class="lockClass"
  />
</template>
