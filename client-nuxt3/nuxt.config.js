import { defineNuxtConfig } from 'nuxt';
require('dotenv').config({ path: '../.env' });

let back = new URL(process.env.APP_URL);
back.port = ''+(parseInt(back.port)+1);

// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
    ssr: false,

    // head: {
    //     link: [
    //         {rel:'stylesheet', type: 'text/css', href:'https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css'},
    //     ],
    // },

    css: ['vuetify/lib/styles/main.css'],

    buildModules: [

        // https://vueuse.org/
        '@vueuse/nuxt',

        // https://pinia.vuejs.org/
        '@pinia/nuxt',

        // https://vuetifyjs.com/en/getting-started/installation/
        // ['@nuxtjs/vuetify', {}],
    ],

    vite: {
        define: {
            'process.env.DEBUG': 'false',
        },
    },

    hooks: {
        'vite:extendConfig': (config, { isClient, isServer }) => {
            if (isClient) config.resolve.alias.vue = 'vue/dist/vue.esm-bundler';
        },
    },
});