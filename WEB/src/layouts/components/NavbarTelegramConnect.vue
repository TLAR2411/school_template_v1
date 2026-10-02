<script setup>
import { api } from "@/utils/api";

const isDialogOpen = ref(false);
const isLoading = ref(false);
const isDisconnecting = ref(false);
const errorMessage = ref("");
const status = ref(null);
const pendingConnect = ref(false);

const isConnected = computed(
  () =>
    !!(
      status.value?.connected ||
      status.value?.personal_connected ||
      status.value?.group_linked
    ),
);

const openDialog = async () => {
  isDialogOpen.value = true;
  await refreshStatus();
};

const refreshStatus = async () => {
  isLoading.value = true;
  errorMessage.value = "";

  try {
    const { data } = await api.get("telegram-connection/status");
    status.value = data;

    if (
      pendingConnect.value &&
      (data?.connected || data?.personal_connected || data?.group_linked)
    ) {
      pendingConnect.value = false;
    }
  } catch (error) {
    status.value = null;
    errorMessage.value =
      error?.response?.data?.message || "Failed to load Telegram status";
  } finally {
    isLoading.value = false;
  }
};

const connectTelegram = () => {
  const link = status.value?.link;
  if (!link) return;

  pendingConnect.value = true;
  window.open(link, "_blank", "noopener,noreferrer");
  isDialogOpen.value = false;
};

const disconnect = async () => {
  isDisconnecting.value = true;
  errorMessage.value = "";

  try {
    await api.post("telegram-connection/disconnect");
    status.value = null;
    pendingConnect.value = false;
    isDialogOpen.value = false;
  } catch (error) {
    errorMessage.value =
      error?.response?.data?.message || "Failed to disconnect Telegram";
  } finally {
    isDisconnecting.value = false;
  }
};

const onWindowFocus = () => {
  if (isDialogOpen.value || pendingConnect.value) {
    refreshStatus();
  }
};

onMounted(() => {
  window.addEventListener("focus", onWindowFocus);
});

onUnmounted(() => {
  window.removeEventListener("focus", onWindowFocus);
});
</script>

<template>
  <IconBtn
    class="jusitify-end"
    :aria-label="$t('Connect Telegram')"
    @click="openDialog"
  >
    <VIcon
      size="26"
      icon="tabler-brand-telegram"
      color="info"
      :color="isConnected ? 'info' : 'secondary'"
    />
    <VTooltip activator="parent" open-delay="500" scroll-strategy="close">
      <span>{{
        isConnected ? $t("Disconnect Telegram") : $t("Connect Telegram")
      }}</span>
    </VTooltip>
  </IconBtn>

  <VDialog v-model="isDialogOpen" max-width="420">
    <VCard>
      <VCardTitle class="d-flex align-center justify-space-between">
        <div class="d-flex align-center gap-2">
          <VIcon icon="tabler-brand-telegram" color="info" />
          <span>{{ $t("Telegram") }}</span>
        </div>
        <VBtn icon variant="text" size="small" @click="isDialogOpen = false">
          <VIcon icon="tabler-x" />
        </VBtn>
      </VCardTitle>

      <VDivider />

      <VCardText>
        <div v-if="isLoading" class="d-flex justify-center py-6">
          <VProgressCircular indeterminate color="primary" />
        </div>

        <template v-else>
          <VAlert
            v-if="errorMessage"
            type="error"
            variant="tonal"
            density="compact"
            class="mb-4"
          >
            {{ errorMessage }}
          </VAlert>

          <p class="text-body-2 text-medium-emphasis mb-4">
            {{
              isConnected
                ? $t("Disconnect Telegram description")
                : $t("Connect Telegram description")
            }}
          </p>

          <div
            v-if="isConnected && status?.telegram_username"
            class="mb-4 text-body-2"
          >
            <strong>{{ $t("Username") }}:</strong>
            @{{ status.telegram_username }}
          </div>

          <VBtn
            v-if="!isConnected"
            block
            color="info"
            prepend-icon="tabler-brand-telegram"
            :disabled="!status?.link"
            @click="connectTelegram"
          >
            {{ $t("Connect Telegram") }}
          </VBtn>

          <VBtn
            v-else
            block
            color="error"
            variant="tonal"
            prepend-icon="tabler-unlink"
            :loading="isDisconnecting"
            @click="disconnect"
          >
            {{ $t("Disconnect") }}
          </VBtn>
        </template>
      </VCardText>

      <VDivider />

      <VCardActions class="pa-4">
        <VSpacer />
        <VBtn variant="text" @click="isDialogOpen = false">
          {{ $t("Close") }}
        </VBtn>
      </VCardActions>
    </VCard>
  </VDialog>
</template>
