<script setup>
import { ref, computed, watch } from "vue";
import getImageUrl, { getThumbUrl } from "@/utils/image/getImageUrl";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import { useI18n } from "vue-i18n";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import AppAvatar from "@/components/AppAvatar.vue";
import formatContact from "@/utils/formater/formatContact";
import AppImage from "@/components/AppImage.vue";

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

const isImageDialog = ref(false);
const imageUrlPath = ref(null);
const { t } = useI18n();
</script>

<template>
  <VRow class="match-height">
    <VCol cols="12">
      <VCard>
        <VCardText>
          <VRow>
            <VCol
              cols="12"
              sm="3"
              class="d-flex flex-column justify-center align-center"
            >
              <!-- <AppAvatar
                :image="itemData.image_path_home"
                :size="150"
                title="?"
              /> -->
              <AppImage
                :image="itemData.image_path_home"
                :size="150"
                title="?"
              />
              <VLabel class="mt-2" style="font-size: 13px">រូបភាពផ្ទះ</VLabel>
            </VCol>
            <VCol
              cols="12"
              sm="3"
              class="d-flex flex-column justify-center align-center"
            >
              <AppImage
                :image="itemData.image_path_shop"
                :size="150"
                title="?"
              />
              <!-- <AppAvatar
                :image="itemData.image_path_shop"
                :size="150"
                title="?"
              /> -->

              <VLabel class="mt-2" style="font-size: 13px">រូបភាពតូប</VLabel>
            </VCol>
            <VCol
              cols="12"
              sm="3"
              class="d-flex flex-column justify-center align-center"
            >
              <AppImage
                :image="itemData.image_path_document"
                :size="150"
                title="?"
              />
              <!-- <AppAvatar
                :image="itemData.image_path_shop"
                :size="150"
                title="?"
              /> -->

              <VLabel class="mt-2" style="font-size: 13px">រូបភាពឯកសារយោង</VLabel>
            </VCol>
            <VCol
              cols="12"
              sm="3"
              class="d-flex flex-column justify-center align-center"
            >
              <AppImage
                :image="itemData.thumbprint_path"
                :size="150"
                title="?"
              />
              <!-- <AppAvatar
                :image="itemData.thumbprint_path"
                :size="150"
                title="?"
              /> -->
              <VLabel class="mt-2" style="font-size: 13px"
                >រូបភាពស្នាមមេដៃ</VLabel
              >
            </VCol>
          </VRow>
        </VCardText>
      </VCard>
    </VCol>
  </VRow>
</template>
