export default [
    {
        title: "Dashboards",
        to: { name: "admin-dashboards" },
        icon: { icon: "tabler-dashboard" },
    },
    {
        title: "List Users",
        to: { name: "admin-users" },
        icon: { icon: "tabler-users" },
        permission: "view-users"
    },
    {
        title: "Students",
        to: { name: "admin-students" },
        icon: { icon: "tabler-users" },
        // permission: "view-students",
    },
    {
        title: "Curriculums",
        to: { name: "admin-curriculums" },
        icon: { icon: "tabler-book" },
        // permission: "view-curriculums",
    },
    {
        title: "Years",
        to: { name: "admin-years" },
        icon: { icon: "tabler-calendar" },
        // permission: "view-years",
    },
    {
        title: "Activity Log",
        to: { name: "admin-activity-log" },
        icon: { icon: "tabler-file-text-shield" },
        permission: "view-activity-log"
    },
    {
        title: "Generals",
        icon: { icon: "tabler-settings" },
        permission: '',
        children: [
            {
                title: "Branches",
                to: {
                    name: "admin-branches",
                },
                permission: "view-branches",
            },
        ],
    },
    {
        title: "Auth",
        icon: { icon: "tabler-shield-lock" },
        permission: '',
        children: [
            {
                title: "Roles",
                to: {
                    name: "admin-roles",
                },
                permission: "view-roles",
            },
            {
                title: "Positions",
                to: {
                    name: "admin-positions",
                },
                permission: "view-positions",
            },
        ],
    },
    {
        title: "Address",
        icon: { icon: "tabler-map" },
        permission: '',
        children: [
            {
                title: "Villages",
                to: {
                    name: "admin-address-villages",
                },
                permission: "view-villages",
            },
            {
                title: "Communes",
                to: {
                    name: "admin-address-communes",
                },
                permission: "view-communes",
            },
            {
                title: "Districts",
                to: {
                    name: "admin-address-districts",
                },
                permission: "view-districts",
            },
            {
                title: "Provinces",
                to: {
                    name: "admin-address-provinces",
                },
                permission: "view-provinces",
            },
        ],
    },
];
