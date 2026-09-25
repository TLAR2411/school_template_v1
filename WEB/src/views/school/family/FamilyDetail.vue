<script setup>
import { api } from "@/utils/api";
import { computed, onMounted, ref } from "vue";
import { useRoute } from "vue-router";
import { useI18n } from "vue-i18n";
import FamilyMember from "./FamilyMember.vue";
import StudentFamily from "./StudentFamily.vue";
import AddStudentFamilyDialog from "./AddStudentFamilyDialog.vue";
import AddFamilyMemberDialog from "./AddFamilyMemberDialog.vue";
import PasswordDialog from "@/views/admin/users/PasswordDialog.vue";
import UsernameDialog from "@/views/admin/users/UsernameDialog.vue";
import { useDialog } from "@/composables/useDialog";
import hasPermission from "@/utils/hasPermission";

const { showDialog } = useDialog();

const { t } = useI18n();
const route = useRoute();

const isBack = ref(false);
const isLoading = ref(false);
const isAddStudentDialogVisible = ref(false);
const isMemberDialogVisible = ref(false);
const isPasswordDialog = ref(false);
const isUsernameDialog = ref(false);
const memberFormData = ref({});
const userIdSelected = ref(null);

const members = ref([]);
const students = ref([]);
const familyData = ref({});

const linkedStudentIds = computed(() =>
  (students.value || []).map((s) => s.student_id || s.id).filter(Boolean),
);

const fetchDataFamilyDetail = async () => {
  try {
    const res = await api.post("families-show", {
      id: route.params.id,
    });

    familyData.value = res.data.data || {};
    members.value = familyData.value.member || [];
    students.value = familyData.value.student || [];
  } catch (error) {
    console.log(error);
  }
};

const openCreateMember = () => {
  memberFormData.value = {};
  isMemberDialogVisible.value = true;
};

const onEditMember = async (member) => {
  try {
    isLoading.value = true;
    const res = await api.post("family-members-show", { id: member.id });

    if (res.data.status) {
      memberFormData.value = res.data.data;
      isMemberDialogVisible.value = true;
    }
  } catch (error) {
    console.error(error);
  } finally {
    isLoading.value = false;
  }
};

const onAddStudents = async (payload, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("student-family-store", {
      family_id: route.params.id,
      student_ids: payload.student_ids,
    });

    if (res.data.status) {
      isAddStudentDialogVisible.value = false;
      await fetchDataFamilyDetail();
      callback?.(true);
    } else {
      callback?.(false);
    }
  } catch (error) {
    console.error(error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onCreateMember = async (payload, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("family-members-store", {
      family_id: route.params.id,
      ...payload,
    });
    if (res.data.status) {
      isMemberDialogVisible.value = false;
      await fetchDataFamilyDetail();
      callback?.(true);
    } else {
      callback?.(false);
    }
  } catch (error) {
    console.error(error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onUpdateMember = async (payload, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("family-members-update", payload);
    if (res.data.status) {
      isMemberDialogVisible.value = false;
      await fetchDataFamilyDetail();
      callback?.(true);
    } else {
      callback?.(false);
    }
  } catch (error) {
    console.error(error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onDeleteMember = async (member) => {
  const confirmed = await showDialog({
    title: t(
      `Delete member (${member.name_kh || member.name_en})? This will also delete their user account.`,
    ),
    icon: "warning",
    confirmColor: "error",
    confirmText: t("Delete"),
  });
  if (!confirmed) return;
  try {
    isLoading.value = true;
    const res = await api.post("family-members-delete", { id: member.id });
    if (res.data.status) {
      await fetchDataFamilyDetail();
    }
  } catch (error) {
    console.error(error);
  } finally {
    isLoading.value = false;
  }
};

const onPassword = (member) => {
  if (!member?.user_id) return;
  userIdSelected.value = member.user_id;
  isPasswordDialog.value = true;
};

const onUsername = (member) => {
  if (!member?.user_id) return;
  userIdSelected.value = member.user_id;
  isUsernameDialog.value = true;
};

const stats = computed(() => {
  const memberCount = members.value.length;
  const studentCount = students.value.length;

  return [
    {
      label: t("Guardians"),
      value: memberCount,
      icon: "tabler-users",
      iconBg: "#E6F1FB",
      iconColor: "#185FA5",
    },
    {
      label: t("Students"),
      value: studentCount,
      icon: "tabler-school",
      iconBg: "#E1F5EE",
      iconColor: "#0F6E56",
    },
    {
      label: t("Total Members"),
      value: memberCount + studentCount,
      icon: "tabler-home-heart",
      iconBg: "#FAEEDA",
      iconColor: "#633806",
    },
  ];
});

onMounted(() => {
  fetchDataFamilyDetail();
});
</script>

<template>
  <AddStudentFamilyDialog
    v-model:isDialogVisible="isAddStudentDialogVisible"
    :loading="isLoading"
    :exclude-ids="linkedStudentIds"
    @on-create="onAddStudents"
  />

  <AddFamilyMemberDialog
    v-model:isDialogVisible="isMemberDialogVisible"
    :loading="isLoading"
    :item-data="memberFormData"
    @on-create="onCreateMember"
    @on-update="onUpdateMember"
  />

  <PasswordDialog
    v-if="isPasswordDialog"
    v-model:is-dialog-visible="isPasswordDialog"
    :item-data="{ user_id: userIdSelected }"
    @onReload="fetchDataFamilyDetail"
  />

  <UsernameDialog
    v-if="isUsernameDialog"
    v-model:is-dialog-visible="isUsernameDialog"
    :item-data="{ user_id: userIdSelected }"
    @onReload="fetchDataFamilyDetail"
  />

  <AppCard
    :isBack="isBack"
    titleIcon="tabler-users"
    :title="familyData.name_en || familyData.name_kh || t('Family')"
  >
    <VRow class="mb-4">
      <VCol v-for="stat in stats" :key="stat.label" cols="12" sm="4">
        <VCard rounded="lg" class="pa-3">
          <div class="d-flex align-center justify-space-between mb-2">
            <span class="text-caption text-medium-emphasis">
              {{ stat.label }}
            </span>
            <div
              class="d-flex align-center justify-center rounded"
              :style="{
                width: '38px',
                height: '38px',
                background: stat.iconBg,
              }"
            >
              <VIcon size="22" :color="stat.iconColor">
                {{ stat.icon }}
              </VIcon>
            </div>
          </div>
          <p class="text-h4 font-weight-medium mb-0">
            {{ stat.value }}
          </p>
        </VCard>
      </VCol>
    </VRow>

    <VCard class="mt-3">
      <VCardTitle class="d-flex align-center justify-space-between">
        <span>{{ $t("Members") }}</span>
        <VBtn
          v-if="hasPermission('edit-families')"
          variant="tonal"
          density="comfortable"
          color="primary"
          @click="openCreateMember"
        >
          <VIcon size="18" class="mr-1">tabler-user-plus</VIcon>
          {{ $t("Add Member") }}
        </VBtn>
      </VCardTitle>
      <VCardText>
        <div v-if="!members.length" class="text-center py-8">
          <VIcon size="40" class="text-medium-emphasis mb-2">
            tabler-user-off
          </VIcon>
          <p class="text-body-2 text-medium-emphasis mb-0">
            {{ t("No guardians") }}
          </p>
        </div>
        <FamilyMember
          v-else
          :members="members"
          @on-edit="onEditMember"
          @on-delete="onDeleteMember"
          @on-password="onPassword"
          @on-username="onUsername"
        />
      </VCardText>
    </VCard>

    <VCard class="mt-3">
      <VCardTitle class="d-flex align-center justify-space-between">
        <span>{{ $t("Students") }}</span>
        <VBtn
          v-if="hasPermission('edit-families')"
          variant="tonal"
          density="comfortable"
          color="primary"
          @click="isAddStudentDialogVisible = true"
        >
          <VIcon size="18" class="mr-1">tabler-user-plus</VIcon>
          {{ $t("Add Student") }}
        </VBtn>
      </VCardTitle>
      <VCardText>
        <div v-if="!students.length" class="text-center py-8">
          <VIcon size="40" class="text-medium-emphasis mb-2">
            tabler-user-off
          </VIcon>
          <p class="text-body-2 text-medium-emphasis mb-0">
            {{ t("No students") }}
          </p>
        </div>
        <StudentFamily
          v-else
          :students="students"
          @removed="fetchDataFamilyDetail"
        />
      </VCardText>
    </VCard>
  </AppCard>
</template>
