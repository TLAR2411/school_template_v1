<script setup>
import { computed, onMounted, ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import formatDate from "@/utils/formater/formatDate";
import TermPeriodList from "@/views/school/TermPeriodList/TermPeriodList.vue";

const route = useRoute();
const router = useRouter();
const { t, locale } = useI18n();

const isLoading = ref(true);
const termPeriod = ref(null);
const listsByGrade = ref([]);

const termPeriodId = computed(() => Number(route.params.id));

const termTitle = computed(() => {
  const tp = termPeriod.value;
  if (!tp) return "";
  if (locale.value === "km" && tp.name_kh) return tp.name_kh;
  return tp.name_en || tp.name_kh || `#${tp.id}`;
});

const loadTermPeriod = async () => {
  if (!termPeriodId.value) return;

  try {
    isLoading.value = true;
    const res = await api.post("term-periods-show", { id: termPeriodId.value });
    if (res.data.status) {
      termPeriod.value = res.data.data?.term_period ?? null;
      listsByGrade.value = res.data.data?.lists_by_grade ?? [];
    }
  } catch (error) {
    console.error("Failed to load term period:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(loadTermPeriod);
</script>

<template>
  <div>
    <!-- <VCard class="mb-4">
      <VCardText>
        <div class="d-flex flex-wrap align-center gap-3 mb-2">
          <VBtn
            icon
            variant="text"
            @click="router.push({ name: 'school-term-period' })"
          >
            <VIcon icon="tabler-arrow-left" />
          </VBtn>
          <div>
            <div class="text-h6">{{ termTitle }}</div>
            <div class="text-body-2 text-medium-emphasis">
              {{ t("Term Period Detail") }}
            </div>
          </div>
        </div>

        <VProgressLinear v-if="isLoading" indeterminate color="primary" />

        <VRow v-else-if="termPeriod">
          <VCol cols="12" sm="6" md="3">
            <div class="text-caption text-medium-emphasis">
              {{ t("Name Khmer") }}
            </div>
            <div>{{ termPeriod.name_kh || "-" }}</div>
          </VCol>
          <VCol cols="12" sm="6" md="3">
            <div class="text-caption text-medium-emphasis">
              {{ t("Name English") }}
            </div>
            <div>{{ termPeriod.name_en || "-" }}</div>
          </VCol>
          <VCol cols="12" sm="6" md="3">
            <div class="text-caption text-medium-emphasis">
              {{ t("Start Date") }}
            </div>
            <div>{{ formatDate(termPeriod.start_date) }}</div>
          </VCol>
          <VCol cols="12" sm="6" md="3">
            <div class="text-caption text-medium-emphasis">
              {{ t("End Date") }}
            </div>
            <div>{{ formatDate(termPeriod.end_date) }}</div>
          </VCol>
        </VRow>
      </VCardText>
    </VCard> -->

    <TermPeriodList
      v-if="termPeriod"
      :term-period-id="termPeriodId"
      :term-period="termPeriod"
      :lists-by-grade="listsByGrade"
      :loading="isLoading"
      @refresh="loadTermPeriod"
    />
  </div>
</template>
