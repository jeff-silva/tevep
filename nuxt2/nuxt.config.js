import { defineNuxtConfig } from '@nuxt/bridge';
// import colors from 'vuetify/es5/util/colors';
const { env } = require('../scripts/base');

export default defineNuxtConfig({
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,
  // bridge: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    titleTemplate: '%s - Nuxt2',
    title: 'Nuxt2',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }
    ]
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: [],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: [],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [

    // https://go.nuxtjs.dev/vuetify
    // https://go.nuxtjs.dev/config-vuetify
    ['@nuxtjs/vuetify', {
      // customVariables: ['~/assets/variables.scss'],
      // theme: {
      //   dark: true,
      //   themes: {
      //     dark: {
      //       primary: colors.blue.darken2,
      //       accent: colors.grey.darken3,
      //       secondary: colors.amber.darken3,
      //       info: colors.teal.lighten1,
      //       warning: colors.amber.base,
      //       error: colors.deepOrange.accent4,
      //       success: colors.green.accent3
      //     }
      //   }
      // },
    }],
  ],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    
    // https://go.nuxtjs.dev/axios
    // Axios module configuration: https://go.nuxtjs.dev/config-axios
    ['@nuxtjs/axios', {
      // Workaround to avoid enforcing hard-coded localhost:3000: https://github.com/nuxt-community/axios-module/issues/308
      baseURL: '/',
      proxy: true,
    }],

    // https://dev.auth.nuxtjs.org
    ['@nuxtjs/auth-next', {
      strategies: {
        local: {
          endpoints: {
            login: { url: '/api/auth/login', method: 'post' },
            logout: { url: '/api/auth/logout', method: 'post' },
            user: { url: '/api/auth/me', method: 'get' },
          },
        },
      },
    }],

    // https://go.nuxtjs.dev/pwa
    ['@nuxtjs/pwa', {
      manifest: {
        lang: 'en'
      }
    }],
  ],

  proxy: {
    '/api/': { target: env.SERVER_HOST },
    '/uploads/': { target: env.SERVER_HOST },
    '/files/': { target: env.SERVER_HOST },
  },

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {},
});