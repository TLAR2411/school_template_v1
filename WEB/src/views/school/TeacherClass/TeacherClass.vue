<script setup>
import { onMounted, ref } from "vue";

import { api } from "@/utils/api.js";
import AddEditTeacherClassDialog from "./AddEditTeacherClassDialog.vue";
import { useDialog } from "@/composables/useDialog";
import { useI18n } from "vue-i18n";
import getImageUrl from "@/utils/image/getImageUrl";
import hasPermission from "@/utils/hasPermission";

const { showDialog } = useDialog();
const { t } = useI18n();

const formData = ref({});
const isDialogVisible = ref(false);
const isLoading = ref(false);

const props = defineProps({
  class_id: {
    type: Number,
  },
});

const teachers = ref([]);

const defaultPhoto =
  "https://st4.depositphotos.com/9998432/24428/v/450/depositphotos_244284796-stock-illustration-person-gray-photo-placeholder-man.jpg";

const onDelete = async (item) => {
  //   try {
  //     isLoading.value = true;

  //     const res = await api.post("teachers-classes-delete", {
  //       class_id: item.class_id,
  //       teacher_id: item.teacher_id,
  //     });

  //     if (res.data.status) {
  //       getTeacherClassList();
  //     } else {
  //       console.error("Error with the response:", res.data);
  //     }
  //   } catch (error) {
  //     console.error("Failed to fetch data:", error);
  //   } finally {
  //     isLoading.value = false;
  //   }

  const confirmed = await showDialog({
    title: t(`Delete this teacher (${item.name_kh}-${item.name_en})?`),
    icon: "warning",
    confirmColor: "error",
    confirmText: t("Delete"),
  });
  if (!confirmed) return; // user clicked Cancel
  try {
    isLoading.value = true;
    const res = await api.post("teachers-classes-delete", {
      class_id: item.class_id,
      teacher_id: item.teacher_id,
    });
    if (res.data.status) {
      getTeacherClassList();
    } else {
      console.error(res.data.message);
    }
  } catch (error) {
    console.error("Failed to delete teacher:", error);
  } finally {
    isLoading.value = false;
  }
};

const onCreate = async (data, callback) => {
  const payload = {
    ...data,
    class_id: props.class_id,
  };

  console.log("pay", payload);
  try {
    isLoading.value = true;

    const res = await api.post("teachers-classes-store", payload);

    if (res.data.status) {
      isDialogVisible.value = false;
      getTeacherClassList();
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("teachers-classes-show", {
      class_id: item.class_id,
      teacher_id: item.teacher_id,
    });

    if (res.data.status) {
      formData.value = res.data.data;
      console.log("formData", formData.value);
      // console.log(formData.value)
      isDialogVisible.value = true;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = async (data, callback) => {
  const payload = {
    ...data,
    class_id: props.class_id,
  };
  try {
    isLoading.value = true;

    const res = await api.post("teachers-classes-update", payload);

    // if (res.data.status) {
    //   isDialogVisible.value = false;
    // } else {
    //   console.error("Error with the response:", res.data);
    // }
    getTeacherClassList();
    isDialogVisible.value = false;

    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const getTeacherClassList = async () => {
  try {
    const res = await api.post("teachers-classes-list", {
      class_id: props?.class_id,
    });

    teachers.value = res.data.data;
    console.log("teacher", teachers.value);
  } catch (error) {}
};

const onDeleteSubject = async (subjectRow) => {
  const confirmed = await showDialog({
    title: t(`Delete this subject (${subjectRow.name_en}) from teacher?`),
    icon: "warning",
    confirmColor: "error",
    confirmText: t("Delete"),
  });
  if (!confirmed) return; // user clicked Cancel
  try {
    isLoading.value = true;
    const res = await api.post("teachers-classes-delete_subject", {
      id: subjectRow.id,
    });
    if (res.data.status) {
      getTeacherClassList();
    } else {
      console.error(res.data.message);
    }
  } catch (error) {
    console.error("Failed to delete subject:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(() => {
  getTeacherClassList();
});
</script>

<template>
  <AddEditTeacherClassDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    :class_id="props.class_id"
    @on-create="onCreate"
    @on-update="onUpdate"
  />
  <VCard class="mt-3">
    <VCardTitle class="d-flex align-center justify-space-between pa-4">
      <VChip class="rounded-l" color="primary">Teacher and Subjects</VChip>
      <VBtn
        v-if="hasPermission('add-teacher-classes')"
        id="page-tour-add-teacher"
        color="primary"
        size="small"
        prepend-icon="tabler-plus"
        @click="isDialogVisible = !isDialogVisible"
      >
        Add Teacher
      </VBtn>
    </VCardTitle>

    <VCardText class="pa-4">
      <VRow>
        <VCol
          cols="12"
          sm="3"
          md="3"
          v-for="item in teachers"
          :key="item.name_en"
        >
          <VCard
            :loading="isLoading"
            class="teacher-card pa-4 text-center"
            rounded="lg"
            variant="outlined"
          >
            <div class="card-actions">
              <VBtn
                v-if="hasPermission('edit-teacher-classes')"
                icon
                size="x-small"
                variant="text"
                color="warning"
                @click="onEdit(item)"
              >
                <VIcon size="14">tabler-edit</VIcon>
              </VBtn>
              <VBtn
                v-if="hasPermission('delete-teacher-classes')"
                icon
                size="x-small"
                variant="text"
                color="error"
                @click="onDelete(item)"
              >
                <VIcon size="14">tabler-trash</VIcon>
              </VBtn>
            </div>

            <VAvatar
              :image="
                item.photo_path ? getImageUrl(item.photo_path) : defaultPhoto
              "
              size="72"
              rounded="circle"
              class="mb-2"
            />

            <!-- <div class="d-flex justify-center w-75">
              <AppName :image="item.photo_path" :size="80" rounded="circle" />
            </div> -->
            <div class="d-flex ga-2 justify-center">
              <p class="text-body-2 font-weight-medium mb-0">
                {{ item.name_en }}
              </p>
              <p class="text-caption text-medium-emphasis mb-2">
                ({{ item.name_kh }})
              </p>
            </div>

            <div
              class="text-caption mt-1 text-medium-emphasis d-flex align-center justify-start ga-1"
            >
              <VIcon size="14">tabler-phone</VIcon> {{ item.phone }}
            </div>
            <div
              v-if="item.email"
              class="text-caption text-medium-emphasis d-flex align-center justify-start ga-1"
            >
              <VIcon size="14">tabler-mail</VIcon> {{ item.email }}
            </div>
            <div
              class="text-caption text-medium-emphasis d-flex align-center justify-start ga-1"
            >
              <VIcon size="14">tabler-book</VIcon>
              <div v-for="s in item.subjects" :key="s.subject_id">
                {{ s.name_en }}
                <VBtn
                  v-if="hasPermission('delete-teacher-classes')"
                  icon
                  size="x-small"
                  variant="text"
                  color="error"
                  @click="onDeleteSubject(s)"
                >
                  <VIcon size="14">tabler-trash</VIcon>
                </VBtn>
              </div>
            </div>

            <div class="d-flex ga-2 mt-2">
              <VChip
                v-if="item.is_classload"
                size="x-small"
                color="success"
                variant="tonal"
              >
                Classload Teacher
              </VChip>
              <VChip
                v-if="item.is_assisstant"
                size="x-small"
                color="info"
                variant="tonal"
              >
                Assistant
              </VChip>
              <VChip v-else size="x-small" color="info" variant="tonal">
                Main Teacher
              </VChip>
            </div>
          </VCard>
        </VCol>
      </VRow>
    </VCardText>
  </VCard>
</template>

<style scoped>
.teacher-card {
  position: relative;
}

.card-actions {
  position: absolute;
  top: 6px;
  right: 6px;
  display: flex;
}

.add-card {
  border-style: dashed;
  cursor: pointer;
  color: rgba(var(--v-theme-on-surface), 0.6);
}

.add-card:hover {
  background: rgba(var(--v-theme-on-surface), 0.03);
}
</style>
