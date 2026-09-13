import { api } from "@/utils/api";
import { useSettingStore } from "@/stores/settingStore";




export const getCurrentYearId = () => {
    const settingStore = useSettingStore();
    return settingStore.year_id;
};

export const getUnderUsers = async () => {
    try {
        const response = await api.post("users-all-under-users");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getApproveRanks = async () => {
    try {
        const response = await api.post("approve-ranks-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getPeople = async () => {
    try {
        const response = await api.post("people-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getAccountTypes = async () => {
    try {
        const response = await api.post("account-types-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};


export const getChartAccounts = async () => {
    try {
        const response = await api.post("chart-accounts-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getJournalClasses = async () => {
    try {
        const response = await api.post("journal-classes-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getAccountants = async () => {
    try {
        const response = await api.post("accountants-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getIdentities = async () => {
    try {
        const response = await api.post("identities-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getPositions = async () => {
    try {
        const response = await api.post("positions-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getDepartments = async () => {
    try {
        const response = await api.post("departments-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getCurrencies = async () => {
    try {
        const response = await api.post("currencies-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getRoles = async () => {
    try {
        const response = await api.post("roles-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getBranches = async () => {
    try {
        const response = await api.post("branches-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getPermissions = async () => {
    try {
        const response = await api.post("permissions-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getUsers = async () => {
    try {
        const response = await api.post("users-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getCo = async () => {
    try {
        const response = await api.post("users-get-co");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getApprover = async () => {
    try {
        const response = await api.post("users-get-approver");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getCashDenominationPurposes = async () => {
    try {
        const response = await api.post("cash-denomination-purposes-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getOccupations = async () => {
    try {
        const response = await api.post("occupations-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getMainSourceIncomes = async () => {
    try {
        const response = await api.post("main-source-incomes-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getCollaterals = async () => {
    try {
        const response = await api.post("collaterals-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getClients = async () => {
    try {
        const response = await api.post("clients-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getClientsNonLoans = async () => {
    try {
        const response = await api.post("clients-all-non-loans");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};



export const getLoanDurations = async () => {
    try {
        const response = await api.post("loan-durations-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getLoanSettings = async () => {
    try {
        const response = await api.post("loan-settings-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};


export const getLoanTerms = async () => {
    try {
        const response = await api.post("loan-terms-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getLoanRepayments = async () => {
    try {
        const response = await api.post("loan-repayments-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};
export const getBank = async () => {
    try {
        const response = await api.post("bank-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getRestructureSettings = async () => {
    try {
        const response = await api.post("restructure-settings-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getReceiveDays = async () => {
    try {
        const response = await api.post("receive-days-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getEducationLevels = async () => {
    try {
        const response = await api.post("education-levels-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getCurriculums = async () => {
    try {
        const response = await api.post("curriculums-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getYears = async () => {
    try {
        const response = await api.post("years-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getGrades = async () => {
    try {
        const response = await api.post("grades-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getRooms = async () => {
    try {
        const response = await api.post("rooms-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getSubjects = async () => {
    try {
        const response = await api.post("subjects-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getSubjectActivity = async () => {
    try {
        const response = await api.post("subjects-activity-type-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};


export const getClassType = async () => {
    try {
        const response = await api.post("classes-type-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};

export const getTeachers = async () => {
    try {
        const response = await api.post("teachers-all");
        return response.data.data;
    } catch (error) {
        console.error("Server error: ", error);
    }
};