<script setup>
definePage({
  meta: {
    title: "Dashboards",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
  },
});

import { api } from "@/utils/api";
import { useRouter } from "vue-router";
import ActivityLogsList from "@/views/admin/activity-logs/ActivityLogsList.vue";
import { useI18n } from "vue-i18n";

const router = useRouter();
const { t } = useI18n();

const isLoading = ref(false);
const items = ref({});

const getData = async () => {
  isLoading.value = true;
  try {
    const res = await api.post("admin-dashboards");
    if (res.data.status) {
      items.value = res.data.data;
    }
  } catch (error) {
  } finally {
    isLoading.value = false;
  }
};

const quickLinks = [
  {
    title: t("List Users"),
    icon: "tabler-users",
    color: "primary",
    route: { name: "admin-users" },
  },
  {
    title: t("Branches"),
    icon: "tabler-building",
    color: "info",
    route: { name: "admin-branches" },
  },
  {
    title: t("Roles"),
    icon: "tabler-shield-lock",
    color: "warning",
    route: { name: "admin-roles" },
  },
  {
    title: t("Positions"),
    icon: "tabler-id-badge",
    color: "secondary",
    route: { name: "admin-positions" },
  },
  {
    title: t("Activity Log"),
    icon: "tabler-file-text-shield",
    color: "error",
    route: { name: "admin-activity-log" },
  },
];

onMounted(() => {
  getData();
});
</script>

<template>
  <div>
    <VRow class="match-height">
      <VCol cols="6" sm="6" md="3">
        <VCard>
          <VCardText class="d-flex flex-column align-center justify-center">
            <VAvatar size="40" variant="tonal" color="success" rounded>
              <VIcon icon="tabler-user-check" />
            </VAvatar>
            <h5 class="text-h5 pt-2 mb-1">
              <VProgressCircular
                v-if="isLoading"
                indeterminate
                size="20"
                width="2"
              />
              <span v-else>{{ items.total_users_active ?? 0 }}</span>
            </h5>
            <div class="text-body-2 text-center">{{ $t("Active Users") }}</div>
          </VCardText>
        </VCard>
      </VCol>

      <VCol cols="6" sm="6" md="3">
        <VCard>
          <VCardText class="d-flex flex-column align-center justify-center">
            <VAvatar size="40" variant="tonal" color="success" rounded>
              <VIcon icon="tabler-home-check" />
            </VAvatar>
            <h5 class="text-h5 pt-2 mb-1">
              <VProgressCircular
                v-if="isLoading"
                indeterminate
                size="20"
                width="2"
              />
              <span v-else>{{ items.total_branches_active ?? 0 }}</span>
            </h5>
            <div class="text-body-2 text-center">
              {{ $t("Active Branches") }}
            </div>
          </VCardText>
        </VCard>
      </VCol>
    </VRow>

    <VRow class="mt-1">
      <VCol cols="12">
        <AppCard
          :title="$t('Quick Links')"
          title-icon="tabler-layout-grid"
          :is-back="false"
        >
          <VCardText>
            <VRow>
              <VCol
                v-for="link in quickLinks"
                :key="link.title"
                cols="6"
                sm="4"
                md="3"
              >
                <VCard
                  variant="tonal"
                  :color="link.color"
                  class="cursor-pointer"
                  @click="router.push(link.route)"
                >
                  <VCardText
                    class="d-flex flex-column align-center justify-center py-4"
                  >
                    <VIcon :icon="link.icon" size="28" />
                    <div class="text-center mt-2">{{ link.title }}</div>
                  </VCardText>
                </VCard>
              </VCol>
            </VRow>
          </VCardText>
        </AppCard>
      </VCol>
    </VRow>

    <VRow class="mt-1">
      <VCol cols="12">
        <ActivityLogsList :is-full-height="false" />
      </VCol>
    </VRow>
  </div>
</template>
