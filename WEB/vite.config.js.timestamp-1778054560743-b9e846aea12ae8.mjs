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
      svgLoader()
    ],
    define: { "process.env": {} },
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
          manualChunks(id) {
            if (id.includes("node_modules")) {
              return id.toString().split("node_modules/")[1].split("/")[0].toString();
            }
          }
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
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcuanMiXSwKICAic291cmNlc0NvbnRlbnQiOiBbImNvbnN0IF9fdml0ZV9pbmplY3RlZF9vcmlnaW5hbF9kaXJuYW1lID0gXCJDOlxcXFxDb2RpbmcgUHJvamVjdFxcXFxWdWVcXFxcbG9hbl9zeXN0ZW1fdjFcXFxcV0VCXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJDOlxcXFxDb2RpbmcgUHJvamVjdFxcXFxWdWVcXFxcbG9hbl9zeXN0ZW1fdjFcXFxcV0VCXFxcXHZpdGUuY29uZmlnLmpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9DOi9Db2RpbmclMjBQcm9qZWN0L1Z1ZS9sb2FuX3N5c3RlbV92MS9XRUIvdml0ZS5jb25maWcuanNcIjtpbXBvcnQgeyBmaWxlVVJMVG9QYXRoIH0gZnJvbSAnbm9kZTp1cmwnXHJcbmltcG9ydCB2dWUgZnJvbSAnQHZpdGVqcy9wbHVnaW4tdnVlJ1xyXG5pbXBvcnQgdnVlSnN4IGZyb20gJ0B2aXRlanMvcGx1Z2luLXZ1ZS1qc3gnXHJcbmltcG9ydCBBdXRvSW1wb3J0IGZyb20gJ3VucGx1Z2luLWF1dG8taW1wb3J0L3ZpdGUnXHJcbmltcG9ydCBDb21wb25lbnRzIGZyb20gJ3VucGx1Z2luLXZ1ZS1jb21wb25lbnRzL3ZpdGUnXHJcbmltcG9ydCB7IFZ1ZVJvdXRlckF1dG9JbXBvcnRzLCBnZXRQYXNjYWxDYXNlUm91dGVOYW1lIH0gZnJvbSAndW5wbHVnaW4tdnVlLXJvdXRlcidcclxuaW1wb3J0IFZ1ZVJvdXRlciBmcm9tICd1bnBsdWdpbi12dWUtcm91dGVyL3ZpdGUnXHJcbmltcG9ydCB7IGRlZmluZUNvbmZpZywgbG9hZEVudiB9IGZyb20gJ3ZpdGUnXHJcbmltcG9ydCBWdWVEZXZUb29scyBmcm9tICd2aXRlLXBsdWdpbi12dWUtZGV2dG9vbHMnXHJcbmltcG9ydCBNZXRhTGF5b3V0cyBmcm9tICd2aXRlLXBsdWdpbi12dWUtbWV0YS1sYXlvdXRzJ1xyXG5pbXBvcnQgdnVldGlmeSBmcm9tICd2aXRlLXBsdWdpbi12dWV0aWZ5J1xyXG5pbXBvcnQgc3ZnTG9hZGVyIGZyb20gJ3ZpdGUtc3ZnLWxvYWRlcidcclxuaW1wb3J0IExheW91dHMgZnJvbSAndml0ZS1wbHVnaW4tdnVlLWxheW91dHMnO1xyXG5pbXBvcnQgeyBWaXRlUFdBIH0gZnJvbSAndml0ZS1wbHVnaW4tcHdhJyAvLyBJbXBvcnQgdGhlIHBsdWdpblxyXG5cclxuLy8gaHR0cHM6Ly92aXRlanMuZGV2L2NvbmZpZy9cclxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKChtb2RlKSA9PiB7XHJcbiAgY29uc3QgZW52ID0gbG9hZEVudihtb2RlLCBwcm9jZXNzLmN3ZCgpLCAnJylcclxuICAvLyBjb25zb2xlLmxvZygnRU5WIENIRUNLOicsIGVudi5WSVRFX0JBU0VfQ09NUEFOWSwgZW52LlZJVEVfQVBQX1BXQV9OQU1FKSAvLyBcdUQ4M0RcdURDNDggYWRkIHRoaXNcclxuICByZXR1cm4ge1xyXG4gICAgcGx1Z2luczogW1xyXG4gICAgICAvLyBEb2NzOiBodHRwczovL2dpdGh1Yi5jb20vcG9zdmEvdW5wbHVnaW4tdnVlLXJvdXRlclxyXG4gICAgICAvLyBcdTIxMzlcdUZFMEYgVGhpcyBwbHVnaW4gc2hvdWxkIGJlIHBsYWNlZCBiZWZvcmUgdnVlIHBsdWdpblxyXG4gICAgICBWdWVSb3V0ZXIoe1xyXG4gICAgICAgIGdldFJvdXRlTmFtZTogcm91dGVOb2RlID0+IHtcclxuICAgICAgICAgIC8vIENvbnZlcnQgcGFzY2FsIGNhc2UgdG8ga2ViYWIgY2FzZVxyXG4gICAgICAgICAgcmV0dXJuIGdldFBhc2NhbENhc2VSb3V0ZU5hbWUocm91dGVOb2RlKVxyXG4gICAgICAgICAgICAucmVwbGFjZSgvKFthLXpcXGRdKShbQS1aXSkvZywgJyQxLSQyJylcclxuICAgICAgICAgICAgLnRvTG93ZXJDYXNlKClcclxuICAgICAgICB9LFxyXG4gICAgICAgIC8vIGJlZm9yZVdyaXRlRmlsZXM6IHJvb3QgPT4ge1xyXG4gICAgICAgIC8vICAgcm9vdC5pbnNlcnQoJy9sb2Fucy9pbmRleC52dWUnLCAnL3NyYy9wYWdlcy9sb2Fucy9pbmRleC52dWUnKVxyXG4gICAgICAgIC8vICAgcm9vdC5pbnNlcnQoJ3Rlc3QudnVlJywgJy9zcmMvcGFnZXMvdGVzdC52dWUnKVxyXG4gICAgICAgIC8vIH0sXHJcbiAgICAgIH0pLFxyXG4gICAgICB2dWUoe1xyXG4gICAgICAgIHRlbXBsYXRlOiB7XHJcbiAgICAgICAgICBjb21waWxlck9wdGlvbnM6IHtcclxuICAgICAgICAgICAgaXNDdXN0b21FbGVtZW50OiB0YWcgPT4gdGFnID09PSAnc3dpcGVyLWNvbnRhaW5lcicgfHwgdGFnID09PSAnc3dpcGVyLXNsaWRlJyxcclxuICAgICAgICAgIH0sXHJcbiAgICAgICAgfSxcclxuICAgICAgfSksXHJcbiAgICAgIFZ1ZURldlRvb2xzKCksXHJcbiAgICAgIHZ1ZUpzeCgpLFxyXG4gICAgICBMYXlvdXRzKCksIC8vIDwtLS0gRW5zdXJlIGl0J3MgdXNlZCBoZXJlXHJcblxyXG4gICAgICBWaXRlUFdBKHtcclxuICAgICAgICByZWdpc3RlclR5cGU6ICdhdXRvVXBkYXRlJywgICAgICAgIC8vIGNoZWNrICYgaW5zdGFsbCB1cGRhdGVzIGluIGJnXHJcbiAgICAgICAgaW5qZWN0UmVnaXN0ZXI6ICdhdXRvJywgICAgICAgICAgICAvLyBpbmplY3RzIHRoZSByZWdpc3RlciBjb2RlIGZvciB5b3VcclxuICAgICAgICBpbmNsdWRlQXNzZXRzOiBbYCR7ZW52LlZJVEVfQkFTRV9DT01QQU5ZfS5mYXZpY29uLmljb2AsICdyb2JvdHMudHh0J10sXHJcbiAgICAgICAgc2VsZkRlc3Ryb3lpbmc6IHRydWUsXHJcbiAgICAgICAgbWFuaWZlc3Q6IHtcclxuICAgICAgICAgIG5hbWU6IGVudi5WSVRFX0FQUF9USVRMRV9OQU1FIHx8ICdNaXRyYSBNYW5hZ2UgU3lzdGVtJyxcclxuICAgICAgICAgIHNob3J0X25hbWU6IGVudi5WSVRFX0FQUF9TSE9SVF9OQU1FIHx8ICdNaXRyYScsXHJcbiAgICAgICAgICBkZXNjcmlwdGlvbjogZW52LlZJVEVfQVBQX1RJVExFX05BTUUgfHwgJ01pdHJhIE1hbmFnZSBTeXN0ZW0nLFxyXG4gICAgICAgICAgc3RhcnRfdXJsOiAnLycsICAgICAgICAgICAgICAgICAgLy8gaW1wb3J0YW50IGZvciBzY29wZVxyXG4gICAgICAgICAgc2NvcGU6ICcvJywgICAgICAgICAgICAgICAgICAgICAgLy8gbWFrZSBTVyBjb250cm9sIHdob2xlIGFwcFxyXG4gICAgICAgICAgZGlzcGxheTogJ3N0YW5kYWxvbmUnLFxyXG4gICAgICAgICAgYmFja2dyb3VuZF9jb2xvcjogJyNmZmZmZmYnLFxyXG4gICAgICAgICAgdGhlbWVfY29sb3I6ICcjNjM2MzYzZmYnLFxyXG4gICAgICAgICAgaWNvbnM6IFtcclxuICAgICAgICAgICAgeyBzcmM6IGAvbG9nby8ke2Vudi5WSVRFX0JBU0VfQ09NUEFOWX0vbG9nby0xOTIucG5nYCwgc2l6ZXM6ICcxOTJ4MTkyJywgdHlwZTogJ2ltYWdlL3BuZycgfSxcclxuICAgICAgICAgICAgeyBzcmM6IGAvbG9nby8ke2Vudi5WSVRFX0JBU0VfQ09NUEFOWX0vbG9nby01MTIucG5nYCwgc2l6ZXM6ICc1MTJ4NTEyJywgdHlwZTogJ2ltYWdlL3BuZycgfSxcclxuICAgICAgICAgIF0sXHJcbiAgICAgICAgfSxcclxuICAgICAgICB3b3JrYm94OiB7XHJcbiAgICAgICAgICBza2lwV2FpdGluZzogdHJ1ZSwgICAgICAgICAgICAgICAvLyBhY3RpdmF0ZSBuZXcgU1cgaW1tZWRpYXRlbHlcclxuICAgICAgICAgIGNsaWVudHNDbGFpbTogdHJ1ZSwgICAgICAgICAgICAgIC8vIHRha2UgY29udHJvbCBvZiBvcGVuIHRhYnNcclxuICAgICAgICAgIGNsZWFudXBPdXRkYXRlZENhY2hlczogdHJ1ZSxcclxuICAgICAgICAgIGdsb2JQYXR0ZXJuczogWycqKi8qLntqcyxjc3MsaHRtbCxpY28scG5nLHN2Zyx3ZWJwfSddLFxyXG4gICAgICAgICAgbmF2aWdhdGVGYWxsYmFja0RlbnlsaXN0OiBbL15cXC9hcGlcXC8vXSwgLy8gZG9uXHUyMDE5dCBoaWphY2sgQVBJXHJcbiAgICAgICAgICBtYXhpbXVtRmlsZVNpemVUb0NhY2hlSW5CeXRlczogNV8wMDBfMDAwLCAvLyB5b3VyIDVNQiBsaW1pdFxyXG4gICAgICAgIH0sXHJcbiAgICAgICAgLy8gT3B0aW9uYWw6IGVuYWJsZSBpbiBkZXYgdG8gdGVzdCB1cGRhdGVzXHJcbiAgICAgICAgLy8gZGV2T3B0aW9uczogeyBlbmFibGVkOiB0cnVlIH1cclxuICAgICAgfSksXHJcblxyXG4gICAgICAvLyBEb2NzOiBodHRwczovL2dpdGh1Yi5jb20vdnVldGlmeWpzL3Z1ZXRpZnktbG9hZGVyL3RyZWUvbWFzdGVyL3BhY2thZ2VzL3ZpdGUtcGx1Z2luXHJcbiAgICAgIHZ1ZXRpZnkoe1xyXG4gICAgICAgIHN0eWxlczoge1xyXG4gICAgICAgICAgY29uZmlnRmlsZTogJ3NyYy9hc3NldHMvc3R5bGVzL3ZhcmlhYmxlcy9fdnVldGlmeS5zY3NzJyxcclxuICAgICAgICB9LFxyXG4gICAgICB9KSxcclxuXHJcblxyXG5cclxuICAgICAgLy8gRG9jczogaHR0cHM6Ly9naXRodWIuY29tL2Rpc2hhaXQvdml0ZS1wbHVnaW4tdnVlLW1ldGEtbGF5b3V0cz90YWI9cmVhZG1lLW92LWZpbGVcclxuICAgICAgTWV0YUxheW91dHMoe1xyXG4gICAgICAgIHRhcmdldDogJy4vc3JjL2xheW91dHMnLFxyXG4gICAgICAgIGRlZmF1bHRMYXlvdXQ6ICdkZWZhdWx0JyxcclxuICAgICAgfSksXHJcblxyXG4gICAgICAvLyBEb2NzOiBodHRwczovL2dpdGh1Yi5jb20vYW50ZnUvdW5wbHVnaW4tdnVlLWNvbXBvbmVudHMjdW5wbHVnaW4tdnVlLWNvbXBvbmVudHNcclxuICAgICAgQ29tcG9uZW50cyh7XHJcbiAgICAgICAgZGlyczogWydzcmMvQGNvcmUvY29tcG9uZW50cycsICdzcmMvdmlld3MvZGVtb3MnLCAnc3JjL2NvbXBvbmVudHMnXSxcclxuICAgICAgICBkdHM6IHRydWUsXHJcbiAgICAgICAgcmVzb2x2ZXJzOiBbXHJcbiAgICAgICAgICBjb21wb25lbnROYW1lID0+IHtcclxuICAgICAgICAgICAgLy8gQXV0byBpbXBvcnQgYFZ1ZUFwZXhDaGFydHNgXHJcbiAgICAgICAgICAgIGlmIChjb21wb25lbnROYW1lID09PSAnVnVlQXBleENoYXJ0cycpXHJcbiAgICAgICAgICAgICAgcmV0dXJuIHsgbmFtZTogJ2RlZmF1bHQnLCBmcm9tOiAndnVlMy1hcGV4Y2hhcnRzJywgYXM6ICdWdWVBcGV4Q2hhcnRzJyB9XHJcbiAgICAgICAgICB9LFxyXG4gICAgICAgIF0sXHJcbiAgICAgIH0pLFxyXG5cclxuICAgICAgLy8gRG9jczogaHR0cHM6Ly9naXRodWIuY29tL2FudGZ1L3VucGx1Z2luLWF1dG8taW1wb3J0I3VucGx1Z2luLWF1dG8taW1wb3J0XHJcbiAgICAgIEF1dG9JbXBvcnQoe1xyXG4gICAgICAgIGltcG9ydHM6IFsndnVlJywgVnVlUm91dGVyQXV0b0ltcG9ydHMsICdAdnVldXNlL2NvcmUnLCAnQHZ1ZXVzZS9tYXRoJywgJ3Z1ZS1pMThuJywgJ3BpbmlhJ10sXHJcbiAgICAgICAgZGlyczogW1xyXG4gICAgICAgICAgJy4vc3JjL0Bjb3JlL3V0aWxzJyxcclxuICAgICAgICAgICcuL3NyYy9AY29yZS9jb21wb3NhYmxlLycsXHJcbiAgICAgICAgICAnLi9zcmMvY29tcG9zYWJsZXMvJyxcclxuICAgICAgICAgICcuL3NyYy91dGlscy8nLFxyXG4gICAgICAgICAgJy4vc3JjL3BsdWdpbnMvKi9jb21wb3NhYmxlcy8qJyxcclxuICAgICAgICBdLFxyXG4gICAgICAgIHZ1ZVRlbXBsYXRlOiB0cnVlLFxyXG5cclxuICAgICAgICAvLyBcdTIxMzlcdUZFMEYgRGlzYWJsZWQgdG8gYXZvaWQgY29uZnVzaW9uICYgYWNjaWRlbnRhbCB1c2FnZVxyXG4gICAgICAgIGlnbm9yZTogWyd1c2VDb29raWVzJywgJ3VzZVN0b3JhZ2UnXSxcclxuICAgICAgICBlc2xpbnRyYzoge1xyXG4gICAgICAgICAgZW5hYmxlZDogdHJ1ZSxcclxuICAgICAgICAgIGZpbGVwYXRoOiAnLi8uZXNsaW50cmMtYXV0by1pbXBvcnQuanNvbicsXHJcbiAgICAgICAgfSxcclxuICAgICAgfSksXHJcbiAgICAgIHN2Z0xvYWRlcigpLFxyXG5cclxuICAgIF0sXHJcbiAgICBkZWZpbmU6IHsgJ3Byb2Nlc3MuZW52Jzoge30gfSxcclxuICAgIHJlc29sdmU6IHtcclxuICAgICAgYWxpYXM6IHtcclxuICAgICAgICAnQCc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9zcmMnLCBpbXBvcnQubWV0YS51cmwpKSxcclxuICAgICAgICAnQHRoZW1lQ29uZmlnJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3RoZW1lQ29uZmlnLmpzJywgaW1wb3J0Lm1ldGEudXJsKSksXHJcbiAgICAgICAgJ0Bjb3JlJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYy9AY29yZScsIGltcG9ydC5tZXRhLnVybCkpLFxyXG4gICAgICAgICdAbGF5b3V0cyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9zcmMvQGxheW91dHMnLCBpbXBvcnQubWV0YS51cmwpKSxcclxuICAgICAgICAnQGltYWdlcyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9zcmMvYXNzZXRzL2ltYWdlcy8nLCBpbXBvcnQubWV0YS51cmwpKSxcclxuICAgICAgICBcclxuICAgICAgICAnQHN0eWxlcyc6IGZpbGVVUkxUb1BhdGgobmV3IFVSTCgnLi9zcmMvYXNzZXRzL3N0eWxlcy8nLCBpbXBvcnQubWV0YS51cmwpKSxcclxuICAgICAgICAnQGNvbmZpZ3VyZWQtdmFyaWFibGVzJzogZmlsZVVSTFRvUGF0aChuZXcgVVJMKCcuL3NyYy9hc3NldHMvc3R5bGVzL3ZhcmlhYmxlcy9fdGVtcGxhdGUuc2NzcycsIGltcG9ydC5tZXRhLnVybCkpLFxyXG4gICAgICAgICdAZGInOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vc3JjL3BsdWdpbnMvZmFrZS1hcGkvaGFuZGxlcnMvJywgaW1wb3J0Lm1ldGEudXJsKSksXHJcbiAgICAgICAgJ0BhcGktdXRpbHMnOiBmaWxlVVJMVG9QYXRoKG5ldyBVUkwoJy4vc3JjL3BsdWdpbnMvZmFrZS1hcGkvdXRpbHMvJywgaW1wb3J0Lm1ldGEudXJsKSksXHJcbiAgICAgIH0sXHJcbiAgICB9LFxyXG4gICAgYnVpbGQ6IHtcclxuICAgICAgY2h1bmtTaXplV2FybmluZ0xpbWl0OiA1MDAwLFxyXG4gICAgICBtaW5pZnk6ICdlc2J1aWxkJyxcclxuICAgICAgZXNidWlsZDoge1xyXG4gICAgICAgIGRyb3A6IFsnY29uc29sZScsICdkZWJ1Z2dlciddLFxyXG4gICAgICB9LFxyXG4gICAgICByb2xsdXBPcHRpb25zOiB7XHJcbiAgICAgICAgb3V0cHV0OiB7XHJcbiAgICAgICAgICBtYW51YWxDaHVua3MoaWQpIHtcclxuICAgICAgICAgICAgaWYgKGlkLmluY2x1ZGVzKCdub2RlX21vZHVsZXMnKSkge1xyXG4gICAgICAgICAgICAgIHJldHVybiBpZC50b1N0cmluZygpLnNwbGl0KCdub2RlX21vZHVsZXMvJylbMV0uc3BsaXQoJy8nKVswXS50b1N0cmluZygpO1xyXG4gICAgICAgICAgICB9XHJcbiAgICAgICAgICB9XHJcbiAgICAgICAgfVxyXG4gICAgICB9XHJcbiAgICB9LFxyXG4gICAgb3B0aW1pemVEZXBzOiB7XHJcbiAgICAgIGV4Y2x1ZGU6IFsndnVldGlmeSddLFxyXG4gICAgICBlbnRyaWVzOiBbXHJcbiAgICAgICAgJy4vc3JjLyoqLyoudnVlJyxcclxuICAgICAgXSxcclxuICAgIH0sXHJcbiAgfVxyXG59KVxyXG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQXNULFNBQVMscUJBQXFCO0FBQ3BW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
