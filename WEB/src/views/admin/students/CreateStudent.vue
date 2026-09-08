<script setup>
import AppImageUpload from '@/components/AppImageUpload.vue';
import { nations } from '@/utils/formater/formatNation';
import { app } from "@/utils/app";
import { ref, watch, computed } from 'vue';
import { useI18n } from 'vue-i18n';

const {locale} = useI18n();

const isLoading = ref(false);

const gender =ref( [
  { name_kh: "ប្រុស", name_en: "Male", value: "male" },
  { name_kh: "ស្រី", name_en: "Female", value: "female" },
]
)
const genderTitle = computed(()=>{
  return locale.value === 'en' ? 'name_en' : 'name_kh';
})

const nationTitle = computed(()=>{
  return locale.value === 'en' ? 'name_en' : 'name_kh';
})

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
    email: null,
    b_province_code: null,
    b_district_code: null,
    b_commune_code: null,
    b_village_code: null,
})

const onSubmit = async () => {
   try {
    isLoading.value = true;
    const res = await api.post("students-store", formData.value);
    if (res.data.status) {
      // restFormData();
    }
    
   } catch (error) {
    console.error("Failed to fetch data:", error);
   }finally{
    isLoading.value = false;
   }
};


</script>
<template>
    <AppCard title="Create Student"
    title-icon="tabler-user-plus"
    is-submit
      :loading="isLoading"
      @on-submit="onSubmit">
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

          <VCol cols="6" lg="4" sm="6">
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
              :rules="[requiredValidator]"
              :config="{ allowInput: true }"
              
            />
          </VCol>
          
          
          <VCol cols="12" lg="4" sm="6">
            <AppTextField
              v-model="formData.phone"
              label="Phone"
             
            />
          </VCol>
          <VCol cols="12" lg="4" sm="6">
            <AppTextField
              v-model="formData.email"
              label="Email"
              :rules="[emailValidator]"
            />
          </VCol>
        </VRow>
      </VCol>

       <!-- Photo on the left, spanning rows -->
       <VCol cols="12" sm="6" md="3">
        <AppImageUpload
          icon="tabler-user"
          :label="$t('Student Photo')"
          v-model="formData.photo_path"
          :is-loading="isLoading"
          :headline="$t('Student Photo')"
          :support-text="$t('PNG or JPG up to 2MB')"
          style="height: 248px"
          :crop-aspect-ratio="1"
        />
      </VCol>
      <!-------- Address ---------->

      <AppLabel title="Place of Birth" icon="tabler-map-pin" />

      <AppAddressPicker 
      v-model:province-code="formData.b_province_code"
  v-model:district-code="formData.b_district_code"
  v-model:commune-code="formData.b_commune_code"
  v-model:village-code="formData.b_village_code"/>
      <AppLabel title="Address" icon="tabler-map-pin" />

      <AppAddressPicker 
      v-model:province-code="formData.province_code"
  v-model:district-code="formData.district_code"
  v-model:commune-code="formData.commune_code"
  v-model:village-code="formData.village_code"/>
      
    </VRow>

    </AppCard>
</template>