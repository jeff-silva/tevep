// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAuthStore } from '@/stores/auth';

export default function(params={}) {
    const auth = useAuthStore();
    
    if (auth.token) {
        params.headers = params.headers || {};
        params.headers['Authorization'] = `Bearer ${auth.token}`;
    }

    if (params.url.startsWith('/api')) {
        params.url = `http://localhost:5001${params.url}`;
    }

    console.log(params);
    const req = ref({
        loading: false,
        ...params,
        resp: false,
    });

    req.value.submit = () => {
        return new Promise((resolve, reject) => {
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