// import { useState } from '#app';
import { ref } from 'vue';
import axios from 'axios';
import { useAppStore } from '@/stores/app';


export default function(axiosParams={}) {
    axiosParams.headers = axiosParams.headers||{};
    axiosParams.headers['Content-Type'] = 'multipart/form-data';

    const app = useAppStore();
    const axiosData = {
        method: (axiosParams.method||'get'),
        url: (axiosParams.url||''),
        headers: (axiosParams.headers||{}),
    };

    let cancelTokenSource = false;
    let onSubmit = (axiosParams.onSubmit||false);
    let onSubmited = (axiosParams.onSubmited||false);
    let paramsTimeout = false;

    let req = ref({
        loading: false,
        status: false,
        params: (axiosParams.params||{}),
        data: (axiosParams.data||{}),
        err: {message:false, fields:{}},
        resp: (axiosParams.resp||{}),
    });

    const mountedSubmit = !!axiosParams.submit;
    
    req.value.errorField = (name) => {
        return req.value.err.fields[name] || [];
    };

    req.value.cancel = () => {
        req.value.loading = false;
        if (!cancelTokenSource) return;
        cancelTokenSource.cancel();
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
            req.value.err = {message:false, fields:{}};
            

            if (submitParams.params) {
                req.value.params = submitParams.params;
            }
            
            if (submitParams.data) {
                req.value.data = submitParams.data;
            }

            axiosData.params = req.value.params;

            let formData = new FormData();
            for(let i in req.value.data) {
                let value = req.value.data[i];

                if (value!==null && (value.constructor.name=='Object' || value.constructor.name=='Array')) {
                    value = JSON.stringify(value);
                }

                formData.append(i, value);
            }
            axiosData.data = formData;

            if (typeof onSubmit=='function') {
                onSubmit(req.value);
            }

            // Axios error
            const axiosThen = (resp) => {
                req.value.loading = false;
                req.value.status = resp.status;
                req.value.resp = resp.data;

                if (typeof onSubmited=='function') {
                    onSubmited(resp);
                }

                resolve(resp);
            };

            const axiosCatch = (err) => {
                req.value.loading = false;
                req.value.status = err.response.status;
                req.value.err = {
                    message: err.response.data.message,
                    fields: err.response.data.fields,
                };
                // reject(err);
            };

            // Debounce submit
            if (!isNaN(submitParams.debounce)) {
                if (paramsTimeout) {
                    clearTimeout(paramsTimeout);
                }
                return paramsTimeout = setTimeout(() => {
                    axios(axiosData).then(axiosThen).catch(axiosCatch);
                }, submitParams.debounce);
            }
            
            // Submit
            axios(axiosData).then(axiosThen).catch(axiosCatch);
        });
    };

    if (mountedSubmit) {
        req.value.submit();
    }

    return req;
}