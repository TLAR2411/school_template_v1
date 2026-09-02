<script setup>
import { useI18n } from "vue-i18n";
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import { useRouter } from "vue-router";
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import AppName from "@/components/AppName.vue";
import { useDisplay } from "vuetify";
import formatContact from "@/utils/formater/formatContact";
import AppIconImage from "@/components/AppIconImage.vue";
import { usePartStore } from "@/stores/partStore";

definePage({
  meta: {
    title: "Clients",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-clients",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { mdAndUp } = useDisplay();
const { t } = useI18n();
const router = useRouter();
const isLoading = ref(false);
const isDialogVisible = ref(false);
const dataTableRef = ref(null);

const filter = ref({
  search: "",
});

const getAge = (birthDate) => {
  return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e10);
};

const headers = [
  {
    title: t("Code"),
    key: "code",
    exportValue: (item) => item.code,
    visible: false,
  },
  {
    title: t("Black List"),
    key: "is_black_list",
    exportValue: (item) => item.is_black_list,
    visible: false,
  },
  {
    title: t("Client"),
    key: "name_kh",
    exportValue: (item) => item.name_kh,
    cellClass: "fixed-first-column",
    headerClass: "fixed-first-column-header",
    visible: true,
    fixed: mdAndUp.value,
  },

  {
    title: t("Branch"),
    key: "branch_id",
    value: (item) => {
      return item.branch.name_kh;
    },
    dataPriority: 1,
    visible: true,
  },
  // { title: t("Name English"), key: "name_en" },
  {
    title: t("Gender"),
    key: "gender",
    value: (items) => formatGender(items.gender),
    dataPriority: 4,
    visible: true,
  },
  {
    title: t("Date of birth"),
    key: "dob",
    value: (items) => formatDate(items.dob),
    exportValue: (item) => item.dob,
    dataPriority: 4,
    visible: true,
  },
  {
    title: t("Age"),
    key: "age",
    value: (items) => getAge(items.dob),
    align: "center",
    dataPriority: 4,
    visible: true,
  },
  {
    title: t("National ID Number"),
    key: "national_id_number",
    dataPriority: 5,
    visible: true,
  },
  {
    title: t("Contact"),
    key: "contact",
    value: (item) => {
      return formatContact(item.contact);
    },
    dataPriority: 6,
    visible: true,
  },
  {
    title: t("Occupation"),
    key: "occupation_id",
    value: (item) => {
      return item.occupation?.name_kh;
    },
    visible: true,
  },
  {
    title: t("Occupation Note"),
    key: "occupation_note",
    visible: true,
  },
  // {
  //   title: t("Main Source Income"),
  //   key: "main_source_income_id",
  //   value: (item) => {
  //     return item.main_source_income.name_kh;
  //   },
  // },
  {
    title: t("Daily Income Amount"),
    key: "monthly_income_amount",
    value: (items) => {
      return `${formatCurrency(items.monthly_income_amount)}`;
    },
    align: "end",
    visible: true,
  },
  // {
  //   title: t("Limit Loan Amount"),
  //   key: "limit_loan_amount",
  //   value: (items) => {
  //     return `${formatCurrency(items.limit_loan_amount)}`;
  //   },
  //   align: "end",
  //   visible: true,
  // },

  {
    title: t("Status"),
    key: "is_client",
    align: "center",
    exportValue: (item) => {
      if (item.is_client == true && item.is_guarantor == true) {
        return "ខ្ចី/ធានា";
      } else if (item.is_client == true && item.is_guarantor == false) {
        return "អតិថិជន";
      } else if (item.is_client == false && item.is_guarantor == true) {
        return "អ្នកធានា";
      } else if (item.is_client == false && item.is_guarantor == false) {
        return "គ្មាន";
      }
    },
    dataPriority: 8,
    visible: true,
  },
  {
    title: t("Have Loans"),
    key: "is_have_loans",
    align: "center",
    exportValue: (item) => {
      if (item.is_have_loans == true) {
        return "មានកម្ចី";
      } else {
        return "គ្មានកម្ចី";
      }
    },
    dataPriority: 8,
    visible: true,
  },
  {
    title: t("Location Home"),
    key: "location",
    align: "center",
    exportValue: (item) => {
      if (item.location) {
        return "មាន";
      } else {
        return "មិនមាន";
      }
    },
    visible: true,
  },
  {
    title: t("Location Shop"),
    key: "location_shop",
    align: "center",
    exportValue: (item) => {
      if (item.location_shop) {
        return "មាន";
      } else {
        return "មិនមាន";
      }
    },
    visible: true,
  },
  {
    title: t("Image Home"),
    key: "image_home",
    align: "center",
    exportValue: (item) => {
      if (item.image_path_home) {
        return "មាន";
      } else {
        return "មិនមាន";
      }
    },
    visible: true,
  },
  {
    title: t("Image Shop"),
    key: "image_shop",
    align: "center",
    exportValue: (item) => {
      if (item.image_path_shop) {
        return "មាន";
      } else {
        return "មិនមាន";
      }
    },
    visible: true,
  },
  {
    title: t("Image Thumbprint"),
    key: "image_thumbprint",
    align: "center",
    exportValue: (item) => {
      if (item.thumbprint_path) {
        return "មាន";
      } else {
        return "មិនមាន";
      }
    },
    visible: true,
  },
  {
    title: t("Village"),
    key: "village",
    value: (item) => {
      return item?.village
        ? `
      ${item?.village?.name_kh || ""}`
        : "";
    },
    visible: true,
  },
  {
    title: t("Commune"),
    key: "commune",
    value: (item) => {
      return item?.village
        ? `
      ${item?.village?.commune.name_kh || ""}
        `
        : "";
    },
    visible: true,
  },
  {
    title: t("District"),
    key: "district",
    value: (item) => {
      return item?.village
        ? `
      ${item?.village?.commune?.district?.name_kh || ""}
        `
        : "";
    },
    visible: true,
  },
  {
    title: t("Province"),
    key: "province",
    value: (item) => {
      return item?.village
        ? `
      ${item?.village?.commune?.district?.province?.name_kh || ""}
        `
        : "";
    },
    visible: true,
  },

  // { title: t("Status"), key: "is_active", align: "center" },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: true,
  },
];

const onEdit = (item) => {
  if (usePartStore().system_part == "loan") {
    router.push({
      name: "loan-clients-tab",
      params: { tab: "create" },
      query: { id: item.id },
    });
  } else {
    router.push({
      name: "accounting-clients-tab",
      params: { tab: "create" },
      query: { id: item.id },
    });
  }
};
const onDelete = async (item) => {
  try {
    // previewFormDialog.value = true;
    isLoading.value = true;

    const res = await api.post("clients-delete", { id: item.id });

    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
const onView = (item) => {
  router.push({ name: "loan-clients-client-profile", query: { id: item.id } });
};

const onBlackList = async (item) => {
  try {
    // previewFormDialog.value = true;
    isLoading.value = true;

    const res = await api.post("clients-black-list", { id: item.id });

    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <AppCardTable
    ref="dataTableRef"
    v-model:isDialogCreateVisible="isDialogVisible"
    title="Clients"
    title-icon="tabler-user-circle"
    saveHeaderName="header-list-client"
    saveStateName="save-state-list-client"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="clients-list"
    :headers="headers"
    is-edit
    is-client-history
    is-filter
    is-delete
    is-black-list
    is-excel
    save-state
    :is-back="false"
    can-check-black-list="check-black-list-clients"
    can-uncheck-black-list="uncheck-black-list-clients"
    can-edit="edit-clients"
    can-delete="delete-clients"
    @onEdit="onEdit"
    @onDelete="onDelete"
    @onClientHistory="onView"
    @onBlackList="onBlackList"
    is-full-height-tab
    border="border-none"
    :is-title="false"
    :is-header="false"
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
      <VRow class="justify-start">
        <VCol cols="12" sm="6" md="4" lg="2">
          <VTextField
            v-model="filter.search"
            :label="t('Search')"
            prepend-inner-icon="tabler-search"
            clearable
            hide-details
            autocomlete="off"
            clear-icon="tabler-x"
          />
        </VCol>
      </VRow>
    </template>

    <template v-slot:item.name_kh="{ item }">
      <div class="d-flex flex-row pt-2 pb-2">
        <AppName
          :title="item.name_kh"
          :sub-title="item.code"
          :image="item.image_path"
          :sub-title-condition="item.is_black_list"
        />
      </div>
    </template>

    <template v-slot:item.is_have_loans="{ item }">
      <VChip color="success" size="small" v-if="item.is_have_loans == true">
        {{ $t("Have Loans") }}
      </VChip>
      <VChip color="error" size="small" v-if="item.is_have_loans == false">
        {{ $t("None Loans") }}
      </VChip>
    </template>

    <template v-slot:item.is_client="{ item }">
      <VChip
        color="warning"
        size="small"
        v-if="item.is_client == true && item.is_guarantor == true"
      >
        {{ $t("Client/Guarantor") }}
      </VChip>
      <VChip
        color="success"
        size="small"
        v-if="item.is_client == true && item.is_guarantor == false"
      >
        {{ $t("Client") }}
      </VChip>
      <VChip
        color="info"
        size="small"
        v-if="item.is_client == false && item.is_guarantor == true"
      >
        {{ $t("Guarantor") }}
      </VChip>
      <VChip
        color="error"
        size="small"
        v-if="item.is_client == false && item.is_guarantor == false"
      >
        {{ $t("None") }}
      </VChip>
    </template>

    <template v-slot:item.is_active="{ item }">
      <VChip color="success" size="small" v-if="item.is_active == true">
        Active
      </VChip>
      <VChip color="error" size="small" v-if="item.is_active == false">
        Inactive
      </VChip>
    </template>

    <template v-slot:item.location="{ item }">
      <VIcon icon="tabler-check" color="success" v-if="item.location" />
      <VIcon icon="tabler-x" color="error" v-else />
    </template>
    <template v-slot:item.location_shop="{ item }">
      <VIcon icon="tabler-check" color="success" v-if="item.location_shop" />
      <VIcon icon="tabler-x" color="error" v-else />
    </template>

    <template v-slot:item.image_home="{ item }">
      <AppIconImage :image="item.image_path_home" />
    </template>
    <template v-slot:item.image_shop="{ item }">
      <AppIconImage :image="item.image_path_shop" />
    </template>
    <template v-slot:item.image_thumbprint="{ item }">
      <AppIconImage :image="item.thumbprint_path" />
    </template>
  </AppCardTable>
</template>
