<script setup>
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import hasPermission from "@/utils/hasPermission";
import CashDenominationCreateEditDialog from "@/views/accounting/closed-entries/CashDenominationCreateEditDialog.vue";
import { onMounted } from "vue";

const props = defineProps({
  itemData: { type: Object, default: [] },
  loading: { type: Boolean, default: false },
  coId: { type: String, default: null },
  isPaymentByBank: { type: Boolean, default: false },
});

const emit = defineEmits(["reload"]);

const isCashDenominationCreateEditDialog = ref(false);
const formData = ref({});
const isLoading = ref(props.loading);

const onCreate = async (item, callback) => {
  isLoading.value = true;
  try {
    const res = await api.post("cash-denominations-daily-cash-store", {
      ...item,
      co_id: props.coId,
    });
    if (res.data.status) {
      isCashDenominationCreateEditDialog.value = false;
      emit("reload");
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
  isLoading.value = false;
};

const onUpdate = async (item, callback) => {
  isLoading.value = true;
  try {
    const res = await api.post("cash-denominations-daily-cash-update", {
      ...item,
      co_id: props.coId,
    });
    if (res.data.status) {
      isCashDenominationCreateEditDialog.value = false;
      emit("reload");
      show();
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
  isLoading.value = false;
};

const onSubmit = async (item) => {
  isLoading.value = true;
  try {
    const res = await api.post("cash-denominations-submit", {
      id: props.itemData?.cash_denomination?.cash_denomination_id,
      shift_amount:
        props?.itemData?.cash_denomination?.total -
        props?.itemData.receive_amount,
    });
    if (res.data.status) {
      emit("reload");
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
  isLoading.value = false;
};

const show = async () => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-show", {
      code: props?.itemData.cash_denomination?.cash_denomination_code,
    });

    if (res.data.status) {
      formData.value = res.data.data;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

watch(
  () => props?.itemData.cash_denomination?.cash_denomination_code,
  (n, o) => {
    if (n != null) {
      show();
    } else {
      formData.value = {};
    }
  },
);
</script>

<template>
  <CashDenominationCreateEditDialog
    ref="createDialog"
    v-if="isCashDenominationCreateEditDialog"
    v-model:is-dialog-visible="isCashDenominationCreateEditDialog"
    v-model:loading="isLoading"
    :item-data="formData"
    :is-payment-by-bank="isPaymentByBank"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <AppCard
    :is-back="false"
    title="Cash Denominations"
    title-icon="tabler-cash"
    :loading="loading"
    :createDialog="itemData?.cash_denomination?.can_create"
    :editDialog="itemData?.cash_denomination?.can_update"
    v-model:isDialogCreateVisible="isCashDenominationCreateEditDialog"
    v-model:isDialogEditVisible="isCashDenominationCreateEditDialog"
  >
    <VRow>
      <VCol class="pa-0">
        <VTable>
          <thead style="background-color: rgba(211, 211, 211, 0.2)">
            <tr>
              <th>ប្រភេទ</th>
              <th class="text-center">ចំនួន</th>
              <th class="text-end">សរុប</th>
            </tr>
          </thead>
          <tbody>
            <template
              v-for="(item, index) in itemData?.cash_denomination?.type"
            >
              <tr>
                <td class="text-start">{{ formatCurrency(item) }}</td>
                <td class="text-center font-weight-bold">
                  {{ itemData?.cash_denomination?.value[index] || 0 }}
                </td>
                <td class="text-end font-weight-bold">
                  {{
                    formatCurrency(
                      item * (itemData?.cash_denomination?.value[index] || 0),
                    )
                  }}
                </td>
              </tr>
            </template>
          </tbody>
        </VTable>
        <VDivider />
        <VTable>
          <thead style="background-color: rgba(211, 211, 211, 0.2)">
            <tr>
              <th colspan="2" class="text-center">ផ្សេងៗ</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                <div class="d-flex flex-column pa-1 text-center">
                  <span style="font-size: 12px; color: gray"
                    >សរុបសន្លឹកលុយ
                  </span>
                  <span class="font-weight-bold">
                    {{
                      formatCurrency(itemData?.cash_denomination?.cash)
                    }}</span
                  >
                </div>
              </td>
              <td>
                <div class="d-flex flex-column pa-1 text-center">
                  <span style="font-size: 12px; color: gray"
                    >កាត់កងប្រាក់តម្កល់
                  </span>
                  <span class="font-weight-bold">
                    {{
                      formatCurrency(itemData?.cash_denomination?.deposit)
                    }}</span
                  >
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <div class="d-flex flex-column pa-1 text-center">
                  <span style="font-size: 12px; color: gray">ដកក្នុងភូមិ </span>
                  <span class="font-weight-bold">
                    {{
                      formatCurrency(itemData?.cash_denomination?.disburse)
                    }}</span
                  >
                </div>
              </td>
              <td>
                <div class="d-flex flex-column pa-1 text-center">
                  <span style="font-size: 12px; color: gray"
                    >អតិថិជនស្លាប់
                  </span>
                  <span class="font-weight-bold">
                    {{
                      formatCurrency(itemData?.cash_denomination?.write_off)
                    }}</span
                  >
                </div>
              </td>
            </tr>
            <!-- <tr>
                  <td>កាត់កងសន្សំ</td>
                  <td class="text-end font-weight-bold">
                    {{ itemData?.cash_denomination?.deposit }}
                  </td>
                </tr>
                <tr>
                  <td>ដកក្នុងភូមិ</td>
                  <td class="text-end font-weight-bold">
                    {{ itemData?.cash_denomination?.disburse }}
                  </td>
                </tr>
                <tr>
                  <td>អតិថិជនស្លាប់</td>
                  <td class="text-end font-weight-bold">
                    {{ itemData?.cash_denomination?.write_off }}
                  </td>
                </tr> -->

            <tr v-if="isPaymentByBank">
              <td colspan="2">
                <div class="d-flex flex-column pa-1 text-center">
                  <span style="font-size: 12px; color: gray"
                    >វេរតាមធនាគារ
                  </span>
                  <span class="font-weight-bold">
                    {{
                      formatCurrency(itemData?.cash_denomination?.bank)
                    }}</span
                  >
                </div>
              </td>
            </tr>
          </tbody>
          <thead style="background-color: rgba(211, 211, 211, 0.2)">
            <tr>
              <th class="text-center">សរុបរួម</th>
              <th class="text-center">
                {{
                  itemData?.cash_denomination?.total -
                    itemData.receive_amount ==
                  0
                    ? "ស្មើ"
                    : itemData?.cash_denomination?.total -
                          itemData.receive_amount <
                        0
                      ? "ជំពាក់លុយ"
                      : "លើសលុយ"
                }}
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="text-center font-weight-bold">
                {{ formatCurrency(itemData?.cash_denomination?.total) }}
              </td>
              <td
                class="text-center font-weight-bold"
                :class="
                  itemData?.cash_denomination?.total -
                    itemData.receive_amount ==
                  0
                    ? 'text-success'
                    : 'text-error'
                "
              >
                {{
                  formatCurrency(
                    itemData?.cash_denomination?.total -
                      itemData.receive_amount,
                  )
                }}
              </td>
            </tr>
          </tbody>
        </VTable>
      </VCol>
    </VRow>

    <VRow v-if="hasPermission('submit-cash-denominations')">
      <VDivider />
      <VCol cols="12">
        <div v-if="itemData?.cash_denomination?.is_co">
          <div
            class="d-flex flex-row justify-center"
            v-if="
              !itemData?.cash_denomination?.has_checked &&
              !itemData?.cash_denomination?.has_pending
            "
          >
            <span class="text-warning font-weight-bold">
              {{ $t("Please create the cash denomination") }}
            </span>
          </div>
          <div
            class="d-flex flex-row justify-end"
            v-if="itemData?.cash_denomination?.has_pending"
          >
            <VBtn
              color="success"
              :disabled="!itemData?.cash_denomination?.can_submit"
              @click="onSubmit"
            >
              <VIcon start>tabler-check</VIcon>
              ផ្ទៀងផ្ទៀត
            </VBtn>
          </div>
          <div
            class="d-flex flex-row justify-center"
            v-if="itemData?.cash_denomination?.has_checked"
          >
            <span class="text-success font-weight-bold">
              {{ $t("Already Submit") }}
            </span>
          </div>
          <div v-else></div>
        </div>
        <div v-else class="d-flex flex-row justify-center">
          <span class="text-error font-weight-bold">
            {{ $t("Please Select Credit Officer") }}
          </span>
        </div>
      </VCol>
    </VRow>
  </AppCard>
</template>
