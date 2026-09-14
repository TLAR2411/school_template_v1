<script setup>
import { useI18n } from "vue-i18n";

const { t } = useI18n();

defineProps({
  members: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits([
  "onEdit",
  "onDelete",
  "onPassword",
  "onUsername",
]);
</script>

<template>
  <VTable>
    <thead>
      <tr>
        <th>{{ t("Type") }}</th>
        <th>{{ t("Name English") }}</th>
        <th>{{ t("Name Khmer") }}</th>
        <th>{{ t("Phone") }}</th>
        <th>{{ t("username") }}</th>
        <th>{{ t("email") }}</th>
        <th>{{ t("Action") }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="m in members" :key="m.id">
        <td>
          <VChip size="small" variant="tonal">
            {{ m.type }}
          </VChip>
        </td>
        <td>{{ m.name_en || "-" }}</td>
        <td>{{ m.name_kh || "-" }}</td>
        <td>{{ m.phone || "-" }}</td>
        <td>{{ m.user?.username || "-" }}</td>
        <td>{{ m.email || m.user?.email || "-" }}</td>
        <td>
          <div class="d-flex align-center ga-2">
            <VIcon
              size="18"
              class="text-warning cursor-pointer"
              :title="t('Edit')"
              @click="emit('onEdit', m)"
            >
              tabler-pencil
            </VIcon>

            <VIcon
              v-if="m.user_id"
              size="18"
              class="text-info cursor-pointer"
              :title="t('Change Password')"
              @click="emit('onPassword', m)"
            >
              tabler-key
            </VIcon>

            <VIcon
              v-if="m.user_id"
              size="18"
              class="text-primary cursor-pointer"
              :title="t('Change Username')"
              @click="emit('onUsername', m)"
            >
              tabler-user
            </VIcon>

            <VIcon
              size="18"
              class="text-error cursor-pointer"
              :title="t('Delete')"
              @click="emit('onDelete', m)"
            >
              tabler-trash
            </VIcon>
          </div>
        </td>
      </tr>
    </tbody>
  </VTable>
</template>
