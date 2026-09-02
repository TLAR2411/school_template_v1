<script setup>
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { requiredValidator } from "@/@core/utils/validators";
import AppLabel from "@/components/AppLabel.vue";
import { auth } from "@/utils/auth";
import { computed, onMounted, readonly, ref, watch } from "vue";
import { useSettingStore } from "@/stores/settingStore";
import { useRoute, useRouter } from "vue-router";
import { api } from "@/utils/api";
import formatContact from "@/utils/formater/formatContact";
import { getCollaterals } from "@/services/dataService";

const props = defineProps({
  modelValue: {
    type: Object,
    default: () => ({}),
  },
  loanInfo: {
    type: Object,
    default: () => ({}),
  },
  selectedClient: {
    type: Object,
    default: () => ({}),
  },
  loading: {
    type: Boolean,
    required: false,
  },
});

const isLoading = ref(false);
const router = useRouter();
const route = useRoute();
const clients = ref([]);
const collaterals = ref([]);
const filter = ref({
  search: null,
});

const formData = ref({
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
  client_id: route?.query?.client_id ? Number(route?.query?.client_id) : null,
  guarantor_id: null,
  collateral_id: null,
});

const borrower = ref([]);
const guarantor = ref([]);
// Track image errors per item
const imageErrors = ref(new Set());

const handleImageError = (itemId) => {
  imageErrors.value.add(itemId);
};

const hasImageError = (itemId) => {
  return imageErrors.value.has(itemId);
};

const emit = defineEmits([
  "update:modelValue",
  "update:selectedClient",
  "restForm",
  "update:loading",
]);

watch(
  () => formData.value,
  (val) => {
    emit("update:modelValue", val);
  },
  { deep: true },
);

watch(
  () => formData.value.client_id,
  (newVal) => {
    if (formData.value.client_id == formData.value.guarantor_id) {
      formData.value.guarantor_id = null;
    }

    if (newVal) {
      const findClient = borrower.value.find((v) => v.id == newVal);
      emit("update:selectedClient", findClient);
    }
  },
);

const restForm = () => {
  removeClient();
  guarantor.value = [];
  imageErrors.value.clear(); // Clear image errors on form reset
  formData.value = {
    client_id: null,
    guarantor_id: null,
  };
};

const removeClient = () => {
  const idToRemove = formData.value.client_id;
  borrower.value = borrower.value.filter((v) => v.id != idToRemove);
};

defineExpose({
  restForm,
});

onMounted(async () => {
  emit("update:loading", false);

  const clientId = route?.query?.client_id || null;

  if (clientId) {
    searchClientNonLoanAPI(clientId);
  }

  const [dataCollaterals] = await Promise.all([getCollaterals()]);

  collaterals.value = dataCollaterals;
});

const onCreateClient = () => {
  router.push({ name: "loan-clients-tab", params: { tab: "create" } });
};

const searchClientNonLoanAPI = async (query) => {
  isLoading.value = true;
  const searchQuery = query ? String(query) : "";
  try {
    if (!searchQuery.trim()) {
      borrower.value = [];
      isLoading.value = false;
      return;
    }

    const response = await api.post("clients-search-non-loans", {
      filter: {
        search: searchQuery,
      },
    });

    if (response.data.status) {
      borrower.value = response.data?.data?.filter(
        (v) => v.is_have_loans == false,
      );

      if (borrower.value.length == 0) {
        formData.value.client_id = null;
      }
    } else {
      borrower.value = [];
    }
  } catch (error) {
    console.error("API search error:", error);
    borrower.value = [];
  } finally {
    isLoading.value = false;
  }
};

const searchClientAPI = async (query) => {
  isLoading.value = true;

  try {
    if (!query || query?.trim() === "") {
      // When search is empty, you might want to load initial data or clear
      guarantor.value = []; // or load your initial guarantors
      isLoading.value = false;
      return;
    }

    const response = await api.post("clients-search", {
      filter: {
        search: query,
      },
    });

    if (response.data.status) {
      guarantor.value = response.data?.data;
    } else {
      guarantor.value = [];
    }
  } catch (error) {
    console.error("API search error:", error);
    guarantor.value = [];
  } finally {
    isLoading.value = false;
  }
};

watch(
  () => useSettingStore().branch_id,
  (newValue, oldValue) => {
    if (newValue) {
      if (formData?.value?.client_id) {
        searchClientNonLoanAPI(formData?.value?.client_id);
      }

      if (formData?.value?.guarantor_id) {
        searchClientAPI(formData?.value?.guarantor_id);
      }
    }
  },
);
</script>

<template>
  <VRow>
    <!-- Borrower -->
    <AppLabel title="Borrower" icon="tabler-user" :is-border-top="false" />

    <VCol cols="12" lg="3" md="6" sm="6">
      <AppAutocomplete
        v-model="formData.client_id"
        :placeholder="$t('Select Borrower')"
        prepend-inner-icon="tabler-user"
        class="search-field"
        :loading="isLoading"
        v-model:items="borrower"
        :item-title="
          (item) => {
            if (item.village) {
              return `${item.name_kh} (${item.village?.name_kh})`;
            } else {
              return `${item.name_kh}`;
            }
          }
        "
        item-value="id"
        :item-disabled="
          (item) => {
            return item.id == formData.guarantor_id || item.is_black_list;
          }
        "
        :rules="[requiredValidator]"
        autocomplete="off"
        :debounce="500"
        server-side
        api-url="clients-search-non-loans"
        label="Borrower"
      >
        <template #item="{ props, item }">
          <VListItem
            v-if="item?.raw?.village"
            v-bind="props"
            :title="`${item?.raw?.name_kh} (${item?.raw?.village?.name_kh})`"
            :subtitle="`${formatContact(item?.raw?.contact)} ${
              item?.raw?.is_black_list ? 'ក្នុងបញ្ចីខ្មៅ' : ''
            }`"
            :disabled="
              item?.raw?.is_black_list || item?.raw?.id == formData.guarantor_id
            "
            :class="{ 'text-error': item?.raw?.is_black_list }"
          >
            <template #prepend>
              <AppAvatar
                :title="item?.raw?.name_kh"
                :image="item?.raw?.image_path"
                :size="40"
                :is-show-full-image="false"
                class="mr-3"
              />
              &nbsp;&nbsp;
            </template>
          </VListItem>
          <VListItem
            v-else
            v-bind="props"
            :title="`${item?.raw?.name_kh}`"
            :subtitle="`${formatContact(item?.raw?.contact)} ${
              item?.raw?.is_black_list ? 'ក្នុងបញ្ចីខ្មៅ' : ''
            }`"
            :disabled="
              item?.raw?.is_black_list || item?.raw?.id == formData.guarantor_id
            "
            :class="{ 'text-error': item?.raw?.is_black_list }"
          >
            <template #prepend>
              <AppAvatar
                :title="item?.raw?.name_kh"
                :image="item?.raw?.image_path"
                :size="40"
                :is-show-full-image="false"
              />
              &nbsp;&nbsp;
            </template>
          </VListItem>
        </template>
        <template #append>
          <VBtn
            icon="tabler-plus"
            rounded
            @click="onCreateClient"
            :aria-label="$t('create client')"
          />
        </template>
      </AppAutocomplete>
    </VCol>

    <VCol cols="12" lg="3" md="6" sm="6">
      <AppAutocomplete
        v-model="formData.guarantor_id"
        :placeholder="$t('Select Guarantor')"
        prepend-inner-icon="tabler-user"
        :loading="isLoading"
        :items="guarantor"
        :item-title="
          (item) => {
            if (item.village) {
              return `${item.name_kh} (${item.village?.name_kh})`;
            } else {
              return `${item.name_kh}`;
            }
          }
        "
        item-value="id"
        :item-disabled="
          (item) => {
            return item.id == formData.client_id || item.is_black_list;
          }
        "
        autocomplete="off"
        :debounce="500"
        server-side
        @search="searchClientAPI"
        label="Guarantor"
      >
        <template #item="{ props, item }">
          <VListItem
            v-if="item?.raw?.village"
            v-bind="props"
            :title="`${item?.raw?.name_kh} (${item?.raw?.village?.name_kh})`"
            :subtitle="`${formatContact(item?.raw?.contact)} ${
              item?.raw?.is_black_list ? 'ក្នុងបញ្ចីខ្មៅ' : ''
            }`"
            :disabled="
              item?.raw?.is_black_list || item?.raw?.id == formData.client_id
            "
            :class="{ 'text-error': item?.raw?.is_black_list }"
          >
            <template #prepend>
              <AppAvatar
                :title="item?.raw?.name_kh"
                :image="item?.raw?.image_path"
                :size="40"
                :is-show-full-image="false"
                class="mr-3"
              />
              &nbsp;&nbsp;
            </template>
          </VListItem>
          <VListItem
            v-else
            v-bind="props"
            :title="`${item?.raw?.name_kh}`"
            :subtitle="`${formatContact(item?.raw?.contact)} ${
              item?.raw?.is_black_list ? 'ក្នុងបញ្ចីខ្មៅ' : ''
            }`"
            :disabled="
              item?.raw?.is_black_list || item?.raw?.id == formData.client_id
            "
            :class="{ 'text-error': item?.raw?.is_black_list }"
          >
            <template #prepend>
              <AppAvatar
                :title="item?.raw?.name_kh"
                :image="item?.raw?.image_path"
                :size="40"
                :is-show-full-image="false"
              />
              &nbsp;&nbsp;
            </template>
          </VListItem>
        </template>
      </AppAutocomplete>
    </VCol>

    <VCol cols="12" lg="3" md="6" sm="6">
      <AppAutocomplete
        v-model="formData.collateral_id"
        :placeholder="$t('Select Collateral')"
        prepend-inner-icon="tabler-home"
        :loading="isLoading"
        :items="collaterals"
        item-value="id"
        item-title="name_kh"
        autocomplete="off"
        label="Collateral"
        clearable
      >
      </AppAutocomplete>
    </VCol>

    <!-- Credit Officer -->
  </VRow>
</template>

<style scoped>
/* remove Vuetify's default gap before the append slot */
.search-field :deep(.v-input__append) {
  margin-inline-start: 0;
}

/* square the field's right corners */
.search-field :deep(.v-field) {
  border-start-end-radius: 0;
  border-end-end-radius: 0;
}

/* drop the round icon-button shape; keep only the outer corners rounded */
.search-field :deep(.v-input__append .v-btn) {
  border-radius: 0;
  border-start-end-radius: 6px;
  border-end-end-radius: 6px;
}
</style>
