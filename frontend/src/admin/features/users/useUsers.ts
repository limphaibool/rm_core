import { ref } from "vue";
import axios from "axios";
import { UserListResponse } from "../../interfaces/responses/UserListResponse";
import { User } from "../../interfaces/User";

export default function useUsers() {
  const users = ref<User[]>([]);
  const getUsers = async () => {
    try {
      const res = await axios.get<UserListResponse>("/admin/users");
      users.value = res.data.data;
      console.log(res.data);
    } catch (e) {
      console.log(e);
    }
  };
  const getUserById = async () => {};

  const createUser = async () => {};

  return { users, getUsers, getUserById, createUser };
}
