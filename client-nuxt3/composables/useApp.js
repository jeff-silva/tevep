// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAuthStore } from '@/stores/auth';

export default function() {
    const auth = useAuthStore();

    const req = ref({
        loading: false,
        auth,
        settings: {},
    });

    req.value.me = () => {
        useAxios({method: "post", url: "/api/auth/me"}).value.submit()
        .then(resp => {
            auth.setUser(resp.data);
        });
    };

    req.value.login = (data={}) => {
        data = JSON.parse(JSON.stringify(data));
        useAxios({method: "post", url: "/api/auth/login", data}).value.submit()
        .then(resp => {
            auth.setToken(resp.data.access_token);
            req.value.me();
        });
    };

    req.value.logout = () => {
        useAxios({method: "post", url: "/api/auth/logout"}).value.submit()
        .then(resp => {
            auth.setToken(false);
            auth.setUser(false);
        });
    };

    if (auth.token) {
        req.value.me();
    }

    return req;
}