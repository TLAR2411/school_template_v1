import { defineStore } from "pinia";

export const useSettingStore = defineStore("setting", {
  state: () => ({
    branch_id: null,
    branch_abbr: null,
    branch_province_code: null,
    curriculum_id: null,
    curriculum_symbol: null,
    year_id: null,
    year_name: null,
  }),

  getters: {
    getBranchId() {
      return this.branch_id;
    },
    getBranchAbbr() {
      return this.branch_abbr;
    },
    getBranchProvinceCode() {
      return this.branch_province_code;
    },
    getCurriculumId() {
      return this.curriculum_id;
    },
    getCurriculumSymbol() {
      return this.curriculum_symbol;
    },
    getYearId() {
      return this.year_id;
    },
    getYearName() {
      return this.year_name;
    },
  },

  actions: {
    setBranchId(id) {
      this.branch_id = id;
    },
    setBranchAbbr(abbr) {
      this.branch_abbr = abbr;
    },
    setBranchProvinceCode(code) {
      this.branch_province_code = code;
    },
    setCurriculumId(id) {
      this.curriculum_id = id;
    },
    setCurriculumSymbol(symbol) {
      this.curriculum_symbol = symbol;
    },
    setYearId(id) {
      this.year_id = id;
    },
    setYearName(name) {
      this.year_name = name;
    },
  },

  persist: {
    enabled: true,
    strategies: [
      {
        key: "setting",
        storage: localStorage,
      },
    ],
  },
});
