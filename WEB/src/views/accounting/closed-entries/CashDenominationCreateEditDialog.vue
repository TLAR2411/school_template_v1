<script setup>
import { ref, watch, onMounted, computed } from "vue";
import { debounce } from "lodash";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import formatCurrency from "@/utils/formater/formatCurrency";
import { api } from "@/utils/api";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({
      type: "out",
      cash_date: new Date(),
      denominationValues: {},
    }),
  },
  users: {
    type: Array,
    default: () => [],
  },
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    required: false,
    default: undefined,
  },
  isPaymentByBank: { type: Boolean, default: false },
});

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

// State
const currentTab = ref(null); // Initialize as null
const cashDenominationType = ref([]);
const itemData = ref({ ...props.itemData });

// --- 1. Data Fetching ---
const initData = async () => {
  try {
    const res = await api.post("cash-denomination-types-all");
    if (res.data.status) {
      cashDenominationType.value = res.data.data;

      // Auto-select first tab if not set
      if (cashDenominationType.value.length > 0 && !currentTab.value) {
        currentTab.value = cashDenominationType.value[0].id;
      }

      // Re-run initialization now that we have the types
      initializeDenominations();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
};

// --- 2. Structure Initialization ---
const initializeDenominations = () => {
  if (
    !Array.isArray(cashDenominationType.value) ||
    cashDenominationType.value.length === 0
  )
    return;

  // Ensure denominationValues object exists
  if (!itemData.value.denominationValues) {
    itemData.value.denominationValues = {};
  }

  cashDenominationType.value.forEach((currencyType) => {
    // Ensure the specific currency ID object exists
    if (!itemData.value.denominationValues[currencyType.id]) {
      itemData.value.denominationValues[currencyType.id] = {};
    }

    // Initialize individual denomination keys to 0 if undefined
    currencyType.cash_denomination_types.forEach((denom) => {
      if (
        itemData.value.denominationValues[currencyType.id][denom.value] ===
        undefined
      ) {
        itemData.value.denominationValues[currencyType.id][denom.value] = 0;
      }
    });
  });
};

// --- 3. Calculation (Pure Function for Display) ---
const calculateDisplayTotal = (id) => {
  const values = itemData.value.denominationValues?.[id];
  if (!values) return 0;

  return Object.entries(values).reduce((acc, [key, val]) => {
    // Only calculate using numeric keys (denominations)
    if (key !== "total" && !isNaN(key)) {
      acc += Number(key) * Number(val);
    }
    return acc;
  }, 0);
};

// 1. Calculate Denominations Subtotal
const calculateDenominationTotal = (currencyId) => {
  const values = itemData.value.denominationValues?.[currencyId];
  if (!values) return 0;

  return Object.entries(values).reduce((acc, [key, val]) => {
    if (key !== "total" && !isNaN(key)) {
      acc += Number(key) * Number(val);
    }
    return acc;
  }, 0);
};
// 2. Calculate Grand Total (Denominations + Extra Fields)
const grandTotal = computed(() => {
  // Get total from denominations for the CURRENT tab
  const denomTotal = calculateDenominationTotal(currentTab.value);

  // Get values from the 3 extra fields (default to 0 if empty)
  const deposit = Number(itemData.value.deposit || 0);
  const disburse = Number(itemData.value.disburse || 0);
  const death = Number(itemData.value.write_off || 0);
  const bank = Number(itemData.value.bank || 0);

  return denomTotal + deposit + disburse + death + bank;
});

// --- 4. Watchers ---
watch(
  () => props.itemData,
  (newVal) => {
    // Use structuredClone for a deep copy, fallback to JSON parse/stringify
    try {
      itemData.value = structuredClone(newVal || {});
    } catch (e) {
      itemData.value = JSON.parse(JSON.stringify(newVal || {}));
    }
    initializeDenominations();
  },
  { deep: true, immediate: true },
);

const resetData = () => {
  itemData.value = {
    date: "",
    is_public_holiday: "",
    description: "",
    denominationValues: {},
    type: "out",
    cash_date: new Date(),
  };
  initializeDenominations();
};

// --- 5. Submit Logic ---
const onFormSubmit = debounce(async (refForm) => {
  // 1. Validate Form (assuming refForm is a VForm)
  // const { valid } = await refForm.validate(); // Uncomment if you have validation rules
  const valid = true; // Placeholder

  if (valid) {
    // 2. Calculate Totals just before submitting (avoid side effects in template)
    cashDenominationType.value.forEach((currency) => {
      const total = calculateDisplayTotal(currency.id);
      if (
        itemData.value.denominationValues &&
        itemData.value.denominationValues[currency.id]
      ) {
        itemData.value.denominationValues[currency.id].total = total;
      }
    });

    // 3. Emit
    const itemId = props?.itemData?.code || null;

    const eventName = itemId ? "onUpdate" : "onCreate";

    emit(eventName, itemData.value, (res) => {
      if (res) {
        resetData();
      }
    });
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

onMounted(() => {
  initData();
});

const sumTotal = computed(() => {
  const total = itemData.value?.denominationValues;
  return 0;
});

watch(
  () => props.isDialogVisible,
  (visible) => {
    if (visible) {
      // Check if we are in "Update" mode (has a code/ID) or "Create" mode
      const isUpdate =
        !!props.itemData?.code || !!props.itemData?.cash_denomination_code; // Adjust key based on your API

      if (isUpdate) {
        // UPDATE MODE: Copy data from props
        try {
          itemData.value = structuredClone(props.itemData);
        } catch (e) {
          itemData.value = JSON.parse(JSON.stringify(props.itemData));
        }
        initializeDenominations();
      } else {
        // CREATE MODE: Force a clean slate
        resetData();
      }
    }
  },
  { immediate: true },
);
</script>

<template>
  <AppAddEditDialog
    :is-dialog-visible="isDialogVisible"
    :title="
      itemData.cash_denomination?.cash_denomination_code == null
        ? 'Create Cash Denomination'
        : 'Update Cash Denomination'
    "
    :is-update="itemData.cash_denomination?.cash_denomination_code != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <!-- <VRow>
      <VCol cols="12" sm="6" md="6" class="mt-0 pt-0">
        <AppDateTimePicker
          v-model="itemData.cash_date"
          label="Date"
          placeholder="2025-01-01"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6" class="mt-0 pt-0">
        <AppAutocomplete
          v-model="itemData.cash_on_user"
          label="Cash On User"
          :items="users"
          :item-title="(item) => `${item.name_kh} (${item.position_abbr})`"
          item-value="id"
          clearable
        />
      </VCol>
    </VRow> -->

    <VTabs v-model="currentTab" grow stacked class="mb-4 d-none">
      <template v-for="item in cashDenominationType" :key="item.id">
        <VTab :value="item.id">
          <span style="font-family: freehand; font-size: 20px">
            {{ item.abbr }}
          </span>
          <span class="mt-2">{{ item.name_kh }}</span>
        </VTab>
      </template>
    </VTabs>

    <!-- {{ itemData.denominationValues }} -->
    <VCardText class="pl-0 pr-0 pb-0 pt-0">
      <VWindow v-model="currentTab">
        <template
          v-for="currencyType in cashDenominationType"
          :key="currencyType.id"
        >
          <VWindowItem :value="currencyType.id">
            <template v-if="itemData.denominationValues[currencyType.id]">
              <template
                v-for="denom in currencyType.cash_denomination_types"
                :key="denom.id"
              >
                <AppTextField
                  class="mb-1 custom-prefix"
                  v-model="
                    itemData.denominationValues[currencyType.id][denom.value]
                  "
                  format-currency
                  :prefix="formatCurrency(denom.value)"
                  :suffix="
                    formatCurrency(
                      (itemData.denominationValues[currencyType.id][
                        denom.value
                      ] || 0) * denom.value,
                    )
                  "
                  @blur="
                    () => {
                      // Only reset to 0 if the field is empty/null when clicking away
                      if (
                        !itemData.denominationValues[currencyType.id][
                          denom.value
                        ]
                      ) {
                        itemData.denominationValues[currencyType.id][
                          denom.value
                        ] = 0;
                      }
                    }
                  "
                />
              </template>
            </template>
          </VWindowItem>
        </template>
      </VWindow>

      <VRow>
        <VCol cols="12" class="mt-4">
          <AppTextField v-model="itemData.deposit" format-currency>
            <template #label> កាត់កងប្រាក់តម្កល់ </template>
          </AppTextField>
        </VCol>
        <VCol cols="12" class="mt-0 pt-0" v-if="isPaymentByBank == 'true'">
          <AppTextField v-model="itemData.bank" format-currency>
            <template #label> វេរតាមធនាគារ </template>
          </AppTextField>
        </VCol>

        <VCol cols="12" class="mt-0 pt-0">
          <AppTextField v-model="itemData.disburse" format-currency>
            <template #label> ដកក្នុងភូមិ </template>
          </AppTextField>
        </VCol>
        <VCol cols="12" class="mt-0 pt-0">
          <AppTextField v-model="itemData.write_off" format-currency>
            <template #label> អតិថិជនស្លាប់ </template>
          </AppTextField>
        </VCol>
      </VRow>

      <div
        class="d-flex flex-row justify-space-between mt-4 mb text-bolder text-error"
        style="font-size: 28px"
      >
        <span>{{ $t("Total") }}</span>
        <span> {{ formatCurrency(grandTotal) }}</span>
      </div>
    </VCardText>
  </AppAddEditDialog>
</template>

<style scoped>
/* UPDATED: Use :deep() instead of >>> for Vue 3 compatibility */
.custom-prefix :deep(.v-text-field__prefix) {
  position: relative;
  padding-right: 8px;
  margin-right: 8px;
  width: 100px;
  text-align: left;
  border-right: 1px solid #ccc;
}

.custom-prefix :deep(.v-text-field__suffix) {
  color: rgb(var(--v-theme-primary));
}

.custom-prefix :deep(.v-text-field__slot) {
  padding-left: 0;
}
</style>
