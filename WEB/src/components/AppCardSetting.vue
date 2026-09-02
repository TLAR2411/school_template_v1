<script setup>
const props = defineProps({
  item: {
    type: Object,
    required: true,
    default: () => ({ name: "", value: "", id: null }),
  },
});

const emit = defineEmits(["onEdit"]);

const handleEdit = () => {
  emit("onEdit", props.item.id);
};
</script>

<template>
  <VCol cols="12" sm="6" md="4" lg="3">
    <VCard variant="outlined" class="card-hover-effect rounded-lg h-100">
      <VCardText class="d-flex align-center justify-space-between ga-3 pa-4">
        <!-- Content Column -->
        <div class="d-flex flex-column overflow-hidden">
          <span
            class="text-caption text-medium-emphasis text-uppercase font-weight-medium text-truncate"
          >
            {{ item.name }}
          </span>
          <span
            class="text-h6 font-weight-bold text-high-emphasis mt-1 text-truncate"
          >
            {{ item.value }}
          </span>
        </div>

        <!-- Action Button -->
        <VBtn
          icon="tabler-pencil"
          variant="tonal"
          color="primary"
          size="small"
          rounded
          aria-label="Edit item"
          @click="handleEdit"
        />
      </VCardText>
    </VCard>
  </VCol>
</template>

<style scoped>
.card-hover-effect {
  transition:
    transform 0.2s ease-in-out,
    box-shadow 0.2s ease-in-out;
}

.card-hover-effect:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 18px 0 rgba(0, 0, 0, 0.08) !important;
}
</style>
