<script setup>
import { useLoanNavigation } from "@/navigation/vertical/loan/index.js";
import { getNavItemsByPart } from "@/config/systemParts";
import { useLayoutConfigStore } from "@layouts/stores/config";
import NavBarI18n from "@core/components/I18n.vue";
import { themeConfig } from "@themeConfig";

// Components
import Footer from "@/layouts/components/Footer.vue";
import NavbarBranches from "./NavbarBranches.vue";
import NavbarCurriculum from "./NavbarCurriculum.vue";
import NavbarYear from "./NavbarYear.vue";

// @layouts plugin
import { VerticalNavLayout } from "@layouts";
import { usePartStore } from "@/stores/partStore";
import NavbarClearAppDataButton from "./NavbarClearAppDataButton.vue";

const loanNavItems = useLoanNavigation();
const configStore = useLayoutConfigStore();
const setting = usePartStore();

const navItems = computed(() =>
  getNavItemsByPart(setting.system_part, loanNavItems.value),
);

const isMobileNav = ref(window.innerWidth < 1280);
const updateMobileNav = () => {
  isMobileNav.value = window.innerWidth < 1280;
};

onMounted(() => {
  window.addEventListener("resize", updateMobileNav);
});

onUnmounted(() => {
  window.removeEventListener("resize", updateMobileNav);
});
</script>

<template>
  <VerticalNavLayout :nav-items="navItems">
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
        <NavbarYear />

        <VSpacer />
        <!-- <NavbarQrScan class="ml-1" /> -->

        <div class="navbar-filters d-flex align-center flex-shrink-1">
         
          <NavbarCurriculum v-if="setting.system_part === 'school'" />
          <NavbarBranches />
        </div>

        <NavBarI18n
          style="margin-right: -12px"
          v-if="
            themeConfig.app.i18n.enable &&
            themeConfig.app.i18n.langConfig?.length
          "
          :languages="themeConfig.app.i18n.langConfig"
        />
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
