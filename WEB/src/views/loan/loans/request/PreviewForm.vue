<script setup>
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

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);
const onClose = () => {
  emit("update:isDialogVisible", false);
};
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    fullscreen
    :scrim="false"
    transition="dialog-bottom-transition"
  >
    <!-- Dialog Content -->
    <VCard>
      <!-- Toolbar -->
      <div>
        <VToolbar color="primary">
          <VBtn icon variant="plain" @click="onClose">
            <VIcon color="white" icon="tabler-x" />
          </VBtn>

          <VToolbarTitle>Preview</VToolbarTitle>

          <VSpacer />

          <VToolbarItems>
            <VBtn variant="text" @click="isDialogVisible = false"> Save </VBtn>
          </VToolbarItems>
        </VToolbar>
      </div>

      <!-- List -->
      <VList lines="two">
        <VListSubheader>User Controls</VListSubheader>
        <VListItem
          title="Content filtering"
          subtitle="Set the content filtering level to restrict apps that can be downloaded"
        />
        <VListItem
          title="Password"
          subtitle="Require password for purchase or use password to restrict purchase"
        />
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
