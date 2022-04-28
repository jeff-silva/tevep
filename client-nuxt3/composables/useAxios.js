import { useState } from '#app';
import { onMounted } from 'vue';
// import axios from 'axios';

export default async function(params={}) {
    // const r = useAsync(() => axios(params));
    // console.log(r);

    onMounted(() => {
        // console.log('vueAxios mounted', this);
    });

    return useState('axios', () => false);
}