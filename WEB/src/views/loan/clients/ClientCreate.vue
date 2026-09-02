<script setup>
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import AppSelect from "@/@core/components/app-form-elements/AppSelect.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import { requiredValidator } from "@/@core/utils/validators";
import AppCard from "@/components/AppCard.vue";
import AppGoogleMap from "@/components/AppGoogleMap.vue";
import { api } from "@/utils/api";
import { app } from "@/utils/app";
import {
  getCurrencies,
  getMainSourceIncomes,
  getOccupations,
} from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";
import { onMounted } from "vue";
import { ref } from "vue";
import { Cropper } from "vue-advanced-cropper";
import AppImageUpload from "@/components/AppImageUpload.vue";

definePage({
  meta: {
    title: "Clients",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "add-clients",
    navActiveLink: "clients",
  },
});
const today = new Date().toISOString();

const getInitialFormData = () => ({
  name_kh: "",
  name_en: "",
  gender: "male",
  dob: null,
  contact: "",
  national_id_number: "",
  national_id_issue_date: null,
  bank_account_name: "",
  province_code: null,
  district_code: null,
  commune_code: null,
  village_code: null,
  occupation_id: null,
  occupation_note: null,
  main_source_income_id: 1,
  currency_id: 1,
  monthly_income_amount: "",
  image_path: null,
  image_path_home: null,
  image_path_shop: null,
  image_path_document: null,
  thumbprint_path: null,
  location: null,
  location_shop: null,
});

const formData = ref(getInitialFormData());

const restFormData = () => {
  formData.value = getInitialFormData();
};

const gender = [
  { name: "ប្រុស", value: "male" },
  { name: "ស្រី", value: "female" },
];
const isLoading = ref(false);
const occupations = ref([]);
const mainSourceIncomes = ref([]);
const provinces = ref([...app().provinces]);
const districts = ref([]);
const communes = ref([]);
const villages = ref([]);
const coordinates = ref(null);
const error = ref(null);
const currencies = ref([]);
const position = ref(null);
const positionShop = ref(null);

const handleGeoError = (err) => {
  switch (err.code) {
    case err.PERMISSION_DENIED:
      return "User denied the request for Geolocation.";
    case err.POSITION_UNAVAILABLE:
      return "Location information is unavailable.";
    case err.TIMEOUT:
      return "The request to get user location timed out.";
    default:
      return "An unknown error occurred.";
  }
};
const onSubmit = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("clients-store", formData.value);
    if (res.data.status) {
      restFormData();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  const [dataOccupation, dataMainSourceIncomes, dataCurrencies] =
    await Promise.all([
      getOccupations(),
      getMainSourceIncomes(),
      getCurrencies(),
    ]);

  if (useSettingStore().branch_province_code) {
    formData.value.province_code = useSettingStore().branch_province_code;
  }

  occupations.value = dataOccupation;
  mainSourceIncomes.value = dataMainSourceIncomes;
  currencies.value = dataCurrencies;
});
watch(
  () => formData.value.province_code,
  (newVal, oldValue) => {
    if (newVal) {
      formData.value.district_code = null;
      formData.value.commune_code = null;
      formData.value.village_code = null;

      districts.value = app().districts.filter(
        (v) => v.province_code === parseInt(newVal),
      );
      communes.value = [];
      villages.value = [];
    }
  },
);

watch(
  () => formData.value.district_code,
  (newVal, oldValue) => {
    if (newVal) {
      formData.value.commune_code = null;
      formData.value.village_code = null;

      communes.value = app().communes.filter(
        (v) => v.district_code === parseInt(newVal),
      );
      villages.value = [];
    }
  },
);

watch(
  () => formData.value.commune_code,
  (newVal, oldValue) => {
    if (newVal) {
      formData.value.village_code = null;

      villages.value = app().villages.filter(
        (v) => v.commune_code === parseInt(newVal),
      );
    }
  },
);

watch(
  () => formData.value.village_code,
  (newVal, oldValue) => {
    if (newVal) {
      if (formData.value.province_code == null) {
        const communeCode = app().villages.find(
          (v) => v.code === parseInt(newVal),
        ).commune_code;
        const districtCode = app().communes.find(
          (v) => v.code === parseInt(communeCode),
        ).district_code;
        const provinceCode = app().districts.find(
          (v) => v.code === parseInt(districtCode),
        ).province_code;

        formData.value.province_code = provinceCode;
        formData.value.district_code = districtCode;
        formData.value.commune_code = communeCode;
        formData.value.village_code = newVal;
      }
    }
  },
);

const getLocation = async () => {
  position.value = null;

  if (!navigator.geolocation) {
    error.value = "Geolocation is not supported by your browser";
    alert(error.value);
    return;
  }

  // Check permission status first
  try {
    const permissionStatus = await navigator.permissions.query({
      name: "geolocation",
    });

    console.log("Permission status:", permissionStatus.state);
    // 'granted', 'denied', or 'prompt'

    if (permissionStatus.state === "denied") {
      error.value =
        "Location permission denied. Please enable it in your browser settings.";
      alert(error.value);
      return;
    }

    // Listen for permission changes
    permissionStatus.onchange = () => {
      console.log("Permission changed to:", permissionStatus.state);
    };
  } catch (err) {
    console.log("Permission API not supported, trying geolocation anyway");
  }

  // This will trigger the permission prompt if state is 'prompt'
  navigator.geolocation.getCurrentPosition(
    (pos) => {
      position.value = {
        lat: pos.coords.latitude,
        lng: pos.coords.longitude,
      };

      formData.value.location = `${pos.coords.latitude},${pos.coords.longitude}`;
    },
    (err) => {
      if (err.code === 1) {
        error.value =
          "Location permission denied. Please enable location access in your browser settings.";
      } else {
        error.value = `Error getting location: ${err.message}`;
      }
      alert(error.value);
    },
    {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    },
  );
};
const getLocationShop = async () => {
  positionShop.value = null;

  if (!navigator.geolocation) {
    error.value = "Geolocation is not supported by your browser";
    alert(error.value);
    return;
  }

  // Check permission status first
  try {
    const permissionStatus = await navigator.permissions.query({
      name: "geolocation",
    });

    console.log("Permission status:", permissionStatus.state);
    // 'granted', 'denied', or 'prompt'

    if (permissionStatus.state === "denied") {
      error.value =
        "Location permission denied. Please enable it in your browser settings.";
      alert(error.value);
      return;
    }

    // Listen for permission changes
    permissionStatus.onchange = () => {
      console.log("Permission changed to:", permissionStatus.state);
    };
  } catch (err) {
    console.log("Permission API not supported, trying geolocation anyway");
  }

  // This will trigger the permission prompt if state is 'prompt'
  navigator.geolocation.getCurrentPosition(
    (pos) => {
      positionShop.value = {
        lat: pos.coords.latitude,
        lng: pos.coords.longitude,
      };

      formData.value.location_shop = `${pos.coords.latitude},${pos.coords.longitude}`;
    },
    (err) => {
      if (err.code === 1) {
        error.value =
          "Location_shop permission denied. Please enable location_shop access in your browser settings.";
      } else {
        error.value = `Error getting location_shop: ${err.message}`;
      }
      alert(error.value);
    },
    {
      enableHighAccuracy: true,
      timeout: 5000,
      maximumAge: 0,
    },
  );
};
watch(
  () => useSettingStore().branch_province_code,
  (n, o) => {
    if (n != formData.value.province_code && n != null) {
      formData.value.province_code = n;
    }
  },
);
</script>

<template>
  <AppCard
    title="Create Client"
    title-icon="tabler-user-circle"
    is-submit
    :loading="isLoading"
    is-check-branch
    @on-submit="onSubmit"
    border="border-none"
    :is-title="false"
    :is-header="false"
  >
    <VRow>
      <!--------Personal Information---------->
      <AppLabel
        title="Personal Information"
        icon="tabler-file-check"
        :is-border-top="false"
      />
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppTextField
          v-model="formData.name_kh"
          label="Name Khmer"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppTextField v-model="formData.name_en" label="Name English" />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppSelect
          v-model="formData.gender"
          :items="gender"
          item-title="name"
          item-value="value"
          label="Gender"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppDateTimePicker
          v-model="formData.dob"
          label="Date of birth"
          :config="{
            allowInput: true,
            maxDate: today,
          }"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppTextField v-model="formData.contact" label="Contact" numbers-only />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppTextField
          v-model="formData.national_id_number"
          label="National ID Number"
          hint="9 numbers only"
          maxlength="9"
          numbers-only
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppDateTimePicker
          v-model="formData.national_id_issue_date"
          label="National ID Issue Date"
          :config="{
            allowInput: true,
          }"
        />
      </VCol>
      <!-- <VCol cols="12" lg="3" md="4" sm="6">
        <AppTextField
          v-model="formData.bank_account_name"
          label="Bank Account Name"
        />
      </VCol> -->

      <!--------Address---------->
      <AppLabel title="Address" icon="tabler-map-pin" />
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppAutocomplete
          v-model="formData.province_code"
          label="Provinces"
          :items="provinces"
          item-value="code"
          item-title="name_kh"
          :placeholder="$t('Select Province')"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppAutocomplete
          v-model="formData.district_code"
          label="Districts"
          :items="districts"
          item-value="code"
          item-title="name_kh"
          :placeholder="$t('Select District')"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppAutocomplete
          v-model="formData.commune_code"
          label="Communes"
          :items="communes"
          item-value="code"
          item-title="name_kh"
          :placeholder="$t('Select Commune')"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppAutocomplete
          v-model="formData.village_code"
          label="Villages"
          :items="villages"
          item-value="code"
          item-title="name_kh"
          :placeholder="$t('Select Village')"
          :rules="[requiredValidator]"
        />
      </VCol>

      <!--------Personal Income---------->
      <AppLabel title="Personal Income" icon="tabler-briefcase" />
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppAutocomplete
          v-model="formData.occupation_id"
          :items="occupations"
          item-title="name_kh"
          item-value="id"
          label="Occupation"
          :placeholder="$t('Select Occupation')"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppTextField
          v-model="formData.occupation_note"
          label="Occupation Note"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <AppAutocomplete
          v-model="formData.main_source_income_id"
          :items="mainSourceIncomes"
          item-title="name_kh"
          item-value="id"
          label="Main Source Income"
          :placeholder="$t('Select Main Source Income')"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" lg="3" md="4" sm="6">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Daily Income Amount')"
        />
        <VRow>
          <!-- <VCol cols="6" md="6" sm="6">
            <AppSelect
              v-model="formData.currency_id"
              :items="currencies"
              :item-title="
                (item) => {
                  return `${item.abbr} - ${item.name_kh}`;
                }
              "
              item-value="id"
            />
          </VCol> -->
          <VCol cols="12">
            <AppTextField
              v-model="formData.monthly_income_amount"
              format-currency
              hint="e.g. 100,000/ថ្ងៃ"
              :rules="[requiredValidator]"
            />
          </VCol>
        </VRow>
      </VCol>

      <!--------Other Information---------->
      <AppLabel title="Other Information" icon="tabler-info-circle" />

      <VCol cols="12" sm="6" md="3" class="lg-five-cols">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Client Image')"
        />
        <AppImageUpload
          icon="tabler-user"
          :label="$t('Client Image')"
          v-model="formData.image_path"
          :is-loading="isLoading"
          :headline="$t('Client Image')"
          :support-text="$t('PNG or JPG up to 2MB')"
          :url-resolver="getImageUrl"
          style="height: 248px"
          :crop-aspect-ratio="1"
        />
      </VCol>

      <VCol cols="12" sm="6" md="3" class="lg-five-cols">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Client Image Home')"
        />
        <AppImageUpload
          icon="tabler-home"
          :label="$t('Client Image Home')"
          v-model="formData.image_path_home"
          :is-loading="isLoading"
          :headline="$t('Client Image Home')"
          :support-text="$t('PNG or JPG up to 2MB')"
          :url-resolver="getImageUrl"
          style="height: 248px"
        />
      </VCol>
      <VCol cols="12" sm="6" md="3" class="lg-five-cols">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Client Image Shop')"
        />
        <AppImageUpload
          icon="tabler-building-store"
          :label="$t('Client Image Shop')"
          v-model="formData.image_path_shop"
          :is-loading="isLoading"
          :headline="$t('Client Image Shop')"
          :support-text="$t('PNG or JPG up to 2MB')"
          :url-resolver="getImageUrl"
          style="height: 248px"
        />
      </VCol>
      <VCol cols="12" sm="6" md="3" class="lg-five-cols">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Client Image Document')"
        />
        <AppImageUpload
          icon="tabler-file-description"
          :label="$t('Client Image Document')"
          v-model="formData.image_path_document"
          :is-loading="isLoading"
          :headline="$t('Client Image Document')"
          :support-text="$t('PNG or JPG up to 2MB')"
          :url-resolver="getImageUrl"
          style="height: 248px"
        />
      </VCol>
      <VCol cols="12" sm="6" md="3" class="lg-five-cols">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Client Thumbprint')"
        />

        <AppImageUpload
          icon="tabler-fingerprint"
          :label="$t('Client Thumbprint')"
          v-model="formData.thumbprint_path"
          :is-loading="isLoading"
          :headline="$t('Client Thumbprint')"
          :support-text="$t('PNG or JPG up to 2MB')"
          :url-resolver="getImageUrl"
          style="height: 248px"
          :crop-aspect-ratio="1"
        />
      </VCol>
    </VRow>
    <VRow>
      <VCol cols="12" lg="3" md="4" sm="6">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Location Home')"
        />

        <VBtn class="w-100" @click="getLocation">
          <VIcon start>tabler-location</VIcon>
          {{ $t("Click For Location") }}
        </VBtn>

        <div
          style="
            width: 100%;
            height: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
          "
        >
          <AppGoogleMap
            v-if="formData.location"
            v-model:center="position"
            :center="position"
          />
          <p v-else>{{ $t("Location Not Found") }}</p>
        </div>
      </VCol>

      <VCol cols="12" lg="3" md="4" sm="6">
        <VLabel
          class="mb-1 text-wrap notasans font-size-0-75 pt-2"
          style="line-height: 15px"
          :text="$t('Location Shop')"
        />

        <VBtn class="w-100" @click="getLocationShop">
          <VIcon start>tabler-location</VIcon>
          {{ $t("Click For Location Shop") }}
        </VBtn>

        <div
          style="
            width: 100%;
            height: 200px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 10px;
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
          "
        >
          <AppGoogleMap
            v-if="formData.location_shop"
            v-model:center="positionShop"
            :center="positionShop"
          />
          <p v-else>{{ $t("Location Not Found") }}</p>
        </div>
      </VCol>
    </VRow>
  </AppCard>
</template>
<style lang="scss" scoped>
/* Vuetify 3 default 'lg' breakpoint starts at 1280px */
@media (min-width: 1280px) {
  .lg-five-cols {
    width: 20% !important;
    max-width: 20% !important;
    flex: 0 0 20% !important;
  }
}
</style>
