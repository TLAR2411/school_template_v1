<script setup>
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import { onMounted } from "vue";
import moment from "moment-timezone";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import { getBranches } from "@/services/dataService";
import { debounce } from "lodash";
import { useDialog } from "@/composables/useDialog";
import { useSettingStore } from "@/stores/settingStore";
import hasPermission from "@/utils/hasPermission";

const items = ref([]);
const branches = ref([]);
const isLoading = ref(false);
const { showDialog } = useDialog();

const filter = ref({
  choose_branch_id: null,
  choose_date: moment()
    .tz("Asia/Phnom_Penh")
    .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00"),
});

const initData = async () => {
  try {
    isLoading.value = true;

    const res = await api.post("close-entries-by-branches", {
      filter: filter.value,
    });
    if (res.data.status) {
      items.value = res.data.data;
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
onMounted(async () => {
  initData();
  const dataBranches = await getBranches();
  branches.value = dataBranches;
});

const formatDateTime = (date) => {
  const d = new Date(date);
  const year = d.getFullYear();
  const month = String(d.getMonth() + 1).padStart(2, "0");
  const day = String(d.getDate()).padStart(2, "0");
  const hours = String(d.getHours()).padStart(2, "0");
  const minutes = String(d.getMinutes()).padStart(2, "0");
  const seconds = String(d.getSeconds()).padStart(2, "0");

  return `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
};

watch(filter.value, (newVal) => {
  initData();
});
watch(
  () => [filter.value, useSettingStore().branch_id],
  (newVal) => {
    initData();
  },
);

const onRollback = async (item) => {
  const result = await showDialog({
    title: "ធ្វើការលុបការបិទបញ្ចីសាខា?",
    icon: "warning",
    confirmColor: "error",
    confirmText: "Delete",
  });
  if (result) {
    try {
      isLoading.value = true;

      const res = await api.post("close-entries-delete", {
        id: item.id,
      });

      if (res.data.status) {
        initData();
      }
    } catch (error) {
      console.error("Failed to fetch data:", error);
    } finally {
      isLoading.value = false;
    }
  }
};

const onReceiveRollback = debounce(async (item) => {
  const result = await showDialog({
    title: "ធ្វើការលុបការប្រមូលប្រាក់ក្នុងសាខា?",
    icon: "warning",
    confirmColor: "error",
    confirmText: "Delete",
  });
  if (result) {
    try {
      isLoading.value = true;

      const res = await api.post("receives-rollback-by-receive", {
        choose_branch_id: item.id,
        receive_date: filter.value.choose_date,
      });

      if (res.data.status) {
        initData();
      } else {
        console.error("Error with the response:", res.data);
      }
    } catch (error) {
      console.error("Failed to fetch data:", error);
    } finally {
      //
      // isDialogVisible.value = false;
      isLoading.value = false;
    }
  }
}, 500);
</script>

<template>
  <AppCard
    title="Close entries by branches"
    title-icon="tabler-checklist"
    :loading="isLoading"
    showFilters
    :is-back="false"
  >
    <template #filter>
      <VRow class="justify-end">
        <VCol cols="12" sm="6" md="4" lg="3">
          <AppDateTimePicker v-model="filter.choose_date">
            <template #label>{{ $t("Date") }}</template>
          </AppDateTimePicker>
        </VCol>
      </VRow>
    </template>

    <VRow>
      <VCol>
        <VTimeline
          side="end"
          align="start"
          line-inset="8"
          truncate-line="start"
          density="compact"
        >
          <template v-for="item in items">
            <VTimelineItem
              size="x-small"
              dot-color="success"
              v-if="item.close_entry"
            >
              <VCard>
                <VRow>
                  <VCol>
                    <div class="d-flex flex-column w-100 pa-3">
                      <div
                        class="d-flex justify-space-between align-center flex-wrap mb-2"
                      >
                        <div class="app-timeline-title text-primary">
                          {{ item.name_kh }}
                        </div>
                        <span class="app-timeline-meta">
                          {{ formatDateTime(item?.close_entry?.created_at) }}
                        </span>
                      </div>
                      <div
                        class="app-timeline-text mt-1 d-flex flex-column"
                        style="font-size: 14px"
                      >
                        <!-- <VChip color="success" size="small"> បានបិទបញ្ចីរួចរាល់ </VChip> -->
                        <span
                          >ទម្លាក់ទុន
                          {{
                            formatCurrency(item?.close_entry?.disburse_amount)
                          }}</span
                        >
                        <span
                          >ប្រមូល
                          {{
                            formatCurrency(item?.close_entry?.receive_amount)
                          }}</span
                        >
                      </div>
                      <VDivider class="mt-2" />

                      <div
                        class="d-flex justify-space-between align-center flex-wrap"
                      >
                        <!-- 👉 Avatar & Personal Info -->
                        <div class="d-flex align-center mt-2">
                          <!-- <VAvatar
                            v-if="item?.close_entry?.created_by?.image_path"
                            :image="
                              getImageUrl(
                                item?.close_entry?.created_by?.image_path,
                              )
                            "
                          />
                          <VAvatar v-else :image="avatar1" /> -->
                          <AppName
                            :title="item.close_entry?.created_by?.name_kh"
                            :sub-title="
                              item?.close_entry?.created_by?.position?.name_kh
                            "
                            :image="item?.close_entry?.created_by?.image_path"
                          />
                          <!-- <div class="d-flex flex-column">
                            <p
                              class="text-sm font-weight-medium text-medium-emphasis mb-0"
                            >
                              {{ item?.close_entry?.created_by?.name_kh }}
                            </p>
                            <span class="text-sm">
                              {{
                                item?.close_entry?.created_by?.position?.name_kh
                              }}</span
                            >
                          </div> -->
                        </div>
                        <VBtn
                          color="error"
                          size="small"
                          @click="onRollback(item?.close_entry)"
                        >
                          <VIcon start icon="tabler-arrow-back-up" />{{
                            $t("Rollback")
                          }}</VBtn
                        >
                      </div>
                    </div>
                  </VCol>
                </VRow>
              </VCard>
            </VTimelineItem>

            <VTimelineItem size="x-small" dot-color="error" v-else>
              <!-- 👉 Header -->
              <div
                class="d-flex justify-space-between align-center flex-wrap mb-2"
              >
                <div class="app-timeline-title">{{ item.name_kh }}</div>
                <span class="app-timeline-meta">{{
                  item?.close_entry?.created_at
                }}</span>
              </div>
              <div
                class="app-timeline-text mt-1 d-flex flex-column text-center"
                style="width: 200px"
              >
                <VChip
                  color="error"
                  size="small"
                  style="
                    text-align: center;
                    align-items: center;
                    justify-content: center;
                  "
                >
                  <span style="width: 100%; text-align: center"
                    >សាខាមិនទាន់បានបិទបញ្ចី</span
                  >
                </VChip>
                <!-- <VBtn
                  v-if="hasPermission('delete-receives')"
                  class="mt-2"
                  size="x-small"
                  color="error"
                  @click="onReceiveRollback(item)"
                  ><VIcon
                    start
                    icon="tabler-trash"
                  />លុបការបង់ប្រាក់ក្នុងសាខា</VBtn
                > -->
              </div>
            </VTimelineItem>
          </template>
        </VTimeline>
      </VCol>
    </VRow>
  </AppCard>
</template>
