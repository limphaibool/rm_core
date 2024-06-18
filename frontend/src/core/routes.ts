import UsersListView from "./users/UsersListView.vue";
import RoleCreateView from "./roles/RoleCreateView.vue";
import RoleGetView from "./roles/RoleGetView.vue";
import RoleListView from "./roles/RoleListView.vue";

export const adminRoutes = [
  {
    path: "/admin",
    children: [
      {
        path: "roles",
        name: "role.list",
        component: RoleListView,
        meta: { title: "Roles" },
      },
      {
        path: "roles/new",
        name: "role.create",
        component: RoleCreateView,
        meta: { title: "เพิ่ม role" },
      },
      {
        path: "roles/:id",
        name: "role.get",
        component: RoleGetView,
        meta: { title: "Role detail" },
      },
      {
        path: "users",
        name: "users",
        component: UsersListView,
        meta: { title: "Users" },
      },
    ],
  },
];
