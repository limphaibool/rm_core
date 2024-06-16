import { useToast } from "primevue/usetoast";
import { ref } from "vue";
import axios from "axios";
import { ErrorHandler } from "../../shared/helpers/errorHandler";

export default function useRoles() {
  const toast = useToast();
  const roles = ref<Role[]>([]);

  const getRoles = async () => {
    try {
      const res = await axios.get<DataResponse<Role[]>>("/admin/roles");
      roles.value = res.data.data;
    } catch (e) {
      const error = ErrorHandler.handle(e);
      toast.add({
        severity: "error",
        summary: "Error",
        detail: error.message,
        life: 3000,
      });
    }
  };
  return { roles, getRoles };
}
