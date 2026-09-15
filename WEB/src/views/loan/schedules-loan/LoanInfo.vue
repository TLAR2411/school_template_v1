<script setup>
import formatContact from "@/utils/formater/formatContact";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import { template } from "@antfu/utils";

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
</script>

<template>
  <VRow>
    <VCol cols="12" lg="4" md="4" sm="12">
      <h3 class="text-start text-primary">
        ព័ត៌មានអតិថិជន&nbsp;{{ itemData?.client?.code }}
      </h3>
      <VDivider class="mt-2 mb-4" />
      <VRow>
        <VCol
          cols="12"
          lg="12"
          md="12"
          sm="12"
          style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis"
        >
          <table width="100%" class="text-no-wrap">
            <tr>
              <td width="100px">
                <h4 class="text-start">ឈ្មោះអតិថិជន:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{ itemData?.client?.name_kh }}</span>
              </td>
            </tr>
            <!-- <tr>
              <td width="100px">
                <h4 class="text-start">ភេទ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  formatGender(itemData?.client?.gender)
                }}</span>
              </td>
            </tr> -->
            <!-- <tr>
              <td width="100px">
                <h4 class="text-start">មុខរបរ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.client?.occupation?.name_kh
                }}</span>
              </td>
            </tr> -->

            <tr>
              <td width="100px">
                <h4 class="text-start">លេខទូរស័ព្ទ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  formatContact(itemData?.client?.contact)
                }}</span>
              </td>
            </tr>

            <tr>
              <td width="100px">
                <h4 class="text-start">ឈ្មោះអ្នកធានា:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.guarantor?.name_kh
                }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">លេខទូរស័ព្ទ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.guarantor?.contact
                    ? formatContact(itemData?.guarantor?.contact)
                    : "N/A"
                }}</span>
              </td>
            </tr>

            <tr
              style="
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
              "
            >
              <td width="100px">
                <h4 class="text-start">អាសយដ្ឋាន:&nbsp;&nbsp;</h4>
              </td>
              <td
                v-if="itemData?.client?.village"
                style="overflow-wrap: break-word"
              >
                {{ itemData?.client?.village.name_kh }} /
                {{ itemData?.client?.village.commune.name_kh }} /
                {{ itemData?.client?.village.commune.district.name_kh }} /
                {{
                  itemData?.client?.village.commune.district.province.name_kh
                }}
              </td>
            </tr>
          </table>
        </VCol>
      </VRow>
    </VCol>

    <VCol cols="12" lg="4" md="4" sm="12">
      <h3 class="text-start text-primary">
        ព័ត៌មានកម្ចី&nbsp;{{ itemData?.code }}
      </h3>
      <VDivider class="mt-2 mb-4" />
      <VRow>
        <VCol cols="12" lg="12" md="12" sm="12">
          <table width="100%" class="text-no-wrap">
            <tr>
              <td width="100px">
                <h4 class="text-start">រូបិយប័ណ្ណ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.currency?.currency_code
                }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">ទំហំកម្ចី:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  formatCurrency(itemData?.loan_amount)
                }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">វគ្គកម្ចី:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{ itemData?.loan_cycle }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">រយៈពេលកម្ចី:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start"
                  >{{ itemData?.loan_duration }}&nbsp;{{
                    itemData?.loan_term?.sort
                  }}</span
                >
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">កាលបរិច្ឆេទអនុម័ត:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  formatDate(itemData?.approval_date)
                }}</span>
              </td>
            </tr>
          </table>
        </VCol>
      </VRow>
    </VCol>
    <VCol cols="12" lg="4" md="4" sm="12">
      <h3 class="text-start text-primary">ព័ត៌មានមន្ត្រីឥណទាន</h3>
      <VDivider class="mt-2 mb-4" />
      <VRow>
        <VCol cols="12" lg="12" md="12" sm="12">
          <table width="100%" class="text-no-wrap">
            <tr>
              <td width="100px">
                <h4 class="text-start">ឈ្មោះមន្ត្រីឥណទាន:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{ itemData?.co?.name_kh }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">ភេទ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  formatGender(itemData?.co?.gender)
                }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">លេខទូរស័ព្ទ:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.co?.contact
                    ? formatContact(itemData?.co?.contact)
                    : "N/A"
                }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">ប្រចាំការក្នុងសាខា:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.co?.branch?.name_kh
                }}</span>
              </td>
            </tr>
            <tr>
              <td width="100px">
                <h4 class="text-start">លេខទូរស័ព្ទសាខា:&nbsp;&nbsp;</h4>
              </td>
              <td>
                <span class="text-start">{{
                  itemData?.co?.branch?.contact
                    ? formatContact(itemData?.co?.branch?.contact)
                    : "N/A"
                }}</span>
              </td>
            </tr>
          </table>
        </VCol>
      </VRow>
    </VCol>
  </VRow>
</template>

<style scoped>
table td {
  padding: 5px !important;
}
</style>
