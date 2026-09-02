import { computed } from 'vue';

export const useLoanNavigation = () => {
    return computed(() => [
        {
            title: "Dashboards",
            to: { name: "loan-dashboards" },
            icon: { icon: "tabler-dashboard" },
        },
    ]);
};
