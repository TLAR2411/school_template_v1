<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import { useRouter } from "vue-router";
import getImageUrl from "@/utils/image/getImageUrl.js";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import ShowImageDialog from "@/components/ShowImageDialog.vue";
import ApproveDialog from "./ApproveDialog.vue";
import { api } from "@/utils/api";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import { auth } from "@/utils/auth";
import AppName from "@/components/AppName.vue";
import { useDisplay } from "vuetify";
import formatDate from "@/utils/formater/formatDate";
import { useLoanStore } from "@/stores/loanStore";

definePage({
  meta: {
    title: "Approve Loans",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-loans",
  },
});

const { mdAndUp } = useDisplay();
const emit = defineEmits(["reload"]);
const router = useRouter();
const { t } = useI18n();
const isLoading = ref(true);
const dataTableRef = ref(null);
const filter = ref({
  search: null,
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
});
const isImageDialog = ref(false);
const imageUrlPath = ref(null);
const isApproveDialog = ref(false);
const approveFormData = ref({
  loan_id: null,
  client_id: null,
});
const loanStore = useLoanStore();
const showImage = (image) => {
  imageUrlPath.value = image ? getImageUrl(image) : avatar1;
  isImageDialog.value = true;
};

const headers = [
  { title: t("Client"), key: "code", visible: true, fixed: mdAndUp.value },

  {
    title: t("Loan Amount"),
    key: "loan_amount",
    value: (item) => {
      return formatCurrency(item.loan_amount);
    },
    align: "end",
    visible: true,
  },

  {
    title: t("Credit Officer"),
    key: "co.name_kh",
    visible: !auth()?.user?.position?.is_member,
  },

  {
    title: t("Branch"),
    key: "branch.name_kh",
    visible: auth()?.user?.manage_branch != 1,
  },
  { title: t("Guarantor"), key: "guarantor.name_kh", visible: true },
  {
    title: t("Created At"),
    key: "created_at",
    value: (item) => {
      return formatDate(item.created_at);
    },
  },
  {
    title: t("Loan Durations"),
    key: "loan_duration",
    value: (item) => {
      return `${item.loan_duration} ${item.loan_term?.sort}`;
    },
    align: "center",
    visible: true,
  },

  // { title: t("Currency"), key: "currency.currency_code", align: "center" },

  // {
  //   title: t("Start Date"),
  //   key: "loan_start_date",
  //   value: (item) => {
  //     return formatDate(item.loan_start_date);
  //   },
  // },
  // {
  //   title: t("End Date"),
  //   key: "loan_end_date",
  //   value: (item) => {
  //     return formatDate(item.loan_end_date);
  //   },
  // },
  {
    title: t("Address"),
    key: "address",
    value: (item) => {
      return item?.client?.village
        ? `
      ${item?.client?.village?.commune.name_kh || ""}-
      ${item?.client?.village?.name_kh || ""}
        `
        : "";
    },
    visible: true,
  },
  { title: t("Approver"), key: "approver.name_kh", visible: true },
  { title: t("Status"), key: "status", align: "center", visible: true },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
];

const onApprove = (item) => {
  approveFormData.value.client_id = item.client_id;
  approveFormData.value.loan_id = item.id;
  isApproveDialog.value = true;
};

const onDelete = async (item) => {
  try {
    // previewFormDialog.value = true;
    isLoading.value = true;

    const res = await api.post("loans-delete-request", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onReload = () => {
  dataTableRef.value.reload();
  loanStore?.fetchApprovalCount();
  emit("reload");
};

const onView = (item) => {
  router.push({ name: "loan-schedules", query: { id: item.id } });
};
</script>

<template>
  <ApproveDialog
    v-model:isDialogVisible="isApproveDialog"
    :item-data="approveFormData"
    @onReload="onReload"
  />

  <ShowImageDialog
    v-model:isDialogVisible="isImageDialog"
    :image="imageUrlPath"
  />
  <AppCardTable
    ref="dataTableRef"
    title="Approve Loans"
    title-icon="tabler-file-pencil"
    saveHeaderName="header-list-approve-loans"
    saveStateName="save-state-list-approve-loans"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="loans-approve-list"
    :headers="headers"
    border="border-none"
    is-full-height-tab
    :isTitle="false"
    is-filter
    is-delete
    is-approve
    isSchedule
    btnSchedule
    btn-approve
    is-reload
    save-state
    can-approve="approval-loans"
    enableMobileCard
    :approve-condition="
      (item) =>
        (auth().user.is_super || item.approve_by === auth().user.id) &&
        item.status == 'pending'
    "
    :schedule-condition="(item) => item.status == 'approved'"
    :is-more-action-condition="
      (item) => (item.status == 'pending' ? true : false)
    "
    :is-back="false"
    @onDelete="onDelete"
    @onApprove="onApprove"
    @onSchedule="onView"
    :isHeader="false"
  >
    <!-- <template #card-header>
      <VCol cols="7" lg="3" md="4">
        <AppTextField
          v-model="filter.search"
          autocomplete="off"
          variant="filled"
        >
          <template #label>{{ $t("Search") }}</template>
        </AppTextField>
      </VCol>
    </template> -->
    <template #filter>
      <VRow class="justify-end">
        <VCol cols="12" sm="6" md="4" lg="2">
          <AppTextField v-model="filter.search">
            <template #label>{{ $t("Search") }}</template>
          </AppTextField>
        </VCol>
      </VRow>
    </template>

    <template v-slot:item.code="{ item }">
      <div class="d-flex flex-row pt-2 pb-2">
        <div class="d-flex flex-column">
          <div class="d-flex flex-row">
            <AppName
              :image="item.client?.image_path"
              :title="item.client?.name_kh"
              :sub-title="item.code"
            />
          </div>
          <VBadge
            v-if="item.status == 'pending'"
            class="small-badge"
            color="warning"
            :offset-x="100"
            :offset-y="-14"
          >
            <template #badge>
              <VIcon icon="tabler-hourglass-empty" size="12" />
            </template>
          </VBadge>
          <VBadge
            v-else
            class="small-badge"
            color="success"
            :offset-x="100"
            :offset-y="-14"
          >
            <template #badge>
              <VIcon icon="tabler-check" size="12" />
            </template>
          </VBadge>
        </div>
      </div>
    </template>

    <template v-slot:item.guarantor="{ item }">
      <div class="d-flex flex-row pt-2 pb-2" v-if="item.guarantor">
        <div class="d-flex flex-column">
          <div class="d-flex flex-row">
            <AppName
              :image="item.guarantor?.image_path"
              :title="item.guarantor?.name_kh"
              :sub-title="item.code"
            />
          </div>
        </div>
      </div>
    </template>

    <template v-slot:item.status="{ item }">
      <VChip color="warning" size="small" v-if="item.status == 'pending'">
        {{ $t("Pending") }}
      </VChip>
      <VChip color="warning" size="small" v-if="item.status == 'check'">
        {{ $t("Check") }}
      </VChip>
      <VChip color="success" size="small" v-if="item.status == 'approved'">
        {{ $t("Approve") }}
      </VChip>
    </template>
  </AppCardTable>
</template>

<style lang="scss" scoped>
.small-badge :deep(.v-badge__badge) {
  /* Reduce padding */
  padding: 2px;

  /* Override Vuetify's default min-width */
  min-width: 18px;
  height: 18px;

  /* Ensure the icon inside is also small */
  font-size: 12px;
}
</style>
