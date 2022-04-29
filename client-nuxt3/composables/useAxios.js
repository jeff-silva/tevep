// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';

export default async function(params={}) {
    const req = ref({
        loading: false,
        ...params,
        resp: [],
    });

    req.value.submit = () => {
        req.value.loading = true;
        axios(params).then(resp => {
            req.value.loading = false;
            req.value.resp = resp.data;
        });
    };

    return req;
}