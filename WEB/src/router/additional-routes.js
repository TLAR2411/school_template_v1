import { auth } from '@/utils/auth'
import hasPermission from '@/utils/hasPermission'
import { getAccessToken } from '@/utils/accessToken'

const isLoggedIn = () => !!getAccessToken()

export const redirects = [
  {
    path: "/",
    name: "index",
    redirect: () => {
      if (!isLoggedIn()) return { name: 'login' }

      const userPath = auth()?.user?.default_part

      if (userPath == 'loan') {
        return hasPermission('loan-allow-part')
          ? { name: 'loan-dashboards' }
          : { name: 'not-authorized' }
      } else if (userPath == 'accounting') {
        return hasPermission('accounting-allow-part')
          ? { name: 'accounting-dashboards' }
          : { name: 'not-authorized' }
      } else if (userPath == 'hr') {
        return hasPermission('hr-allow-part')
          ? { name: 'hr-dashboards' }
          : { name: 'not-authorized' }
      } else if (userPath == 'admin') {
        return hasPermission('admin-allow-part')
          ? { name: 'admin-dashboards' }
          : { name: 'not-authorized' }
      } else {
        return { name: 'not-authorized' }
      }
    },
  },
  {
    path: "",
    redirect: () => {
      if (!isLoggedIn()) return { name: 'login' }

      const userPath = auth()?.user?.default_part

      if (userPath == 'loan') {
        return hasPermission('loan-allow-part')
          ? { name: 'loan-dashboards' }
          : { name: 'not-authorized' }
      } else if (userPath == 'accounting') {
        return hasPermission('accounting-allow-part')
          ? { name: 'accounting-dashboards' }
          : { name: 'not-authorized' }
      } else if (userPath == 'hr') {
        return hasPermission('hr-allow-part')
          ? { name: 'hr-dashboards' }
          : { name: 'not-authorized' }
      } else if (userPath == 'admin') {
        return hasPermission('admin-allow-part')
          ? { name: 'admin-dashboards' }
          : { name: 'not-authorized' }
      } else {
        return { name: 'not-authorized' }
      }
    },
  },
  {
    path: "/loan",
    name: "loan",
    redirect: () => {
      if (!isLoggedIn()) return { name: 'login' }

      return hasPermission('loan-allow-part')
        ? { name: 'loan-dashboards' }
        : { name: 'not-authorized' }
    },
  },
  {
    path: '/admin',
    name: 'admin',
    redirect: () => {
      if (!isLoggedIn()) return { name: 'login' }

      return hasPermission('admin-allow-part')
        ? { name: 'admin-dashboards' }
        : { name: 'not-authorized' }
    },
  },
  {
    path: '/accounting',
    name: 'accounting',
    redirect: () => {
      if (!isLoggedIn()) return { name: 'login' }

      return hasPermission('accounting-allow-part')
        ? { name: 'accounting-dashboards' }
        : { name: 'not-authorized' }
    },
  },
  {
    path: '/hr',
    name: 'hr',
    redirect: () => {
      if (!isLoggedIn()) return { name: 'login' }

      return hasPermission('hr-allow-part')
        ? { name: 'hr-dashboards' }
        : { name: 'not-authorized' }
    },
  },
]
export const routes = [

]
