<script setup>
import { ref, watch, nextTick, onMounted } from "vue";
import { debounce } from "lodash";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import formatCurrency from "@/utils/formater/formatCurrency";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";
import InOut from "@/components/AppTowRadioIcon.vue";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({
      type: "out",
      cash_date: new Date(),
    }),
  },
  cashDenominationType: {
    type: Array,
    default: () => [],
  },
  cashDenominationPurposes: {
    type: Array,
    default: () => [],
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
    skipCheck: true,
    default: undefined,
  },
});

const propertyRadioContent = [
  {
    title: "In",
    icon: {
      icon: "tabler-arrow-down",
      size: "28",
    },
    value: "in",
  },
  {
    title: "Out",
    icon: {
      icon: "tabler-arrow-up",
      size: "28",
    },
    value: "out",
  },
];

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

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const currentTab = ref(1);
const purposes = ref(props.cashDenominationPurposes || []);

const type = [
  { name: "Out", value: "out" },
  { name: "In", value: "in" },
];

const itemData = ref({ ...props.itemData });

const initializeDenominations = () => {
  if (!Array.isArray(props.cashDenominationType)) return;

  if (!itemData.value.denominationValues) {
    itemData.value.denominationValues = {};
  }

  props.cashDenominationType.forEach((type) => {
    if (!itemData.value.denominationValues[type.id]) {
      itemData.value.denominationValues[type.id] = {};
    }

    type.cash_denomination_types.forEach((denom) => {
      if (
        itemData.value.denominationValues[type.id][denom.value] === undefined
      ) {
        itemData.value.denominationValues[type.id][denom.value] = 0;
      }
    });
    // Initialize total
    itemData.value.denominationValues[type.id].total = 0;
  });
};

const calculateTotal = (id) => {
  const values = itemData.value.denominationValues?.[id];
  if (!values) return 0;

  // Skip `total` key in calculation
  const total = Object.entries(values).reduce((acc, [key, val]) => {
    if (key !== "total") {
      acc += Number(key) * Number(val);
    }
    return acc;
  }, 0);

  // Update the total field
  itemData.value.denominationValues[id].total = total;

  return total;
};

watch(
  () => props.itemData,
  (newVal) => {
    initializeDenominations();
    itemData.value = JSON.parse(JSON.stringify(newVal || {}));
  },
  { deep: true, immediate: true },
);

watch(
  () => props.cashDenominationType,
  () => {
    initializeDenominations();
  },
  { deep: true, immediate: true },
);
watch(
  () => props.cashDenominationPurposes,
  (newVal) => {
    purposes.value = newVal.filter((v) => v.type == itemData.value.type) || [];
  },
  { immediate: true },
);
// Reset form

// Submit form
const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    const itemId = itemData.value.id || null;
    if (itemId) {
      emit("onUpdate", itemData.value, (res) => {
        if (res) {
          resetData();
        }
      });
    } else {
      emit("onCreate", itemData.value, (res) => {
        if (res) {
          resetData();
        }
      });
    }
  }
}, 500);

// Close dialog
const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

watch(
  () => itemData.value.type,
  (newVal, oldVal) => {
    purposes.value = props.cashDenominationPurposes.filter(
      (v) => v.type == newVal,
    );
    const fildPurpose = purposes.value.filter(
      (v) => v.id == itemData.value.cash_denomination_purpose_id,
    );
    if (fildPurpose == 0) {
      itemData.value.cash_denomination_purpose_id = null;
    }
  },
  { deep: true, immediate: true },
);
</script>

<template>
  <AppAddEditDialog
    :is-dialog-visible="isDialogVisible"
    :title="
      itemData.id == null
        ? 'Create Cash Denomination'
        : 'Update Cash Denomination'
    "
    :is-update="itemData.id != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6" md="6" class="mt-0 pt-0">
        <AppDateTimePicker
          v-model="itemData.cash_date"
          label="Date"
          placeholder="2025-01-01"
        />
      </VCol>
      <!-- <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.type"
          label="Type"
          :items="type"
          item-title="name"
          item-value="value"
        />
      </VCol> -->
      <VCol cols="12" sm="6" md="6" class="mt-0 pt-0">
        <AppAutocomplete
          v-model="itemData.cash_on_user"
          label="Cash On User"
          :items="users"
          :item-title="
            (item) => {
              return `${item.name_kh} (${item.position_abbr})`;
            }
          "
          item-value="id"
          clearable
        />
      </VCol>
    </VRow>
    <!-- <VDivider class="mt-5" /> -->

    <VTabs v-model="currentTab" grow stacked class="d-none">
      <template v-for="item in cashDenominationType" :key="item.id">
        <VTab :value="item.id">
          <span style="font-family: freehand; font-size: 20px">
            {{ item.abbr }}
          </span>
          <span class="mt-2">{{ item.name_kh }}</span>
        </VTab>
      </template>
    </VTabs>

    <VCardText class="pl-0 pr-0 pb-0">
      <VWindow v-model="currentTab">
        <template v-for="item in cashDenominationType" :key="item.id">
          <VWindowItem :value="item.id">
            <!-- <div class="d-flex flex-row justify-space-between mb-4">
              <span>{{ $t("Cash Denominations") }}</span>
              <span>{{ $t("Total") }}</span>
            </div> -->
            <template v-for="i in item.cash_denomination_types" :key="i.id">
              <AppTextField
                class="mb-1 custom-prefix"
                v-model="itemData.denominationValues[item.id][i.value]"
                format-currency
                :prefix="formatCurrency(i.value)"
                :suffix="
                  formatCurrency(
                    itemData.denominationValues[item.id][i.value] * i.value,
                  )
                "
              />
            </template>

            <!-- <VDivider class="mt-5 mb-5" /> -->
            <div
              class="d-flex flex-row justify-space-between mt-4 mb-4 text-bolder text-error"
              style="font-size: 28px"
            >
              <span class="">{{ $t("Total") }}</span>
              <span> {{ formatCurrency(calculateTotal(item.id)) }}</span>
            </div>
          </VWindowItem>
        </template>
      </VWindow>
    </VCardText>

    <VRow>
      <VCol cols="12" sm="12" md="12" class="pb-0">
        <InOut
          v-model:selected-radio="itemData.type"
          :radio-content="propertyRadioContent"
          :grid-column="{ cols: '12', sm: '6' }"
        />
      </VCol>
      <VCol cols="12" sm="12" md="12" class="pb-0">
        <AppAutocomplete
          v-model="itemData.cash_denomination_purpose_id"
          label="Purpose"
          :items="purposes"
          item-title="name"
          item-value="id"
        />
      </VCol>
      <VCol cols="12" sm="12" md="12">
        <AppTextarea
          v-model="itemData.description"
          label="Description"
          clearable
          clear-icon="tabler-x"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
<style scoped>
/* Style the prefix and add a vertical line */
.custom-prefix >>> .v-text-field__prefix {
  position: relative;
  padding-right: 8px; /* Space between prefix text and line */
  margin-right: 8px; /* Space between line and input */
  width: 150px; /* Optional: fixed width for consistency */
  text-align: left; /* Align prefix content */
}

.custom-prefix >>> .v-text-field__suffix {
  color: rgb(var(--v-theme-primary));
}

/* Add vertical line using border */
.custom-prefix >>> .v-text-field__prefix {
  border-right: 1px solid #ccc; /* Vertical line color and thickness */
}

/* Optional: Adjust input slot to align with prefix */
.custom-prefix >>> .v-text-field__slot {
  padding-left: 0; /* Ensure input text doesn’t overlap */
}
</style>
