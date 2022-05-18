import axios from "axios";



let Api = axios.create({
  baseURL: "/api",
  timeout: 3000,
  withCredentials: true,
  headers:{
    'Content-Type':'application/json',
      'Accept': 'application/json'
  }
  
});
Api.defaults.withCredentials = true;
// Api.interceptors.request.use(
// 	(config) => {

//   },);
//   Api.interceptors.response.use(
//     (response) => {
//      if (response) {
//         // response
//      }
//     },	(error) => {
//       return error;
//     }
    
// );


export default Api;