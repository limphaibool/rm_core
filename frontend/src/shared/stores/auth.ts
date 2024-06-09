import { defineStore } from "pinia";
import axios from "axios";
import { User } from "../interfaces/User";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    authUser: null as User | null,
    authPermissions: null as Array<object> | null,
  }),
  getters: {
    user: (state) => state.authUser,
    permissions: (state) => state.authPermissions,
  },
  actions: {
    async getCsrfToken() {
      await axios.get("http://localhost:8000/sanctum/csrf-cookie");
    },
    async getUser() {
      const res = await axios.get<BaseResponse<User>>("/auth/user");
      this.authUser = res.data.data;
    },

    async getPermissions() {
      const res = await axios.get("/auth/permissions");
      this.authPermissions = res.data.data ?? null;
    },
    isLoggedIn() {
      return this.authUser != null;
    },
    clearUser() {
      this.authUser = null;
    },
  },
});
