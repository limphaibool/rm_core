import { ref } from "vue";
import { User } from "../../shared/interfaces/User";
import axios from "axios";
export default function useProfile() {
  const user = ref<User>({
    id: 0,
    username: "",
    name: "",
    nameThai: "",
    nameEng: "",
    email: "",
  });

  const getUser = async () => {
    const res = await axios.get<BaseResponse<User>>("/auth/user");
    return res.data.data;
  };

  const updateUser = async () => {};
  return { user, getUser, updateUser };
}
