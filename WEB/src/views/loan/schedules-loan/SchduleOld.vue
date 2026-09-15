<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { getReceiveDays } from "@/services/dataService";
import { onMounted, ref, watch } from "vue";
import ReceivePerScheduleDialog from "@/views/loan/receives/ReceivePerScheduleDialog.vue";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  totalAmount: {
    type: Number,
    default: 0,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const emit = defineEmits(["onReload"]);

const penaltyIndex = ref({
  index: 0,
  amount: 0,
});
const firstTrueStatus = ref(false);
const receiveDays = ref([]);
const isReceiveDialogVisible = ref(false);
const scheduleSelected = ref(null);
const scheduleIdSelected = ref(null);

const totalPenalty = computed(() => {
  const penalty = parseFloat(props.itemData.totalPenalty || 0);
  // console.log("totalPenalty:", props.itemData.totalPenalty, "parsed:", penalty);
  return penalty;
});

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

watch(
  () => props.itemData,
  () => {
    console.log("itemData changed:", props.itemData);
    firstTrueStatus.value = false;
  },
  { deep: true },
);

onMounted(async () => {
  const [dataReceiveDays] = await Promise.all([getReceiveDays()]);
  receiveDays.value = dataReceiveDays;
});

const onReceive = async (item) => {
  scheduleSelected.value = item;

  isReceiveDialogVisible.value = true;
};

const onReload = () => {
  emit("onReload");
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

  <VTable class="text-no-wrap custom-header">
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
  /* This is required to position the line relative to the row */
  position: relative;
}

/* This creates the actual line */
.row-line-through::after {
  content: ""; /* A pseudo-element must have a content property */
  position: absolute;
  top: 50%; /* Position the line in the vertical middle of the row */
  left: 0; /* Start the line at the far left edge */
  right: 0; /* End the line at the far right edge */
  height: 1px; /* The thickness of the line */
  background-color: #000000; /* The color of the line (a bold red) */
  transform: translateY(-50%); /* Fine-tune the vertical centering */
}
</style>
