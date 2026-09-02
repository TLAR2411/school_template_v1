<script setup>
import { ref, watch, nextTick, onMounted } from "vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import formatCurrency from "@/utils/formater/formatCurrency";

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
    title="Cash Denomination Details"
    :loading="loading"
    :is-submit="false"
    @on-close-dialog="onCloseDialog"
    icon="tabler-list"
  >
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

    <VCardText class="pl-0 pr-0 pb-0 pt-0">
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
                readonly
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
