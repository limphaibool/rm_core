import axios from "axios";

export abstract class ErrorHandler {
  public static handle(err: unknown): Error {
    if (axios.isAxiosError<ErrorResponse>(err)) {
      if (err.response?.data.status == 3) {
        return new Error("User is unauthenticated");
      }
    }
    return new Error("An error has occured");
  }
}
