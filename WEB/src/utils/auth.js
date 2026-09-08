import { useAuthStore } from "@/stores/authStore"

export const auth = () => {
  const authStore = useAuthStore()
  return {
    user: authStore.user,
    accessToken: authStore.accessToken,
    permissions: authStore.permissions,
    branches: authStore.branches,
    curriculums: authStore.curriculums,
    isAuthenticated: authStore.isAuthenticated,
  }
}
