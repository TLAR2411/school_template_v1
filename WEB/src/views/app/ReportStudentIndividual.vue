<script setup>
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import axios from "axios";
import ReportStudentKhmer from "./ReportStudentKhmer.vue";
import ReportStudentEnglish from "./ReportStudentEnglish.vue";

const route = useRoute();

const loading = ref(true);
const error = ref("");
const report = ref(null);

const classId = computed(() => route.query.class_id);
const studentId = computed(() => route.query.student_id);
const code = computed(() => route.query.code);

const isKhmer = computed(() => {
  const symbol = String(report.value?.curriculum?.symbol || "").toUpperCase();
  return symbol === "KH" || symbol === "KHM";
});

const appApiBase = import.meta.env.DEV
  ? "/api/app"
  : `${import.meta.env.VITE_API_URL}/api/app`;

async function loadReport() {
  loading.value = true;
  error.value = "";
  report.value = null;

  if (!classId.value || !studentId.value || !code.value) {
    error.value = "Missing class_id, student_id, or code in the URL.";
    loading.value = false;
    return;
  }

  try {
    const res = await axios.post(
      `${appApiBase}/report-student-individual`,
      {
        class_id: Number(classId.value),
        student_id: Number(studentId.value),
        code: String(code.value),
      },
      {
        headers: {
          Accept: "application/json",
          "Content-Type": "application/json",
        },
      },
    );

    if (!res.data?.status) {
      error.value = res.data?.message || "Unable to load report.";
      return;
    }

    report.value = res.data.data;
  } catch (e) {
    error.value =
      e?.response?.data?.message || e?.message || "Unable to load report.";
  } finally {
    loading.value = false;
  }
}

onMounted(loadReport);
</script>

<template>
  <div class="report-page">
    <div
      v-if="loading"
      class="report-state"
    >
      Loading report…
    </div>

    <div
      v-else-if="error"
      class="report-state report-state--error"
    >
      {{ error }}
    </div>

    <template v-else-if="report">
      <ReportStudentKhmer
        v-if="isKhmer"
        :report="report"
      />
      <ReportStudentEnglish
        v-else
        :report="report"
      />
    </template>
  </div>
</template>

<style scoped>
.report-page {
  min-height: 100dvh;
  background: #f3f4f6;
  padding: 16px;
}

.report-state {
  max-width: 480px;
  margin: 48px auto;
  padding: 24px;
  text-align: center;
  background: #fff;
  border-radius: 12px;
  color: #374151;
  font-size: 1rem;
}

.report-state--error {
  color: #b91c1c;
  border: 1px solid #fecaca;
  background: #fef2f2;
}
</style>
