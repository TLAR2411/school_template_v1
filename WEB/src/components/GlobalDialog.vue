<template>
  <!-- ===== Confirmation dialog (single modal) ===== -->
  <VDialog v-model="isOpen" persistent max-width="340">
    <VCard class="confirm-card" :class="`confirm-${icon}`">
      <div class="confirm-inner">
        <div class="confirm-icon-wrap">
          <VIcon :icon="dialogIconMapping[icon]" size="30" />
        </div>

        <h3 class="confirm-title" style="font-family: Public Sans">
          {{ labelMapping[icon] || "Confirm" }}
        </h3>
        <p
          class="confirm-message"
          style="
            font-family:
              Public Sans,
              notosans,
              sans-serif;
          "
        >
          {{ title }}
        </p>

        <div class="confirm-actions">
          <VBtn
            v-if="isCancle"
            variant="tonal"
            color="secondary"
            class="confirm-btn confirm-btn-cancel"
            size="small"
            @click="onCancel"
          >
            {{ cancelText ? $t(cancelText) : "" }}
          </VBtn>
          <VBtn
            v-if="isConfirm"
            :color="confirmColor"
            variant="flat"
            class="confirm-btn"
            size="small"
            @click="onConfirm"
          >
            {{ confirmText ? $t(confirmText) : "" }}
          </VBtn>
        </div>
      </div>
    </VCard>
  </VDialog>

  <!-- ===== Toasts (stacked, multiple) ===== -->
  <!-- One wrapper at top-center; each toast stacks vertically inside. -->
  <div class="toast-stack">
    <TransitionGroup name="toast">
      <div
        v-for="t in toasts"
        :key="t.id"
        class="toast-item"
        :class="`toast-${t.icon}`"
      >
        <div class="toast-row">
          <span class="toast-badge">
            <VIcon :icon="iconMapping[t.icon]" size="16" color="#fff" />
          </span>
          <div class="toast-body">
            <p class="toast-title" style="font-family: Public Sans">
              {{ labelMapping[t.icon] }}
            </p>
            <p
              v-if="t.title"
              class="toast-subtitle"
              style="
                font-family:
                  Public Sans,
                  notosans,
                  sans-serif;
              "
            >
              {{ t.title }}
            </p>
          </div>
          <VBtn
            icon="tabler-x"
            size="x-small"
            variant="text"
            class="toast-close"
            @click="removeToast(t.id)"
          />
        </div>
      </div>
    </TransitionGroup>
  </div>
</template>

<script setup>
import { ref } from "vue";

/* ===== Dialog state (single modal) ===== */
const isOpen = ref(false);
const isCancle = ref(true);
const isConfirm = ref(true);
const title = ref("");
const icon = ref(null);
const confirmColor = ref("primary");
let resolvePromise = null;

const cancelText = ref(null);
const confirmText = ref(null);

/* ===== Toast state (array → multiple) ===== */
const toasts = ref([]);
let toastSeq = 0;

const iconMapping = {
  success: "tabler-check",
  error: "tabler-x",
  warning: "tabler-alert-triangle",
  info: "tabler-info-circle",
};

const labelMapping = {
  success: "Success",
  error: "Error",
  warning: "Warning",
  info: "Info",
  delete: "Delete",
};

const dialogIconMapping = {
  success: "tabler-check-filled",
  error: "tabler-alert-circle-filled",
  warning: "tabler-alert-triangle-filled",
  info: "tabler-info-circle-filled",
  delete: "tabler-trash-filled",
};

/* ===== Toast API ===== */
const addToast = (toastTitle, toastIcon, delay) => {
  const id = ++toastSeq;
  const base = delay > 0 ? delay : 3000;
  // small stagger based on stack position so simultaneous toasts don't all
  // expire on the same frame
  const stagger = toasts.value.length * 150;
  const duration = base + stagger;

  const timerId = setTimeout(() => removeToast(id), duration);
  toasts.value.push({ id, title: toastTitle, icon: toastIcon, timerId });
};

const removeToast = (id) => {
  const t = toasts.value.find((t) => t.id === id);
  if (t && t.timerId) {
    clearTimeout(t.timerId); // cancel the pending auto-dismiss
  }
  toasts.value = toasts.value.filter((t) => t.id !== id);
};

/* ===== Main entry point =====
   Accepts EITHER an options object:
     openDialog({ title, icon, isConfirm, timer, ... })
   OR legacy positional args:
     openDialog(title, icon, isCancel, isConfirm, confirmColor, timer, cancelText, confirmText)
   timer > 0  → show a toast (can stack many at once)
   timer == 0 → show the confirmation dialog (single, returns a Promise) */
const openDialog = (arg = {}, ...rest) => {
  // Normalize: if first arg is an object, use it; otherwise treat args as positional.
  let opts;
  if (arg && typeof arg === "object" && !Array.isArray(arg)) {
    opts = arg;
  } else {
    opts = {
      title: arg,
      icon: rest[0],
      isCancel: rest[1],
      isConfirm: rest[2],
      confirmColor: rest[3],
      timer: rest[4],
      cancelText: rest[5],
      confirmText: rest[6],
    };
  }

  const {
    title: optTitle = "",
    icon: optIcon = null,
    isCancel: optIsCancel = true,
    isConfirm: optIsConfirm = true,
    confirmColor: optConfirmColor = "primary",
    timer: optTimer = 0,
    cancelText: optCancelText = "Close",
    confirmText: optConfirmText = "OK",
  } = opts;

  // Toast path
  if (optTimer > 0) {
    addToast(optTitle, optIcon, optTimer);
    return Promise.resolve(true);
  }

  // Dialog path
  title.value = optTitle;
  icon.value = optIcon;
  isOpen.value = true;
  isCancle.value = optIsCancel ?? true;
  isConfirm.value = optIsConfirm ?? true;
  confirmColor.value = optConfirmColor ?? "primary";
  cancelText.value = optCancelText ?? "Close";
  confirmText.value = optConfirmText ?? "OK";

  return new Promise((resolve) => {
    resolvePromise = resolve;
  });
};

const onConfirm = () => {
  isOpen.value = false;
  if (resolvePromise) resolvePromise(true);
};

const onCancel = () => {
  isOpen.value = false;
  if (resolvePromise) resolvePromise(false);
};

defineExpose({ openDialog });
</script>

<style scoped>
.toast-badge :deep(svg) {
  stroke-width: 3 !important;
}
/* ===== Confirmation dialog ===== */
.confirm-card {
  border-radius: 8px !important;
  overflow: hidden;
}
.confirm-inner {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
  padding: 28px 24px 22px;
}
.confirm-icon-wrap {
  flex: 0 0 auto;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 56px !important;
  height: 56px !important;
  min-width: 56px;
  border-radius: 50%;
  border: 2px solid currentColor;
  margin-bottom: 14px;
}
.confirm-title {
  margin: 0 0 6px;
  font-size: 19px;
  font-weight: 500;
  line-height: 1.3;
}
.confirm-message {
  margin: 0 0 22px;
  font-size: 14px;
  line-height: 1.5;
  opacity: 0.7;
}
.confirm-actions {
  display: flex;
  gap: 10px;
  width: 100%;
}
.confirm-btn {
  flex: 1;
  height: 38px !important;
  border-radius: 6px !important;
  font-size: 14px;
  font-weight: 500;
  text-transform: none;
  letter-spacing: 0;
}
.confirm-btn-cancel {
  background: rgba(127, 127, 127, 0.12) !important;
}

/* per-variant accent color for the icon ring + glyph */
.confirm-success .confirm-icon-wrap {
  color: #1d9e75;
}
.confirm-error .confirm-icon-wrap,
.confirm-delete .confirm-icon-wrap {
  color: #e24b4a;
}
.confirm-warning .confirm-icon-wrap {
  color: #ef9f27;
}
.confirm-info .confirm-icon-wrap {
  color: #378add;
}

/* ===== Toast stack ===== */
/* The wrapper centers the column at the top of the viewport. */
.toast-stack {
  position: fixed;
  top: 12px;
  left: 50%;
  transform: translateX(-50%);
  z-index: 3000;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 10px;
  pointer-events: none;
  width: max-content;
  max-width: calc(100vw - 24px);
}

/* Each toast is a plain styled card — no Vuetify overlay involved. */
.toast-item {
  pointer-events: auto;
  min-width: 280px;
  max-width: 380px;
  border-radius: 8px;
  padding: 11px 14px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.18);
}

/* ===== TransitionGroup animations ===== */
/* enter: fade + slide down into place */
.toast-enter-from {
  opacity: 0;
  transform: translateY(-12px);
}
.toast-enter-to {
  opacity: 1;
  transform: translateY(0);
}
.toast-enter-active {
  transition:
    opacity 0.25s ease,
    transform 0.25s ease;
}

/* leave: fade + slide up, with width/height collapsing handled by move */
.toast-leave-active {
  transition:
    opacity 0.2s ease,
    transform 0.2s ease,
    margin 0.25s ease,
    max-height 0.25s ease,
    padding 0.25s ease;
  overflow: hidden;
}
.toast-leave-from {
  opacity: 1;
  transform: translateY(0);
  max-height: 80px; /* roughly the toast's natural height */
}
.toast-leave-to {
  opacity: 0;
  transform: translateY(-12px);
  max-height: 0;
  margin-top: -10px; /* offset the stack gap as it collapses */
  padding-top: 0;
  padding-bottom: 0;
}
/* move: when a toast leaves, the remaining ones glide into their new spot */
.toast-move {
  transition: transform 0.25s ease;
}

.toast-row {
  display: flex;
  align-items: center;
  gap: 13px;
}
.toast-badge {
  flex-shrink: 0;
  width: 25px;
  height: 25px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}
.toast-body {
  flex: 1;
  min-width: 0;
}
.toast-title {
  margin: 0;
  font-size: 14px;
  font-weight: 500;
  line-height: 1.3;
  color: #fff;
}
.toast-subtitle {
  margin: 1px 0 0;
  font-size: 12px;
  line-height: 1.3;
  color: rgba(255, 255, 255, 0.85);
}
.toast-close {
  flex-shrink: 0;
  color: rgba(255, 255, 255, 0.8) !important;
}

/* success */
.toast-success {
  background: #1d9e75;
}
.toast-success .toast-badge {
  background: #0f6e56;
}

/* error */
.toast-error {
  background: #e24b4a;
}
.toast-error .toast-badge {
  background: #a32d2d;
}

/* warning */
.toast-warning {
  background: #ef9f27;
}
.toast-warning .toast-badge {
  background: #ba7517;
}
.toast-warning .toast-subtitle {
  color: rgba(255, 255, 255, 0.92);
}

/* info */
.toast-info {
  background: #378add;
}
.toast-info .toast-badge {
  background: #185fa5;
}
</style>
