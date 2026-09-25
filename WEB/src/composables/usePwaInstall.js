import { ref } from "vue";

const deferredPrompt = ref(null);
const canInstall = ref(false);
const isStandalone = ref(false);
const isIos = ref(false);
const isIosNonSafari = ref(false);
let initialized = false;

export function initPwaInstall() {
  if (initialized || typeof window === "undefined") return;

  initialized = true;

  const ua = window.navigator.userAgent;

  isStandalone.value =
    window.matchMedia("(display-mode: standalone)").matches ||
    window.navigator.standalone === true;

  isIos.value =
    /iphone|ipad|ipod/i.test(ua) ||
    (navigator.maxTouchPoints > 1 && /Macintosh/i.test(ua));

  isIosNonSafari.value =
    isIos.value && (/CriOS/i.test(ua) || /FxiOS/i.test(ua) || /EdgiOS/i.test(ua));

  window.addEventListener("beforeinstallprompt", (event) => {
    event.preventDefault();
    deferredPrompt.value = event;
    canInstall.value = !isStandalone.value;
  });

  window.addEventListener("appinstalled", () => {
    deferredPrompt.value = null;
    canInstall.value = false;
    isStandalone.value = true;
  });
}

export function usePwaInstall() {
  initPwaInstall();

  const install = async () => {
    if (!deferredPrompt.value) return false;

    deferredPrompt.value.prompt();

    const { outcome } = await deferredPrompt.value.userChoice;

    deferredPrompt.value = null;
    canInstall.value = false;

    return outcome === "accepted";
  };

  return {
    canInstall,
    isIos,
    isIosNonSafari,
    isStandalone,
    install,
  };
}
