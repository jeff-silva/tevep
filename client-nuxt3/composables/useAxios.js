// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAppStore } from '@/stores/app';


export default function(params={}) {
    const app = useAppStore();

    const req = ref({
        loading: false,
        ...params,
        resp: false,
        timeout: false,
        cancelTokenSource: false,
    });

    req.value.cancel = () => {
        if (!req.value.cancelTokenSource) return;
        req.value.cancelTokenSource.cancel();
        req.value.loading = false;
    };

    req.value.submit = (submitParams={}) => {
        return new Promise((resolve, reject) => {
            req.value.loading = true;
            
            req.value.cancelTokenSource = axios.CancelToken.source();
            params.cancelToken = req.value.cancelTokenSource.token;

            if (!isNaN(submitParams.debounce)) {
                if (req.value.timeout) {
                    clearTimeout(req.value.timeout);
                }
                req.value.timeout = setTimeout(() => {
                    axios(params).then(resp => {
                        req.value.loading = false;
                        req.value.resp = resp.data;
                        resolve(resp);
                    }).catch(reject);
                }, submitParams.debounce);
                return;
            }

            if (submitParams.data) {
                params.data = submitParams.data;
            }

            if (submitParams.params) {
                params.params = submitParams.params;
            }

            axios(params).then(resp => {
                req.value.loading = false;
                req.value.resp = resp.data;
                resolve(resp);
            }).catch(reject);
        });
    };

    return req;
}