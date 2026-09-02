<script setup>
import { ref, onMounted, watch } from "vue";
import { useRoute, useRouter } from "vue-router";
import hasPermission from "@/utils/hasPermission";
import { useDisplay } from "vuetify";
import DepositTransactionList from "@/views/loan/deposit-transactions/DepositTransactionList.vue";
import DepositTransactionWithdrawList from "@/views/loan/deposit-transactions/DepositTransactionWithdrawList.vue";
import DepositTransactionDepositList from "@/views/loan/deposit-transactions/DepositTransactionDepositList.vue";
import { usePartStore } from "@/stores/partStore";

definePage({
  meta: {
    title: "Deposit Transactions",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-deposit-transactions",
  },
});

const part = usePartStore();

const mainTabs = [
  {
    title: "Deposit Transactions",
    icon: "tabler-users",
    tab: "deposit-transactions",
    permission: "view-deposit-transactions",
    sub: [
      {
        title: "Balance",
        icon: "tabler-cash-banknote",
        tab: "balance",
      },
      {
        title: "Withdraw",
        icon: "tabler-cash-banknote-move",
        tab: "withdraw",
      },
      // {
      //   title: "Deposit",
      //   icon: "tabler-cash-banknote-move-back",
      //   tab: "deposit",
      // },
    ],
  },
];

const route = useRoute();
const { mdAndUp } = useDisplay();
const defaultTab = "balance";
const activeTab = ref(route.params.tab || defaultTab);

const tabs = mainTabs.find((v) => v.tab == "deposit-transactions")?.sub;

const preventScrollInterference = (event) => {
  if (event.target.closest(".v-window__container")) {
    event.stopPropagation();
  }
};

onMounted(() => {
  const windowContainer = document.querySelector(".v-window");
  if (windowContainer) {
    windowContainer.addEventListener("wheel", preventScrollInterference, {
      passive: false,
    });
    windowContainer.addEventListener("touchmove", preventScrollInterference, {
      passive: false,
    });
  }
});
</script>

<template>
  <VCard>
    <VCol>
      <VRow>
        <div class="d-flex flex-column w-100 h-100">
          <VTabs
            v-model="activeTab"
            grow
            stacked
            class="v-tabs--fixed"
            height="60px"
          >
            <template v-for="item in tabs">
              <VTab
                v-if="!item.permission || hasPermission(item.permission)"
                :key="item.icon"
                :value="item.tab"
                :to="{
                  name:
                    part.system_part === 'accounting'
                      ? 'accounting-deposit-transactions-tab'
                      : 'loan-deposit-transactions-tab',
                  params: { tab: item.tab },
                }"
              >
                <VIcon :icon="item.icon" class="mb-1" />
                <span style="font-size: 14px">
                  {{ $t(item.title) }}
                </span>
              </VTab>
            </template>
          </VTabs>

          <VWindow
            v-model="activeTab"
            class="disable-tab-transition"
            :touch="false"
          >
            <VWindowItem value="balance">
              <DepositTransactionList
                v-if="activeTab === 'balance'"
                :key="activeTab"
              />
            </VWindowItem>
            <VWindowItem value="withdraw">
              <DepositTransactionWithdrawList
                v-if="activeTab === 'withdraw'"
                :key="activeTab"
              />
            </VWindowItem>
            <VWindowItem value="deposit">
              <DepositTransactionDepositList
                v-if="activeTab === 'deposit'"
                :key="activeTab"
              />
            </VWindowItem>
          </VWindow>
        </div>
      </VRow>
    </VCol>
  </VCard>
</template>

<style scoped>
/* Ensure content area handles scrolling correctly */
.v-window__container {
  max-height: calc(100vh - 150px); /* Adjust based on your layout */
  overflow-y: auto;
  -webkit-overflow-scrolling: touch; /* Smooth scrolling on touch devices */
}

/* Prevent VWindow from intercepting scroll events */
.v-window {
  overflow: hidden !important;
}
</style>
