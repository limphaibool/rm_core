import { ref } from "vue";
import { User } from "../interfaces/User";
import axios from "axios";
export default function useProfile() {
  const user = ref<User>({});
  const getUser = async () => {
    try {
      const res = await axios.get<BaseResponse<User>>("/auth/user");
      user.value = res.data.data;
    } catch (e) {
      console.log(e);
    }
  };
  return { user, getUser };
}
