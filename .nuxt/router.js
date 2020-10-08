import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _51dd451c = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\index.vue' /* webpackChunkName: "pages/auth/index" */))
const _b19159b0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\business.vue' /* webpackChunkName: "pages/business" */))
const _19cee748 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard.vue' /* webpackChunkName: "pages/dashboard" */))
const _d5dc8de0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\search.vue' /* webpackChunkName: "pages/search" */))
const _5dd1f20c = () => interopDefault(import('..\\resources\\nuxt\\pages\\test.vue' /* webpackChunkName: "pages/test" */))
const _2da52e2a = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\index.vue' /* webpackChunkName: "pages/tevep/index" */))
const _6bbd2b6f = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\index.vue' /* webpackChunkName: "pages/user/index" */))
const _8265a0aa = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\password.vue' /* webpackChunkName: "pages/auth/password" */))
const _37365fb3 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\register.vue' /* webpackChunkName: "pages/auth/register" */))
const _c71470f6 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\notifications.vue' /* webpackChunkName: "pages/user/notifications" */))
const _7c1b7bd4 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\settings.vue' /* webpackChunkName: "pages/user/settings" */))
const _121cb312 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id.vue' /* webpackChunkName: "pages/tevep/_id" */))
const _6a9f939a = () => interopDefault(import('..\\resources\\nuxt\\pages\\index.vue' /* webpackChunkName: "pages/index" */))

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
    component: _51dd451c,
    name: "auth"
  }, {
    path: "/business",
    component: _b19159b0,
    name: "business"
  }, {
    path: "/dashboard",
    component: _19cee748,
    name: "dashboard"
  }, {
    path: "/search",
    component: _d5dc8de0,
    name: "search"
  }, {
    path: "/test",
    component: _5dd1f20c,
    name: "test"
  }, {
    path: "/tevep",
    component: _2da52e2a,
    name: "tevep"
  }, {
    path: "/user",
    component: _6bbd2b6f,
    name: "user"
  }, {
    path: "/auth/password",
    component: _8265a0aa,
    name: "auth-password"
  }, {
    path: "/auth/register",
    component: _37365fb3,
    name: "auth-register"
  }, {
    path: "/user/notifications",
    component: _c71470f6,
    name: "user-notifications"
  }, {
    path: "/user/settings",
    component: _7c1b7bd4,
    name: "user-settings"
  }, {
    path: "/tevep/:id",
    component: _121cb312,
    name: "tevep-id"
  }, {
    path: "/",
    component: _6a9f939a,
    name: "index"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
