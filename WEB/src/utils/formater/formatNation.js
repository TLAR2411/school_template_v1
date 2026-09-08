import { getI18n } from '@/plugins/i18n'

// Single source of truth for nationality options.
// Used by formatNation (lists/tables) and the student create/edit forms.
export const nations = [
  { name_kh: 'ខ្មែរ', name_en: 'Cambodian', value: 'kh' },
  { name_kh: 'ជនជាតិ', name_en: 'Other', value: 'other' },
]

function formatNation(nationValue) {
  if (!nationValue) return ''

  const nation = nations.find(n => n.value === nationValue)

  // Unknown code: show it as-is instead of hiding the data
  if (!nation) return nationValue

  // Auto-translate: follows the app's current language (en / km)
  const locale = getI18n().global.locale.value

  return locale === 'en' ? nation.name_en : nation.name_kh
}

export default formatNation
