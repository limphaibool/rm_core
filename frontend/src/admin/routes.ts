import RoleDetailView from "./views/RoleDetailView.vue";
import RolesListView from "./views/RolesListView.vue";

export const adminRoutes = [
  {
    path: "/admin",
    children: [
      { path: "roles", component: RolesListView },
      { path: "roles/:id", component: RoleDetailView },
    ],
  },
];
