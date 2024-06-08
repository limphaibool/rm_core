import { createRouter, createWebHistory } from "vue-router";
import HomeView from "../views/HomeView.vue";
import LoginView from "../views/LoginView.vue";
import ProfileView from "../views/ProfileView.vue";
import MainLayout from "../layouts/MainLayout.vue";
import GuestLayout from "../layouts/GuestLayout.vue";
import TopBarOnlyLayout from "../layouts/TopBarOnlyLayout.vue";
import { useAuthStore } from "../stores/auth";
import { adminRoutes } from "../../admin/routes";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: "/",
      component: () => MainLayout,
      children: [
        {
          path: "",
          name: "home",
          component: HomeView,
        },
        {
          path: "/profile",
          name: "profile",
          component: ProfileView,
        },
        ...adminRoutes,
      ],
      meta: { requiresAuth: true },
    },
    {
      path: "/login",
      name: "login",
      component: () => GuestLayout,
      children: [{ path: "", component: LoginView }],
    },
  ],
});

router.beforeEach((to, _from, next) => {
  const authStore = useAuthStore(); // Access your authentication store
  const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);

  if (requiresAuth && !authStore.isLoggedIn()) {
    next({ path: "/login" });
  } else if (!requiresAuth && authStore.isLoggedIn()) {
    next({ path: "/" });
  } else {
    next(); // Proceed to route
  }
});

export default router;
