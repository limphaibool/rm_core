import { useToast } from "primevue/usetoast";
import { ref } from "vue";
import axios from "axios";
import { ErrorHandler } from "../../shared/helpers/errorHandler";
import { useRouter } from "vue-router";
import { useAuthStore } from "../../shared/stores/auth";

export default function useRoles() {
  const toast = useToast();
  const roles = ref<Role[]>([]);
  const router = useRouter();
  const authStore = useAuthStore();

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

  const goRoleCreateView = () => {
    router.push({ name: "role.create" });
  };

  const errors = ref({
    name: null as string | null,
  });

  const createRole = async (newRole: RoleRequest) => {
    try {
      const data = {
        roleName: newRole.name!,
        parentId: newRole.parentRole!.id,
      };
      const res = await axios.post<DataResponse<Role>>("/admin/roles", data);
      toast.add({
        severity: "success",
        summary: "Success",
        detail: res.data.message,
        life: 3000,
      });
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

  return { roles, getRoles, goRoleCreateView, createRole, errors };
}
