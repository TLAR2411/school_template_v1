<script setup>
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import AppSelect from "@/@core/components/app-form-elements/AppSelect.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import AppCard from "@/components/AppCard.vue";
import { api } from "@/utils/api";
import { app } from "@/utils/app";
import { requiredValidator } from "@/@core/utils/validators";
import {
  getCurrencies,
  getMainSourceIncomes,
  getOccupations,
} from "@/services/dataService";
import { onMounted, ref, watch, nextTick } from "vue";
import { useRoute } from "vue-router";
import getImageUrl from "@/utils/image/getImageUrl";
import AppLabel from "@/components/AppLabel.vue";
import { router } from "@/router";
import AppImageUpload from "@/components/AppImageUpload.vue";

// Page metadata
definePage({
  meta: {
    title: "Clients",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "edit-clients",
    navActiveLink: "clients",
  },
});

const today = new Date().toISOString();

// Reactive state
const formData = ref({
  currency_id: 1,
  gender: "male",
});

const gender = [
  { name: "ប្រុស", value: "male" },
  { name: "ស្រី", value: "female" },
];

const route = useRoute();
const clientId = ref(route.query.id);
const isLoading = ref(false);
const occupations = ref([]);
const mainSourceIncomes = ref([]);
const provinces = ref([...app().provinces]);
const districts = ref([]);
const communes = ref([]);
const villages = ref([]);
const error = ref(null);
const currencies = ref([]);
const position = ref(null);
const positionShop = ref(null);

const isInitializing = ref(false);

// Reset form data
const resetFormData = () => {
  formData.value = { currency_id: 1, gender: "male" };
  error.value = null;
  districts.value = [];
  communes.value = [];
  villages.value = [];
};

// Initialize address fields with fetched data
const initializeAddressFields = async (data) => {
  // Convert codes to numbers to match expected type
  const provinceCode = data.province_code
    ? Number(data.province_code)
    : undefined;
  const districtCode = data.district_code
    ? Number(data.district_code)
    : undefined;
  const communeCode = data.commune_code ? Number(data.commune_code) : undefined;
  const villageCode = data.village_code ? Number(data.village_code) : undefined;

  // console.log("Initializing address fields with:", {
  //   provinceCode,
  //   districtCode,
  //   communeCode,
  //   villageCode,
  // });

  if (provinceCode) {
    districts.value = app().districts.filter(
      (v) => v.province_code === provinceCode,
    );
    // console.log("Districts after filtering:", districts.value);
    formData.value.province_code = provinceCode;
  }
  if (districtCode) {
    communes.value = app().communes.filter(
      (v) => v.district_code === districtCode,
    );
    // console.log("Communes after filtering:", communes.value);
    formData.value.district_code = districtCode;
  }
  if (communeCode) {
    villages.value = app().villages.filter(
      (v) => v.commune_code === communeCode,
    );
    // console.log("Villages after filtering:", villages.value);
    formData.value.commune_code = communeCode;
  }
  if (villageCode) {
    formData.value.village_code = villageCode;
  }

  // Force re-render to ensure AppAutocomplete picks up the values
  await nextTick();
};

// Fetch initial data
const initData = async () => {
  if (!clientId.value) return;
  try {
    isLoading.value = true;
    isInitializing.value = true;
    const res = await api.post("clients-show", { id: clientId.value });
    console.log("Fetched client data:", res.data);
    if (res.data.status) {
      const clientData = res.data.data;
      formData.value = { ...formData.value, ...clientData };

      await initializeAddressFields(clientData);

      const location = res.data.data.location;
      const locationShop = res.data.data.location_shop;

      if (location) {
        const splitLocation = location.split(",");
        position.value = {
          lat: parseFloat(splitLocation[0]),
          lng: parseFloat(splitLocation[1]),
        };
      }

      if (locationShop) {
        const splitLocation = locationShop.split(",");
        positionShop.value = {
          lat: parseFloat(splitLocation[0]),
          lng: parseFloat(splitLocation[1]),
        };
      }

      // console.log(splitLocation[1]);
    } else {
      error.value = "Failed to load client data.";
    }
  } catch (err) {
    error.value = "Error fetching client data.";
    console.error(err);
  } finally {
    isLoading.value = false;
    isInitializing.value = false;
  }
};

// Form submission
const onSubmit = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("clients-update", formData.value);
    if (res.data.status) {
      // resetFormData();
      router.push({ name: "loan-clients-tab", params: { tab: "list" } });
      error.value = null;
      // console.log("Client updated successfully");
    } else {
      error.value = "Failed to save client data.";
    }
  } catch (err) {
    error.value = "Error saving client data.";
    console.error(err);
  } finally {
    isLoading.value = false;
  }
};

// Watchers for cascading location fields
watch(
  () => formData.value.province_code,
  (newVal) => {
    if (newVal && !isInitializing.value) {
      districts.value = app().districts.filter(
        (v) => v.province_code === newVal,
      );
      formData.value.district_code = undefined;
      formData.value.commune_code = undefined;
      formData.value.village_code = undefined;
      communes.value = [];
      villages.value = [];
    }
  },
);

watch(
  () => formData.value.district_code,
  (newVal) => {
    if (newVal && !isInitializing.value) {
      communes.value = app().communes.filter((v) => v.district_code === newVal);
      formData.value.commune_code = undefined;
      formData.value.village_code = undefined;
      villages.value = [];
    }
  },
);

watch(
  () => formData.value.commune_code,
  (newVal) => {
    if (newVal && !isInitializing.value) {
      villages.value = app().villages.filter((v) => v.commune_code === newVal);
      formData.value.village_code = undefined;
    }
  },
);

// Fetch data on mount
onMounted(async () => {
  try {
    isLoading.value = true;
    const [dataOccupation, dataMainSourceIncomes, dataCurrencies] =
      await Promise.all([
        getOccupations(),
        getMainSourceIncomes(),
        getCurrencies(),
      ]);

    occupations.value = dataOccupation;
    mainSourceIncomes.value = dataMainSourceIncomes;
    currencies.value = dataCurrencies;
    await initData();
  } catch (err) {
    error.value = "Error loading initial data.";
    console.error(err);
  } finally {
    isLoading.value = false;
  }
});

const getLocation = () => {
  if (!navigator.geolocation) {
    error.value = "Geolocation is not supported by your browser";
    alert(error.value);
    return;
  }

  navigator.geolocation.getCurrentPosition(
    (pos) => {
      position.value = {
        lat: pos.coords.latitude,
        lng: pos.coords.longitude,
      };

      formData.value.location = `${pos.coords.latitude},${pos.coords.longitude}`;
    },
    (err) => {
      error.value = `Error getting location: ${err.message}`;
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
</script>

<template>
  <AppCard
    title="Create Client"
    title-icon="tabler-user-circle"
    is-update
    :loading="isLoading"
    is-check-branch
    @on-update="onSubmit"
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
          :crop-aspect-ratio="1"
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
          :crop-aspect-ratio="1"
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
