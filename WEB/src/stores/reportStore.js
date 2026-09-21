import { defineStore } from "pinia";
import {
  DATE_BOX_DEFAULTS,
  DEFAULT_FONTS,
  DEFAULT_PAPER,
  HEADER_DEFAULTS,
  LOGO_DEFAULTS,
} from "@/config/report";
import { REPORT_BRAND_KEY } from "@/config/reportKeys";
import { api } from "@/utils/api.js";
import {
  extractBrandConfig,
  extractReportConfig,
  mergeBrandAndReport,
} from "@/utils/reportTemplateMerge";

const isPlainObject = (value) =>
  Object.prototype.toString.call(value) === "[object Object]";

const merge = (base, override) => {
  if (!isPlainObject(base) || !isPlainObject(override))
    return override === undefined ? base : override;

  const result = { ...base };

  for (const [key, value] of Object.entries(override))
    result[key] = merge(result[key], value);

  return result;
};

const baseTemplate = () => ({
  paper: { ...DEFAULT_PAPER },
  fonts: { ...DEFAULT_FONTS },
  header: {
    showLogo: true,
    logo: null,
    logoBox: { ...LOGO_DEFAULTS },
    dateBox: { ...DATE_BOX_DEFAULTS },
    title: "",
    subtitle: "",
    lines: [],
    ...HEADER_DEFAULTS,
  },
  footer: {
    show: true,
    note: "",
  },
  signatures: [],
});

export const useReportStore = defineStore("report", {
  state: () => ({
    zoom: 1,
    templates: {},
    /** Per-key: loading template from API */
    loadingKeys: {},
  }),

  actions: {
    ensure(key, defaults = {}) {
      const shape = merge(baseTemplate(), defaults);

      this.templates[key] = this.templates[key]
        ? merge(shape, this.templates[key])
        : shape;

      return this.templates[key];
    },

    reset(key, defaults = {}) {
      delete this.templates[key];

      return this.ensure(key, defaults);
    },

    async load(key, defaults = {}) {
      this.loadingKeys[key] = true;
      const shape = merge(baseTemplate(), defaults);

      try {
        const res = await api.post("report-templates-show", { key });

        if (res.data?.status === false) {
          return this.ensure(key, defaults);
        }

        const { brand, report } = res.data?.data ?? {};
        const merged = mergeBrandAndReport(brand ?? {}, report ?? {}, {});

        this.templates[key] = merge(shape, merged);

        return this.templates[key];
      } catch {
        return this.ensure(key, defaults);
      } finally {
        this.loadingKeys[key] = false;
      }
    },

    async save(key, defaults = {}) {
      const full = this.templates[key];

      if (!full) return null;

      const brandPayload = extractBrandConfig(full);
      const reportPayload = extractReportConfig(full);

      await Promise.all([
        api.post("report-templates-save", {
          key: REPORT_BRAND_KEY,
          config: brandPayload,
        }),
        api.post("report-templates-save", {
          key,
          config: reportPayload,
        }),
      ]);

      await this.load(key, defaults);

      return this.templates[key];
    },
  },

  persist: {
    key: "report",
    storage: localStorage,
  },
});
