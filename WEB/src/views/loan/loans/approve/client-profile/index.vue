<script setup>
import { onMounted } from "vue";
import ClientLoanHistory from "@/views/loan/clients/client-profile/ClientLoanHistory.vue";
import ClientDepositHistory from "@/views/loan/clients/client-profile/ClientDepositHistory.vue";
import ClientNewLoan from "@/views/loan/clients/client-profile/ClientNewLoan.vue";
import { useRoute } from "vue-router";
import { api } from "@/utils/api";
import ClientLocation from "@/views/loan/clients/client-profile/ClientLocation.vue";
import ClientBio from "@/views/loan/clients/client-profile/ClientBio.vue";
import ClientImage from "@/views/loan/clients/client-profile/ClientImage.vue";

const props = defineProps({
  clientId: {
    type: String,
    required: false,
    default: null,
  },
  loanId: {
    type: String,
    required: false,
    default: null,
  },
});
// Page metadata
definePage({
  meta: {
    title: "Clients",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-clients",
    navActiveLink: "clients",
  },
});

const emit = defineEmits(["onClose", "onReload"]);

const route = useRoute();
const isLoading = ref(false);
const clientId = ref(props?.clientId);
const loanId = ref(props?.loanId);
const formData = ref({});
const loanData = ref({});

const initData = async () => {
  if (!clientId.value) return;
  try {
    isLoading.value = true;
    const res = await api.post("clients-show-profile", { id: clientId.value });
    if (res.data.status) {
      const clientData = res.data.data;
      formData.value = { ...formData.value, ...clientData };
    } else {
      error.value = "Failed to load client data.";
    }
  } catch (err) {
    error.value = "Error fetching client data.";
    console.error(err);
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  initData();
});

const onSubmit = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("loans-approve", loanData.value);
    if (res.data.status) {
      emit("onReload");
      emit("onClose");
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
const onReject = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("loans-reject", {
      id: loanId.value,
    });
    if (res.data.status) {
      emit("onReload");
      emit("onClose");
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <VRow>
    <VCol cols="12">
      <ClientBio
        :loading="isLoading"
        :item-data="formData"
        is-approve
        @onApprove="onSubmit"
        @onReject="onReject"
      />
    </VCol>
    <VCol cols="12">
      <ClientImage :item-data="formData" />
    </VCol>
    <VCol cols="12">
      <ClientNewLoan
        v-model:itemData="loanData"
        v-model:itemId="loanId"
        :loading="isLoading"
      />
    </VCol>
    <VCol cols="12">
      <ClientLoanHistory
        v-model:itemId="clientId"
        :loading="isLoading"
        class="mt-5"
      />
    </VCol>
    <VCol cols="12">
      <ClientLocation
        v-if="formData.location"
        v-model:center="formData.location"
        :center="formData.location"
      />
    </VCol>
  </VRow>
</template>
