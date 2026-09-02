import { useAuthStore } from "@/stores/authStore";
import hasPermission from "@/utils/hasPermission";
import { useLoanStore } from "@/stores/loanStore";
import { useSettingStore } from "@/stores/settingStore";
import { getI18n } from '@/plugins/i18n';
import { usePartStore } from "@/stores/partStore";
import { getAccessToken, removeAccessToken } from "@/utils/accessToken";
// import { useCookie } from "#imports";
const { t } = getI18n().global;
export const setupGuards = (router) => {
  router.beforeEach(async (to) => {
    const auth = useAuthStore()
    const part = usePartStore()
    const setting = useSettingStore()
    const loan = useLoanStore()

    // 1. Determine the module (Admin, HR, etc.)
    const firstSegment = to.path.split("/")[1] || 'loan';
    const segmentMap = {
      'loan': 'loan',
      'admin': 'admin',
      'hr': 'hr',
      'accounting': 'accounting',
      'stock': 'stock'
    };
    part.setSystemPart(segmentMap[firstSegment] || 'loan');

    document.title = t(to?.meta?.title || "School Template");

    // 2. Get the token - use a fresh check
    const accessToken = getAccessToken();

    // 3. Handle Bootstrapping (Syncing Cookie to Pinia)
    if (accessToken && !auth.isBootstrapped) {
      try {
        await auth.bootstrap();
      } catch (error) {
        console.error("Bootstrap failed, likely invalid token:", error);
        removeAccessToken() // Clear invalid cookie
        return { name: 'login' };
      }
    }

    // 4. Determine Login Status
    const isLoggedIn = Boolean(accessToken) || auth.isAuthenticated;

    // 5. Public Route Logic
    if (to.meta.public) return true;

    // 6. Redirect Logic
    if (!isLoggedIn) {
      if (to.name !== 'login') {
        return { name: 'login' };
      }
      return true;
    }

    if (to.meta.unauthenticatedOnly && isLoggedIn) {
      return { name: 'root' };
    }

    // 7. Permissions
    if (to.meta.permissions && !hasPermission(to.meta.permissions)) {
      return { name: "not-authorized" };
    }

    // 8. Background Data Fetching
    if (setting.branch_id && isLoggedIn) {
      if (hasPermission('view-loans') && part.system_part == 'loan') {
        loan.fetchApprovalCount();
        loan.fetchCollectCount();
      }
    }

    return true;
  });
};