import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
  state: () => ({
    authUser: null,
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

    async getPermissions() {
      const res = await axios.get("/auth/permissions");
      this.authPermissions = res.data;
    },

    isLoggedIn() {
      return this.authPermissions != null;
    },
  },
});
