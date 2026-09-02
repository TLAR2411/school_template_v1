import { onMounted, onUnmounted, ref } from "vue"

// `define` values are only substituted during a production build — Vite's
// dev server leaves this identifier undeclared, so it must be read via
// `typeof` (never throws on an undeclared identifier) rather than referenced
// directly. In dev this resolves to null and the update check is skipped.
const CURRENT_VERSION = typeof __APP_BUILD_VERSION__ !== "undefined" ? String(__APP_BUILD_VERSION__) : null
const CHECK_INTERVAL = 5 * 60 * 1000 // 5 minutes

// Module-level so every component using this composable shares one state
// and only one polling loop runs regardless of how many navbars mount it.
const hasNewBuild = ref(false)
let watcherCount = 0
let intervalId = null

const checkForNewBuild = async () => {
  if (hasNewBuild.value || CURRENT_VERSION === null) return

  try {
    const response = await fetch(`/version.json?t=${Date.now()}`, {
      cache: "no-store",
    })

    if (!response.ok) return

    const data = await response.json()
    if (data?.version && String(data.version) !== CURRENT_VERSION) {
      hasNewBuild.value = true
    }
  } catch {
    // Offline or request blocked — try again on the next check.
  }
}

const handleVisibilityChange = () => {
  if (document.visibilityState === "visible") checkForNewBuild()
}

// Polling on an interval alone misses the common mobile case: a PWA
// resumed from the background after sitting idle for hours. Re-checking
// on visibilitychange/focus catches that moment on both iOS and Android,
// unlike service-worker update detection which is unreliable there.
export function useBuildVersion() {
  onMounted(() => {
    watcherCount += 1

    checkForNewBuild()

    if (!intervalId) {
      intervalId = setInterval(checkForNewBuild, CHECK_INTERVAL)
      document.addEventListener("visibilitychange", handleVisibilityChange)
      window.addEventListener("focus", checkForNewBuild)
    }
  })

  onUnmounted(() => {
    watcherCount -= 1

    if (watcherCount <= 0) {
      clearInterval(intervalId)
      intervalId = null
      document.removeEventListener("visibilitychange", handleVisibilityChange)
      window.removeEventListener("focus", checkForNewBuild)
    }
  })

  return { hasNewBuild }
}
