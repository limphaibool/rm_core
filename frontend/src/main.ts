import { createApp } from "vue";
import { createPinia } from "pinia";
import router from "./shared/router";
import PrimeVue from "primevue/config";
// @ts-ignore
import Lara from "./shared/presets/lara";
import App from "./App.vue";
import "./axios";
import { useAuthStore } from "./shared/stores/auth";

const pinia = createPinia();
const app = createApp(App);
app.use(pinia);
const authStore = useAuthStore();
await authStore.getPermissions();

app.use(router);
app.use(PrimeVue, { unstyled: true, pt: Lara });
app.mount("#app");
