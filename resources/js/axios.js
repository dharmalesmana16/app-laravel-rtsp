import axios from "axios";
let token = localStorage.getItem("token");
const Axios = axios.create({
    baseURL: "http://localhost:8000",
    timeout: 5000,
    headers: {
        // "Content-Type: "application/json",
        Authorization: `Bearer ${token}`,
    },
    withCredentials: true,
    withXSRFToken: true,
});

export default Axios;
