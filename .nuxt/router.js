import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _7d493e30 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\index.vue' /* webpackChunkName: "pages/auth/index" */))
const _44eaf372 = () => interopDefault(import('..\\resources\\nuxt\\pages\\business.vue' /* webpackChunkName: "pages/business" */))
const _0bd8f552 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard.vue' /* webpackChunkName: "pages/dashboard" */))
const _5ae4e3da = () => interopDefault(import('..\\resources\\nuxt\\pages\\search.vue' /* webpackChunkName: "pages/search" */))
const _c32b4778 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test.vue' /* webpackChunkName: "pages/test" */))
const _e6c8cd18 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\index.vue' /* webpackChunkName: "pages/tevep/index" */))
const _56072ee5 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\index.vue' /* webpackChunkName: "pages/user/index" */))
const _39d5f075 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\password.vue' /* webpackChunkName: "pages/auth/password" */))
const _9b81bf06 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\register.vue' /* webpackChunkName: "pages/auth/register" */))
const _7cd0160a = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\notifications.vue' /* webpackChunkName: "pages/user/notifications" */))
const _3cfb02e0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\settings.vue' /* webpackChunkName: "pages/user/settings" */))
const _116968dc = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id.vue' /* webpackChunkName: "pages/tevep/_id" */))
const _47b6e790 = () => interopDefault(import('..\\resources\\nuxt\\pages\\index.vue' /* webpackChunkName: "pages/index" */))

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
    component: _7d493e30,
    name: "auth"
  }, {
    path: "/business",
    component: _44eaf372,
    name: "business"
  }, {
    path: "/dashboard",
    component: _0bd8f552,
    name: "dashboard"
  }, {
    path: "/search",
    component: _5ae4e3da,
    name: "search"
  }, {
    path: "/test",
    component: _c32b4778,
    name: "test"
  }, {
    path: "/tevep",
    component: _e6c8cd18,
    name: "tevep"
  }, {
    path: "/user",
    component: _56072ee5,
    name: "user"
  }, {
    path: "/auth/password",
    component: _39d5f075,
    name: "auth-password"
  }, {
    path: "/auth/register",
    component: _9b81bf06,
    name: "auth-register"
  }, {
    path: "/user/notifications",
    component: _7cd0160a,
    name: "user-notifications"
  }, {
    path: "/user/settings",
    component: _3cfb02e0,
    name: "user-settings"
  }, {
    path: "/tevep/:id",
    component: _116968dc,
    name: "tevep-id"
  }, {
    path: "/",
    component: _47b6e790,
    name: "index"
  }, {
    path: "/__laravel_nuxt__",
    component: _47b6e790,
    name: "__laravel_nuxt__"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
