export default [
    {
        title: "Dashboards",
        to: { name: "school-dashboards" },
        icon: { icon: "tabler-dashboard" },
    },

    {
        title: "Students",
        to: { name: "school-student-enroll" },
        icon: { icon: "tabler-user-plus" },
    },

    {
        title: "Manage Classes",
        icon: { icon: "tabler-school" },
        children: [
            {
                title: "Classes",
                to: { name: "school-class" },
            },
            {
                title: "Grades",
                to: { name: "school-grade" },

            },
            {
                title: "Rooms",
                to: { name: "school-room" },

            },
        ],
    },

    {
        title: "Teachers",
        to: { name: "school-teacher" },
        icon: { icon: "tabler-user" },
    }
];
