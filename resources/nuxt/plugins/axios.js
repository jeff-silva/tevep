// https://axios.nuxtjs.org/
export default function ({ $axios, redirect }) {
    if (process.client) {
        $axios.defaults.baseURL = `${window.location.protocol}//${window.location.host}:${port}`;
    }
}