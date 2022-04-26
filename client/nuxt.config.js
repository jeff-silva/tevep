require('dotenv').config({ path: '../.env' });

export default {
  // Disable server-side rendering: https://go.nuxtjs.dev/ssr-mode
  ssr: false,

  // Target: https://go.nuxtjs.dev/config-target
  target: 'static',
  proxy: {
    '/api/': process.env.APP_URL,
    '/uploads/': process.env.APP_URL,
    '/assets/': process.env.APP_URL,
  },

  // Global page headers: https://go.nuxtjs.dev/config-head
  head: {
    title: 'client',
    meta: [
      { charset: 'utf-8' },
      { name: 'viewport', content: 'width=device-width, initial-scale=1' },
      { hid: 'description', name: 'description', content: '' },
      { name: 'format-detection', content: 'telephone=no' }
    ],
    link: [
      { rel: 'icon', type: 'image/x-icon', href: '/icon.png' }
    ],
    // script: [
    //   {src: "/assets/app.js", defer:true},
    // ],
  },

  // https://nuxtjs.org/examples/loading/custom-loading-component/
  loadingIndicator: {
    name: 'folding-cube',
    color: '#fff',
    background: '#3459e6',
  },

  // Global CSS: https://go.nuxtjs.dev/config-css
  css: ['@/app.css'],

  // Plugins to run before rendering page: https://go.nuxtjs.dev/config-plugins
  plugins: ['@/plugins/app.js'],

  // Auto import components: https://go.nuxtjs.dev/config-components
  components: true,

  router: {
    middleware: ["global"],
  },

  // Modules for dev and build (recommended): https://go.nuxtjs.dev/config-modules
  buildModules: [],

  // Modules: https://go.nuxtjs.dev/config-modules
  modules: [
    // https://go.nuxtjs.dev/axios
    ['@nuxtjs/axios', { proxy: true }],

    // https://go.nuxtjs.dev/pwa
    ['@nuxtjs/pwa', {
      manifest: {lang: 'en'},
      icon: {source:'~/static/icon.png'},
    }],

    // https://github.com/nuxt-community/google-gtag-module
    ['@nuxtjs/google-gtag', {
      id: false,
      config: {
        anonymize_ip: true, // anonymize IP 
        send_page_view: false, // might be necessary to avoid duplicated page track on page reload
        // linker: {domains: ['domain.com','domain.org']}
      },
      debug: true, // enable to track in dev mode
      disableAutoPageTrack: false,
    }],

    // https://auth.nuxtjs.org/
    ['@nuxtjs/auth-next', {

      plugins: ['~/plugins/auth.js'],

      // https://dev.auth.nuxtjs.org/api/options#redirect
      redirect: {
        login: '/',
        logout: '/',
        callback: false,
        home: false,
      },
  
      // https://dev.auth.nuxtjs.org/providers/laravel-jwt
      // https://github.com/nuxt-community/auth-module/blob/dev/src/providers/laravel/jwt/index.ts
      strategies: {
        'jwt': {
          provider: 'laravel/jwt',
          url: '/',
          name: 'jwt',
          endpoints: {
            login: {method:'POST', url:'/api/auth/login'},
            refresh: {method:'POST', url:'/api/auth/refresh'},
            logout: {method:'POST', url:'/api/auth/logout'},
            user: {method:'POST', url:'/api/auth/me', data:{test:1}},
          },
          token: {
            property: 'access_token',
            maxAge: (60 * 60),
          },
          refreshToken: {
            maxAge: (20160 * 60),
          },
        },
      },
    }],

    ['nuxt-leaflet', { /* module options */ }],
  ],

  // Axios module configuration: https://go.nuxtjs.dev/config-axios
  axios: {},

  // Build Configuration: https://go.nuxtjs.dev/config-build
  build: {
    transpile: [/^element-ui/],

    extend(config, {isDev, isClient}) {
      config.resolve.alias["vue"] = "vue/dist/vue.common";
    },
  }
}
