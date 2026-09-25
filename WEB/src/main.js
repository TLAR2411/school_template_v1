import { createApp } from "vue"
import App from "@/App.vue"
import { registerPlugins } from "@core/utils/plugins"
import { PerfectScrollbarPlugin } from 'vue3-perfect-scrollbar';
import "@core/scss/template/index.scss"
import "@styles/styles.scss"
import 'vue3-perfect-scrollbar/style.css';
import Notifications, { notify } from "@kyvg/vue3-notification"
import print from "vue3-print-nb"
import { router } from "@/router"
import { useAuthStore } from "@/stores/authStore"
import { getAccessToken } from "@/utils/accessToken"
import { initPwaInstall } from "@/composables/usePwaInstall"

// Create app
const app = createApp(App)

// Plugins
registerPlugins(app)
app.use(Notifications)
app.use(PerfectScrollbarPlugin);
app.use(print)

async function start() {
  initPwaInstall()

  if (getAccessToken()) {
    await useAuthStore().bootstrap()
  }

  app.use(router)

  app.mount("#app")
}

start()
