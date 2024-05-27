import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/Auth/LoginView.vue";
import MainLayout from "../layouts/MainLayout.vue";
import GuestLayout from "../layouts/GuestLayout.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      component: () => MainLayout,
      children: [{ path: "", component: HomeView }],
      meta: { requiresAuth: true },
    },
    {
      path: "/login",
      component: () => GuestLayout,
      children: [{ path: "", component: LoginView }],
    },
  ],
});

export default router;
