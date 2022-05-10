// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAppStore } from '@/stores/app';


export default function(axiosParams={}) {
    const app = useAppStore();

    const req = ref({
        loading: false,
        ...axiosParams,
        resp: false,
        timeout: false,
        cancelTokenSource: false,
    });

    req.value.cancel = () => {
        if (!req.value.cancelTokenSource) return;
        req.value.cancelTokenSource.cancel();
        req.value.loading = false;
    };

    const mountedSubmit = !!req.value.submit;
    req.value.submit = (submitParams={}) => {
        return new Promise((resolve, reject) => {
            submitParams = {...axiosParams, ...submitParams};

            req.value.loading = true;
            req.value.cancelTokenSource = axios.CancelToken.source();
            axiosParams.cancelToken = req.value.cancelTokenSource.token;

            if (!isNaN(submitParams.debounce)) {
                if (req.value.timeout) {
                    clearTimeout(req.value.timeout);
                }
                req.value.timeout = setTimeout(() => {
                    axios(axiosParams).then(resp => {
                        req.value.loading = false;
                        req.value.resp = resp.data;
                        resolve(resp);
                    }).catch(reject);
                }, submitParams.debounce);
                return;
            }

            axios(submitParams).then(resp => {
                req.value.loading = false;
                req.value.resp = resp.data;
                resolve(resp);
            }).catch(reject);
        });
    };

    if (mountedSubmit) {
        req.value.submit();
    }

    return req;
}