import { ref } from "vue";
import axios from "axios";
import { User } from "../../../shared/interfaces/User";

export default function useUsers() {
  const users = ref<User[]>([]);
  const getUsers = async () => {
    try {
      const res = await axios.get<DataResponse<User[]>>("/admin/users");
      users.value = res.data.data;
    } catch (e) {}
  };
  const getUserById = async () => {};

  const createUser = async () => {};

  return { users, getUsers, getUserById, createUser };
}
