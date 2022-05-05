import { defineNuxtPlugin } from '#app';
import axios from 'axios';

import '@mdi/font/css/materialdesignicons.css';

import { createVuetify } from 'vuetify';
import * as vuetifyComponents from 'vuetify/components';

export default defineNuxtPlugin((nuxtApp) => {
    const vuetify = createVuetify({
        components: vuetifyComponents,
        icons: { defaultSet: 'mdi' },
    });
    
    nuxtApp.vueApp.use(vuetify);
    nuxtApp.provide('axios', axios);
});