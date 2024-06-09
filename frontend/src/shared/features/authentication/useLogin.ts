import { ref } from "vue";
import { useAuthStore } from "./auth.ts";
import axios from "axios";

export default function useLogin() {
  const authStore = useAuthStore();
  const form = ref({
    username: "",
    password: "",
  });
  const login = async () => {
    await authStore.getCsrfToken();
    await axios.post("/auth/login", {
      username: form.value.username,
      password: form.value.password,
    });
    await authStore.getUser();
  };
  return { form, login };
}
