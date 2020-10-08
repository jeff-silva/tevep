const laravelNuxt = require("laravel-nuxt");
require('dotenv').config();

module.exports = laravelNuxt({
    ssr: false,
    head: {
        title: process.env.APP_NAME || '',
        meta: [
            {charset: 'utf-8'},
            {name: 'viewport', content: 'width=device-width, initial-scale=1'},
            {hid: 'description', name: 'description', content: process.env.APP_DESCRIPTION || ''},
        ],
        link: [
            {rel: 'icon', type: 'image/x-icon', href: '/favicon.ico'},
            {rel: 'stylesheet', href: 'https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css'},
            {rel: 'stylesheet', href: 'https://cdn.jsdelivr.net/npm/animate.css@4.1.0/animate.min.css'},
        ],
        script: [],
    },

    modules: [
        '@nuxtjs/pwa',
        // '@nuxtjs/axios',
        // '@nuxtjs/dotenv',

        ['nuxt-leaflet', { /* module options */ }],
    ],
    
    plugins: ['@/plugins/axios.js', '@/plugins/utils.js'],
    css: ['@/assets/bootstrap.css'],
    components: true,

    pwa: {
        meta: {
            title: (process.env.APP_NAME||'APP_NAME'),
            author: 'jeferson.i.silva@gmail.com',
        },
        manifest: {
            name: (process.env.APP_NAME||'APP_NAME'),
            short_name: (process.env.APP_DESCRIPTION||'APP_DESCRIPTION'),
            lang: 'pt-BR',
        },
    },

    // auth: {
    //     strategies: {
    //         local: {
    //             endpoints: {
    //                 login: { url: '/api/auth/login', method: 'post', propertyName: 'access_token' },
    //                 logout: { url: '/api/auth/logout', method: 'post' },
    //                 user: { url: '/api/auth/user', method: 'post', propertyName: 'user' },
    //             },
    //         },
    //     },
    // },
    
});