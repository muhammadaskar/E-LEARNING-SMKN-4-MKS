import axios from "axios";
import store from "./store";
import router from "./router";

const axiosClient = axios.create({
    baseURL: `https://api.elearning.muhammadaskar.com/api`
    // baseURL: `http://localhost:8000/api`
})

axiosClient.defaults.headers.common['Access-Control-Allow-Origin'] = '*';

axiosClient.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${store.state.user.token}`
    return config;
})

export default axiosClient