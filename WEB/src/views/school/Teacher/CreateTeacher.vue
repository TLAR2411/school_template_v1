<script setup>
import AppImageUpload from "@/components/AppImageUpload.vue";
import { nations } from "@/utils/formater/formatNation";
import { app } from "@/utils/app";
import { ref, watch, computed } from "vue";
import { useI18n } from "vue-i18n";
import { getBranches, getRoles } from "@/services/dataService";

const { locale, t } = useI18n();

const isLoading = ref(false);

const branches = ref([]);

const roles = ref([]);

const manageBranch = [
  { name: "មួយសាខា", value: 1, name_en: "Single Branch" },
  { name: "ច្រើនសាខា", value: 2, name_en: "Multiple Branch" },
];

const gender = ref([
  { name_kh: "ប្រុស", name_en: "Male", value: "male" },
  { name_kh: "ស្រី", name_en: "Female", value: "female" },
]);
const genderTitle = computed(() => {
  return locale.value === "en" ? "name_en" : "name_kh";
});

const nationTitle = computed(() => {
  return locale.value === "en" ? "name_en" : "name_kh";
});

const formData = ref({
  photo_path: null,
  province_code: null,
  district_code: null,
  commune_code: null,
  village_code: null,
  name_kh: null,
  name_en: null,
  gender: gender.value[0].value,
  dob: null,
  nation: nations[0].value,
  phone: null,
  manage_branch: manageBranch[0].value,
  branch_id: [],
  role_id: null,
});

const onSubmit = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("teachers-store", formData.value);
    if (res.data.status) {
      // restFormData();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  branches.value = await getBranches();
  roles.value = await getRoles();
});
</script>
<template>
  <AppCard
    title="Create Teacher"
    title-icon="tabler-user-plus"
    is-submit
    :loading="isLoading"
    @on-submit="onSubmit"
  >
    <AppLabel title="Personal Information" />

    <VRow>
      <VCol cols="12" md="9">
        <VRow>
          <VCol cols="12" lg="4" sm="6">
            <AppTextField
              v-model="formData.name_kh"
              label="Name Khmer"
              :rules="[requiredValidator]"
            />
          </VCol>
          <VCol cols="12" lg="4" sm="6">
            <AppTextField
              v-model="formData.name_en"
              label="Name English"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="6" lg="2" sm="4">
            <AppSelect
              v-model="formData.gender"
              :items="gender"
              :item-title="genderTitle"
              item-value="value"
              label="Gender"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="6" lg="2" sm="4">
            <AppSelect
              v-model="formData.nation"
              :items="nations"
              :item-title="nationTitle"
              item-value="value"
              label="Nationality"
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="12" lg="4" sm="6">
            <AppDateTimePicker
              v-model="formData.dob"
              label="Date of birth"
              :rules="[requiredValidator]"
              :config="{ allowInput: true }"
            />
          </VCol>

          <VCol cols="12" lg="4" sm="6">
            <AppTextField v-model="formData.phone" label="Phone" />
          </VCol>
          <VCol cols="12" md="4" sm="6">
            <AppAutocomplete
              v-model="formData.role_id"
              :label="t('Role')"
              :items="roles"
              item-title="display_name"
              item-value="id"
              autocomplete="off"
            />
          </VCol>

          <VCol cols="12" md="4" sm="6">
            <AppAutocomplete
              v-model="formData.manage_branch"
              :label="t('Manage Branch')"
              :items="manageBranch"
              :item-title="
                (item) => (locale == 'km' ? item.name : item.name_en)
              "
              item-value="value"
              autocomplete="off"
            />
          </VCol>

          <VCol cols="12" md="8" sm="12">
            <AppAutocomplete
              v-model="formData.branch_id"
              :label="t('Choose Branches')"
              :items="branches"
              :disabled="
                formData.manage_branch != 2 && formData.manage_branch != 4
              "
              :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
              item-value="id"
              multiple
              eager
              closable-chips
              chips
              autocomplete="off"
            />
          </VCol>
        </VRow>
      </VCol>

      <!-- Photo on the left, spanning rows -->
      <VCol cols="12" sm="6" md="3">
        <AppImageUpload
          icon="tabler-user"
          :label="$t('Teacher Photo')"
          v-model="formData.photo_path"
          :is-loading="isLoading"
          :headline="$t('Teacher Photo')"
          :support-text="$t('PNG or JPG up to 2MB')"
          style="height: 248px"
          :crop-aspect-ratio="1"
        />
      </VCol>

      <!-------- Address ---------->

      <AppLabel title="Address" icon="tabler-map-pin" />

      <AppAddressPicker
        v-model:province-code="formData.province_code"
        v-model:district-code="formData.district_code"
        v-model:commune-code="formData.commune_code"
        v-model:village-code="formData.village_code"
      />
    </VRow>
  </AppCard>
</template>
