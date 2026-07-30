import axios from "axios";

const Axios = axios.create({
    baseURL: import.meta.env.VITE_API_URL ?? "",
    timeout: 5000,
    withCredentials: true,
    withXSRFToken: true,
});

export default Axios;
