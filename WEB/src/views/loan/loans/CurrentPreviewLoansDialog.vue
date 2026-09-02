<script setup>
import { ref, nextTick } from "vue";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import formatDate from "@/utils/formater/formatDate";
import { getThumbUrl } from "@/utils/image/getImageUrl";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import html2canvas from "html2canvas";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({ type: "check_in" }),
  },
  isDialogVisible: { type: Boolean, required: true },
});

const emit = defineEmits(["update:isDialogVisible"]);
const onCloseDialog = () => emit("update:isDialogVisible", false);

const getImage = (image) => {
  if (image) {
    return getThumbUrl(image, {
      w: 500,
      h: 500,
      fit: "cover",
      fmt: "webp",
      q: 100,
    });
  }
  return null;
};

const loading = ref(false);
const overlay = ref(false);
const target = ref(null);

async function waitAssets(el) {
  // Wait for fonts
  if (document.fonts && document.fonts.ready) {
    try {
      await document.fonts.ready;
    } catch {}
  }
  // Wait for images inside the element
  const imgs = Array.from(el.querySelectorAll("img"));
  await Promise.all(
    imgs.map((img) =>
      img.complete
        ? Promise.resolve()
        : new Promise((res) => {
            img.addEventListener("load", res, { once: true });
            img.addEventListener("error", res, { once: true });
          })
    )
  );
}

const capture = async () => {
  if (!target.value) return;
  loading.value = true;
  overlay.value = true;
  try {
    await nextTick();
    await waitAssets(target.value);

    const dpr = Math.min(window.devicePixelRatio || 1, 2);

    const canvas = await html2canvas(target.value, {
      scale: dpr,
      proxy: `${import.meta.env.VITE_API_URL}/h2c-proxy`,
      useCORS: false, // proxy handles it
      allowTaint: true, // safe because image comes from your origin now
      backgroundColor: "#fff", // set to null for transparent PNG
      logging: false,
      onclone: (doc) => {
        const clonedTarget = doc.querySelector('[data-capture-root="true"]');
        if (clonedTarget) clonedTarget.style.overflow = "visible";
        doc
          .querySelectorAll(
            ".v-overlay, .v-overlay__content, .v-dialog, .v-card"
          )
          .forEach((el) => {
            el.style.transform = "none";
            el.style.overflow = "visible";
            el.style.contain = "none";
            el.style.filter = "none";
          });
      },
      windowWidth: document.documentElement.clientWidth,
      windowHeight: document.documentElement.clientHeight,
      foreignObjectRendering: false,
      removeContainer: true,
    });

    await new Promise((resolve) => {
      canvas.toBlob((blob) => {
        if (!blob) return resolve();
        const url = URL.createObjectURL(blob);
        const a = document.createElement("a");
        a.href = url;
        a.download = `capture-${Date.now()}.png`;
        a.click();
        URL.revokeObjectURL(url);
        resolve();
      }, "image/png");
    });
  } finally {
    loading.value = false;
    overlay.value = false;
  }
};
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    @update:model-value="(value) => $emit('update:isDialogVisible', value)"
    persistent
    width="350"
  >
    <div class="dialog-content" style="max-height: 100vh; overflow-y: auto">
      <!-- Ensure this div can scroll -->
      <DialogCloseBtn @click="onCloseDialog" />
      <VCard>
        <VCardItem style="padding-top: 12px; padding-bottom: 12px">
          <span style="font-size: 18px">
            <VIcon start>tabler-users</VIcon>
            {{ $t("Information") }}
          </span>
        </VCardItem>
        <VDivider />

        <div ref="target" data-capture-root="true" class="pa-2">
          <VCardText
            class="d-flex justify-center align-center"
            style="padding: 0px"
          >
            <div class="d-flex flex-row pt-4">
              <VAvatar :size="150" rounded="">
                <VImg :src="getImage(itemData.client?.image_path) ?? avatar1" />
              </VAvatar>
            </div>
          </VCardText>
          <div
            class="d-flex flex-column w-100 pa-5 pt-2"
            style="font-size: 16px"
          >
            <span class="mt-1 mb-1 text-center" style="font-size: 18px">
              {{ itemData.client?.name_kh }}
            </span>
            <!-- <span class="mt-1 mb-1 text-center" style="font-size: 16px">
              {{ itemData.code }}
            </span> -->
            <VDivider class="mt-1 mb-2" />
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="text-primary">កាលបរិច្ចេទ</div>
              <div>
                {{ formatDate(itemData.current_date) }}
              </div>
            </div>
            <!-- <VDivider class="mt-1 mb-2" />
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="text-primary">ការបង់</div>
              <div>
              
              </div>
            </div>
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="pl-10">បានបង់</div>
              <div>
                {{ formatNoneZero(0) }}
              </div>
            </div>
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="pl-10">យឺតក្នុងតារាង</div>
              <div>
                {{ formatNoneZero(0) }}
              </div>
            </div>
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="pl-10">យឺតផុតតារាង</div>
              <div>
                {{ formatNoneZero(0) }}
              </div>
            </div> -->
            <VDivider class="mt-1 mb-2" />
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="text-primary">ប្រាក់ពិន័យ</div>
              <div>
                {{ formatNoneZero(itemData.total_penalty_amount) }}
              </div>
            </div>

            <VDivider class="mt-1 mb-2" />
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="text-primary">ប្រាក់ត្រូវបង់ថ្ងៃនេះ</div>
              <div>
                {{
                  formatNoneZero(
                    itemData.current_payment - itemData.total_penalty_amount
                  )
                }}
              </div>
            </div>
            <VDivider class="mt-1 mb-2" />
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="text-primary">សរុបប្រាក់ត្រូវបង់ថ្ងៃនេះ</div>
              <div>
                {{ formatNoneZero(itemData.current_payment) }}
              </div>
            </div>
            <VDivider class="mt-1 mb-2" />
            <div class="d-flex flex-row mt-1 mb-1 justify-space-between">
              <div class="text-primary">ភ្នាក់ងារឥណទាន</div>
              <div>
                {{ itemData.co?.name_kh }}
              </div>
            </div>
          </div>
        </div>
        <VDivider />
        <VCardText
          class="d-flex justify-end flex-wrap gap-3"
          style="padding-top: 12px; padding-bottom: 12px"
        >
          <VBtn @click="capture" :loading="loading">
            <VIcon start icon="tabler-download" />
            ទាញយក
          </VBtn>
        </VCardText>
      </VCard>
    </div>
  </VDialog>
</template>

<style scoped>
.dialog-bottom-transition-enter-active,
.dialog-bottom-transition-leave-active {
  transition: transform 0.2s ease-in-out;
}
</style>
