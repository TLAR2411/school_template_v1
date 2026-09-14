<script setup>
import { useI18n } from "vue-i18n";
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import formatNation from "@/utils/formater/formatNation";
import AppName from "@/components/AppName.vue";
import { api } from "@/utils/api";
import { useDialog } from "@/composables/useDialog";
const { t,locale } = useI18n();
const { showDialog } = useDialog();
const props = defineProps({
  students: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(["removed"]);
const removeStudentFromFamily = async (student) => {
  const confirmed = await showDialog({
    title: t(`Remove student (${student.name_kh || student.name_en}) from this family?`),
    icon: "warning",
    confirmColor: "error",
    confirmText: t("Delete"),
  });
  if (!confirmed) return;
  try {
    const res = await api.post("student-family-delete", {
      student_family_id: student.student_family_id,
    });
    if (res.data.status) {
      emit("removed");
    }
  } catch (error) {
    console.log(error);
  }
};
</script>
<template>
  <VTable>
    <thead>
      <tr>
        <!-- <th>{{ t("Name English") }}</th>
        <th>{{ t("Name Khmer") }}</th> -->
        <th>{{ t("Student") }}</th>
        <th>{{ t("Gender") }}</th>
        <th>{{ t("Nation") }}</th>
        <th>{{ t("Date of Birth") }}</th>
        <th>{{ t("Action") }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="s in students" :key="s.id">
        <td>
          <div class="d-flex flex-row pt-2 pb-2">
            <AppName
              :title="s.name_en"
              :sub-title="s.name_kh"
              :image="s.photo_path"
            />
          </div>
        </td>
        <td>{{ formatGender(s.gender) }}</td>
        <td>{{ formatNation(s.nation) }}</td>
        <td>{{ formatDate(s.dob) }}</td>
        <td>
          <VIcon
            @click="removeStudentFromFamily(s)"
            size="18"
            class="mr-1 text-error cursor-pointer"
          >
            tabler-trash
          </VIcon>
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
