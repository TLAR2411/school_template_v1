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
        title: "Attendance",
        to: { name: "school-attendance" },
        icon: { icon: "tabler-file-check" },
    },
    {
        title: "Schedule",
        to: { name: "school-schedule" },
        icon: { icon: "tabler-calendar" },
    },
    {
        title: "Manage Classes",
        to: { name: "school-class" },
        icon: { icon: "tabler-home-cog" },
    },
    {
        title: "Family",
        to: { name: "school-family" },
        icon: { icon: "tabler-users" },
    },

    {
        title: "Term Period",
        to: { name: "school-term-period" },
        icon: { icon: "tabler-calendar-time" },
    },


    // {
    //     title: "Manage Classes",
    //     icon: { icon: "tabler-home-cog" },
    //     children: [
    //         {
    //             title: "Classes",
    //             to: { name: "school-class" },
    //         },
    //         {
    //             title: "Grades",
    //             to: { name: "school-grade" },

    //         },
    //         {
    //             title: "Rooms",
    //             to: { name: "school-room" },

    //         },
    //     ],
    // },

    {
        title: "Manage Subjects",
        icon: { icon: "tabler-files" },
        to: { name: 'school-subject' }
        // children: [
        //     {
        //         title: "Subject",
        //         to: { name: "school-subject" },
        //     },
        //     {
        //         title: "Grades",
        //         to: { name: "school-grade" },

        //     },
        //     {
        //         title: "Rooms",
        //         to: { name: "school-room" },

        //     },
        // ],
    },

    {
        title: "Teachers",
        to: { name: "school-teacher" },
        icon: { icon: "tabler-user" },
    }
];
