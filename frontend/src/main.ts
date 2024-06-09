import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./shared/router";
import PrimeVue from "primevue/config";
// @ts-ignore
import Lara from "./shared/presets/lara";
import App from "./App.vue";
import "./axios";
import { useAuthStore } from "./shared/stores/auth.ts";
import ToastService from "primevue/toastservice";

const pinia = createPinia();
const app = createApp(App);
app.use(ToastService);
app.use(pinia);

const authStore = useAuthStore();
try {
  await authStore.getUser();
} catch {}

app.use(router);

app.use(PrimeVue, { unstyled: true, pt: Lara });
app.mount("#app");
