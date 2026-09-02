<script setup>
import { ref, computed, watch } from "vue";
import getImageUrl, { getThumbUrl } from "@/utils/image/getImageUrl";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import { useI18n } from "vue-i18n";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import AppAvatar from "@/components/AppAvatar.vue";
import formatContact from "@/utils/formater/formatContact";
import { useDialog } from "@/composables/useDialog";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isApprove: {
    type: Boolean,
    required: false,
    default: false,
  },
  loading: {
    type: Boolean,
    required: false,
    default: false,
  },
});
const { showDialog } = useDialog();
const { t } = useI18n();

const emit = defineEmits(["onApprove", "onReject"]);

// const showImage = (image) => {
//   imageUrlPath.value = image ? getImageUrl(image) : avatar1;
//   isImageDialog.value = true;
// };

const getAge = (birthDate) => {
  return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e10);
};

const getVillage = (item) => {
  if (!item) {
    return;
  }

  return `${item.name_kh}/${item.commune.name_kh}/${item.commune.district.name_kh}/${item.commune.district.province.name_kh}`;
};

// Use computed to make clientDetails reactive to props and i18n changes
const clientDetails = computed(() => [
  {
    title: t("Date of birth"),
    value: `${formatDate(props.itemData?.dob) || "-"} (${
      getAge(props.itemData?.dob) || "-"
    })`,
  },
  // { title: t("Age"), value: getAge(props.itemData?.dob) || "-" },
  { title: t("Occupation"), value: props.itemData?.occupation?.name_kh || "-" },
  {
    title: t("Main Source Income"),
    value: props.itemData?.main_source_income?.name_kh || "-",
  },
  {
    title: t("Daily Income Amount"),
    value: `${formatCurrency(props.itemData?.monthly_income_amount)}` || "-",
  },
  {
    title: t("Address"),
    value: getVillage(props.itemData?.village || null) || "-",
  },
  {
    title: t("Branch"),
    value: props.itemData?.branch?.name_kh || "-",
  },
]);

const onApprove = async () => {
  let result = await showDialog({
    title: t("Approve this loan?"),
    icon: "warning",
    confirmColor: "success",
    confirmText: "Approve",
  });

  if (result) {
    // await refForm.value.onSubmit();
    emit("onApprove");
  }
};

const onReject = async () => {
  let result = await showDialog({
    title: t("Reject this loan?"),
    icon: "warning",
    confirmColor: "error",
    confirmText: "Reject",
  });

  if (result) {
    // await refForm.value.onSubmit();
    emit("onReject");
  }
};
</script>

<template>
  <VRow class="match-height">
    <VCol cols="12" md="4">
      <VCard min-height="350px" class="d-flex justify-center align-center">
        <VCardText
          class="d-flex flex-column justify-center align-center"
          style="padding: 0px"
        >
          <div class="d-flex flex-column align-center">
            <AppAvatar
              :image="itemData.image_path"
              :size="130"
              :title="itemData.name_kh"
              :q="100"
            />
            <span class="mt-2" style="font-size: 14px; color: #343434">
              {{ itemData.name_en }}
            </span>
            <span
              class="mt-2 mb-2 font-weight-bold"
              style="font-size: 20px; color: #343434"
            >
              {{ itemData.name_kh }}
              <VChip v-if="itemData.ever_black_list" size="small" color="error">
                ធ្លាប់ក្នុងបញ្ចីខ្មៅ
              </VChip>
            </span>

            <span class="mb-2" style="font-size: 14px">
              {{ itemData.code }}
            </span>
            <div class="d-flex flex-row">
              <span class="align-center" style="font-size: 14px">
                <VIcon size="small">tabler-phone</VIcon>
                {{ itemData.contact ? formatContact(itemData.contact) : "N/A" }}
              </span>
              &nbsp;&nbsp;&nbsp;
              <span style="font-size: 14px">
                <VIcon size="small">tabler-id</VIcon>
                {{
                  itemData?.national_id_number
                    ? itemData?.national_id_number
                    : "N/A"
                }}
              </span>
            </div>
          </div>
          <VDivider />

          <VRow class="w-100 mt-2" v-if="isApprove">
            <VCol cols="6" class="pb-0">
              <VBtn class="w-100" color="error" @click="onReject">
                <VIcon start>tabler-x</VIcon> {{ $t("Rejected") }}
              </VBtn>
            </VCol>

            <VCol cols="6" class="pb-0">
              <VBtn class="w-100" color="success" @click="onApprove">
                <VIcon start>tabler-check</VIcon> {{ $t("Approve") }}
              </VBtn>
            </VCol>
          </VRow>
        </VCardText>
      </VCard>
    </VCol>
    <VCol cols="12" md="8">
      <AppCard
        title="Client Information"
        title-icon="tabler-user"
        :loading="loading"
      >
        <VCardText class="text-center" style="padding: 0px">
          <template v-for="(item, index) in clientDetails">
            <div class="d-flex flex-row pa-2">
              <span style="width: 30%; text-align: start">{{
                item.title
              }}</span>
              <span style="width: 70%; text-align: start; color: #343434">{{
                item.value
              }}</span>
            </div>
            <VDivider
              class="pt-1 pb-1"
              v-if="index != clientDetails.length - 1"
            />
          </template>
        </VCardText>
      </AppCard>
    </VCol>
  </VRow>
</template>
