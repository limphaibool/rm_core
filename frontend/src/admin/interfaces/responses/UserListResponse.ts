import { User } from "../../../shared/interfaces/User";

export interface UserListResponse {
  status: string;
  message: string;
  data: User[];
}
