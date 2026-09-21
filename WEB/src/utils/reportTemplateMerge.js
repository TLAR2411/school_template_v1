const isPlainObject = (value) =>
  Object.prototype.toString.call(value) === "[object Object]";

export const deepMerge = (base, override) => {
  if (!isPlainObject(base) || !isPlainObject(override))
    return override === undefined ? base : override;

  const result = { ...base };

  for (const [key, value] of Object.entries(override))
    result[key] = deepMerge(result[key], value);

  return result;
};

/** Shared across schedule, score, attendance, … */
export function extractBrandConfig(full = {}) {
  const header = full.header ?? {};

  return {
    fonts: full.fonts ? { ...full.fonts } : undefined,
    header: {
      showLogo: header.showLogo,
      logo: header.logo,
      logoBox: header.logoBox ? { ...header.logoBox } : undefined,
      lines: header.lines ? [...header.lines] : undefined,
      lineFontSize: header.lineFontSize,
    },
    footer: full.footer
      ? { show: full.footer.show, note: full.footer.note }
      : undefined,
  };
}

/** Only this report type (title, table layout, signatures, paper, …) */
export function extractReportConfig(full = {}) {
  const header = full.header ?? {};

  return {
    paper: full.paper ? { ...full.paper } : undefined,
    header: {
      title: header.title,
      subtitle: header.subtitle,
      titleFontSize: header.titleFontSize,
      subtitleFontSize: header.subtitleFontSize,
      dateBox: header.dateBox ? { ...header.dateBox } : undefined,
    },
    footer: full.footer ? { show: full.footer.show } : undefined,
    signatures: full.signatures
      ? full.signatures.map((s) => ({ ...s }))
      : undefined,
  };
}

export function mergeBrandAndReport(brand, report, pageDefaults = {}) {
  const brandPart = brand && Object.keys(brand).length ? brand : {};
  const reportPart = report && Object.keys(report).length ? report : {};

  return deepMerge(deepMerge({}, pageDefaults), deepMerge(brandPart, reportPart));
}
