export default function ({ $axios, redirect }) {
    let access_token = localStorage.getItem('access_token') || false;
    if (access_token) { $axios.setToken(access_token, 'Bearer'); }
}