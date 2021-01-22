// import axios from 'axios';

// if (process.browser) {
//     axios.defaults.baseURL = `${window.location.protocol}//${window.location.host}`;
// }


// https://axios.nuxtjs.org/
export default function ({ $axios }) {
    $axios.onRequest ((config) => {
        config.baseURL = `${window.location.protocol}//${window.location.host}`;
        return config;
    });
};
