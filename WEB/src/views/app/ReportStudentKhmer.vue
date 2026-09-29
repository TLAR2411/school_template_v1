<script setup>
defineProps({
  report: {
    type: Object,
    required: true,
  },
});
</script>

<template>
  <article class="report-card">
    <header class="report-card__header">
      <p class="report-card__eyebrow">របាយការណ៍សិស្ស · Khmer</p>
      <h1 class="report-card__title">
        {{ report.student?.name_kh || report.student?.name_en }}
      </h1>
      <p
        v-if="report.student?.name_en && report.student?.name_kh"
        class="report-card__subtitle"
      >
        {{ report.student.name_en }}
      </p>
    </header>

    <section class="report-card__meta">
      <div class="meta-row">
        <span>ថ្នាក់</span>
        <strong>{{ report.class?.name_kh || report.class?.name_en || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>កម្រិត</span>
        <strong>{{ report.class?.grade?.name_kh || report.class?.grade?.name_en || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>ឆ្នាំសិក្សា</span>
        <strong>{{ report.class?.year?.name || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>វេន</span>
        <strong>{{ report.class?.shift?.name_kh || report.class?.shift?.name_en || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>កម្មវិធី</span>
        <strong>{{ report.curriculum?.name_kh || report.curriculum?.name_en || "KH" }}</strong>
      </div>
    </section>

    <section class="report-card__placeholder">
      <p>តារាងពិន្ទុនឹងបង្ហាញនៅទីនេះ។</p>
      <p class="hint">Score table placeholder — wire score API next.</p>
    </section>
  </article>
</template>

<style scoped>
.report-card {
  max-width: 720px;
  margin: 0 auto;
  background: #fff;
  border-radius: 16px;
  box-shadow: 0 8px 24px rgb(15 23 42 / 8%);
  overflow: hidden;
}

.report-card__header {
  padding: 24px 20px 16px;
  background: linear-gradient(135deg, #0f766e, #115e59);
  color: #fff;
}

.report-card__eyebrow {
  margin: 0 0 8px;
  font-size: 0.8rem;
  opacity: 0.85;
}

.report-card__title {
  margin: 0;
  font-size: 1.5rem;
  line-height: 1.3;
}

.report-card__subtitle {
  margin: 6px 0 0;
  opacity: 0.9;
  font-size: 0.95rem;
}

.report-card__meta {
  display: grid;
  gap: 10px;
  padding: 20px;
}

.meta-row {
  display: flex;
  justify-content: space-between;
  gap: 12px;
  padding-bottom: 8px;
  border-bottom: 1px solid #e5e7eb;
  font-size: 0.95rem;
  color: #4b5563;
}

.meta-row strong {
  color: #111827;
  text-align: right;
}

.report-card__placeholder {
  margin: 0 20px 20px;
  padding: 20px;
  border-radius: 12px;
  background: #f0fdfa;
  color: #115e59;
  text-align: center;
}

.hint {
  margin: 8px 0 0;
  font-size: 0.8rem;
  color: #6b7280;
}
</style>
