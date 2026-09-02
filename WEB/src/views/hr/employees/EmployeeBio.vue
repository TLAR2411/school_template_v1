<script setup>
import { ref, computed, watch } from "vue";
import getImageUrl from "@/utils/image/getImageUrl";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import { useI18n } from "vue-i18n";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  loading: {
    type: Boolean,
    required: false,
    default: false,
  },
});

const isImageDialog = ref(false);
const imageUrlPath = ref(null);
const { t } = useI18n();

const showImage = (image) => {
  imageUrlPath.value = image ? getImageUrl(image) : avatar1;
  isImageDialog.value = true;
};

const getAge = (birthDate) => {
  return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e10);
};

const getVillage = (item) => {
  if (!item) {
    return;
  }

  return `${item.name_kh}/${item.commune.name_kh}/${item.commune.district.name_kh}/${item.commune.district.province.name_kh}`;
};

// Use computed to make employeeDetails reactive to props and i18n changes
const employeeDetails = computed(() => [
  {
    title: t("Date of birth"),
    value: `${props.itemData?.dob ? formatDate(props.itemData?.dob) : "-"} (${
      getAge(props.itemData?.dob) || "-"
    })`,
  },
  {
    title: t("Position"),
    value: props.itemData?.position?.name_kh || "-",
  },
  {
    title: t("Bank Account"),
    value: props.itemData?.bank_account_number || "-",
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
</script>

<template>
  <ShowImageDialog
    v-model:isDialogVisible="isImageDialog"
    :image="imageUrlPath"
  />
  <VRow class="match-height">
    <VCol cols="12" sm="4">
      <VCard class="d-flex justify-center align-center">
        <VCardText
          class="d-flex justify-center align-center"
          style="padding: 0px"
        >
          <div class="d-flex flex-column align-center">
            <VAvatar :size="100">
              <VImg
                :src="getImageUrl(itemData?.image_path) || avatar1"
                @click="itemData?.image_path && showImage(itemData.image_path)"
              />
            </VAvatar>

            <span class="mt-5 mb-2" style="font-size: 18px; color: #343434">
              {{ itemData.name_kh }}
            </span>

            <span class="mb-2" style="font-size: 16px">
              {{ itemData.code }}
            </span>
            <span
              class="text-primary align-center mb-2"
              style="font-size: 16px"
            >
              <VIcon v-if="itemData?.contact" size="small">tabler-phone</VIcon>
              {{ itemData.contact || "N/A" }}
            </span>
            <span v-if="itemData?.national_id_number" style="font-size: 16px">
              <VIcon size="small">tabler-id</VIcon>
              {{ itemData?.national_id_number }}
            </span>
          </div>
        </VCardText>
      </VCard>
    </VCol>
    <VCol cols="12" sm="8">
      <AppCard
        title="Employee Information"
        title-icon="tabler-user"
        :loading="loading"
      >
        <VCardText class="text-center" style="padding: 0px">
          <template v-for="(item, index) in employeeDetails">
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
              v-if="index != employeeDetails.length - 1"
            />
          </template>
        </VCardText>
      </AppCard>
    </VCol>
  </VRow>
</template>
