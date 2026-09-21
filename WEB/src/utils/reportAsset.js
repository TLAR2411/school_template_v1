import getImageUrl from "@/utils/image/getImageUrl";

/** Logo / signature: data URL from upload, or storage path from API. */
export function resolveReportAsset(value) {
  if (!value || typeof value !== "string") return null;

  if (value.startsWith("data:")) return value;

  return getImageUrl(value);
}
