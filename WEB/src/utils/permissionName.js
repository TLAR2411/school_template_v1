/**
 * Permission name helpers.
 * Change these if you want a different naming style later.
 * Current format matches the seeder: `{action}-{group}` → `view-users`
 */
export const slugifyPermission = (value) =>
  String(value || "")
    .trim()
    .toLowerCase()
    .replace(/[^a-z0-9]+/g, "-")
    .replace(/^-+|-+$/g, "");

export const buildPermissionName = (displayName, group) => {
  const action = slugifyPermission(displayName);
  const groupSlug = slugifyPermission(group);

  if (!action || !groupSlug) return "";

  return `${action}-${groupSlug}`;
};

export const formatPermissionLabel = (value) =>
  String(value || "")
    .split("-")
    .filter(Boolean)
    .map((word) => word.charAt(0).toUpperCase() + word.slice(1))
    .join(" ");
