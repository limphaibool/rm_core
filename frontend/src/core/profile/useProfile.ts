import { computed, ref } from "vue";
import { User } from "../../shared/interfaces/User";
import axios from "axios";
import { useToast } from "primevue/usetoast";
import { ErrorHandler } from "../../shared/helpers/errorHandler";

export default function useProfile() {
  const toast = useToast();
  const user = ref<User>({
    id: 0,
    username: "",
    nameThai: "",
    nameEng: "",
    email: "",
  });

  const errors = ref({
    nameThai: null as string | null,
    nameEng: null as string | null,
    email: null as string | null,
  });

  const isValidEmail = (email: string): boolean => {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  };

  const isValidName = (name: string): boolean => {
    return name.trim().length > 0;
  };

  const validate = () => {
    errors.value.email = isValidEmail(user.value.email)
      ? null
      : "Invalid email format";
    errors.value.nameEng = isValidName(user.value.nameEng)
      ? null
      : "Invalid name";
    errors.value.nameThai = isValidName(user.value.nameThai)
      ? null
      : "Invalid name";
  };

  const getUser = async () => {
    try {
      const res = await axios.get<DataResponse<User>>("/auth/user");
      user.value = res.data.data;
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
  const isValid = computed(() => {
    return errors.value.email === null;
  });

  const updateUser = async () => {
    validate();
    if (!isValid.value) return;
    try {
      const res = await axios.patch<DataResponse<User>>("/auth/user", {
        nameThai: user.value.nameThai.trim(),
        nameEng: user.value.nameEng.trim(),
        email: user.value.email.trim(),
      });
      user.value = res.data.data;
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
  return { user, errors, getUser, updateUser };
}
