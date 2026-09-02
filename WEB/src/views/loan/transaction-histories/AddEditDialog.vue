<script setup>
import { ref, watch, nextTick, onMounted } from "vue";
import { debounce } from "lodash";
import AppAutocomplete from "@core/components/app-form-elements/AppAutocomplete.vue";
import { app } from "@/utils/app.js";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import { getBank } from "@/services/dataService";
import { api } from "@/utils/api";
import getImageUrl from "@/utils/image/getImageUrl";
import RadioIcon from "@/components/AppTowRadioIcon.vue";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({
      bank_id: 1,
      type: "new_transaction",
      transaction_date: new Date(),
    }),
  },
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    required: false,
  },
});

const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "onReload",
  "update:isDialogVisible",
]);

const itemData = ref({ ...props.itemData });
const banks = ref([]);
const loans = ref([]);
const isLoading = ref(false);

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = { ...newData };
  },
  { deep: true },
);

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    const itemId = itemData.value.id || null;
    if (itemId) {
    } else {
      onSubmit();
    }
  }
}, 500);

const onSubmit = async () => {
  isLoading.value = true;
  try {
    const res = await api.post("transaction-histories-store", itemData.value);
    if (res.data.status) {
      emit("onReload");
      onCloseDialog();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
    isLoading.value = false;
  } finally {
    isLoading.value = false;
  }
};

const onCloseDialog = () => {
  //   resetData();
  emit("update:isDialogVisible", false);
};

const dialogModelValueUpdate = (newVal) => {
  emit("update:isDialogVisible", newVal);
  isDialogVisible.value = newVal;
};

const getLoan = async () => {
  try {
    // previewFormDialog.value = true;
    isLoading.value = true;

    const res = await api.post("loans-all");

    if (res.data.status) {
      loans.value = res.data.data;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  getLoan();
  const [dataBank] = await Promise.all([getBank()]);
  banks.value = dataBank;
});

const propertyRadioContent = [
  {
    title: "New Transaction",
    icon: {
      icon: "tabler-check",
      size: "28",
    },
    value: "new_transaction",
  },
  {
    title: "Pre Transaction",
    icon: {
      icon: "tabler-stopwatch",
      size: "28",
    },
    value: "pre_transaction",
  },
];

watch(
  () => itemData.value.transaction_amount,
  (newVal) => {
    itemData.value.amount_tobe_receive = newVal;
  },
);
</script>

<template>
  <AppAddEditDialog
    v-model:loading="isLoading"
    :title="itemData.id == null ? 'Create Transaction' : 'Update Transaction'"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    max-width="1000"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.account_name"
          label="Sender Name"
          placeholder="ឈ្មោះអ្នកផ្ញើ"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.account_number"
          label="Sender Number"
          placeholder="លេខអ្នកផ្ញើ"
        />
      </VCol>

      <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.bank_id"
          label="Bank"
          placeholder="ធនាគារ"
          :items="banks"
          :item-title="
            (item) => {
              return `${item.name_kh}`;
            }
          "
          item-value="id"
        >
          <template #item="{ props, item }">
            <VListItem
              v-bind="props"
              :prepend-avatar="getImageUrl(item?.raw?.image_path)"
              :title="item?.raw?.name_kh"
              :subtitle="item?.raw?.name_en"
            />
          </template>
        </AppAutocomplete>
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.reference"
          label="Reference"
          placeholder="លេខយោង"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppDateTimePicker
          v-model="itemData.transaction_date"
          label="Transaction Date"
          :config="{
            enableTime: true,
            dateFormat: 'Y-m-d H:i',
            allowInput: true,
          }"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.transaction_amount"
          label="Transaction Amount"
          format-currency
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.loan_id"
          label="Loan"
          placeholder="កម្ចី"
          :items="loans"
          :item-title="
            (item) => {
              return `${item?.client?.name_kh}-${item?.client?.name_en}`;
            }
          "
          item-value="id"
        >
          <template #item="{ props, item }">
            <VListItem
              v-bind="props"
              :prepend-avatar="getImageUrl(item?.raw?.client?.image_path)"
              :title="`${item?.raw?.client?.name_kh}-${item?.raw?.client?.name_en}`"
              :subtitle="item?.raw?.code"
            /> </template
        ></AppAutocomplete>
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.amount_tobe_receive"
          label="Receive Amount"
          format-currency
        />
      </VCol>
      <VCol cols="12" sm="12" md="12">
        <AppTextarea
          v-model="itemData.description"
          label="Description"
          placeholder="បរិយាយ"
        />
      </VCol>
      <VCol cols="12" sm="12" md="12">
        <RadioIcon
          v-model:selected-radio="itemData.type"
          :radio-content="propertyRadioContent"
          :grid-column="{ cols: '12', sm: '6' }"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
