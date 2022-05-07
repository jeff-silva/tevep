import { defineNuxtPlugin } from '#app';
import axios from 'axios';

import '@mdi/font/css/materialdesignicons.css';

import { createVuetify } from 'vuetify';
import * as vuetifyComponents from 'vuetify/components';

import 'leaflet/dist/leaflet.css'
import * as leafletComponents from '@vue-leaflet/vue-leaflet';

const isDev = process.env.NODE_ENV !== 'production';

export default defineNuxtPlugin((nuxtApp) => {
    const vuetify = createVuetify({
        components: vuetifyComponents,
        icons: { defaultSet: 'mdi' },
    });
    
    nuxtApp.vueApp.use(vuetify);

    for(let i in leafletComponents) {
        nuxtApp.vueApp.component(i, leafletComponents[i]);
    }
    
    axios.interceptors.request.use(config => {
        const access_token = localStorage.getItem('access_token') || false;
        if (access_token) {
            config.headers = config.headers || {};
            config.headers['Authorization'] = `Bearer ${access_token}`;
        }

        if (isDev && (config.url||'').startsWith('/api')) {
            config.url = `http://localhost:5001${config.url}`;
        }
        return config;
    });
    nuxtApp.provide('axios', axios);
    nuxtApp.provide('log', console.log);

    // nuxtApp.provide('log', function() {
    //     Array.prototype.slice.call(arguments).forEach(item => {
    //         console.log(item);
    //     });
    // });
});