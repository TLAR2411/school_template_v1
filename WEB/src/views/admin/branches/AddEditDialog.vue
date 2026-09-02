<script setup>
import { ref, watch, nextTick } from "vue";
import { debounce } from "lodash";
import { app } from "@/utils/app.js";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import { requiredValidator } from "@/@core/utils/validators";

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

const itemData = ref({
  name_kh: "",
  name_en: "",
  abbr: "",
  contact: "",
  house_no: "",
  street: "",
  village_code: "",
  commune_id: "",
  district_id: "",
  province_id: "",
  region: "",
  start_date: null,
  ...props.itemData,
});

const villages = ref([]);
const communes = ref([]);
const districts = ref([]);
const provinces = ref([...app().provinces]);

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = { ...newData };
  },
  { deep: true },
);

const resetData = () => {
  itemData.value = {
    name_kh: "",
    name_en: "",
    abbr: "",
    contact: "",
    house_no: "",
    street: "",
    village_code: "",
    commune_id: "",
    district_id: "",
    province_id: "",
    region: "",
    start_date: null,
  };
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    const branchId = itemData.value.id || null;
    if (branchId) {
      emit("onUpdate", itemData.value, (response) => {
        if (response == 200) {
          resetData();
        }
      });
    } else {
      emit("onCreate", itemData.value, (response) => {
        if (response == 200) {
          resetData();
        }
      });
    }
  }

  // emit("update:isDialogVisible", false);
}, 500);

const emit = defineEmits(["update:isDialogVisible", "onCreate", "onUpdate"]);

const onCloseDialog = () => {
  // Properly handle dialog close
  resetData();
  emit("update:isDialogVisible", false);
};

const dialogModelValueUpdate = (newVal) => {
  emit("update:isDialogVisible", newVal);
  isDialogVisible.value = newVal;
};

watch(
  () => itemData.value.province_id,
  (newVal, oldValue) => {
    // console.log(newVal);
    if (newVal) {
      if (oldValue) {
        itemData.value.district_id = null;
        itemData.value.commune_id = null;
        itemData.value.village_code = null;
      }

      districts.value = app().districts.filter(
        (v) => v.province_code === parseInt(newVal),
      );
    }
  },
);

watch(
  () => itemData.value.district_id,
  (newVal, oldValue) => {
    // console.log(newVal);
    if (newVal) {
      if (oldValue) {
        itemData.value.commune_id = null;
        itemData.value.village_code = null;
      }

      communes.value = app().communes.filter(
        (v) => v.district_code === parseInt(newVal),
      );
    }
  },
);

watch(
  () => itemData.value.commune_id,
  (newVal, oldValue) => {
    // console.log(newVal);
    if (newVal) {
      if (oldValue) {
        itemData.value.village_code = null;
      }

      villages.value = app().villages.filter(
        (v) => v.commune_code === parseInt(newVal),
      );
    }
  },
);

watch(
  () => itemData.value.village_code,
  (newVal, oldValue) => {
    if (newVal) {
      if (itemData.value.province_id == null) {
        const communeCode = app().villages.find(
          (v) => v.code === parseInt(newVal),
        ).commune_code;
        const districtCode = app().communes.find(
          (v) => v.code === parseInt(communeCode),
        ).district_code;
        const provinceCode = app().districts.find(
          (v) => v.code === parseInt(districtCode),
        ).province_code;

        itemData.value.province_id = provinceCode;
        itemData.value.district_id = districtCode;
        itemData.value.commune_id = communeCode;
        itemData.value.village_code = newVal;
      }
    }
  },
);
</script>

<template>
  <AppAddEditDialog
    max-width="1000px"
    :title="itemData.id == null ? 'Create Branch' : 'Update Branch'"
    :isUpdate="itemData.id != null ? true : false"
    :isDialogVisible="isDialogVisible"
    :loading="loading"
    @update:isDialogVisible="isDialogVisible = $event"
    @onCloseDialog="onCloseDialog"
    @onSubmit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.name_kh"
          label="Name Khmer"
          placeholder="ការិយាល័យកណ្ដាល"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.name_en"
          label="Name English"
          placeholder="Head office"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.abbr"
          label="Abbr"
          persistent-hint
          placeholder="HO"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.contact"
          label="Contact"
          placeholder="098898988"
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppDateTimePicker
          v-model="itemData.start_date"
          label="Start Date"
          placeholder="01/01/2000"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.region"
          label="Region"
          placeholder="1"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.house_no"
          label="House No"
          placeholder="981"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.street"
          label="Street"
          placeholder="205 Street"
        />
      </VCol>

      <VCol cols="12" sm="3">
        <AppAutocomplete
          v-model="itemData.province_id"
          label="Provinces"
          :items="provinces"
          item-value="code"
          item-title="name_kh"
        />
      </VCol>
      <VCol cols="12" sm="3">
        <AppAutocomplete
          v-model="itemData.district_id"
          label="Districts"
          :items="districts"
          item-value="code"
          item-title="name_kh"
        />
      </VCol>
      <VCol cols="12" sm="3">
        <AppAutocomplete
          v-model="itemData.commune_id"
          label="Communes"
          :items="communes"
          item-value="code"
          item-title="name_kh"
        />
      </VCol>
      <VCol cols="12" sm="3">
        <AppAutocomplete
          v-model="itemData.village_code"
          label="Villages"
          :items="villages"
          item-value="code"
          item-title="name_kh"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
