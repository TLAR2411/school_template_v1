import { defineStore } from "pinia";
import { api } from "@/utils/api";
import { router } from "@/router/index";
import { useAppStore } from "@/stores/appStore";
import { useSettingStore } from "./settingStore";
import { usePartStore } from "./partStore";
import { decrypt } from "@/utils/encrypteData";
import { getAccessToken, removeAccessToken, setAccessToken } from "@/utils/accessToken";
import { getPartPath } from "@/config/systemParts";

export const useAuthStore = defineStore("auth", {
  state: () => {
    const token = localStorage.getItem("accessToken");
    return {
      id: null,
      isAuthenticated: !!token,
      user: null,
      accessToken: token || null,
      refreshToken: null,
      isTokenRefreshing: false,
      permissions: [],
      branches: [],
      curriculums: [],
      isBootstrapped: false,
    }
  },
  actions: {
    async login(payload) {
      try {
        const response = await api.post("login", {
          ...payload,
        },
          {               // Third argument: The config object
            headers: {
              'X-CLIENT-ID': import.meta.env.VITE_CLIENT_ID,
            }
          }
        );

        if (response.data.status) {

          const data = response.data.data;
          const token = data.access_token;

          setAccessToken(token);

          this.$patch({
            isAuthenticated: true,
            accessToken: response.data.data.access_token,
            refreshToken: response.data.data.refresh_token,
            isTokenRefreshing: false,
          });

          useAppStore().getAllAppStore();

          await this.bootstrap(token);
          const defaultPart = response?.data?.data?.default_part;
          const defaultBranch = response?.data?.data?.default_branch;
          usePartStore().setSystemPart(defaultPart);
          useSettingStore().setBranchId(defaultBranch);

          router.push(getPartPath(defaultPart));
        } else {
          console.error("Login failed with status:", response.data.status);
        }
      } catch (error) {
        console.error("Login error:", error);
      }
    },
    async token(payload) {
      try {
        const response = await api.post("change-user", {
          ...payload
        }, {               // Third argument: The config object
          headers: {
            'X-CLIENT-ID': import.meta.env.VITE_CLIENT_ID,
          }
        });

        console.log(response);
        if (response.data.status) {

          this.$patch({
            isAuthenticated: true,
            accessToken: response.data.data.access_token,
            refreshToken: response.data.data.refresh_token,
            isTokenRefreshing: false,
          });
          const token = response.data.data.access_token;



          setAccessToken(token);
          await this.bootstrap();
          const defaultPart = response?.data?.data?.default_part;
          usePartStore().setSystemPart(defaultPart);
          useSettingStore().setBranchId(response?.data?.data?.branch_id);

          useAppStore().getAllAppStore();

          router.push(getPartPath(defaultPart));
        } else {
          console.error("Change user failed with status:", response.data.status);
        }
      } catch (error) {
        console.error("Change user error:", error);
      }
    },
    async bootstrap(accessToken = null) {
      const token = accessToken ?? getAccessToken();

      if (!token) {
        return this.unAuthenticated();
      }

      try {
        const response = await api.get('bootstrap');
        if (response.data.a) {
          const userData = decrypt(response.data.b);
          const branches = decrypt(response.data.c);
          const permissions = decrypt(response.data.d);

          this.$patch({
            id: userData.id,
            user: userData,
            branches: branches,
            permissions: permissions,
            isAuthenticated: true,
            accessToken: token, // Sync token just in case
          });

          await this.fetchCurriculums();
        }
      } catch (error) {
        if (error.code === 'ERR_CANCELED' || error.message === 'canceled') {
          return;
        }
        if (error.response?.status === 401) {
          await this.unAuthenticated();
        }
      } finally {
        this.isBootstrapped = true;
      }
    },
    async fetchCurriculums() {
      try {
        const response = await api.post("curriculums-all");
        if (response.data.status) {
          this.curriculums = response.data.data || [];
        }
      } catch (error) {
        console.error("Failed to fetch curriculums:", error);
        this.curriculums = [];
      }
    },
    async logout() {
      try {
        const response = await api.post("logout");

        if (response.data.status) {

          useSettingStore().branch_id = null;
          useSettingStore().curriculum_id = null;
          useSettingStore().year_id = null;
          useSettingStore().year_name = null;
          useAppStore().clearAllAppStore();

          this.unAuthenticated();
        }
      } catch (error) {
        console.error("Server error:", error);
      }
    },
    async unAuthenticated() {
      this.$patch({
        id: null,
        isAuthenticated: false,
        user: null,
        accessToken: null,
        refreshToken: null,
        isTokenRefreshing: false,
        permissions: [],
        branches: [],
        curriculums: [],
        isBootstrapped: false,
      });

      removeAccessToken();
      router.replace({ name: 'login' });
    },
  }
});
