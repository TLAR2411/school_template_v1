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
      <p class="report-card__eyebrow">Student Report · English</p>
      <h1 class="report-card__title">
        {{ report.student?.name_en || report.student?.name_kh }}
      </h1>
      <p
        v-if="report.student?.name_kh && report.student?.name_en"
        class="report-card__subtitle"
      >
        {{ report.student.name_kh }}
      </p>
    </header>

    <section class="report-card__meta">
      <div class="meta-row">
        <span>Class</span>
        <strong>{{ report.class?.name_en || report.class?.name_kh || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>Grade</span>
        <strong>{{ report.class?.grade?.name_en || report.class?.grade?.name_kh || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>School Year</span>
        <strong>{{ report.class?.year?.name || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>Shift</span>
        <strong>{{ report.class?.shift?.name_en || report.class?.shift?.name_kh || "—" }}</strong>
      </div>
      <div class="meta-row">
        <span>Curriculum</span>
        <strong>{{ report.curriculum?.name_en || report.curriculum?.name_kh || "EN" }}</strong>
      </div>
    </section>

    <section class="report-card__placeholder">
      <p>Score table will appear here.</p>
      <p class="hint">Placeholder — wire score API next.</p>
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
  background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
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
  background: #eff6ff;
  color: #1e40af;
  text-align: center;
}

.hint {
  margin: 8px 0 0;
  font-size: 0.8rem;
  color: #6b7280;
}
</style>
