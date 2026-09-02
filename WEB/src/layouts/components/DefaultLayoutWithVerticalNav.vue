<script setup>
import { useLoanNavigation } from "@/navigation/vertical/loan/index.js";
import HrNavItems from "@/navigation/vertical/hr";
import AdminNavItems from "@/navigation/vertical/admin";
import AccountingNavItems from "@/navigation/vertical/accounting";
import { themeConfig } from "@themeConfig";
import { layoutConfig } from "@layouts";
import { useLayoutConfigStore } from "@layouts/stores/config";

// Components
import Footer from "@/layouts/components/Footer.vue";
import NavBarI18n from "@core/components/I18n.vue";
import NavbarBranches from "./NavbarBranches.vue";

// @layouts plugin
import { VerticalNavLayout } from "@layouts";
import { useRoute } from "vue-router";
import NavbarQrScan from "./NavbarQrScan.vue";
import { usePartStore } from "@/stores/partStore";
import NavbarClearAppDataButton from "./NavbarClearAppDataButton.vue";
const navItems = useLoanNavigation();
const configStore = useLayoutConfigStore();

const isMobileNav = ref(window.innerWidth < 1280);
const updateMobileNav = () => {
  isMobileNav.value = window.innerWidth < 1280;
};
const route = useRoute();

const setting = usePartStore();

onMounted(() => {
  window.addEventListener("resize", updateMobileNav);
});

onUnmounted(() => {
  window.removeEventListener("resize", updateMobileNav);
});
</script>

<template>
  <VerticalNavLayout
    :nav-items="
      setting.system_part == 'hr'
        ? HrNavItems
        : setting.system_part == 'admin'
          ? AdminNavItems
          : setting.system_part == 'accounting'
            ? AccountingNavItems
            : navItems
    "
  >
    <!-- 👉 navbar -->
    <template #navbar="{ toggleVerticalOverlayNavActive }">
      <div class="d-flex h-100 align-center">
        <!--Navbar -->

        <IconBtn
          v-if="isMobileNav"
          id="vertical-nav-toggle-btn"
          aria-label="បើក ឬ បិទ បញ្ជីមុខងារចំហៀង Laptop"
          class="ms-n3 d-lg-none"
          @click="toggleVerticalOverlayNavActive(true)"
        >
          <VIcon size="26" icon="tabler-menu-2" />
        </IconBtn>

        <IconBtn
          v-else
          id="vertical-nav-toggle-btn"
          aria-label="បើក ឬ បិទ បញ្ជីមុខងារចំហៀង Mobile"
          class="ms-n3"
          @click="
            configStore.isVerticalNavCollapsed =
              !configStore.isVerticalNavCollapsed
          "
        >
          <VIcon size="26" icon="tabler-menu-2" />
        </IconBtn>

        <VSpacer />
        <!-- <NavbarQrScan class="ml-1" /> -->

        <NavbarBranches />
        <NavbarClearAppDataButton
          style="margin-right: -12px; margin-left: 6px"
        />
        <!-- <NavbarThemeSwitcher class="mr-10" /> -->
        <!-- <NavbarReload /> -->
        <!-- <NavBarI18n
          style="margin-right: -12px"
          v-if="
            themeConfig.app.i18n.enable &&
            themeConfig.app.i18n.langConfig?.length
          "
          :languages="themeConfig.app.i18n.langConfig"
        /> -->
        <!-- <UserProfile /> -->
      </div>
    </template>

    <!-- 👉 Pages -->
    <slot />

    <!-- 👉 Footer -->
    <template #footer>
      <Footer />
    </template>

    <!-- 👉 Customizer -->
    <!-- <TheCustomizer /> -->
  </VerticalNavLayout>
</template>
