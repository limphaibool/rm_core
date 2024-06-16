import UsersListView from "./users/UsersListView.vue";
import RoleCreateView from "./roles/RoleCreateView.vue";
import RoleGetView from "./roles/RoleGetView.vue";
import RoleListView from "./roles/RoleListView.vue";

export const adminRoutes = [
  {
    path: "/admin",
    children: [
      { path: "roles", name: "role.list", component: RoleListView },
      { path: "roles/new", name: "role.create", component: RoleCreateView },
      { path: "roles/:id", name: "role.get", component: RoleGetView },
      { path: "users", name: "users", component: UsersListView },
    ],
  },
];
