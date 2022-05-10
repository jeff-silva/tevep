// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAppStore } from '@/stores/app';


export default function(axiosParams={}) {
    const app = useAppStore();

    let req = ref({
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
    
    req.value.reset = () => {
        req.value.params = axiosParams.params;
        req.value.data = axiosParams.data;
    };
    
    req.value.clear = async () => {
        req.value.params = {};
        req.value.data = {};
    };

    const mountedSubmit = !!req.value.submit;
    req.value.submit = (submitParams={}) => {
        return new Promise((resolve, reject) => {
            req.value.loading = true;
            req.value.cancelTokenSource = axios.CancelToken.source();
            axiosParams.cancelToken = req.value.cancelTokenSource.token;

            if (typeof submitParams.params=='object') {
                req.value.params = submitParams.params;
            }

            if (typeof submitParams.data=='object') {
                req.value.data = submitParams.data;
            }

            if (!isNaN(submitParams.debounce)) {
                if (req.value.timeout) {
                    clearTimeout(req.value.timeout);
                }
                return req.value.timeout = setTimeout(() => {
                    axios(req.value).then(resp => {
                        req.value.loading = false;
                        req.value.resp = resp.data;
                        resolve(resp);
                    }).catch(reject);
                }, submitParams.debounce);
            }

            axios(req.value).then(resp => {
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