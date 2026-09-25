<script setup>
import AppImageUpload from "@/components/AppImageUpload.vue";
import { nations } from "@/utils/formater/formatNation";
import { api } from "@/utils/api";
import getImageUrl from "@/utils/image/getImageUrl";
import { ref, computed, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute, useRouter } from "vue-router";
import { getBranches, getRoles } from "@/services/dataService";

const { locale, t } = useI18n();
const route = useRoute();
const router = useRouter();

const isLoading = ref(false);
const branches = ref([]);

const roles = ref([]);

const manageBranch = [
  { name: "មួយសាខា", value: 1, name_en: "Single Branch" },
  { name: "ច្រើនសាខា", value: 2, name_en: "Multiple Branches" },
];

const gender = ref([
  { name_kh: "ប្រុស", name_en: "Male", value: "male" },
  { name_kh: "ស្រី", name_en: "Female", value: "female" },
]);

const genderTitle = computed(() =>
  locale.value === "en" ? "name_en" : "name_kh",
);
const nationTitle = computed(() =>
  locale.value === "en" ? "name_en" : "name_kh",
);

const formData = ref({
  photo_path: null,
  province_code: null,
  district_code: null,
  commune_code: null,
  village_code: null,
  name_kh: null,
  name_en: null,
  gender: null,
  dob: null,
  nation: null,
  phone: null,
  manage_branch: 1,
  branch_id: [],
  role_id: null,
});

const toCode = (value) => (value ? Number(value) : null);

const initData = async () => {
  try {
    isLoading.value = true;
    branches.value = await getBranches();

    const res = await api.post("teachers-show", { id: route.params.id });
    if (res.data.status) {
      const data = res.data.data;
      formData.value = {
        photo_path: data.photo_path,
        name_kh: data.name_kh,
        name_en: data.name_en,
        gender: data.gender,
        dob: data.dob,
        nation: data.nation,
        phone: data.phone,
        role_id: data.role_id,
        manage_branch: data.manage_branch ?? 1,
        // teacherBranches from show()
        branch_id: (data.teacher_branches || []).map((b) => b.branch_id),
        province_code: toCode(data.province_code),
        district_code: toCode(data.district_code),
        commune_code: toCode(data.commune_code),
        village_code: toCode(data.village_code),
      };
    }
  } catch (error) {
    console.error("Failed to fetch teacher:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(initData);

const onSubmit = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("teachers-update", {
      id: route.params.id,
      ...formData.value,
    });
    if (res.data.status) {
      router.push({ name: "school-teacher" });
    }
  } catch (error) {
    console.error("Failed to update teacher:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <AppCard
    title="Edit Teacher"
    title-icon="tabler-user-edit"
    is-submit
    :loading="isLoading"
    @on-submit="onSubmit"
  >
    <!-- same form fields as CreateTeacher -->
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
          <VCol cols="12" lg="2" sm="4">
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

          <VCol cols="6" lg="4" sm="6">
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
              :item-title="locale === 'km' ? 'name' : 'name_en'"
              item-value="value"
              autocomplete="off"
            />
          </VCol>

          <VCol cols="12" md="8" sm="12">
            <AppAutocomplete
              v-model="formData.branch_id"
              :label="t('Choose Branches')"
              :items="branches"
              :disabled="formData.manage_branch != 2"
              :item-title="locale === 'km' ? 'name' : 'name_en'"
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

      <VCol cols="12" sm="6" md="3">
        <AppImageUpload
          icon="tabler-user"
          :label="$t('Teacher Photo')"
          v-model="formData.photo_path"
          :is-loading="isLoading"
          :url-resolver="getImageUrl"
          :headline="$t('Teacher Photo')"
          :support-text="$t('PNG or JPG up to 2MB')"
          style="height: 248px"
          :crop-aspect-ratio="1"
        />
      </VCol>

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
