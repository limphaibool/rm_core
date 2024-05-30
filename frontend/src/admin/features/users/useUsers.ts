import { ref } from "vue";
import axios from "axios";
import { UserResponse } from "../../interfaces/responses/UserResponse";

export default function useUsers() {
  const users = ref([]);
  const getUsers = async () => {
    try {
      const res = await axios.get<UserResponse>("/admin/users");
    } catch (e) {
      console.log(e);
    }
  };
  const getUserById = async () => {};

  const createUser = async () => {};
}
