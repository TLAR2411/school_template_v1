// vite.config.js
import { fileURLToPath } from "node:url";
import vue from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/@vitejs/plugin-vue/dist/index.mjs";
import vueJsx from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/@vitejs/plugin-vue-jsx/dist/index.mjs";
import AutoImport from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/unplugin-auto-import/dist/vite.js";
import Components from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/unplugin-vue-components/dist/vite.js";
import { VueRouterAutoImports, getPascalCaseRouteName } from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/unplugin-vue-router/dist/index.mjs";
import VueRouter from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/unplugin-vue-router/dist/vite.mjs";
import { defineConfig, loadEnv } from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite/dist/node/index.js";
import VueDevTools from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite-plugin-vue-devtools/dist/vite.mjs";
import MetaLayouts from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite-plugin-vue-meta-layouts/dist/index.mjs";
import vuetify from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite-plugin-vuetify/dist/index.mjs";
import svgLoader from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite-svg-loader/index.js";
import Layouts from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite-plugin-vue-layouts/dist/index.mjs";
import { VitePWA } from "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/node_modules/vite-plugin-pwa/dist/index.js";
var __vite_injected_original_import_meta_url = "file:///C:/Coding%20Project/Vue/loan_system_v1/WEB/vite.config.js";
var buildVersion = (/* @__PURE__ */ new Date()).getTime();
var vite_config_default = defineConfig((mode) => {
  const env = loadEnv(mode, process.cwd(), "");
  return {
    plugins: [
      // Docs: https://github.com/posva/unplugin-vue-router
      // ℹ️ This plugin should be placed before vue plugin
      VueRouter({
        getRouteName: (routeNode) => {
          return getPascalCaseRouteName(routeNode).replace(/([a-z\d])([A-Z])/g, "$1-$2").toLowerCase();
        }
        // beforeWriteFiles: root => {
        //   root.insert('/loans/index.vue', '/src/pages/loans/index.vue')
        //   root.insert('test.vue', '/src/pages/test.vue')
        // },
      }),
      vue({
        template: {
          compilerOptions: {
            isCustomElement: (tag) => tag === "swiper-container" || tag === "swiper-slide"
          }
        }
      }),
      VueDevTools(),
      vueJsx(),
      Layouts(),
      // <--- Ensure it's used here
      VitePWA({
        registerType: "autoUpdate",
        // check & install updates in bg
        injectRegister: "auto",
        // injects the register code for you
        includeAssets: [`${env.VITE_BASE_COMPANY}.favicon.ico`, "robots.txt"],
        selfDestroying: true,
        manifest: {
          name: env.VITE_APP_TITLE_NAME || "Mitra Manage System",
          short_name: env.VITE_APP_SHORT_NAME || "Mitra",
          description: env.VITE_APP_TITLE_NAME || "Mitra Manage System",
          start_url: "/",
          // important for scope
          scope: "/",
          // make SW control whole app
          display: "standalone",
          background_color: "#ffffff",
          theme_color: "#636363ff",
          icons: [
            { src: `/logo/${env.VITE_BASE_COMPANY}/logo-192.png`, sizes: "192x192", type: "image/png" },
            { src: `/logo/${env.VITE_BASE_COMPANY}/logo-512.png`, sizes: "512x512", type: "image/png" }
          ]
        },
        workbox: {
          skipWaiting: true,
          // activate new SW immediately
          clientsClaim: true,
          // take control of open tabs
          cleanupOutdatedCaches: true,
          globPatterns: ["**/*.{js,css,html,ico,png,svg,webp}"],
          navigateFallbackDenylist: [/^\/api\//],
          // don’t hijack API
          maximumFileSizeToCacheInBytes: 5e6
          // your 5MB limit
        }
        // Optional: enable in dev to test updates
        // devOptions: { enabled: true }
      }),
      // Docs: https://github.com/vuetifyjs/vuetify-loader/tree/master/packages/vite-plugin
      vuetify({
        styles: {
          configFile: "src/assets/styles/variables/_vuetify.scss"
        }
      }),
      // Docs: https://github.com/dishait/vite-plugin-vue-meta-layouts?tab=readme-ov-file
      MetaLayouts({
        target: "./src/layouts",
        defaultLayout: "default"
      }),
      // Docs: https://github.com/antfu/unplugin-vue-components#unplugin-vue-components
      Components({
        dirs: ["src/@core/components", "src/views/demos", "src/components"],
        dts: true,
        resolvers: [
          (componentName) => {
            if (componentName === "VueApexCharts")
              return { name: "default", from: "vue3-apexcharts", as: "VueApexCharts" };
          }
        ]
      }),
      // Docs: https://github.com/antfu/unplugin-auto-import#unplugin-auto-import
      AutoImport({
        imports: ["vue", VueRouterAutoImports, "@vueuse/core", "@vueuse/math", "vue-i18n", "pinia"],
        dirs: [
          "./src/@core/utils",
          "./src/@core/composable/",
          "./src/composables/",
          "./src/utils/",
          "./src/plugins/*/composables/*"
        ],
        vueTemplate: true,
        // ℹ️ Disabled to avoid confusion & accidental usage
        ignore: ["useCookies", "useStorage"],
        eslintrc: {
          enabled: true,
          filepath: "./.eslintrc-auto-import.json"
        }
      }),
      svgLoader(),
      // Emits a small version.json the running app polls at runtime to
      // detect a newer deploy — independent of service-worker update
      // timing, which is unreliable on backgrounded/resumed iOS & Android
      // PWAs. See useBuildVersion.js.
      {
        name: "emit-build-version",
        apply: "build",
        generateBundle() {
          this.emitFile({
            type: "asset",
            fileName: "version.json",
            source: JSON.stringify({ version: buildVersion })
          });
        }
      }
    ],
    define: {
      "process.env": {},
      __APP_BUILD_VERSION__: JSON.stringify(buildVersion)
    },
    resolve: {
      alias: {
        "@": fileURLToPath(new URL("./src", __vite_injected_original_import_meta_url)),
        "@themeConfig": fileURLToPath(new URL("./themeConfig.js", __vite_injected_original_import_meta_url)),
        "@core": fileURLToPath(new URL("./src/@core", __vite_injected_original_import_meta_url)),
        "@layouts": fileURLToPath(new URL("./src/@layouts", __vite_injected_original_import_meta_url)),
        "@images": fileURLToPath(new URL("./src/assets/images/", __vite_injected_original_import_meta_url)),
        "@styles": fileURLToPath(new URL("./src/assets/styles/", __vite_injected_original_import_meta_url)),
        "@configured-variables": fileURLToPath(new URL("./src/assets/styles/variables/_template.scss", __vite_injected_original_import_meta_url)),
        "@db": fileURLToPath(new URL("./src/plugins/fake-api/handlers/", __vite_injected_original_import_meta_url)),
        "@api-utils": fileURLToPath(new URL("./src/plugins/fake-api/utils/", __vite_injected_original_import_meta_url))
      }
    },
    build: {
      chunkSizeWarningLimit: 5e3,
      minify: "esbuild",
      esbuild: {
        drop: ["console", "debugger"]
      },
      rollupOptions: {
        output: {
          // Force chunk files to include a build timestamp/version
          chunkFileNames: `assets/[name]-[hash]-v${buildVersion}.js`,
          entryFileNames: `assets/[name]-[hash]-v${buildVersion}.js`,
          assetFileNames: `assets/[name]-[hash]-v${buildVersion}.[ext]`
        }
      }
    },
    optimizeDeps: {
      exclude: ["vuetify"],
      entries: [
        "./src/**/*.vue"
      ]
    }
  };
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxDb2RpbmcgUHJvamVjdFxcXFxWdWVcXFxcbG9hbl9zeXN0ZW1fdjFcXFxcV0VCXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJDOlxcXFxDb2RpbmcgUHJvamVjdFxcXFxWdWVcXFxcbG9hbl9zeXN0ZW1fdjFcXFxcV0VCXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9DOi9Db2RpbmclMjBQcm9qZWN0L1Z1ZS9sb2FuX3N5c3RlbV92MS9XRUIvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBmaWxlVVJMVG9QYXRoIH0gZnJvbSAnbm9kZTp1cmwnXHJcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJ1xyXG5pbXBvcnQgdnVlSnN4IGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZS1qc3gnXHJcbmltcG9ydCBBdXRvSW1wb3J0IGZyb20gJ3VucGx1Z2luLWF1dG8taW1wb3J0L3ZpdGUnXHJcbmltcG9ydCBDb21wb25lbnRzIGZyb20gJ3VucGx1Z2luLXZ1ZS1jb21wb25lbnRzL3ZpdGUnXHJcbmltcG9ydCB7IFZ1ZVJvdXRlckF1dG9JbXBvcnRzLCBnZXRQYXNjYWxDYXNlUm91dGVOYW1lIH0gZnJvbSAndW5wbHVnaW4tdnVlLXJvdXRlcidcclxuaW1wb3J0IFZ1ZVJvdXRlciBmcm9tICd1bnBsdWdpbi12dWUtcm91dGVyL3ZpdGUnXHJcbmltcG9ydCB7IGRlZmluZUNvbmZpZywgbG9hZEVudiB9IGZyb20gJ3ZpdGUnXHJcbmltcG9ydCBWdWVEZXZUb29scyBmcm9tICd2aXRlLXBsdWdpbi12dWUtZGV2dG9vbHMnXHJcbmltcG9ydCBNZXRhTGF5b3V0cyBmcm9tICd2aXRlLXBsdWdpbi12dWUtbWV0YS1sYXlvdXRzJ1xyXG5pbXBvcnQgdnVldGlmeSBmcm9tICd2aXRlLXBsdWdpbi12dWV0aWZ5J1xyXG5pbXBvcnQgc3ZnTG9hZGVyIGZyb20gJ3ZpdGUtc3ZnLWxvYWRlcidcclxuaW1wb3J0IExheW91dHMgZnJvbSAndml0ZS1wbHVnaW4tdnVlLWxheW91dHMnXHJcbmltcG9ydCB7IFZpdGVQV0EgfSBmcm9tICd2aXRlLXBsdWdpbi1wd2EnIC8vIEltcG9ydCB0aGUgcGx1Z2luXHJcblxyXG5jb25zdCBidWlsZFZlcnNpb24gPSBuZXcgRGF0ZSgpLmdldFRpbWUoKVxyXG5cclxuLy8gaHR0cHM6Ly92aXRlanMuZGV2L2NvbmZpZy9cclxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKG1vZGUgPT4ge1xyXG4gIGNvbnN0IGVudiA9IGxvYWRFbnYobW9kZSwgcHJvY2Vzcy5jd2QoKSwgJycpXHJcblxyXG4gIC8vIGNvbnNvbGUubG9nKCdFTlYgQ0hFQ0s6JywgZW52LlZJVEVfQkFTRV9DT01QQU5ZLCBlbnYuVklURV9BUFBfUFdBX05BTUUpIC8vIFx1RDgzRFx1REM0OCBhZGQgdGhpc1xyXG4gIHJldHVybiB7XHJcbiAgICBwbHVnaW5zOiBbXHJcbiAgICAgIC8vIERvY3M6IGh0dHBzOi8vZ2l0aHViLmNvbS9wb3N2YS91bnBsdWdpbi12dWUtcm91dGVyXHJcbiAgICAgIC8vIFx1MjEzOVx1RkUwRiBUaGlzIHBsdWdpbiBzaG91bGQgYmUgcGxhY2VkIGJlZm9yZSB2dWUgcGx1Z2luXHJcbiAgICAgIFZ1ZVJvdXRlcih7XHJcbiAgICAgICAgZ2V0Um91dGVOYW1lOiByb3V0ZU5vZGUgPT4ge1xyXG4gICAgICAgICAgLy8gQ29udmVydCBwYXNjYWwgY2FzZSB0byBrZWJhYiBjYXNlXHJcbiAgICAgICAgICByZXR1cm4gZ2V0UGFzY2FsQ2FzZVJvdXRlTmFtZShyb3V0ZU5vZGUpXHJcbiAgICAgICAgICAgIC5yZXBsYWNlKC8oW2EtelxcZF0pKFtBLVpdKS9nLCAnJDEtJDInKVxyXG4gICAgICAgICAgICAudG9Mb3dlckNhc2UoKVxyXG4gICAgICAgIH0sXHJcblxyXG4gICAgICAgIC8vIGJlZm9yZVdyaXRlRmlsZXM6IHJvb3QgPT4ge1xyXG4gICAgICAgIC8vICAgcm9vdC5pbnNlcnQoJy9sb2Fucy9pbmRleC52dWUnLCAnL3NyYy9wYWdlcy9sb2Fucy9pbmRleC52dWUnKVxyXG4gICAgICAgIC8vICAgcm9vdC5pbnNlcnQoJ3Rlc3QudnVlJywgJy9zcmMvcGFnZXMvdGVzdC52dWUnKVxyXG4gICAgICAgIC8vIH0sXHJcbiAgICAgIH0pLFxyXG4gICAgICB2dWUoe1xyXG4gICAgICAgIHRlbXBsYXRlOiB7XHJcbiAgICAgICAgICBjb21waWxlck9wdGlvbnM6IHtcclxuICAgICAgICAgICAgaXNDdXN0b21FbGVtZW50OiB0YWcgPT4gdGFnID09PSAnc3dpcGVyLWNvbnRhaW5lcicgfHwgdGFnID09PSAnc3dpcGVyLXNsaWRlJyxcclxuICAgICAgICAgIH0sXHJcbiAgICAgICAgfSxcclxuICAgICAgfSksXHJcbiAgICAgIFZ1ZURldlRvb2xzKCksXHJcbiAgICAgIHZ1ZUpzeCgpLFxyXG4gICAgICBMYXlvdXRzKCksIC8vIDwtLS0gRW5zdXJlIGl0J3MgdXNlZCBoZXJlXHJcblxyXG4gICAgICBWaXRlUFdBKHtcclxuICAgICAgICByZWdpc3RlclR5cGU6ICdhdXRvVXBkYXRlJywgICAgICAgIC8vIGNoZWNrICYgaW5zdGFsbCB1cGRhdGVzIGluIGJnXHJcbiAgICAgICAgaW5qZWN0UmVnaXN0ZXI6ICdhdXRvJywgICAgICAgICAgICAvLyBpbmplY3RzIHRoZSByZWdpc3RlciBjb2RlIGZvciB5b3VcclxuICAgICAgICBpbmNsdWRlQXNzZXRzOiBbYCR7ZW52LlZJVEVfQkFTRV9DT01QQU5ZfS5mYXZpY29uLmljb2AsICdyb2JvdHMudHh0J10sXHJcbiAgICAgICAgc2VsZkRlc3Ryb3lpbmc6IHRydWUsXHJcbiAgICAgICAgbWFuaWZlc3Q6IHtcclxuICAgICAgICAgIG5hbWU6IGVudi5WSVRFX0FQUF9USVRMRV9OQU1FIHx8ICdNaXRyYSBNYW5hZ2UgU3lzdGVtJyxcclxuICAgICAgICAgIHNob3J0X25hbWU6IGVudi5WSVRFX0FQUF9TSE9SVF9OQU1FIHx8ICdNaXRyYScsXHJcbiAgICAgICAgICBkZXNjcmlwdGlvbjogZW52LlZJVEVfQVBQX1RJVExFX05BTUUgfHwgJ01pdHJhIE1hbmFnZSBTeXN0ZW0nLFxyXG4gICAgICAgICAgc3RhcnRfdXJsOiAnLycsICAgICAgICAgICAgICAgICAgLy8gaW1wb3J0YW50IGZvciBzY29wZVxyXG4gICAgICAgICAgc2NvcGU6ICcvJywgICAgICAgICAgICAgICAgICAgICAgLy8gbWFrZSBTVyBjb250cm9sIHdob2xlIGFwcFxyXG4gICAgICAgICAgZGlzcGxheTogJ3N0YW5kYWxvbmUnLFxyXG4gICAgICAgICAgYmFja2dyb3VuZF9jb2xvcjogJyNmZmZmZmYnLFxyXG4gICAgICAgICAgdGhlbWVfY29sb3I6ICcjNjM2MzYzZmYnLFxyXG4gICAgICAgICAgaWNvbnM6IFtcclxuICAgICAgICAgICAgeyBzcmM6IGAvbG9nby8ke2Vudi5WSVRFX0JBU0VfQ09NUEFOWX0vbG9nby0xOTIucG5nYCwgc2l6ZXM6ICcxOTJ4MTkyJywgdHlwZTogJ2ltYWdlL3BuZycgfSxcclxuICAgICAgICAgICAgeyBzcmM6IGAvbG9nby8ke2Vudi5WSVRFX0JBU0VfQ09NUEFOWX0vbG9nby01MTIucG5nYCwgc2l6ZXM6ICc1MTJ4NTEyJywgdHlwZTogJ2ltYWdlL3BuZycgfSxcclxuICAgICAgICAgIF0sXHJcbiAgICAgICAgfSxcclxuICAgICAgICB3b3JrYm94OiB7XHJcbiAgICAgICAgICBza2lwV2FpdGluZzogdHJ1ZSwgICAgICAgICAgICAgICAvLyBhY3RpdmF0ZSBuZXcgU1cgaW1tZWRpYXRlbHlcclxuICAgICAgICAgIGNsaWVudHNDbGFpbTogdHJ1ZSwgICAgICAgICAgICAgIC8vIHRha2UgY29udHJvbCBvZiBvcGVuIHRhYnNcclxuICAgICAgICAgIGNsZWFudXBPdXRkYXRlZENhY2hlczogdHJ1ZSxcclxuICAgICAgICAgIGdsb2JQYXR0ZXJuczogWycqKi8qLntqcyxjc3MsaHRtbCxpY28scG5nLHN2Zyx3ZWJwfSddLFxyXG4gICAgICAgICAgbmF2aWdhdGVGYWxsYmFja0RlbnlsaXN0OiBbL15cXC9hcGlcXC8vXSwgLy8gZG9uXHUyMDE5dCBoaWphY2sgQVBJXHJcbiAgICAgICAgICBtYXhpbXVtRmlsZVNpemVUb0NhY2hlSW5CeXRlczogNV8wMDBfMDAwLCAvLyB5b3VyIDVNQiBsaW1pdFxyXG4gICAgICAgIH0sXHJcblxyXG4gICAgICAgIC8vIE9wdGlvbmFsOiBlbmFibGUgaW4gZGV2IHRvIHRlc3QgdXBkYXRlc1xyXG4gICAgICAgIC8vIGRldk9wdGlvbnM6IHsgZW5hYmxlZDogdHJ1ZSB9XHJcbiAgICAgIH0pLFxyXG5cclxuICAgICAgLy8gRG9jczogaHR0cHM6Ly9naXRodWIuY29tL3Z1ZXRpZnlqcy92dWV0aWZ5LWxvYWRlci90cmVlL21hc3Rlci9wYWNrYWdlcy92aXRlLXBsdWdpblxyXG4gICAgICB2dWV0aWZ5KHtcclxuICAgICAgICBzdHlsZXM6IHtcclxuICAgICAgICAgIGNvbmZpZ0ZpbGU6ICdzcmMvYXNzZXRzL3N0eWxlcy92YXJpYWJsZXMvX3Z1ZXRpZnkuc2NzcycsXHJcbiAgICAgICAgfSxcclxuICAgICAgfSksXHJcblxyXG5cclxuXHJcbiAgICAgIC8vIERvY3M6IGh0dHBzOi8vZ2l0aHViLmNvbS9kaXNoYWl0L3ZpdGUtcGx1Z2luLXZ1ZS1tZXRhLWxheW91dHM/dGFiPXJlYWRtZS1vdi1maWxlXHJcbiAgICAgIE1ldGFMYXlvdXRzKHtcclxuICAgICAgICB0YXJnZXQ6ICcuL3NyYy9sYXlvdXRzJyxcclxuICAgICAgICBkZWZhdWx0TGF5b3V0OiAnZGVmYXVsdCcsXHJcbiAgICAgIH0pLFxyXG5cclxuICAgICAgLy8gRG9jczogaHR0cHM6Ly9naXRodWIuY29tL2FudGZ1L3VucGx1Z2luLXZ1ZS1jb21wb25lbnRzI3VucGx1Z2luLXZ1ZS1jb21wb25lbnRzXHJcbiAgICAgIENvbXBvbmVudHMoe1xyXG4gICAgICAgIGRpcnM6IFsnc3JjL0Bjb3JlL2NvbXBvbmVudHMnLCAnc3JjL3ZpZXdzL2RlbW9zJywgJ3NyYy9jb21wb25lbnRzJ10sXHJcbiAgICAgICAgZHRzOiB0cnVlLFxyXG4gICAgICAgIHJlc29sdmVyczogW1xyXG4gICAgICAgICAgY29tcG9uZW50TmFtZSA9PiB7XHJcbiAgICAgICAgICAgIC8vIEF1dG8gaW1wb3J0IGBWdWVBcGV4Q2hhcnRzYFxyXG4gICAgICAgICAgICBpZiAoY29tcG9uZW50TmFtZSA9PT0gJ1Z1ZUFwZXhDaGFydHMnKVxyXG4gICAgICAgICAgICAgIHJldHVybiB7IG5hbWU6ICdkZWZhdWx0JywgZnJvbTogJ3Z1ZTMtYXBleGNoYXJ0cycsIGFzOiAnVnVlQXBleENoYXJ0cycgfVxyXG4gICAgICAgICAgfSxcclxuICAgICAgICBdLFxyXG4gICAgICB9KSxcclxuXHJcbiAgICAgIC8vIERvY3M6IGh0dHBzOi8vZ2l0aHViLmNvbS9hbnRmdS91bnBsdWdpbi1hdXRvLWltcG9ydCN1bnBsdWdpbi1hdXRvLWltcG9ydFxyXG4gICAgICBBdXRvSW1wb3J0KHtcclxuICAgICAgICBpbXBvcnRzOiBbJ3Z1ZScsIFZ1ZVJvdXRlckF1dG9JbXBvcnRzLCAnQHZ1ZXVzZS9jb3JlJywgJ0B2dWV1c2UvbWF0aCcsICd2dWUtaTE4bicsICdwaW5pYSddLFxyXG4gICAgICAgIGRpcnM6IFtcclxuICAgICAgICAgICcuL3NyYy9AY29yZS91dGlscycsXHJcbiAgICAgICAgICAnLi9zcmMvQGNvcmUvY29tcG9zYWJsZS8nLFxyXG4gICAgICAgICAgJy4vc3JjL2NvbXBvc2FibGVzLycsXHJcbiAgICAgICAgICAnLi9zcmMvdXRpbHMvJyxcclxuICAgICAgICAgICcuL3NyYy9wbHVnaW5zLyovY29tcG9zYWJsZXMvKicsXHJcbiAgICAgICAgXSxcclxuICAgICAgICB2dWVUZW1wbGF0ZTogdHJ1ZSxcclxuXHJcbiAgICAgICAgLy8gXHUyMTM5XHVGRTBGIERpc2FibGVkIHRvIGF2b2lkIGNvbmZ1c2lvbiAmIGFjY2lkZW50YWwgdXNhZ2VcclxuICAgICAgICBpZ25vcmU6IFsndXNlQ29va2llcycsICd1c2VTdG9yYWdlJ10sXHJcbiAgICAgICAgZXNsaW50cmM6IHtcclxuICAgICAgICAgIGVuYWJsZWQ6IHRydWUsXHJcbiAgICAgICAgICBmaWxlcGF0aDogJy4vLmVzbGludHJjLWF1dG8taW1wb3J0Lmpzb24nLFxyXG4gICAgICAgIH0sXHJcbiAgICAgIH0pLFxyXG4gICAgICBzdmdMb2FkZXIoKSxcclxuXHJcbiAgICAgIC8vIEVtaXRzIGEgc21hbGwgdmVyc2lvbi5qc29uIHRoZSBydW5uaW5nIGFwcCBwb2xscyBhdCBydW50aW1lIHRvXHJcbiAgICAgIC8vIGRldGVjdCBhIG5ld2VyIGRlcGxveSBcdTIwMTQgaW5kZXBlbmRlbnQgb2Ygc2VydmljZS13b3JrZXIgdXBkYXRlXHJcbiAgICAgIC8vIHRpbWluZywgd2hpY2ggaXMgdW5yZWxpYWJsZSBvbiBiYWNrZ3JvdW5kZWQvcmVzdW1lZCBpT1MgJiBBbmRyb2lkXHJcbiAgICAgIC8vIFBXQXMuIFNlZSB1c2VCdWlsZFZlcnNpb24uanMuXHJcbiAgICAgIHtcclxuICAgICAgICBuYW1lOiAnZW1pdC1idWlsZC12ZXJzaW9uJyxcclxuICAgICAgICBhcHBseTogJ2J1aWxkJyxcclxuICAgICAgICBnZW5lcmF0ZUJ1bmRsZSgpIHtcclxuICAgICAgICAgIHRoaXMuZW1pdEZpbGUoe1xyXG4gICAgICAgICAgICB0eXBlOiAnYXNzZXQnLFxyXG4gICAgICAgICAgICBmaWxlTmFtZTogJ3ZlcnNpb24uanNvbicsXHJcbiAgICAgICAgICAgIHNvdXJjZTogSlNPTi5zdHJpbmdpZnkoeyB2ZXJzaW9uOiBidWlsZFZlcnNpb24gfSksXHJcbiAgICAgICAgICB9KVxyXG4gICAgICAgIH0sXHJcbiAgICAgIH0sXHJcbiAgICBdLFxyXG4gICAgZGVmaW5lOiB7XHJcbiAgICAgICdwcm9jZXNzLmVudic6IHt9LFxyXG4gICAgICBfX0FQUF9CVUlMRF9WRVJTSU9OX186IEpTT04uc3RyaW5naWZ5KGJ1aWxkVmVyc2lvbiksXHJcbiAgICB9LFxyXG4gICAgcmVzb2x2ZToge1xyXG4gICAgICBhbGlhczoge1xyXG4gICAgICAgICdAJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYycsIGltcG9ydC5tZXRhLnVybCkpLFxyXG4gICAgICAgICdAdGhlbWVDb25maWcnOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vdGhlbWVDb25maWcuanMnLCBpbXBvcnQubWV0YS51cmwpKSxcclxuICAgICAgICAnQGNvcmUnOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vc3JjL0Bjb3JlJywgaW1wb3J0Lm1ldGEudXJsKSksXHJcbiAgICAgICAgJ0BsYXlvdXRzJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYy9AbGF5b3V0cycsIGltcG9ydC5tZXRhLnVybCkpLFxyXG4gICAgICAgICdAaW1hZ2VzJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYy9hc3NldHMvaW1hZ2VzLycsIGltcG9ydC5tZXRhLnVybCkpLFxyXG5cclxuICAgICAgICAnQHN0eWxlcyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9zcmMvYXNzZXRzL3N0eWxlcy8nLCBpbXBvcnQubWV0YS51cmwpKSxcclxuICAgICAgICAnQGNvbmZpZ3VyZWQtdmFyaWFibGVzJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYy9hc3NldHMvc3R5bGVzL3ZhcmlhYmxlcy9fdGVtcGxhdGUuc2NzcycsIGltcG9ydC5tZXRhLnVybCkpLFxyXG4gICAgICAgICdAZGInOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vc3JjL3BsdWdpbnMvZmFrZS1hcGkvaGFuZGxlcnMvJywgaW1wb3J0Lm1ldGEudXJsKSksXHJcbiAgICAgICAgJ0BhcGktdXRpbHMnOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vc3JjL3BsdWdpbnMvZmFrZS1hcGkvdXRpbHMvJywgaW1wb3J0Lm1ldGEudXJsKSksXHJcbiAgICAgIH0sXHJcbiAgICB9LFxyXG4gICAgYnVpbGQ6IHtcclxuICAgICAgY2h1bmtTaXplV2FybmluZ0xpbWl0OiA1MDAwLFxyXG4gICAgICBtaW5pZnk6ICdlc2J1aWxkJyxcclxuICAgICAgZXNidWlsZDoge1xyXG4gICAgICAgIGRyb3A6IFsnY29uc29sZScsICdkZWJ1Z2dlciddLFxyXG4gICAgICB9LFxyXG4gICAgICByb2xsdXBPcHRpb25zOiB7XHJcbiAgICAgICAgb3V0cHV0OiB7XHJcbiAgICAgICAgICAvLyBGb3JjZSBjaHVuayBmaWxlcyB0byBpbmNsdWRlIGEgYnVpbGQgdGltZXN0YW1wL3ZlcnNpb25cclxuICAgICAgICAgIGNodW5rRmlsZU5hbWVzOiBgYXNzZXRzL1tuYW1lXS1baGFzaF0tdiR7YnVpbGRWZXJzaW9ufS5qc2AsXHJcbiAgICAgICAgICBlbnRyeUZpbGVOYW1lczogYGFzc2V0cy9bbmFtZV0tW2hhc2hdLXYke2J1aWxkVmVyc2lvbn0uanNgLFxyXG4gICAgICAgICAgYXNzZXRGaWxlTmFtZXM6IGBhc3NldHMvW25hbWVdLVtoYXNoXS12JHtidWlsZFZlcnNpb259LltleHRdYCxcclxuICAgICAgICB9LFxyXG4gICAgICB9LFxyXG4gICAgfSxcclxuICAgIG9wdGltaXplRGVwczoge1xyXG4gICAgICBleGNsdWRlOiBbJ3Z1ZXRpZnknXSxcclxuICAgICAgZW50cmllczogW1xyXG4gICAgICAgICcuL3NyYy8qKi8qLnZ1ZScsXHJcbiAgICAgIF0sXHJcbiAgICB9LFxyXG4gIH1cclxufSlcclxuIl0sCiAgIm1hcHBpbmdzIjogIjtBQUFzVCxTQUFTLHFCQUFxQjtBQUNwVixPQUFPLFNBQVM7QUFDaEIsT0FBTyxZQUFZO0FBQ25CLE9BQU8sZ0JBQWdCO0FBQ3ZCLE9BQU8sZ0JBQWdCO0FBQ3ZCLFNBQVMsc0JBQXNCLDhCQUE4QjtBQUM3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
