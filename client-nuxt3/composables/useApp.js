// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';

export default async function() {
    const req = ref({
        loading: false,
        auth: {
            token: false,
            user: false,
            permissions: [],
        },
        settings: {},
    });

    req.value.login = (params={}) => {
        req.value.loading = true;
        setTimeout(() => {
            req.value.loading = false;
            req.value.auth.user = {
                id: 354,
                ...params,
                created_at: '2022-01-01 00:00:00',
                updated_at: '2022-01-01 00:00:00',
            };
            req.value.auth.permissions = ['root'];
            req.value.auth.token = (() => {
                const shuffle = ([...arr]) => { let m = arr.length; while (m) { const i = Math.floor(Math.random() * m--); [arr[m], arr[i]] = [arr[i], arr[m]]; } return arr; };
                return shuffle('abcdefghijklmnopqrstuvwxyz0123456789'.split('')).join('');
            })();
        }, 1000);
    };

    req.value.logout = () => {
        req.value.loading = true;
        setTimeout(() => {
            req.value.loading = false;
            req.value.auth.token = false;
            req.value.auth.user = false;
            req.value.auth.permissions = [];
        }, 1000);
    };

    return req;
}