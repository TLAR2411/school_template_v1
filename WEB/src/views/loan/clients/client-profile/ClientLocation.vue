<script setup>
import AppGoogleMap from "@/components/AppGoogleMap.vue";

const props = defineProps({
  center: {
    type: String,
    required: false,
    default: null,
  },
});

const location = computed(() => {
  if (props.center) {
    const coordinates = props.center.split(",");
    return {
      lat: parseFloat(coordinates[0]),
      lng: parseFloat(coordinates[1]),
    };
  }
});
</script>

<template>
  <AppCard
    class="pa-0 ma-0"
    title="Location"
    title-icon="tabler-map-pin"
    :is-back="false"
  >
    <VRow v-if="location">
      <div
        style="
          width: 100%;
          height: 450px;
          display: flex;
          justify-content: center;
          align-items: center;
        "
      >
        <AppGoogleMap
          v-if="location"
          v-model:center="location"
          :center="location"
        />
      </div>
    </VRow>
    <VRow v-else>
      <div
        style="
          width: 100%;
          height: 150px;
          display: flex;
          justify-content: center;
          align-items: center;
        "
      >
        <VIcon icon="tabler-map-pin-off" start />{{ $t("None Location") }}
      </div>
    </VRow>
  </AppCard>
</template>
