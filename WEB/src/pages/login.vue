<script setup>
import authV1BottomShape from "@images/svg/auth-v1-bottom-shape.svg?raw";
import authV1TopShape from "@images/svg/auth-v1-top-shape.svg?raw";
import { VNodeRenderer } from "@layouts/components/VNodeRenderer";
import { themeConfig } from "@themeConfig";
import { useAuthStore } from "@/stores/authStore";
import { debounce } from "lodash";

import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import { useDisplay } from "vuetify";
import { usePwaInstall } from "@/composables/usePwaInstall";

definePage({
  meta: {
    title: "Login",
    layout: "blank",
    unauthenticatedOnly: true,
  },
});
const logos = import.meta.glob("@images/logo/*/logo.png", {
  eager: true,
  import: "default",
});

const company = import.meta.env.VITE_BASE_COMPANY;
const MainLogo = logos[`/src/assets/images/logo/${company}/logo.png`];

const form = ref({
  username: import.meta.env.VITE_LOGIN_USERNAME || null,
  password: import.meta.env.VITE_LOGIN_PASSWORD || null,
  remember: false,
});

const isLoading = ref(false);

const isPasswordVisible = ref(false);

const onSubmit = debounce(async () => {
  isLoading.value = true;
  await useAuthStore().login(form.value);
  isLoading.value = false;
}, 500);

const { smAndDown } = useDisplay();

const { isIos, isIosNonSafari, install } = usePwaInstall();

const isIosGuideOpen = ref(false);

const onInstall = async () => {
  console.log("ios", isIos.value);

  if (isIos.value) {
    isIosGuideOpen.value = true;
    return;
  }

  await install();
};
</script>

<template>
  <div class="auth-wrapper d-flex align-center justify-center">
    <div class="position-relative my-sm-16">
      <!-- 👉 Top shape -->
      <VNodeRenderer
        :nodes="h('div', { innerHTML: authV1TopShape })"
        class="text-primary auth-v1-top-shape d-none d-sm-block"
      />

      <!-- 👉 Bottom shape -->
      <VNodeRenderer
        :nodes="h('div', { innerHTML: authV1BottomShape })"
        class="text-primary auth-v1-bottom-shape d-none d-sm-block"
      />

      <!-- 👉 Auth Card -->
      <VCard class="auth-card" width="350" max-width="90vw">
        <VCardItem class="justify-center">
          <VCardTitle>
            <div class="app-logo d-flew flex-column w-100 mt-2">
              <img
                class="justify-center align-center"
                style="width: 100px !important"
                :src="MainLogo"
              />
              <!-- <VNodeRenderer :nodes="themeConfig.app.logo" /> -->
              <span
                class="app-logo-title mt-4 text-uppercase w-100 text-primary"
                style="
                  display: block;
                  width: 100%;
                  word-wrap: break-word;
                  overflow-wrap: break-word;
                  white-space: normal;
                  text-align: center;
                  font-family: moul-light;
                  font-size: 16px;
                "
              >
                {{ themeConfig.app.mainTitle }}
              </span>
            </div>
          </VCardTitle>
        </VCardItem>

        <!-- <VCardText>
          <h4 class="text-h4 mb-1">
            Welcome to
            <span class="text-capitalize">{{ themeConfig.app.title }}</span
            >! 👋🏻
          </h4>
          <p class="mb-0">
            Please sign-in to your account and start the adventure
          </p>
        </VCardText> -->

        <VCardText>
          <VForm @submit.prevent="onSubmit">
            <VRow>
              <!-- email -->
              <VCol cols="12" class="mb-0 pb-0">
                <AppTextField
                  v-model="form.username"
                  autofocus
                  type="email"
                  prepend-inner-icon="tabler-user"
                  required
                >
                  <template #label>{{ $t("Email or Username") }}</template>
                </AppTextField>
              </VCol>

              <!-- password -->
              <VCol cols="12" class="mt-1">
                <AppTextField
                  v-model="form.password"
                  prepend-inner-icon="tabler-key"
                  required
                  :type="isPasswordVisible ? 'text' : 'password'"
                  autocomplete="password"
                  :append-inner-icon="
                    isPasswordVisible ? 'tabler-eye-off' : 'tabler-eye'
                  "
                  @click:append-inner="isPasswordVisible = !isPasswordVisible"
                >
                  <template #label>{{ $t("Password") }}</template>
                </AppTextField>

                <!-- remember me checkbox -->
                <!-- <div
                  class="d-flex align-center justify-space-between flex-wrap my-6"
                >
                  <VCheckbox v-model="form.remember" label="Remember me" />
                </div> -->

                <!-- login button -->
                <VBtn
                  block
                  type="submit"
                  :loading="isLoading"
                  :disabled="isLoading"
                  class="my-6 mb-0"
                >
                  {{ $t("Login") }}
                </VBtn>

                <VBtn
                  block
                  variant="outlined"
                  class="mt-3"
                  prepend-icon="tabler-download"
                  type="button"
                  @click="onInstall"
                >
                  {{ isIos ? $t("How to install") : $t("Install App") }}
                </VBtn>
              </VCol>
            </VRow>
          </VForm>
        </VCardText>
      </VCard>

      <VDialog v-model="isIosGuideOpen" max-width="400">
        <VCard>
          <VCardItem>
            <VCardTitle class="text-wrap">
              {{ $t("Install on iPhone") }}
            </VCardTitle>
          </VCardItem>

          <VCardText>
            <p class="mb-4">
              {{ $t("iOS install intro") }}
            </p>

            <VAlert
              v-if="isIosNonSafari"
              type="warning"
              variant="tonal"
              class="mb-4"
            >
              {{ $t("iOS install safari only") }}
            </VAlert>

            <ol class="ios-install-steps ps-4 mb-0">
              <li class="mb-2">
                {{ $t("iOS install step 1") }}
              </li>
              <li class="mb-2">
                {{ $t("iOS install step 2") }}
              </li>
              <li>
                {{ $t("iOS install step 3") }}
              </li>
            </ol>
          </VCardText>

          <VCardActions>
            <VSpacer />
            <VBtn color="primary" @click="isIosGuideOpen = false">
              {{ $t("Got it") }}
            </VBtn>
          </VCardActions>
        </VCard>
      </VDialog>
    </div>
  </div>
</template>

<style lang="scss">
@use "@core/scss/template/pages/page-auth";

.auth-card {
  width: 350px !important; // Change 600px to your desired width
  max-width: 90vw !important; // Ensures mobile responsiveness
}

.ios-install-steps {
  line-height: 1.5;
}
</style>
