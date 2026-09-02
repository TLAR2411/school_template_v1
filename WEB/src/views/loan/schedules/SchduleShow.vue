<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { getReceiveDays } from "@/services/dataService";
import { onMounted, ref, watch, computed } from "vue";
import { useDisplay } from "vuetify";
import ReceivePerScheduleDialog from "@/views/loan/receives/ReceivePerScheduleDialog.vue";

const { mobile } = useDisplay();

const props = defineProps({
  itemData: { type: Object, required: false, default: () => ({}) },
  totalAmount: { type: Number, default: 0 },
});

const emit = defineEmits(["onReload"]);
const receiveDays = ref([]);
const isReceiveDialogVisible = ref(false);
const scheduleSelected = ref(null);
const penaltyIndex = ref({
  index: 0,
  amount: 0,
});
const firstTrueStatus = ref(false);
// --- FIXED PENALTY LOGIC ---

// 1. Safe access to total penalty
const totalPenaltyAmount = computed(() => {
  return parseFloat(props.itemData?.totalPenalty || 0);
});
const totalPenalty = computed(() => {
  const penalty = parseFloat(props.itemData.totalPenalty || 0);
  // console.log("totalPenalty:", props.itemData.totalPenalty, "parsed:", penalty);
  return penalty;
});

// 2. ROBUST Index Finder
// Fixes "findIndex is not a function" error
const penaltyTargetIndex = computed(() => {
  const list = props.itemData?.schedules;

  // Safety Check: If list doesn't exist OR isn't an Array, stop here.
  if (!list || !Array.isArray(list)) return -1;

  return list.findIndex((item) => item.status == 1);
});

// 3. Helper to get penalty for a specific row
const getPenaltyForItem = (index) => {
  // If we couldn't find a valid index, return 0
  if (penaltyTargetIndex.value === -1) return 0;

  if (index === penaltyTargetIndex.value) {
    return totalPenaltyAmount.value;
  }
  return 0;
};

// 4. Calculate Total Due (Income + Penalty)
const calculateTotalToPay = (item, index) => {
  const income = parseFloat(item.income_amount || 0);
  const penalty = getPenaltyForItem(index);
  return income + penalty;
};

// 5. Calculate Remaining Balance
const calculateRemaining = (item, index) => {
  const total = calculateTotalToPay(item, index);
  const paid = parseFloat(item.income_paid || 0);
  return total - paid;
};

// 6. Check if "Receive" button should be active
const canReceive = (item) => {
  if (!item) return false;
  return (
    (receiveDays.value.find((v) => v.date == item.payment_date) &&
      item.status == true) ||
    (parseFloat(item.schedule_number) ==
      parseFloat(props.itemData?.loanDuration || 0) &&
      item.status == true)
  );
};

onMounted(async () => {
  try {
    const [dataReceiveDays] = await Promise.all([getReceiveDays()]);
    receiveDays.value = dataReceiveDays || [];
  } catch (e) {
    console.error("Failed to load receive days", e);
  }
});

const onReceive = async (item) => {
  scheduleSelected.value = item;
  isReceiveDialogVisible.value = true;
};

const onReload = () => emit("onReload");

const getTotalPenalty = (item, index) => {
  if (item.status == 1 && !firstTrueStatus.value) {
    firstTrueStatus.value = true;
    penaltyIndex.value = {
      index: index,
      amount: totalPenalty,
    };
    return totalPenalty.value;
  }
  return 0;
};
</script>

<template>
  <ReceivePerScheduleDialog
    v-if="isReceiveDialogVisible"
    v-model:is-dialog-visible="isReceiveDialogVisible"
    :item-data="{
      loan_id: scheduleSelected.loan_id,
      schedule_id: scheduleSelected.id,
    }"
    @onReload="onReload"
  />

  <div v-if="mobile" class="mobile-container">
    <div
      class="d-flex justify-space-between align-center px-4 py-3 bg-grey-lighten-4 mb-2"
    >
      <span class="font-weight-bold text-grey-darken-2">{{ $t("Total") }}</span>
      <span class="text-h6 font-weight-black text-primary">{{
        formatCurrency(totalAmount)
      }}</span>
    </div>

    <v-expansion-panels variant="accordion" class="px-2 pb-10">
      <v-expansion-panel
        v-for="(item, index) in itemData.schedules"
        :key="index"
        :class="{ 'opacity-60': item.status == 0 }"
        elevation="1"
        class="mb-1 rounded border-thin"
      >
        <v-expansion-panel-title class="py-2 px-3" style="min-height: 60px">
          <div class="d-flex justify-space-between align-center w-100 mr-2">
            <div class="d-flex align-center">
              <v-icon
                :icon="
                  item.status == 0
                    ? 'tabler-square-check-filled'
                    : 'tabler-square'
                "
                :color="item.status == 0 ? 'success' : 'grey-lighten-1'"
                class="mr-3"
              />
              <div>
                <div class="font-weight-bold text-grey-darken-3">
                  {{ item.payment_date_khmer }}
                </div>
                <div class="text-grey mt-1">
                  #{{ item.schedule_number }} &nbsp;{{
                    formatDate(item.payment_date)
                  }}
                </div>
              </div>
            </div>

            <div class="text-end">
              <div
                class="font-weight-bold"
                :class="
                  item.status == 0
                    ? 'text-decoration-line-through text-grey'
                    : 'text-primary'
                "
              >
                {{
                  formatCurrency(
                    (getTotalPenalty(item, index) ||
                      parseFloat(
                        index == penaltyIndex.index ? penaltyIndex.amount : 0,
                      )) + calculateTotalToPay(item, index),
                  )
                }}
              </div>
              <div
                v-if="getPenaltyForItem(index) > 0"
                class="text-error font-weight-bold"
                style="font-size: 10px"
              >
                (+{{ formatCurrency(getPenaltyForItem(index)) }} Penalty)
              </div>
            </div>
          </div>
        </v-expansion-panel-title>

        <v-expansion-panel-text class="bg-grey-lighten-5">
          <div class="pt-3">
            <v-row dense class="mb-4">
              <v-col cols="6" class="text-grey-darken-1"
                >ប្រាក់ដើម + ការប្រាក់</v-col
              >
              <v-col cols="6" class="text-end font-weight-medium">
                {{ formatCurrency(parseFloat(item.income_amount)) }}
              </v-col>

              <template
                v-if="
                  getTotalPenalty(item, index) ||
                  parseFloat(
                    index == penaltyIndex.index ? penaltyIndex.amount : 0,
                  ) > 0
                "
              >
                <v-col cols="6" class="text-error font-weight-bold"
                  >ប្រាក់ពិន័យ (Penalty)</v-col
                >
                <v-col cols="6" class="text-end text-error font-weight-bold">
                  +
                  {{
                    getTotalPenalty(item, index) ||
                    parseFloat(
                      index == penaltyIndex.index ? penaltyIndex.amount : 0,
                    )
                  }}
                </v-col>
                <v-divider class="my-2" color="error"></v-divider>
              </template>
              <template v-else>
                <v-divider class="my-2"></v-divider>
              </template>

              <v-col cols="6" class="text-grey-darken-1">បានបង់ (Paid)</v-col>
              <v-col cols="6" class="text-end text-success font-weight-bold">
                {{ formatCurrency(parseFloat(item.income_paid)) }}
              </v-col>

              <v-col cols="6" class="text-grey-darken-1"
                >នៅជំពាក់ (Balance)</v-col
              >
              <v-col cols="6" class="text-end text-black font-weight-bold">
                {{
                  formatCurrency(
                    getTotalPenalty(item, index) ||
                      parseFloat(
                        index == penaltyIndex.index ? penaltyIndex.amount : 0,
                      ) + calculateRemaining(item, index),
                  )
                }}
              </v-col>
            </v-row>

            <v-btn
              v-if="canReceive(item)"
              block
              color="success"
              variant="elevated"
              @click.prevent="onReceive(item)"
            >
              <v-icon start icon="tabler-receipt-dollar" />
              {{ $t("Receive") }}
            </v-btn>
          </div>
        </v-expansion-panel-text>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
  <VTable class="text-no-wrap custom-header" v-else>
    <thead>
      <tr style="background-color: rgba(211, 211, 211, 0.2)">
        <th class="text-center" style="width: 10px">ល.រ</th>
        <th class="text-start" colspan="2">ថ្ងៃបង់ប្រាក់</th>
        <!-- <th class="text-end">ប្រាក់ដើមត្រូវបង់</th>
        <th class="text-end">ការប្រាក់ត្រូវបង់</th> -->
        <th class="text-end">ប្រាក់ពិន័យ</th>
        <th class="text-end">សរុបប្រាក់ត្រូវបង់</th>
        <th class="text-center">សរុបប្រាក់បានបង់</th>
        <th class="text-center">សរុបប្រាក់នៅជំពាក់</th>
        <th class="text-center"></th>
      </tr>
    </thead>
    <tbody>
      <template v-for="(item, index) in itemData.schedules" :key="index">
        <tr
          :class="{
            'row-line-through': item.status == 0,
          }"
        >
          <td
            class="text-center"
            style="background-color: rgba(211, 211, 211, 0.2)"
          >
            {{ item.schedule_number }}
          </td>
          <td class="text-start">
            {{ item.payment_date_khmer }}
          </td>
          <td class="text-start">{{ formatDate(item.payment_date) }}</td>
          <!-- <td class="text-end">
            {{ formatCurrency(parseFloat(item.principal_amount)) }}
          </td>
          <td class="text-end">
            {{ formatCurrency(parseFloat(item.interest_amount)) }}
          </td> -->
          <td class="text-end">
            {{
              formatCurrency(
                getTotalPenalty(item, index) ||
                  parseFloat(
                    index == penaltyIndex.index ? penaltyIndex.amount : 0,
                  ),
              )
            }}
          </td>
          <td
            class="text-end"
            style="background-color: rgba(211, 211, 211, 0.2)"
          >
            {{
              formatCurrency(
                parseFloat(item.income_amount) +
                  parseFloat(
                    index == penaltyIndex.index ? penaltyIndex.amount : 0,
                  ),
              )
            }}
          </td>
          <td class="text-end">
            {{ formatCurrency(parseFloat(item.income_paid)) }}
          </td>
          <td
            class="text-end"
            style="background-color: rgba(211, 211, 211, 0.2)"
          >
            {{
              formatCurrency(
                parseFloat(item.income_amount) +
                  parseFloat(
                    index == penaltyIndex.index ? penaltyIndex.amount : 0,
                  ) -
                  parseFloat(item.income_paid),
              )
            }}
          </td>
          <td class="text-end">
            <VBtn
              variant="tonal"
              color="success"
              class="align-center"
              v-if="
                (receiveDays.find((v) => v.date == item.payment_date) &&
                  item.status == true) ||
                (parseFloat(item.schedule_number) ==
                  parseFloat(itemData.loanDuration) &&
                  item.status == true)
              "
              @click.prevent="onReceive(item)"
            >
              <VIcon start icon="tabler-receipt-dollar" />
              {{ $t("Receive") }}
            </VBtn>
          </td>
        </tr>
      </template>
    </tbody>
    <tfoot>
      <tr style="font-size: 20px">
        <td class="text-end" colspan="6">{{ $t("Total") }}</td>
        <td class="text-end">{{ formatCurrency(totalAmount) }}</td>
        <td></td>
      </tr>
    </tfoot>
  </VTable>
</template>

<style scoped>
.row-line-through {
  position: relative;
  opacity: 0.6;
}
.row-line-through::after {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background-color: #000000;
  transform: translateY(-50%);
  pointer-events: none;
}
.opacity-60 {
  opacity: 0.6;
}
.border-thin {
  border: 1px solid rgba(0, 0, 0, 0.08);
}
</style>
