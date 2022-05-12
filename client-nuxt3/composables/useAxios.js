// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAppStore } from '@/stores/app';


export default function(axiosParams={}) {
    const app = useAppStore();

    let req = ref({
        loading: false,
        axios: {
            method: (axiosParams.method||'get'),
            url: (axiosParams.url||''),
            headers: (axiosParams.headers||{}),
        },
        params: (axiosParams.params||{}),
        data: (axiosParams.data||{}),
        resp: false,
        timeout: false,
        cancelTokenSource: false,
    });

    const mountedSubmit = !!axiosParams.submit;

    req.value.cancel = () => {
        req.value.loading = false;
        if (!req.value.cancelTokenSource) return;
        req.value.cancelTokenSource.cancel();
    };
    
    req.value.reset = () => {
        req.value.params = axiosParams.params;
        req.value.data = axiosParams.data;
    };
    
    req.value.clear = async () => {
        req.value.params = {};
        req.value.data = {};
    };

    req.value.submit = async (submitParams={}) => {
        return new Promise((resolve, reject) => {
            req.value.loading = true;

            if (submitParams.params) {
                req.value.params = submitParams.params;
            }
            
            if (submitParams.data) {
                req.value.data = submitParams.data;
            }

            req.value.axios.params = req.value.params;
            req.value.axios.data = req.value.data;

            // Debounce submit
            if (!isNaN(submitParams.debounce)) {
                if (req.value.timeout) {
                    clearTimeout(req.value.timeout);
                }
                return req.value.timeout = setTimeout(() => {
                    axios(req.value.axios).then(resp => {
                        req.value.loading = false;
                        req.value.resp = resp.data;
                        req.value.timeout = false;
                        resolve(resp);
                    }).catch(reject);
                }, submitParams.debounce);
            }
            
            // Submit
            axios(req.value.axios).then(resp => {
                req.value.loading = false;
                req.value.resp = resp.data;
                req.value.timeout = false;
                resolve(resp);
            });
        });
    };

    if (mountedSubmit) {
        req.value.submit();
    }

    return req;
}