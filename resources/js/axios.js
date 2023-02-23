import axios from "axios";

// axios.defaults.withCredentials = true;

// const axiosClient = axios.create({
//     baseURL: 'http://localhost:8000'
// })

axios.interceptors.request.use(config => {
    config.headers.Authorization = `Bearer ${sessionStorage.getItem('AUTH-TOKEN')}`
    config.headers.Accept = "application/json"
    return config
})

export default axios