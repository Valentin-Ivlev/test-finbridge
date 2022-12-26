import axios from 'axios';

const axiosClient = axios.create({
    baseURL: 'http://test-finbridge:8888',
    responseType: 'json',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
    },
});

export default {
    helpGet: url => axiosClient.get(url).then(res => res.data),
    helpPost: (url, data) => axiosClient.post(url, data).then(res => res.data),
    helpSend: (url, data) => axiosClient.post(url, data).then(res => res.data)
}