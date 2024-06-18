import { useToast } from "primevue/usetoast";
import axios from "axios";
import { useRouter, useRoute } from "vue-router";

export default function useRole() {
  const toast = useToast();
  const router = useRouter();
  const route = useRoute();

  const getRoles = async () => {
    const res = await axios.get<DataResponse<Role[]>>("/admin/roles");
    return res.data.data;
  };

  const getRole = async (id: number) => {
    const res = await axios.get<DataResponse<Role>>(`/admin/roles/${id}`);
    return res.data.data;
  };

  const createRole = async (newRole: RoleRequest) => {
    const data = {
      roleName: newRole.name!,
      parentId: newRole.parentRole!.id,
    };
    const res = await axios.post<DataResponse<Role>>("/admin/roles", data);
    return res;
  };
  const updateRole = async (id: number, role: RoleRequest) => {
    const data = {
      roleName: role.name,
      enabled: role.enabled,
    };
    const res = await axios.patch<DataResponse<Role>>(
      `/admin/roles/${id}`,
      data
    );
    return res;
  };

  return { getRoles, updateRole, getRole, createRole, toast, router, route };
}
