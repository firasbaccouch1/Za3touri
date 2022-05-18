
import Api from "./Api";

export default {
  getCookie() {
    return Api.get("/sanctum/csrf-cookie");
  }
};