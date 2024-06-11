import axios from "axios";

export abstract class ErrorHandler {
  public static handle(err: unknown): Error {
    if (axios.isAxiosError<BaseResponse>(err)) {
      if (err.response?.data.status == 3) {
        return new Error("User is unauthenticated");
      } else if (err.response?.data.status == 5) {
        return new Error(err.response.data.data.toString());
      }
    }
    return new Error("An error has occured");
  }
}
