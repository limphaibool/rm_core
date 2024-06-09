import RolesListView from "./roles/RolesListView.vue";
import RoleDetailView from "./roles/RoleDetailView.vue";
import UsersListView from "./users/UsersListView.vue";

export const adminRoutes = [
  {
    path: "/admin",
    children: [
      { path: "roles", name: "roles", component: RolesListView },
      { path: "roles/:id", component: RoleDetailView },
      { path: "users", name: "users", component: UsersListView },
    ],
  },
];
