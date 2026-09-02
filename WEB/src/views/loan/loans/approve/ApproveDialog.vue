<script setup>
import { useI18n } from "vue-i18n";
import ClientProfile from "./client-profile/index.vue";
import { useDialog } from "@/composables/useDialog.js";

const { showDialog } = useDialog();
const { t } = useI18n();
const refForm = ref(null);

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

const emit = defineEmits(["onReload", "update:isDialogVisible"]);
const onClose = () => {
  emit("update:isDialogVisible", false);
};

const onReload = async () => {
  emit("onReload");
};
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    fullscreen
    :scrim="false"
    transition="dialog-bottom-transition"
    persistent
  >
    <!-- Dialog Content -->
    <VCard>
      <!-- Toolbar -->
      <div>
        <VToolbar color="primary">
          <!-- <VBtn icon variant="plain" @click="onClose">
            <VIcon color="white" icon="tabler-x" />
          </VBtn> -->

          <VToolbarTitle>{{ $t("Information") }}</VToolbarTitle>

          <VSpacer />

          <VToolbarItems>
            <!-- <VBtn variant="text" @click="onSubmit">
              {{ $t("Approve") }}
            </VBtn> -->
            <VBtn icon variant="plain" @click="onClose">
              <VIcon color="white" icon="tabler-x" />
            </VBtn>
          </VToolbarItems>
        </VToolbar>
      </div>

      <!-- List -->
      <VList lines="two">
        <VCol>
          <!-- {{ itemData }} -->
          <ClientProfile
            ref="refForm"
            :client-id="itemData.client_id"
            :loan-id="itemData.loan_id"
            @onClose="onClose"
            @onReload="onReload"
          />
        </VCol>
      </VList>
    </VCard>
  </VDialog>
</template>

<style lang="scss">
.dialog-bottom-transition-enter-active,
.dialog-bottom-transition-leave-active {
  transition: transform 0.2s ease-in-out;
}
</style>
