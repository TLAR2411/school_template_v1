import hasPermission from "@/utils/hasPermission";

export const dataTableProps = {
    isDelete: Boolean,
    btnDelete: Boolean,
    canDelete: String,

    isEdit: Boolean,
    btnEdit: String,
    canEdit: String,

    isPrint: Boolean,
    btnPrint: Boolean,
    canPrint: String,

    isReceive: Boolean,
    btnReceive: Boolean,
    canReceive: String,

    isReceiveLastSchedule: Boolean,
    btnReceiveLastSchedule: Boolean,
    canReceiveLastSchedule: String,
    receiveLastScheduleCondition: {
        type: [Function, Boolean],
        default: null,
    },

    isBackDailyCash: Boolean,
    btnBackDailyCash: Boolean,
    canBackDailyCash: String,
    BackDailyCashCondition: {
        type: [Function, Boolean],
        default: null,
    },

    isReceiveHistory: Boolean,
    btnReceiveHistory: Boolean,

    isClientHistory: Boolean,
    btnClientHistory: Boolean,
    canClientHistory: String,

    isView: Boolean,
    btnView: Boolean,
    canView: String,

    isReminderLetter: Boolean,
    btnReminderLetter: Boolean,
    canReminderLetter: String,

    isRecovery: Boolean,
    btnRecovery: Boolean,
    canRecovery: String,

    isDetail: Boolean,
    btnDetail: Boolean,
    canDetail: String,

    isSchedule: Boolean,
    btnSchedule: Boolean,
    canSchedule: String,
    scheduleCondition: {
        type: [Function, Boolean],
        default: null,
    },

    isAttendance: Boolean,
    btnAttendance: Boolean,
    canAttendance: String,
    attendanceCondition: {
        type: [Function, Boolean],
        default: null,
    },



    isScheduleForClient: Boolean,
    btnScheduleForClient: Boolean,
    canScheduleForClient: String,
    scheduleForClientCondition: {
        type: [Function, Boolean],
        default: null,
    },


    isApprove: Boolean,
    btnApprove: Boolean,
    canApprove: String,
    approveCondition: {
        type: [Function, Boolean],
        default: null,
    },

    isBlackList: Boolean,
    btnBlackList: Boolean,
    canCheckBlackList: String,
    canUncheckBlackList: String,

    isAccept: Boolean,
    btnAccept: Boolean,
    canAccept: String,

    isPenalty: Boolean,
    btnPenalty: Boolean,
    canPenalty: String,

    isRollback: Boolean,
    btnRollback: Boolean,
    canRollback: String,
    rollbackCondition: {
        type: [Function, Boolean],
        default: null,
    },

    isRestructure: Boolean,
    btnRestructure: Boolean,
    canRestructure: String,

    isDisable: Boolean,
    btnDisable: Boolean,
    canDisable: String,

    isDefault: Boolean,
    btnDefault: Boolean,
    canDefault: String,

    isPassword: Boolean,
    btnPassword: Boolean,
    canPassword: String,

    isLinkUser: Boolean,
    btnLinkUser: Boolean,
    canLinkUser: String,

    isUsername: Boolean,
    btnUsername: Boolean,
    canUsername: String,

    isPermission: Boolean,
    btnPermission: Boolean,
    canPermission: String,

    isMoreAction: { type: Boolean, default: true },
    isMoreActionCondition: {
        type: [Function, Boolean],
        default: null,
    },
};

export const dataTableEmits = [
    "onApprove",
    "onAccept",
    "onDelete",
    "onView",
    "onReminderLetter",
    "onRecovery",
    "onDetail",
    "onReceive",
    "onReceiveLastSchedule",
    "onBackDailyCash",
    "onReceiveHistory",
    "onClientHistory",
    "onEdit",
    "onLinkUser",
    "onBlackList",
    "onPenalty",
    "onPrint",
    "onDisable",
    "onRollback",
    "onPassword",
    "onUsername",
    "onPermission",
    "onPaginate",
    "onDefault",
    "onSchedule",
    "onAttendance",

    "onScheduleForClient",
    "onRestructure",
];

export function useRowActions(emit, props, { t, showDialog, debounce, DEBOUNCE_DELAY }) {

    const askAction = (emitName, message) => async (item) => {
        const result = await showDialog({
            title: t(message),
            icon: "warning",
            confirmColor: "error",
        });
        if (result) emit(emitName, item);
    };

    const deleteAction = (emitName, message) => async (item) => {
        const result = await showDialog({
            title: t(message),
            icon: "delete",
            confirmColor: "error",
            confirmText: "Delete",
        });
        if (result) emit(emitName, item);
    };

    const actionHandlers = {
        delete: deleteAction("onDelete", "Delete Item?"),
        view: debounce((item) => emit("onView", item), DEBOUNCE_DELAY),
        reminderLetter: debounce((item) => emit("onReminderLetter", item), DEBOUNCE_DELAY),
        recovery: debounce((item) => emit("onRecovery", item), DEBOUNCE_DELAY),
        detail: debounce((item) => emit("onDetail", item), DEBOUNCE_DELAY),
        schedule: debounce((item) => emit("onSchedule", item), DEBOUNCE_DELAY),
        attendance: debounce((item) => emit("onAttendance", item), DEBOUNCE_DELAY),

        scheduleForClient: debounce((item) => emit("onScheduleForClient", item), DEBOUNCE_DELAY),
        edit: debounce((item) => emit("onEdit", item), DEBOUNCE_DELAY),
        approve: debounce((item) => emit("onApprove", item), DEBOUNCE_DELAY),
        receive: debounce((item) => emit("onReceive", item), DEBOUNCE_DELAY),
        receiveLastSchedule: debounce((item) => emit("onReceiveLastSchedule", item), DEBOUNCE_DELAY),
        backDailyCash: debounce((item) => emit("onBackDailyCash", item), DEBOUNCE_DELAY),
        receiveHistory: debounce((item) => emit("onReceiveHistory", item), DEBOUNCE_DELAY),
        clientHistory: debounce((item) => emit("onClientHistory", item), DEBOUNCE_DELAY),
        penalty: debounce((item) => emit("onPenalty", item), DEBOUNCE_DELAY),
        accept: debounce((item) => emit("onAccept", item), DEBOUNCE_DELAY),
        rollback: askAction("onRollback", "Rollback Item?"),
        restructure: debounce((item) => emit("onRestructure", item), DEBOUNCE_DELAY),
        lock: debounce((item) => emit("onDisable", item), DEBOUNCE_DELAY),
        default: debounce((item) => emit("onDefault", item), DEBOUNCE_DELAY),
        linkUser: debounce((item) => emit("onLinkUser", item), DEBOUNCE_DELAY),
        password: debounce((item) => emit("onPassword", item), DEBOUNCE_DELAY),
        username: debounce((item) => emit("onUsername", item), DEBOUNCE_DELAY),
        permission: debounce((item) => emit("onPermission", item), DEBOUNCE_DELAY),
        blackList: askAction("onBlackList", "Do you want to make this client to black list?"),
    };



    const actionButtons = [
        {
            title: "Approve",
            value: "approve",
            icon: "tabler-check",
            color: "success",
            permission: props?.canApprove,
            show: props?.isApprove,
            action: actionHandlers.approve,
            btn: props?.btnApprove,
            condition: props?.approveCondition || ((item) => true),
        },
        {
            title: "Default",
            value: "default",
            icon: "tabler-circuit-capacitor",
            color: "secondary",
            permission: props?.canDefault,
            show: props?.isDefault,
            action: actionHandlers.default,
            checkDefault: true,
            firstColor: "success",
            secondColor: "secondary",
            btn: props?.btnDefault,
        },
        {
            title: "Disable",
            value: "disable",
            icon: "tabler-cancel",
            color: "secondary",
            permission: props?.canDisable,
            show: props?.isDisable,
            action: actionHandlers.lock,
            checkActive: true,
            checkIcon: true,
            checkTitle: true,
            firstColor: "success",
            secondColor: "error",
            firstTitle: "Active",
            secondTitle: "Inactive",
            firstIcon: "tabler-check",
            secondIcon: "tabler-cancel",
            btn: props?.btnDisable,
        },
        {
            title: "Link User",
            value: "link-user",
            icon: "tabler-link",
            color: "success",
            permission: props?.canLinkUser,
            show: props?.isLinkUser,
            action: actionHandlers.linkUser,
            btn: props?.btnLinkUser,
        },
        {
            title: "Password",
            value: "password",
            icon: "tabler-key",
            color: "secondary",
            permission: props?.canPassword,
            show: props?.isPassword,
            action: actionHandlers.password,
            btn: props?.btnPassword,
        },
        {
            title: "Username",
            value: "username",
            icon: "tabler-user",
            color: "success",
            permission: props?.canUsername,
            show: props?.isUsername,
            action: actionHandlers.username,
            btn: props?.btnUsername,
        },
        {
            title: "Receive",
            value: "receive",
            icon: "tabler-cash-banknote",
            color: "success",
            permission: props?.canReceive,
            show: props?.isReceive,
            action: actionHandlers.receive,
            btn: props?.btnReceive,
        },

        {
            title: "Receive Last Schedule",
            value: "receive-last-schedule",
            icon: "tabler-cash-banknote",
            color: "success",
            permission: props?.canReceiveLastSchedule,
            show: props?.isReceiveLastSchedule,
            action: actionHandlers.receiveLastSchedule,
            btn: props?.btnReceiveLastSchedule,
            condition: props?.receiveLastScheduleCondition || ((item) => true),

            checkStatus: true,
            checkIcon: true,
            checkTitle: true,
            checkDisable: true,
            firstColor: "success",
            secondColor: "secondary",
            firstTitle: "Receive Last Schedule",
            secondTitle: "Has Receive",
            firstIcon: "tabler-cash-banknote",
            secondIcon: "tabler-file-check",
        },

        {
            title: "Back Daily Cash",
            value: "back-daily-cash",
            icon: "tabler-arrow-back",
            color: "secondary",
            permission: props?.canBackDailyCash,
            show: props?.isBackDailyCash,
            action: actionHandlers.backDailyCash,
            btn: props?.btnBackDailyCash,
            condition: props?.BackDailyCashCondition || ((item) => true),
        },

        {
            title: "View",
            value: "view",
            icon: "tabler-eye",
            color: "success",
            permission: props?.canView,
            show: props?.isView,
            action: actionHandlers.view,
            btn: props?.btnView,
        },
        {
            title: "Reminder Letter",
            value: "reminder-letter",
            icon: "tabler-bell-ringing",
            color: "secondary",
            permission: props?.canReminderLetter,
            show: props?.isReminderLetter,
            action: actionHandlers.reminderLetter,
            btn: props?.btnReminderLetter,
        },
        {
            title: "Recovery",
            value: "recovery",
            icon: "tabler-restore",
            color: "success",
            permission: props?.canRecovery,
            show: props?.isRecovery,
            action: actionHandlers.recovery,
            btn: props?.btnRecovery,
        },
        {
            title: "Detail",
            value: "detail",
            icon: "tabler-file-description",
            color: "success",
            permission: props?.canDetail,
            show: props?.isDetail,
            action: actionHandlers.detail,
            btn: props?.btnDetail,
        },
        {
            title: "Schedule",
            value: "schedule",
            icon: "tabler-calendar-event",
            color: "warning",
            permission: props?.canSchedule,
            show: props?.isSchedule,
            action: actionHandlers.schedule,
            btn: props?.btnSchedule,
            condition: props?.scheduleCondition || ((item) => true),
        },
        {
            title: "Attendance",
            value: "attendance",
            icon: "tabler-file-check",
            color: "primary",
            permission: props?.canAttendance,
            show: props?.isAttendance,
            action: actionHandlers.attendance,
            btn: props?.btnAttendance,
            condition: props?.attendanceCondition || ((item) => true),
        },

        {
            title: "Schedule For Client",
            value: "scheduleForClient",
            icon: "tabler-calendar-event",
            color: "warning",
            permission: props?.canScheduleForClient,
            show: props?.isScheduleForClient,
            action: actionHandlers.scheduleForClient,
            btn: props?.btnScheduleForClient,
            condition: props?.scheduleForClientCondition || ((item) => true),
        },
        {
            title: "Client History",
            value: "client-history",
            icon: "tabler-user-search",
            color: "success",
            permission: props?.canClientistory,
            show: props?.isClientHistory,
            action: actionHandlers.clientHistory,
            btn: props?.btnClientHistory,
        },
        {
            title: "Black List",
            value: "black_list",
            icon: "tabler-cancel",
            color: "error",
            permission: [props?.canCheckBlackList, props?.canUncheckBlackList],
            show: props?.isBlackList,
            action: actionHandlers.blackList,
            checkBlackList: true,
            checkBleckListPermission: true,
            checkIcon: true,
            firstColor: "error",
            secondColor: "secondary",
            firstIcon: "tabler-address-book-off",
            secondIcon: "tabler-address-book",
            btn: props?.btnBlackList,
        },
        {
            title: "Receive History",
            value: "receive-history",
            icon: "tabler-history",
            color: "success",
            permission: props?.canLoan,
            show: props?.isReceiveHistory,
            action: actionHandlers.receiveHistory,
            btn: props?.btnReceiveHistory,
        },




        {
            title: "Penalty",
            value: "penalty",
            icon: "tabler-coin",
            color: "warning",
            permission: props?.canPenalty,
            show: props?.isPenalty,
            action: actionHandlers.penalty,
            btn: props?.btnPenalty,
        },
        {
            title: "Restructure",
            value: "restructure",
            icon: "tabler-calendar-event",
            color: "warning",
            permission: props?.canRestructure,
            show: props?.isRestructure,
            action: actionHandlers.restructure,
            btn: props?.btnRestructure,
        },

        {
            title: "Permission",
            value: "edit",
            icon: "tabler-shield",
            color: "warning",
            permission: props?.canPermission,
            show: props?.isPermission,
            action: actionHandlers.permission,
            btn: props?.btnPermission,
        },
        {
            title: "Edit",
            value: "edit",
            icon: "tabler-pencil",
            color: "warning",
            permission: props?.canEdit,
            show: props?.isEdit,
            action: actionHandlers.edit,
            btn: props?.btnEdit,
        },
        {
            title: "Rollback",
            value: "rollback",
            icon: "tabler-arrow-back-up",
            color: "error",
            permission: props?.canRollback,
            show: props?.isRollback,
            action: actionHandlers.rollback,
            btn: props?.btnRollback,
            condition: props?.rollbackCondition || ((item) => true),
        },
        {
            title: "Delete",
            value: "delete",
            icon: "tabler-trash",
            color: "error",
            permission: props?.canDelete,
            show: props?.isDelete,
            action: actionHandlers.delete,
            btn: props?.btnDelete,
            isDelete: true,
        },
    ];

    return { actionHandlers, actionButtons };
};



export const getButtonColor = (button, item) => {
    if (button.checkBlackList) return item.is_black_list ? button.firstColor : button.secondColor;
    if (button.checkActive)
        return (item.is_active || item.last_schedule?.status) ? button.firstColor : button.secondColor;

    if (button.checkStatus)

        return (item.last_schedule?.status) ? button.firstColor : button.secondColor;

    if (button.checkDefault) return item.default ? button.firstColor : button.secondColor;
    return button.color;
};

export const getButtonTitle = (button, item) => {
    if (button.checkTitle) {
        return (item.is_active || item.last_schedule?.status) ? button.firstTitle : button.secondTitle;
    }
    return button.title;
};

export const getButtonDisable = (button, item) => {
    if (button.checkDisable) {
        return (item.last_schedule?.status) ? false : true;
    }
    return false;
};

export const getButtonIcon = (button, item) => {
    if (button.checkBlackList) {
        return item.is_black_list ? button.firstIcon : button.secondIcon;
    }
    if (button.checkIcon) {
        return (item.is_active || item.last_schedule?.status) ? button.firstIcon : button.secondIcon;
    }
    return button.icon;
};

export const checkPermission = (button, item) => {
    if (button.checkBleckListPermission) {
        return item.is_black_list ? hasPermission(button.permission[1]) : hasPermission(button.permission[0]);
    }
    return hasPermission(button.permission);
};