import { defineNuxtConfig } from 'nuxt';
require('dotenv').config({ path: '../.env' });
console.log('APP_URL', process.env.APP_URL);

// https://v3.nuxtjs.org/api/configuration/nuxt.config
export default defineNuxtConfig({
    buildModules: [
        '@vueuse/nuxt',
    ],
})
