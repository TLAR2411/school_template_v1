<template>
  <div style="position: relative; height: 90%">
    <div
      ref="uploadBox"
      @click="$refs.fileInput.click()"
      @dragover.prevent="handleDragOver"
      @dragleave.prevent="handleDragLeave"
      @drop.prevent="handleDrop"
      :style="{
        width: '100%',
        height: '100%',
        border: `1.5px dashed ${isDragging ? '#1976d2' : borderColor}`,
        borderRadius: '8px',
        padding: '16px',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'center',
        alignItems: 'center',
        cursor: 'pointer',
        backgroundColor: isDragging ? '#f0f6ff' : '#fafafa',
        transition: 'all 0.3s',
        position: 'relative',
      }"
      @mouseover="handleMouseOver"
      @mouseleave="handleMouseLeave"
    >
      <!-- Preview -->
      <img
        v-if="previewUrl"
        :src="previewUrl"
        :alt="label"
        style="max-height: 100%; max-width: 100%; object-fit: contain"
      />

      <!-- Empty state -->
      <div v-else style="text-align: center; color: #999">
        <div
          style="
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 12px;
          "
        >
          <VIcon
            :icon="icon"
            size="22"
            :color="iconColor"
            style="transition: color 0.3s"
          />
        </div>

        <p
          style="
            font-weight: 600;
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 4px;
          "
        >
          {{ headline || $t("Drop your file here") }}
        </p>

        <p style="font-size: 0.75rem; color: #999; margin-bottom: 12px">
          {{ supportText || $t("Support for image files up to 10MB") }}
        </p>

        <VBtn
          size="small"
          variant="outlined"
          color="default"
          @click.stop="$refs.fileInput.click()"
        >
          {{ $t("Browse Files") }}
        </VBtn>
      </div>

      <!-- Processing overlay (while downscaling / encoding) -->
      <div
        v-if="isProcessing"
        style="
          position: absolute;
          inset: 0;
          display: flex;
          justify-content: center;
          align-items: center;
          background-color: rgba(255, 255, 255, 0.7);
          border-radius: 8px;
        "
      >
        <VProgressCircular indeterminate color="primary" />
      </div>

      <!-- Re-crop button (only for freshly uploaded images, avoids CORS taint) -->
      <VBtn
        v-if="previewUrl && enableCrop && rawImage"
        color="primary"
        icon="tabler-crop"
        size="x-small"
        rounded
        style="position: absolute; top: 10px; right: 44px"
        @click.stop="reopenCropper"
      />

      <!-- Delete button -->
      <VBtn
        v-if="previewUrl"
        :loading="isLoading"
        color="error"
        icon="tabler-x"
        size="x-small"
        rounded
        style="position: absolute; top: 10px; right: 10px"
        @click.stop="handleClear"
      />
    </div>

    <input
      ref="fileInput"
      type="file"
      accept="image/*"
      @change="handleFileChange"
      style="display: none"
    />

    <!-- Crop dialog -->
    <VDialog v-model="cropDialog" max-width="600" persistent>
      <VCard>
        <VCardTitle class="d-flex align-center">
          <VIcon icon="tabler-crop" class="me-2" />
          {{ $t("Crop Image") }}
        </VCardTitle>
        <VDivider />

        <VCardText>
          <Cropper
            ref="cropper"
            :src="rawImage"
            :stencil-props="
              cropAspectRatio ? { aspectRatio: cropAspectRatio } : {}
            "
            :stencil-component="
              circleStencil ? CircleStencil : RectangleStencil
            "
            class="cropper"
            style="max-height: 400px; background: #1e1e1e"
          />
        </VCardText>

        <VDivider />

        <VCardActions class="px-4 pb-4 pt-4">
          <VSpacer />
          <VBtn variant="tonal" color="secondary" @click="cancelCrop">
            {{ $t("Cancel") }}
          </VBtn>
          <VBtn
            color="primary"
            variant="flat"
            :loading="isProcessing"
            @click="confirmCrop"
          >
            {{ $t("Crop & Save") }}
          </VBtn>
        </VCardActions>
      </VCard>
    </VDialog>
  </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { Cropper, CircleStencil, RectangleStencil } from "vue-advanced-cropper";
import "vue-advanced-cropper/dist/style.css";

const props = defineProps({
  modelValue: {
    type: String,
    default: null,
  },
  label: {
    type: String,
    required: true,
  },
  icon: {
    type: String,
    required: true,
    default: "tabler-cloud-upload",
  },
  isLoading: {
    type: Boolean,
    default: false,
  },
  headline: {
    type: String,
    default: null,
  },
  supportText: {
    type: String,
    default: null,
  },
  // Cropping options
  enableCrop: {
    type: Boolean,
    default: true,
  },
  cropAspectRatio: {
    type: Number,
    default: null, // e.g. 1 for square, 16/9 for wide. null = free crop
  },
  circleStencil: {
    type: Boolean,
    default: false,
  },
  // How to turn a server path into a full URL (used on edit)
  urlResolver: {
    type: Function,
    default: null,
  },
  // Performance: largest dimension fed into the cropper / emitted output.
  // Big mobile photos get downscaled to this before any heavy work happens.
  maxDimension: {
    type: Number,
    default: 1600,
  },
  // JPEG quality for the encoded output (0..1)
  outputQuality: {
    type: Number,
    default: 0.85,
  },
});

const emit = defineEmits(["update:modelValue", "change", "clear"]);

const uploadBox = ref(null);
const fileInput = ref(null);
const cropper = ref(null);
const iconColor = ref("#999");
const borderColor = ref("#ddd");
const selectedFile = ref(null);
const isDragging = ref(false);
const isProcessing = ref(false);

const cropDialog = ref(false);
const rawImage = ref(null); // downscaled base64 of a NEW upload, kept for re-cropping

// Is the current value a freshly uploaded base64 string?
const isDataUrl = (val) => typeof val === "string" && val.startsWith("data:");

// What the <img> actually shows: base64 as-is, or server path resolved to URL
const previewUrl = computed(() => {
  const val = props.modelValue;
  if (!val) return null;
  if (isDataUrl(val)) return val;
  return props.urlResolver ? props.urlResolver(val) : val;
});

const readAsDataURL = (file) =>
  new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.onload = (e) => resolve(e.target.result);
    reader.onerror = reject;
    reader.readAsDataURL(file);
  });

const loadImage = (src) =>
  new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = () => resolve(img);
    img.onerror = reject;
    img.src = src;
  });

// Shrink a data URL so its largest side is <= maxDimension.
// Returns a (smaller) data URL — used as the cropper source.
const downscaleDataUrl = async (dataUrl) => {
  const img = await loadImage(dataUrl);
  const max = Math.max(img.width, img.height);
  if (max <= props.maxDimension) return dataUrl; // already small enough

  const scale = props.maxDimension / max;
  const canvas = document.createElement("canvas");
  canvas.width = Math.round(img.width * scale);
  canvas.height = Math.round(img.height * scale);
  const ctx = canvas.getContext("2d");
  ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
  return canvas.toDataURL("image/jpeg", 0.92);
};

const processFile = async (file, event = null) => {
  if (!file) return;
  if (!file.type.startsWith("image/")) return; // ignore non-image drops

  isProcessing.value = true;
  try {
    selectedFile.value = file;
    const original = await readAsDataURL(file);
    // Downscale FIRST so nothing downstream ever touches the full-size photo.
    const downscaled = await downscaleDataUrl(original);

    if (props.enableCrop) {
      rawImage.value = downscaled;
      cropDialog.value = true; // open cropper instead of emitting immediately
    } else {
      // No crop: re-encode at output quality and emit as base64.
      const img = await loadImage(downscaled);
      const canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      canvas.getContext("2d").drawImage(img, 0, 0);
      emit(
        "update:modelValue",
        canvas.toDataURL("image/jpeg", props.outputQuality),
      );
    }

    emit("change", { event, file });
  } finally {
    isProcessing.value = false;
  }
};

const handleFileChange = (event) => {
  processFile(event.target.files[0], event);
};

const handleDrop = (event) => {
  isDragging.value = false;
  processFile(event.dataTransfer.files[0], event);
};

const confirmCrop = () => {
  // Cap the cropper output dimensions too, in case the user zoomed way out.
  const result = cropper.value?.getResult({
    maxWidth: props.maxDimension,
    maxHeight: props.maxDimension,
  });
  if (result?.canvas) {
    emit(
      "update:modelValue",
      result.canvas.toDataURL("image/jpeg", props.outputQuality),
    );
  }
  cropDialog.value = false;
};

const cancelCrop = () => {
  cropDialog.value = false;
  // If nothing was previously saved, discard the pending upload
  if (!props.modelValue || !isDataUrl(props.modelValue)) {
    rawImage.value = null;
    selectedFile.value = null;
    if (fileInput.value) fileInput.value.value = "";
  }
};

const reopenCropper = () => {
  if (rawImage.value) cropDialog.value = true;
};

const handleDragOver = () => {
  isDragging.value = true;
};

const handleDragLeave = () => {
  isDragging.value = false;
};

const handleClear = () => {
  selectedFile.value = null;
  rawImage.value = null;
  if (fileInput.value) fileInput.value.value = "";
  emit("update:modelValue", null);
  emit("clear");
};

const handleMouseOver = () => {
  borderColor.value = "#1976d2";
  iconColor.value = "#1976d2";
};

const handleMouseLeave = () => {
  borderColor.value = "#ddd";
  iconColor.value = "#999";
};
</script>

<style scoped>
.cropper {
  border-radius: 6px;
  overflow: hidden;
}
</style>
