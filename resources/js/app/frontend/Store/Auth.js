import  Api  from "../Api/Api";
import  Csrf  from "../Api/Csrf";
export default {
    async register(form) {
        await Csrf.getCookie();
        return Api.post("/register",form);
      }, 
    
      async login(form) {
        await Csrf.getCookie();
        return Api.post("/login", form);
      },
    
      async logout() {
        await Csrf.getCookie();
        return Api.get("/logout");
      },
    
      auth() {
        return Api.get("/user");
      },
      async userwithCart() {
        await Csrf.getCookie();
        return Api.get("/userwithCart");
      },
      async SocialiteLogin(){
         await Csrf.getCookie();
        Api.get('/Login/facebook')
      }

}


 