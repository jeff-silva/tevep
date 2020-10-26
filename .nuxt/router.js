import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _22391c83 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\index.vue' /* webpackChunkName: "pages/auth/index" */))
const _04eb2796 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\index.vue' /* webpackChunkName: "pages/dashboard/index" */))
const _9c1e059a = () => interopDefault(import('..\\resources\\nuxt\\pages\\inspire.vue' /* webpackChunkName: "pages/inspire" */))
const _bad42ab0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\settings\\index.vue' /* webpackChunkName: "pages/settings/index" */))
const _1d761f59 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index.vue' /* webpackChunkName: "pages/test/index" */))
const _47755139 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\index.vue' /* webpackChunkName: "pages/tevep/index" */))
const _92362b00 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\index.vue' /* webpackChunkName: "pages/user/index" */))
const _b5be6a0c = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\password.vue' /* webpackChunkName: "pages/auth/password" */))
const _1d89fb02 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\register.vue' /* webpackChunkName: "pages/auth/register" */))
const _4311f8e0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\settings.vue' /* webpackChunkName: "pages/dashboard/settings" */))
const _42f4466b = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\users.vue' /* webpackChunkName: "pages/dashboard/users" */))
const _df2f643e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id.vue' /* webpackChunkName: "pages/tevep/_id" */))
const _78a8e630 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\_id.vue' /* webpackChunkName: "pages/user/_id" */))
const _bbf7992a = () => interopDefault(import('..\\resources\\nuxt\\pages\\index.vue' /* webpackChunkName: "pages/index" */))

// TODO: remove in Nuxt 3
const emptyFn = () => {}
const originalPush = Router.prototype.push
Router.prototype.push = function push (location, onComplete = emptyFn, onAbort) {
  return originalPush.call(this, location, onComplete, onAbort)
}

Vue.use(Router)

export const routerOptions = {
  mode: 'history',
  base: decodeURI('/'),
  linkActiveClass: 'nuxt-link-active',
  linkExactActiveClass: 'nuxt-link-exact-active',
  scrollBehavior,

  routes: [{
    path: "/auth",
    component: _22391c83,
    name: "auth"
  }, {
    path: "/dashboard",
    component: _04eb2796,
    name: "dashboard"
  }, {
    path: "/inspire",
    component: _9c1e059a,
    name: "inspire"
  }, {
    path: "/settings",
    component: _bad42ab0,
    name: "settings"
  }, {
    path: "/test",
    component: _1d761f59,
    name: "test"
  }, {
    path: "/tevep",
    component: _47755139,
    name: "tevep"
  }, {
    path: "/user",
    component: _92362b00,
    name: "user"
  }, {
    path: "/auth/password",
    component: _b5be6a0c,
    name: "auth-password"
  }, {
    path: "/auth/register",
    component: _1d89fb02,
    name: "auth-register"
  }, {
    path: "/dashboard/settings",
    component: _4311f8e0,
    name: "dashboard-settings"
  }, {
    path: "/dashboard/users",
    component: _42f4466b,
    name: "dashboard-users"
  }, {
    path: "/tevep/:id",
    component: _df2f643e,
    name: "tevep-id"
  }, {
    path: "/user/:id",
    component: _78a8e630,
    name: "user-id"
  }, {
    path: "/",
    component: _bbf7992a,
    name: "index"
  }, {
    path: "/__nuxt_laravel",
    component: _bbf7992a,
    name: "__nuxt_laravel"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
