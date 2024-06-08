import { User } from "../../../shared/interfaces/User";

export interface UserResponse {
  status: string;
  message: string;
  data: User;
}
