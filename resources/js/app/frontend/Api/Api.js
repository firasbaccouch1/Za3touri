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


export default Api;