import { defineNuxtConfig } from 'nuxt';
const { env } = require('../scripts/base');

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
            'process.env.DEBUG': false,
        },
        server: {
            proxy: {
                '/api/': { target: env.LARAVEL_HOST },
                '/uploads/': { target: env.LARAVEL_HOST },
                '/files/': { target: env.LARAVEL_HOST },
            },
        },
    },

    hooks: {
        'vite:extendConfig': (config, { isClient, isServer }) => {
            if (isClient) config.resolve.alias.vue = 'vue/dist/vue.esm-bundler';
        },
        'builder:watch': () => {
            const base = require('../scripts/base');
            base.run(base.rootPath, 'npm run sync');
        },
    },
});