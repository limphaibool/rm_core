import { User } from "../User";

export interface UserResponse {
  status: string;
  message: string;
  data: User;
}
