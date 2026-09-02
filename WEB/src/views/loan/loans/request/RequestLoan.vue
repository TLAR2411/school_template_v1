<script setup>
import { ref } from "vue";
import ClientInfo from "./ClientInfo.vue";
import LoanInfo from "./LoanInfo.vue";
import { api } from "@/utils/api";
import PreviewForm from "./PreviewForm.vue";
import { useLoanStore } from "@/stores/loanStore";

definePage({
  meta: {
    title: "Request Loans",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "add-loans",
  },
});

// const emit = defineEmits(["reload"]);

const clientInfo = ref({});
const loanInfo = ref({});
const selectedClient = ref({});
const isLoading = ref(true);
const clientRef = ref(null);
const loanRef = ref(null);
const previewFormDialog = ref(false);
const loanStore = useLoanStore();

const onSubmit = async (refForm) => {
  if (isLoading.value) return;
  const { valid } = await refForm;
  if (valid) {
    try {
      if (isLoading.value) return;
      // previewFormDialog.value = true;
      isLoading.value = true;

      const res = await api.post("loans-request", {
        ...clientInfo.value,
        ...loanInfo.value,
      });

      if (res.data.status) {
        loanMode.value = 1;
        clientRef.value.restForm();
        loanRef.value.restForm();

        loanStore?.fetchApprovalCount();
        // emit("reload");
      } else {
        console.error("Error with the response:", res.data);
      }
    } catch (error) {
      console.error("Failed to fetch data:", error);
    } finally {
      isLoading.value = false;
    }
  }
};
const loanMode = ref(1);
const loanModeSelect = [
  { name: "Auto", value: 1 },
  { name: "Manual", value: 2 },
];
</script>

<template>
  <PreviewForm v-model:isDialogVisible="previewFormDialog" />
  <VRow class="match-height">
    <VCol>
      <AppCard
        :loading="isLoading"
        title="Request Loans"
        title-icon="tabler-file-pencil"
        is-submit
        is-clear
        is-check-branch
        :isHeader="true"
        footer-align="justify-space-between"
        @on-submit="onSubmit"
        @on-clear="
          () => {
            clientRef.restForm();
            loanRef.restForm();
          }
        "
      >
        <!-- <template #card-header>
          <VCol
            cols="6"
            sm="4"
            md="3"
            lg="2"
            v-if="hasPermission('loan-mode-loans')"
          >
            <AppSelect
              v-model="loanMode"
              :items="loanModeSelect"
              item-title="name"
              item-value="value"
            />
          </VCol>
        </template> -->
        <ClientInfo
          ref="clientRef"
          v-model="clientInfo"
          v-model:loanInfo="loanInfo"
          v-model:selectedClient="selectedClient"
          v-model:loading="isLoading"
        />
        <LoanInfo
          ref="loanRef"
          v-model="loanInfo"
          v-model:selectedClient="selectedClient"
          :loan-mode="loanMode"
          v-model:loading="isLoading"
        />
      </AppCard>
    </VCol>
  </VRow>
</template>
