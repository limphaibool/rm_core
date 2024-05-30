import { User } from "../User";

export interface UserListResponse {
  status: string;
  message: string;
  data: User[];
}
