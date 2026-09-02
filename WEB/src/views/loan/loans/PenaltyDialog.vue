<script setup>
import { ref, watch, nextTick } from "vue";
import { debounce } from "lodash";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import { api } from "@/utils/api.js";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import AppTextField from "@core/components/app-form-elements/AppTextField.vue";
import getImageUrl from "@/utils/image/getImageUrl.js";
import { useDialog } from "@/composables/useDialog.js";
import { useI18n } from "vue-i18n";
import CustomCheckboxes from "@/@core/components/app-form-elements/CustomCheckboxes.vue";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const { t } = useI18n();
const { showDialog } = useDialog();
const isLoading = ref(false);
const loanInfo = ref({});

const selectedCheckbox = ref([]);

const checkboxContent = [
  {
    title: t("Late Penalty"),
    desc: t("Only In Schedule"),
    value: "id_late_penalty",
  },
  {
    title: t("Overdue Penalty"),
    desc: t("After End Date"),
    value: "id_overdue_penalty",
  },
];

const inintFormData = () => ({
  is_late_penalty: true,
  is_overdue_penalty: true,
});

const formData = ref(inintFormData());

const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "onReload",
  "update:isDialogVisible",
]);

const itemData = ref({ ...props.itemData });

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = { ...newData };
  },
  { deep: true },
);

const resetData = () => {
  inintFormData();
};

const initData = async () => {
  formData.value.loan_id = itemData.value.loan_id;
  const res = await api.post("loans-show", {
    id: itemData.value.loan_id,
  });
  if (res.data.status) {
    formData.value.is_late_penalty = res?.data?.data?.is_late_penalty;
    formData.value.is_overdue_penalty = res?.data?.data?.is_overdue_penalty;
    formData.value.freeze_penalty_amount =
      res?.data?.data?.freeze_penalty_amount;

    loanInfo.value = res.data.data;
    console.log(loanInfo.value);

    const selection = [];
    if (formData.value.is_late_penalty) selection.push("id_late_penalty");
    if (formData.value.is_overdue_penalty) selection.push("id_overdue_penalty");
    selectedCheckbox.value = selection;
  }
};

onMounted(async () => {
  isLoading.value = true;
  await initData();
  isLoading.value = false;
});

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    let result = await showDialog({
      title: t("Do you want to store this record?"),
      icon: "warning",
      confirmColor: "error",
    });

    if (result) {
      try {
        isLoading.value = true;

        const res = await api.post("loans-penalty", formData.value);

        if (res.data.status) {
          resetData();
          initData();
          emit("onReload");
          onCloseDialog();
        } else {
          console.error("Error with the response:", res.data);
        }
      } catch (error) {
        console.error("Failed to fetch data:", error);
      } finally {
        isLoading.value = false;
      }
    }
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

watch(selectedCheckbox, (newValue) => {
  formData.value.is_late_penalty = newValue.includes("id_late_penalty");
  formData.value.is_overdue_penalty = newValue.includes("id_overdue_penalty");
});
</script>

<template>
  <AppAddEditDialog
    title="Penalty"
    icon="tabler-coin"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="isLoading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12">
        <div class="border pa-3 rounded">
          <div class="d-flex flex-row align-center">
            <VAvatar rounded :size="50" border>
              <VImg
                v-if="loanInfo?.client?.image_path"
                :src="getImageUrl(loanInfo?.client?.image_path)"
                @click="showImage(null)"
              />
              <VImg v-else :src="avatar1" @click="showImage(null)" />
            </VAvatar>
            <div class="d-flex flex-column ml-5 align-start">
              <span style="font-size: 14px"
                >{{ loanInfo?.client?.name_kh }}
                <template v-if="loanInfo?.client?.village?.name_kh">
                  <VChip size="small">
                    {{ loanInfo?.client?.village?.name_kh }}
                  </VChip></template
                ></span
              >
              <span class="text-primary" style="font-size: 14px">{{
                loanInfo.code
              }}</span>
            </div>
          </div>
        </div>
      </VCol>
      <VCol cols="12">
        <CustomCheckboxes
          v-model:selected-checkbox="selectedCheckbox"
          :checkbox-content="checkboxContent"
          :grid-column="{ sm: '6', cols: '12' }"
        />
      </VCol>
      <VCol cols="12">
        <AppTextField
          label="Freeze Penalty"
          v-model="formData.freeze_penalty_amount"
          format-currency
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
