<script setup>
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { onMounted, ref } from "vue";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: false,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});
const isLoading = ref(false);
const receiveData = ref([]);
const totalAmount = ref(0);
const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "update:isDialogVisible",
  "update:loading",
]);
const onCloseDialog = () => {
  emit("update:isDialogVisible", false);
};

const initData = async () => {
  const res = await api.post("receives-history", {
    loan_id: props.itemData.loan_id,
  });
  if (res.data.status) {
    receiveData.value = res.data.data;
    totalAmount.value = res.data.total_amount;
  }
};

onMounted(async () => {
  isLoading.value = true;
  emit("update:loading", true);
  await initData();
  isLoading.value = false;
  emit("update:loading", false);
});
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    persistent
    class="v-dialog-xl"
    max-width="1300px"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="onCloseDialog" />

    <!-- Dialog Content -->
    <VCard>
      <VCardItem style="padding-top: 12px; padding-bottom: 12px">
        <span style="font-size: 18px">
          <VIcon>tabler-history</VIcon>
          {{ $t("Receive History") }}
        </span>
      </VCardItem>
      <VDivider />

      <VRow>
        <VCol>
          <VTable
            class="text-no-wrap"
            hover
            :header-props="{
              style:
                'background-color: #F8F8F8; border-bottom: 1px solid #ddd; height: 40px !important; padding: 12px 8px; vertical-align: middle;',
            }"
          >
            <thead style="background-color: rgba(211, 211, 211, 0.15)">
              <tr>
                <th class="text-center">#</th>
                <th class="text-start">ថ្ងៃ</th>
                <th class="text-center">កាលបរិច្ឆេទ</th>
                <th class="text-center">វេលា</th>
                <th class="text-center">ប្រភេទកម្ចី</th>
                <!-- <th class="text-center">ទូទាត់តាម</th> -->
                <th class="text-center">អ្នកទទួលប្រាក់</th>

                <th class="text-center">សរុបប្រាក់ជំពាក់</th>

                <th class="text-center">ប្រាក់ពិន័យ</th>
                <th class="text-center">ប្រាក់បង់ទុក</th>
                <th class="text-center">ប្រាក់ដើមនិងការប្រាក់</th>
                <th class="text-center">ប្រាក់សរុបបានបង់</th>
              </tr>
            </thead>
            <tbody>
              <template v-for="(item, index) in receiveData">
                <tr>
                  <td class="text-center">{{ index + 1 }}</td>
                  <td>
                    {{ item.receive_date_khmer }}
                  </td>
                  <td>
                    {{ formatDate(item.receive_date) }}
                  </td>
                  <td>{{ item.receive_time }}</td>
                  <td class="text-center">
                    <VChip
                      color="success"
                      size="small"
                      v-if="item.type == 'current'"
                    >
                      {{ $t("Current Loan") }}
                    </VChip>
                    <VChip
                      color="warning"
                      size="small"
                      v-if="item.type == 'late'"
                    >
                      {{ $t("Late Loan") }}
                    </VChip>
                    <VChip
                      color="error"
                      size="small"
                      v-if="item.type == 'overdue'"
                    >
                      {{ $t("Overdue Loan") }}
                    </VChip>
                  </td>
                  <!-- <td class="text-center">
                    <VChip
                      color="warning"
                      size="small"
                      v-if="item.payment_method == 'cash'"
                    >
                      <VIcon start icon="tabler-cash" />
                      {{ $t("Cash") }}
                    </VChip>
                    <VChip
                      color="success"
                      size="small"
                      v-if="item.payment_method == 'bank'"
                    >
                      <VIcon start icon="tabler-credit-card" />
                      {{ $t("Bank") }}
                    </VChip>
                    <VChip
                      color="info"
                      size="small"
                      v-if="item.payment_method == 'deduct'"
                    >
                      <VIcon start icon="tabler-plus-minus" />
                      {{ $t("Deduct") }}
                    </VChip>
                  </td> -->
                  <td>{{ item.created_by?.name_kh }}</td>

                  <td
                    class="text-end"
                    style="background-color: rgba(211, 211, 211, 0.2)"
                  >
                    {{ formatCurrency(item.total_before_paid) }}
                  </td>

                  <td class="text-end">
                    {{ formatCurrency(item.total_penalty) }}
                  </td>
                  <td class="text-end">
                    {{ formatCurrency(item.prepaid_amount) }}
                  </td>
                  <td class="text-end">
                    {{ formatCurrency(item.total_receive) }}
                  </td>
                  <td
                    class="text-end"
                    style="background-color: rgba(211, 211, 211, 0.2)"
                  >
                    {{ formatCurrency(item.receive_amount) }}
                  </td>
                </tr>
              </template>
            </tbody>
            <tfoot>
              <tr class="font-weight-bold" style="font-size: 16px">
                <td colspan="10" class="text-end">{{ $t("Total Amount") }}</td>
                <td class="text-end">{{ formatCurrency(totalAmount) }}</td>
              </tr>
            </tfoot>
          </VTable>
        </VCol>
      </VRow>

      <VDivider />
      <VCardText style="padding-top: 12px; padding-bottom: 12px">
        <VRow>
          <VCol class="d-flex justify-end gap-3 flex-wrap pr-0">
            <VBtn color="secondary" variant="tonal" @click="onCloseDialog">
              <VIcon icon="tabler-arrow-left" start />
              {{ $t("Close") }}
            </VBtn>
          </VCol>
        </VRow>
        <!-- <VBtn @click="onCloseDialog"> Agree </VBtn> -->
      </VCardText>
    </VCard>
  </VDialog>
</template>
