require('dotenv').config();

export default {
	srcDir: 'resources/nuxt',
	/*
	** Nuxt rendering mode
	** See https://nuxtjs.org/api/configuration-mode
	*/
	ssr: false,

	/*
	** Headers of the page
	** See https://nuxtjs.org/api/configuration-head
	*/
	head: {
		titleTemplate: '%s - ' + process.env.npm_package_name,
		title: process.env.APP_NAME || '',
		meta: [
			{charset: 'utf-8'},
			{name: 'viewport', content: 'width=device-width, initial-scale=1'},
			{hid: 'description', name: 'description', content: process.env.npm_package_description || ''},
		],
		link: [{ rel: 'icon', type: 'image/x-icon', href: '/favicon.ico' }]
	},

	/*
	** Customize the progress-bar color
	*/
	loading: { color: '#fff' },

	/*
	** Global CSS
	*/
	css: ['@/assets/variables.scss'],

	/*
	** Plugins to load before mounting the App
	** https://nuxtjs.org/guide/plugins
	*/
	plugins: [
		'@/plugins/axios.js',
		'@/plugins/utils.js',
	],

	/*
	** Auto import components
	** See https://nuxtjs.org/api/configuration-components
	*/
	components: true,

	/*
	** Nuxt.js dev-modules
	*/
	buildModules: [
		// Doc: https://github.com/nuxt-community/eslint-module
		'@nuxtjs/pwa',
	],

	/*
	** Nuxt.js modules
	*/
	modules: [
		'nuxt-laravel',
		// Doc: https://axios.nuxtjs.org/usage
		'@nuxtjs/axios',

		// https://dev.auth.nuxtjs.org/guide/setup/
		'@nuxtjs/auth-next'
	],

	auth: {
			// https://dev.auth.nuxtjs.org/api/options#redirect
			redirect: {
				login: '/auth',
				logout: '/auth',
				callback: '/dashboard',
				home: '/',
			},

			strategies: {
					// https://dev.auth.nuxtjs.org/providers/laravel-jwt
					// https://github.com/nuxt-community/auth-module/blob/dev/src/providers/laravel/jwt/index.ts
					'jwt': {
							provider: 'laravel/jwt',
							url: '/',
							name: 'jwt',
							endpoints: {
									login: {method:'POST', url:'/api/auth/login'},
									refresh: {method:'POST', url:'/api/auth/refresh'},
									logout: {method:'POST', url:'/api/auth/logout'},
									user: {method:'POST', url:'/api/auth/me'},
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
	},

	/*
	** PWA module configuration
	** See https://pwa.nuxtjs.org/
	*/
	pwa: {
		icon: {
			// https://pwa.nuxtjs.org/icon
		},
	},

	/*
	** Axios module configuration
	** See https://axios.nuxtjs.org/options
	*/
	axios: {
		debug: false,
	},

	router: {
		// base: '/app/'
	},

	/*
	** Build configuration
	** See https://nuxtjs.org/api/configuration-build/
	*/
	build: {}
}
