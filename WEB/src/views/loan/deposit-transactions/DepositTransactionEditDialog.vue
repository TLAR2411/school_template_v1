<script setup>
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import { api } from "@/utils/api";
import formatContact from "@/utils/formater/formatContact";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: false,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const isLoading = ref(false);
const emit = defineEmits([
  "update:isDialogVisible",
  "update:loading",
  "onSubmit",
]);
const onCloseDialog = () => {
  emit("update:isDialogVisible", false);
};
const clientInfo = ref({});
const formData = ref({
  client_id: props.itemData.client_id,
  client_branch_id: null,
  deposit_amount: 0,
  withdraw_amount: 0,
  transition_date: null,
  description: null,
});

onMounted(async () => {
  try {
    isLoading.value = true;
    const res = await api.post("clients-show-details", {
      id: props.itemData.client_id,
    });
    if (res.data.status) {
      formData.value.client_branch_id = res.data.data.branch_id;
      clientInfo.value = res.data.data;
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
});

const onSubmit = async () => {
  emit("onSubmit", formData.value);
};
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    persistent
    class="v-dialog-xl"
    max-width="1000px"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="onCloseDialog" />

    <!-- Dialog Content -->
    <VCard>
      <VCardItem style="padding-top: 12px; padding-bottom: 12px">
        <span style="font-size: 18px">
          <VIcon>tabler-edit</VIcon>
          {{ $t("Edit Deposit Transactions") }}
        </span>
      </VCardItem>
      <VDivider class="pa-0 ma-0" />
      <VCardText class="mt-0 mb-0">
        <VRow>
          <VCol cols="12" sm="12" md="6" lg="6">
            <div class="d-flex flex-row">
              <AppAvatar
                :title="clientInfo.name_kh"
                :image="clientInfo.image_path"
                size="190"
                :q="100"
              />
              <div class="d-flex flex-column ml-2 w-100">
                <div class="d-flex flex-column ml-2">
                  <span style="font-size: 12px">{{ $t("Client Name") }}</span>
                  <span class="text-primary"
                    ><b>{{ clientInfo.name_kh }}</b></span
                  >
                </div>
                <VDivider class="w-100 mt-1 mb-1" />
                <div class="d-flex flex-column ml-2">
                  <span style="font-size: 12px">{{ $t("Village") }}</span>
                  <span class="text-primary"
                    ><b>{{
                      clientInfo.village?.name_kh
                        ? clientInfo.village?.name_kh
                        : "N/A"
                    }}</b></span
                  >
                </div>
                <VDivider class="w-100 mt-1 mb-1" />
                <div class="d-flex flex-column ml-2">
                  <span style="font-size: 12px">{{ $t("Contact") }}</span>
                  <span class="text-primary"
                    ><b>{{
                      clientInfo.contact
                        ? formatContact(clientInfo.contact)
                        : "N/A"
                    }}</b></span
                  >
                </div>
                <VDivider class="w-100 mt-1 mb-1" v-if="clientInfo.last_loan" />
                <div
                  class="d-flex flex-column ml-2"
                  v-if="clientInfo.last_loan"
                >
                  <span style="font-size: 12px">{{
                    $t("Credit Officer")
                  }}</span>
                  <span class="text-primary"
                    ><b>{{ clientInfo.last_loan?.co?.name_kh }}</b></span
                  >
                </div>
              </div>
            </div>
          </VCol>
          <VDivider vertical />
          <VCol cols="12" sm="12" md="6" lg="6">
            <VRow>
              <VCol cols="12" sm="12" md="6" lg="6">
                <AppTextField
                  v-model="formData.deposit_amount"
                  label="Deposit Amount"
                  format-currency
                />
              </VCol>
              <VCol cols="12" sm="12" md="6" lg="6">
                <AppTextField
                  v-model="formData.withdraw_amount"
                  label="Withdraw Amount"
                  format-currency
                />
              </VCol>
              <VCol cols="12" sm="12" md="12" lg="12">
                <AppDateTimePicker
                  v-model="formData.transition_date"
                  label="Transaction Date"
                />
              </VCol>
              <!-- <VCol cols="12" sm="12" md="12" lg="12">
                <AppTextField
                  v-model="formData.description"
                  label="Description"
                />
              </VCol> -->
            </VRow>
          </VCol>
        </VRow>
      </VCardText>

      <VDivider />
      <VCardText
        class="d-flex justify-end gap-3 flex-wrap"
        style="padding-top: 12px; padding-bottom: 12px"
      >
        <VBtn color="secondary" variant="tonal" @click="onCloseDialog">
          <VIcon start icon="tabler-arrow-left" />
          {{ $t("Close") }}
        </VBtn>
        <VBtn @click="onSubmit">
          <VIcon start icon="tabler-check" />
          {{ $t("Submit") }}
        </VBtn>
      </VCardText>
    </VCard>
  </VDialog>
</template>
