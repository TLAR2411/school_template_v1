<script setup>
import formatNoneZero from "@/utils/formater/formatNoneZero";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import formatContact from "@/utils/formater/formatContact";
const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});
const itemData = ref({ ...props.itemData });

const penaltyIndex = ref({
  index: 0,
  amount: 0,
});
const firstTrueStatus = ref(false);

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
  (newData) => {
    itemData.value = { ...newData };
    firstTrueStatus.value = false;
  },
  { deep: true }
);
</script>

<template>
  <div style="font-family: suwannaphum, sans-serif !important">
    <div class="mb-2">
      <h4 class="text-center" style="color: black">កាលវិភាគបង់ប្រាក់</h4>
    </div>
    <div class="d-flex flex-row mb-2" style="font-size: 13px">
      <div class="d-flex flex-column w-33">
        <table
          width="100%"
          class="text-no-wrap"
          style="color: black; font-size: 13px"
        >
          <tr>
            <td width="100px">
              <span class="text-start">អតិថិជន&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.client?.name_kh
              }}</span>
            </td>
          </tr>
          <!-- <tr>
          <td width="100px">
            <span class="text-start">មុខរបរ&nbsp;</span>
          </td>
          <td>
            <span class="text-start font-weight-bold">{{
              itemData?.loan_info?.client?.occupation?.name_kh
            }}</span>
          </td>
        </tr> -->
          <tr>
            <td width="100px">
              <span class="text-start">លេខទូរស័ព្ទ&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.client?.contact
                  ? formatContact(itemData?.loan_info?.client?.contact)
                  : "N/A"
              }}</span>
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">អ្នកធានា&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.guarantor?.name_kh || "N/A"
              }}</span>
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">លេខទូរស័ព្ទ&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.guarantor?.contact
                  ? formatContact(itemData?.loan_info?.guarantor?.contact)
                  : "N/A"
              }}</span>
            </td>
          </tr>
        </table>
      </div>

      <div class="d-flex flex-column w-33">
        <table width="100%" style="color: black; font-size: 13px">
          <tr>
            <td width="100px">
              <span class="text-start">ទំហំកម្ចី&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold"
                >{{ formatCurrency(itemData?.loan_info?.loan_amount) }}&nbsp;{{
                  itemData?.loan_info?.currency?.currency_code
                }}</span
              >
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">វគ្គកម្ចី&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.loan_cycle
              }}</span>
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">រយៈពេលកម្ចី&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold"
                >{{ itemData?.loan_info?.loan_duration }}&nbsp;{{
                  itemData?.loan_info?.loan_term?.sort
                }}</span
              >
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">ថ្ងៃអនុម័ត&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                formatDate(itemData?.loan_info?.approval_date)
              }}</span>
            </td>
          </tr>
        </table>
      </div>

      <div class="d-flex flex-column w-33">
        <table
          width="100%"
          class="text-no-wrap"
          style="color: black; font-size: 13px"
        >
          <tr>
            <td width="100px">
              <span class="text-start">មន្ត្រីឥណទាន&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.co?.name_kh
              }}</span>
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">ភេទ&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                formatGender(itemData?.loan_info?.co?.gender)
              }}</span>
            </td>
          </tr>
          <tr>
            <td width="100px">
              <span class="text-start">លេខទូរស័ព្ទ&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.co?.contact
                  ? formatContact(itemData?.loan_info?.co?.contact)
                  : "N/A"
              }}</span>
            </td>
          </tr>
          <!-- <tr>
            <td width="100px">
              <span class="text-start">ប្រចាំការក្នុងសាខា&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.co?.branch?.name_kh || "N/A"
              }}</span>
            </td>
          </tr> -->
          <tr>
            <td width="100px">
              <span class="text-start">លេខទូរសព្ទសាខា&nbsp;</span>
            </td>
            <td>
              <span class="text-start font-weight-bold">{{
                itemData?.loan_info?.co?.branch?.contact
                  ? formatContact(itemData?.loan_info?.co?.branch?.contact)
                  : "N/A"
              }}</span>
            </td>
          </tr>
        </table>
      </div>
    </div>
    <!-- <div style="font-size: 12.5px; color: black; margin-bottom: 10px">
      <span v-if="itemData?.loan_info?.client?.village" class="text-start">
        អាសយដ្ឋានអតិថិជន៖
        {{ itemData?.loan_info?.client?.village.name_kh }} /
        {{ itemData?.loan_info?.client?.village.commune.name_kh }} /
        {{ itemData?.loan_info?.client?.village.commune.district.name_kh }}/
        {{
          itemData?.loan_info?.client?.village.commune.district.province.name_kh
        }}
      </span>
    </div> -->

    <table
      class="text-no-wrap custom-table w-100"
      style="
        border-collapse: collapse;
        border: 1px solid black;
        font-size: 12.5px;
      "
    >
      <thead>
        <tr style="background-color: rgba(211, 211, 211, 0.2)">
          <th class="text-center" style="width: 50px">ល.រ</th>
          <th class="text-center" colspan="2">ថ្ងៃបង់ប្រាក់</th>
          <th class="text-center" style="width: 15%">ប្រាក់ត្រូវបង់</th>
          <th class="text-center" style="width: 15%">ប្រាក់បានបង់</th>
          <!-- <th class="text-center" style="width: 15%">សរុប</th> -->
          <th class="text-center" style="width: 35%">ផ្សេងៗ</th>
        </tr>
      </thead>
      <tbody>
        <template v-for="(item, index) in itemData.schedules">
          <tr>
            <td
              class="text-center"
              style="background-color: rgba(211, 211, 211, 0.2)"
            >
              {{ item.schedule_number }}
            </td>

            <td class="text-start pl-2" width="75px">
              {{ item.payment_date_khmer }}
            </td>
            <td class="text-center">{{ formatDate(item.payment_date) }}</td>
            <!-- <td class="text-end">
            {{ formatCurrency(item.principle_amount) }}
          </td>
          <td class="text-end">
            {{ formatCurrency(item.interest_amount) }}
          </td> -->
            <!-- <td class="text-end">
            {{
              formatCurrency(
                
              )
            }}
          </td> -->
            <td class="text-end">
              {{
                formatNoneZero(
                  parseFloat(item.income_amount) +
                    parseFloat(
                      getTotalPenalty(item, index) ||
                        parseFloat(
                          index == penaltyIndex.index ? penaltyIndex.amount : 0
                        )
                    )
                )
              }}
            </td>
            <td class="text-end">
              {{
                item.income_paid == 0 ? "" : formatCurrency(item.income_paid)
              }}
            </td>
            <!-- <td class="text-end">
            {{
              formatNoneZero(
                parseFloat(item.income_amount) +
                  parseFloat(
                    index == penaltyIndex.index ? penaltyIndex.amount : 0
                  ) -
                  parseFloat(item.income_paid)
              )
            }}
          </td> -->
            <!-- <td class="text-end">
            {{ formatNoneZero(item.balance_amount) }}
          </td> -->
            <td></td>
          </tr>
        </template>
      </tbody>
    </table>

    <div
      class="d-flex flex-row justify-space-between mt-5"
      style="font-size: 13px"
    >
      <div
        class="d-flex flex-column text-center ml-10"
        style="font-size: 13px; color: black"
      >
        <span>ស្នាមមេដៃអ្នកទទួលប្រាក់</span>
      </div>
      <div
        class="d-flex flex-column text-center mr-10"
        style="font-size: 13px; color: black"
      >
        <span
          >{{ itemData?.loan_info?.co?.branch?.name_kh || "N/A" }},&nbsp;{{
            itemData?.current_date
          }}</span
        >
        <span>ស្នាមមេដៃអ្នកប្រគល់ប្រាក់</span>
      </div>
    </div>
  </div>
</template>

<style scoped>
/* Print-specific styles */
@media print {
  .printDiv {
    display: block !important;
  }
}
@page {
  size: A4 portrait !important;
  margin: 0.5cm 0.5cm 0.5cm 0.5cm !important;
}
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
.custom-table {
  table,
  td,
  th {
    border: 1px solid;
    padding: 2px;
    color: black;
    font-size: 13px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }
}
</style>
