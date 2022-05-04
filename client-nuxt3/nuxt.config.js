import { defineNuxtConfig } from 'nuxt';
require('dotenv').config({ path: '../.env' });

let back = new URL(process.env.APP_URL);
back.port = ''+(parseInt(back.port)+1);

// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
    ssr: false,

    buildModules: [

        // https://vueuse.org/
        '@vueuse/nuxt',

        // https://pinia.vuejs.org/
        '@pinia/nuxt',

        // https://vuetifyjs.com/en/getting-started/installation/
        // ['@nuxtjs/vuetify', {}],
    ],
});