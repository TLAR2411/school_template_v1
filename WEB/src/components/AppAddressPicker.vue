<script setup>
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { requiredValidator } from "@/@core/utils/validators";
import { app } from "@/utils/app";
import { computed } from "vue";

const props = defineProps({
  // apply requiredValidator on all 4 fields
  required: { type: Boolean, default: false },
  // column sizing, so different forms can control layout
  cols: { type: [Number, String], default: 12 },
  sm: { type: [Number, String], default: 6 },
  md: { type: [Number, String], default: 4 },
  lg: { type: [Number, String], default: 3 },
});

// Four two-way bindings: v-model:province-code, v-model:district-code, ...
const provinceCode = defineModel("provinceCode", { default: null });
const districtCode = defineModel("districtCode", { default: null });
const communeCode = defineModel("communeCode", { default: null });
const villageCode = defineModel("villageCode", { default: null });

const rules = computed(() => (props.required ? [requiredValidator] : []));

// Lists derive from the selected parent — works for create AND edit prefill
const provinces = computed(() => app()?.provinces ?? []);

const districts = computed(() =>
  provinceCode.value
    ? app().districts.filter(
        (v) => v.province_code === parseInt(provinceCode.value),
      )
    : [],
);

const communes = computed(() =>
  districtCode.value
    ? app().communes.filter(
        (v) => v.district_code === parseInt(districtCode.value),
      )
    : [],
);

const villages = computed(() =>
  communeCode.value
    ? app().villages.filter(
        (v) => v.commune_code === parseInt(communeCode.value),
      )
    : [],
);

// Clear children only when the USER changes a parent
const onProvinceChange = () => {
  districtCode.value = null;
  communeCode.value = null;
  villageCode.value = null;
};

const onDistrictChange = () => {
  communeCode.value = null;
  villageCode.value = null;
};

const onCommuneChange = () => {
  villageCode.value = null;
};
</script>

<template>
  <VCol :cols="cols" :sm="sm" :md="md" :lg="lg">
    <AppAutocomplete
      v-model="provinceCode"
      label="Provinces"
      :items="provinces"
      item-value="code"
      item-title="name_kh"
      :placeholder="$t('Select Province')"
      :rules="rules"
      @update:model-value="onProvinceChange"
    />
  </VCol>
  <VCol :cols="cols" :sm="sm" :md="md" :lg="lg">
    <AppAutocomplete
      v-model="districtCode"
      label="Districts"
      :items="districts"
      item-value="code"
      item-title="name_kh"
      :placeholder="$t('Select District')"
      :rules="rules"
      @update:model-value="onDistrictChange"
    />
  </VCol>
  <VCol :cols="cols" :sm="sm" :md="md" :lg="lg">
    <AppAutocomplete
      v-model="communeCode"
      label="Communes"
      :items="communes"
      item-value="code"
      item-title="name_kh"
      :placeholder="$t('Select Commune')"
      :rules="rules"
      @update:model-value="onCommuneChange"
    />
  </VCol>
  <VCol :cols="cols" :sm="sm" :md="md" :lg="lg">
    <AppAutocomplete
      v-model="villageCode"
      label="Villages"
      :items="villages"
      item-value="code"
      item-title="name_kh"
      :placeholder="$t('Select Village')"
      :rules="rules"
    />
  </VCol>
</template>