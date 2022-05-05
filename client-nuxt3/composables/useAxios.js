// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAppStore } from '@/stores/app';


export default function(params={}) {
    const app = useAppStore();
    
    if (app.access_token) {
        params.headers = params.headers || {};
        params.headers['Authorization'] = `Bearer ${app.access_token}`;
    }

    const isDev = process.env.NODE_ENV !== 'production';
    if (isDev && params.url.startsWith('/api')) {
        params.url = `http://localhost:5001${params.url}`;
    }

    const req = ref({
        loading: false,
        ...params,
        resp: false,
    });

    req.value.submit = () => {
        return new Promise((resolve, reject) => {
            if (req.value.loading) return;
            req.value.loading = true;

            axios(params).then(resp => {
                req.value.loading = false;
                req.value.resp = resp.data;
                resolve(resp);
            }).catch(reject);
        });
    };

    return req;
}