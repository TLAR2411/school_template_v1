<script setup>
import { auth } from "@/utils/auth";
import getImageUrl from "@/utils/image/getImageUrl";
import { ref } from "vue";
import { VCardItem } from "vuetify/components";
import { useDisplay } from "vuetify";
import { useAuthStore } from "@/stores/authStore";
import { api } from "@/utils/api";

const loading = ref(false);
const refInputEl = ref();
const isLoading = ref(false);
const formData = ref({ ...auth().user });

const showList = ref([
  {
    title: "Full Name",
    value: auth().user.name_kh,
    icon: "tabler-label",
  },
  {
    title: "Username",
    value: auth().user.username,
    icon: "tabler-brand-twitch",
  },
  {
    title: "Email",
    value: auth().user.email,
    icon: "tabler-mail",
  },
  {
    title: "Contact",
    value: auth().user.contact || "N/A",
    icon: "tabler-address-book",
  },
  {
    title: "Branch",
    value: auth().user.branch?.name_kh,
    icon: "tabler-home",
  },
  {
    title: "Role Name",
    value: auth().user.role?.display_name || "N/A",
    icon: "tabler-user-circle",
  },
  {
    title: "Position Name",
    value: auth().user.position?.name_kh || "N/A",
    icon: "tabler-user-circle",
  },
  {
    title: "Group Name",
    value: auth().user.under_user?.name_kh || "N/A",
    icon: "tabler-user-circle",
  },
]);

const authStore = useAuthStore();

const { mdAndUp } = useDisplay();

const changeAvatar = (file) => {
  const fileReader = new FileReader();
  const { files } = file.target;
  if (files && files.length) {
    fileReader.readAsDataURL(files[0]);
    fileReader.onload = () => {
      if (typeof fileReader.result === "string")
        formData.value.image_path = fileReader.result;
    };
  }
};

const isProfileDialog = ref(false);
// reset avatar image
const resetAvatar = () => {
  formData.value.image_path = accountData.image_path;
};

const onReload = () => {
  authStore.bootstrap();
  isProfileDialog.value = false;
};

const onChangeImage = async () => {
  if (formData.value.image_path) {
    isLoading.value = true;
    const res = await api.post("users-change-image-path", {
      image_path: formData?.value.image_path ?? null,
    });

    if (res.data.status) {
      onReload();
    }
    isLoading.value = false;
  }
};

watch(
  () => formData.value.image_path,
  (newVal, oldVal) => {
    onChangeImage();
  },
);
</script>

<template>
  <AppCard :is-header="false" border="border-none">
    <VCard class="border-none">
      <VCardItem class="pa-0 ma-0">
        <div class="profile-layout">
          <!-- Image upload sidebar -->
          <div class="profile-image-wrap">
            <AppImageUpload
              icon="tabler-user"
              :label="$t('User')"
              v-model="formData.image_path"
              :is-loading="isLoading"
              :headline="$t('User')"
              :support-text="$t('PNG or JPG up to 2MB')"
              :url-resolver="getImageUrl"
              class="profile-image-upload"
              :crop-aspect-ratio="1"
            />
          </div>

          <!-- Info grid -->
          <div class="profile-info">
            <VRow class="ma-0">
              <template
                v-if="showList.length > 0"
                v-for="(i, idx) in showList"
                :key="idx"
              >
                <VCol cols="12" sm="6" lg="6" class="profile-info-col">
                  <div class="d-flex flex-row align-center profile-info-item">
                    <VAvatar
                      color="secondary"
                      variant="tonal"
                      :size="40"
                      class="flex-shrink-0"
                    >
                      <VIcon :size="22" :icon="i.icon || 'tabler-folder'" />
                    </VAvatar>
                    <div class="d-flex flex-column ml-3 profile-info-text">
                      <span class="profile-info-title">{{ $t(i.title) }}</span>
                      <span class="text-primary profile-info-value">{{
                        i.value
                      }}</span>
                    </div>
                  </div>
                </VCol>
              </template>
            </VRow>
          </div>
        </div>
      </VCardItem>
    </VCard>
  </AppCard>
</template>

<style scoped>
.profile-layout {
  display: flex;
  align-items: flex-start;
  gap: 2rem;
  width: 100%;
}

.profile-image-wrap {
  flex-shrink: 0;
  display: flex;
  justify-content: center;
}

.profile-image-upload {
  height: 215px;
  width: 215px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.profile-info {
  flex: 1 1 auto;
  min-width: 0;
}

.profile-info-col {
  padding-block: 0.5rem;
  padding-inline: 0.75rem;
}

.profile-info-item {
  gap: 0;
}

.profile-info-text {
  min-width: 0;
}

.profile-info-title {
  font-size: 13px;
  line-height: 1.4;
  opacity: 0.75;
}

.profile-info-value {
  font-size: 15px;
  font-weight: 500;
  line-height: 1.4;
  word-break: break-word;
}

/* Mobile: stack image on top, single-column info */
@media (max-width: 959px) {
  .profile-layout {
    flex-direction: column;
    align-items: stretch;
    gap: 1rem;
  }

  .profile-image-wrap {
    width: 100%;
    margin-bottom: 0.5rem;
  }

  .profile-info-col {
    padding-block: 0.625rem;
  }
}
</style>
