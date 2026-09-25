import HrNavItems from "@/navigation/vertical/hr";
import AdminNavItems from "@/navigation/vertical/admin";
import AccountingNavItems from "@/navigation/vertical/accounting";
import SchoolNavItems from "@/navigation/vertical/school";

export const DEFAULT_PART = "loan";

/**
 * Single source of truth for system parts (Loan, HR, Admin, Accounting, …).
 * Add a new part here — menus, nav, routes, and redirects can all reuse this.
 *
 * `navItems: null` means the layout resolves nav via a composable (loan).
 */
export const SYSTEM_PARTS = [
  // {
  //   key: "loan",
  //   title: "Loan System",
  //   icon: "tabler-cash",
  //   permission: "loan-allow-part",
  //   path: "/loan",
  //   dashboardRoute: "loan-dashboards",
  //   profileRoute: "loan-user-profile-tab",
  //   navItems: null,
  // },
  // {
  //   key: "accounting",
  //   title: "Accounting System",
  //   icon: "tabler-calculator",
  //   permission: "accounting-allow-part",
  //   path: "/accounting",
  //   dashboardRoute: "accounting-dashboards",
  //   profileRoute: "accounting-user-profile-tab",
  //   navItems: AccountingNavItems,
  // },
  // {
  //   key: "hr",
  //   title: "HR System",
  //   icon: "tabler-users",
  //   permission: "hr-allow-part",
  //   path: "/hr",
  //   dashboardRoute: "hr-dashboards",
  //   profileRoute: "hr-user-profile-tab",
  //   navItems: HrNavItems,
  // },
  {
    key: "admin",
    title: "Admin System",
    icon: "tabler-settings",
    permission: "admin-allow-part",
    path: "/admin",
    dashboardRoute: "admin-dashboards",
    profileRoute: "admin-user-profile-tab",
    navItems: AdminNavItems,
  },
  {
    key: "school",
    title: "School System",
    icon: "tabler-school",
    permission: "school-allow-part",
    path: "/school",
    dashboardRoute: "school-dashboards",
    profileRoute: "school-user-profile-tab",
    navItems: SchoolNavItems,
  },
];

export const getPartConfig = (key) =>
  SYSTEM_PARTS.find((p) => p.key === key) ||
  SYSTEM_PARTS.find((p) => p.key === DEFAULT_PART);

export const getSystemPartsForMenu = (activePart) =>
  SYSTEM_PARTS.map((p) => ({
    title: p.title,
    icon: p.icon,
    part: p.key,
    permission: p.permission,
    active: activePart === p.key,
  }));

export const getDashboardRoute = (part) => getPartConfig(part).dashboardRoute;

export const getProfileRoute = (part) => getPartConfig(part).profileRoute;

export const getPartPath = (part) => getPartConfig(part)?.path ?? "/";

export const getNavItemsByPart = (part, loanNavItems) => {
  const config = getPartConfig(part);

  if (config?.navItems) return config.navItems;

  return loanNavItems;
};

export const segmentMap = Object.fromEntries(
  SYSTEM_PARTS.map((p) => [p.key, p.key]),
);
