import { auth } from '@/utils/auth'
import hasPermission from '@/utils/hasPermission'
import { getAccessToken } from '@/utils/accessToken'
import { SYSTEM_PARTS } from '@/config/systemParts'

const isLoggedIn = () => !!getAccessToken()

const redirectToPartDashboard = (partKey) => {
  if (!isLoggedIn()) return { name: 'login' }

  const part = SYSTEM_PARTS.find((p) => p.key === partKey)
  if (!part) return { name: 'not-authorized' }

  return hasPermission(part.permission)
    ? { name: part.dashboardRoute }
    : { name: 'not-authorized' }
}

export const redirects = [
  {
    path: "/",
    name: "index",
    redirect: () => redirectToPartDashboard(auth()?.user?.default_part),
  },
  {
    path: "",
    redirect: () => redirectToPartDashboard(auth()?.user?.default_part),
  },
  ...SYSTEM_PARTS.map((p) => ({
    path: p.path,
    name: p.key,
    redirect: () => redirectToPartDashboard(p.key),
  })),
]

export const routes = [

]
