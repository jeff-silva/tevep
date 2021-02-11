import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _c854e07a = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\index.vue' /* webpackChunkName: "pages/auth/index" */))
const _6017fe16 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\index.vue' /* webpackChunkName: "pages/dashboard/index" */))
const _08491073 = () => interopDefault(import('..\\resources\\nuxt\\pages\\inspire.vue' /* webpackChunkName: "pages/inspire" */))
const _4646bde8 = () => interopDefault(import('..\\resources\\nuxt\\pages\\settings\\index.vue' /* webpackChunkName: "pages/settings/index" */))
const _d1dadace = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index.vue' /* webpackChunkName: "pages/test/index" */))
const _3fc42301 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\auth.vue' /* webpackChunkName: "pages/test/index/auth" */))
const _53c6c239 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\carousel.vue' /* webpackChunkName: "pages/test/index/carousel" */))
const _409fc58a = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\drawer.vue' /* webpackChunkName: "pages/test/index/drawer" */))
const _ca2e7a16 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\endpoints.vue' /* webpackChunkName: "pages/test/index/endpoints" */))
const _51b854a1 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\example.vue' /* webpackChunkName: "pages/test/index/example" */))
const _1e2e07c2 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\grape.vue' /* webpackChunkName: "pages/test/index/grape" */))
const _6be9727e = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\input.vue' /* webpackChunkName: "pages/test/index/input" */))
const _3bb40343 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\layout.vue' /* webpackChunkName: "pages/test/index/layout" */))
const _5c9be14c = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\nav.vue' /* webpackChunkName: "pages/test/index/nav" */))
const _2472ee76 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\table.vue' /* webpackChunkName: "pages/test/index/table" */))
const _953cc452 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\tabs.vue' /* webpackChunkName: "pages/test/index/tabs" */))
const _016745f9 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\index.vue' /* webpackChunkName: "pages/tevep/index" */))
const _58b6f649 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\index.vue' /* webpackChunkName: "pages/tevep2/index" */))
const _30815dc0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\index.vue' /* webpackChunkName: "pages/user/index" */))
const _ab2ee08c = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\password.vue' /* webpackChunkName: "pages/auth/password" */))
const _22d1bfc2 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\register.vue' /* webpackChunkName: "pages/auth/register" */))
const _69e79260 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\settings.vue' /* webpackChunkName: "pages/dashboard/settings" */))
const _155ddb2b = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\users.vue' /* webpackChunkName: "pages/dashboard/users" */))
const _b6e1ce54 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\notifications.vue' /* webpackChunkName: "pages/user/notifications" */))
const _5346e758 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\notifications\\_id.vue' /* webpackChunkName: "pages/user/notifications/_id" */))
const _f85f1abe = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id.vue' /* webpackChunkName: "pages/tevep/_id" */))
const _37685fb0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\_id.vue' /* webpackChunkName: "pages/user/_id" */))
const _a67ca0f2 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab.vue' /* webpackChunkName: "pages/tevep2/_id/_tab" */))
const _7c7f974e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\atendimento.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/atendimento" */))
const _1288343e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\complexidade.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/complexidade" */))
const _1ffd3476 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\custo.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/custo" */))
const _f6f31e7e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\entrega.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/entrega" */))
const _c26cfc9c = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\expectativas.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/expectativas" */))
const _17b1a15a = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\inerencias.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/inerencias" */))
const _70f8bef8 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\inovacoes.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/inovacoes" */))
const _464a304a = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\logistica.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/logistica" */))
const _3f26f725 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\mao-de-obra.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/mao-de-obra" */))
const _1e525b2d = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\maquina.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/maquina" */))
const _337a5424 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\material.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/material" */))
const _19a02545 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\meio-ambiente.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/meio-ambiente" */))
const _b25a7236 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\metodo.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/metodo" */))
const _5a6c1bf1 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\principios.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/principios" */))
const _e300e6fe = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\qualidade.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/qualidade" */))
const _4378772b = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\relevancia.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/relevancia" */))
const _44d3819a = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\rut.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/rut" */))
const _9e36cb74 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\seguranca.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/seguranca" */))
const _1b9eefb5 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep2\\_id\\_tab\\utilidades.vue' /* webpackChunkName: "pages/tevep2/_id/_tab/utilidades" */))
const _4c6fd2aa = () => interopDefault(import('..\\resources\\nuxt\\pages\\index.vue' /* webpackChunkName: "pages/index" */))

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
    component: _c854e07a,
    name: "auth"
  }, {
    path: "/dashboard",
    component: _6017fe16,
    name: "dashboard"
  }, {
    path: "/inspire",
    component: _08491073,
    name: "inspire"
  }, {
    path: "/settings",
    component: _4646bde8,
    name: "settings"
  }, {
    path: "/test",
    component: _d1dadace,
    name: "test",
    children: [{
      path: "auth",
      component: _3fc42301,
      name: "test-index-auth"
    }, {
      path: "carousel",
      component: _53c6c239,
      name: "test-index-carousel"
    }, {
      path: "drawer",
      component: _409fc58a,
      name: "test-index-drawer"
    }, {
      path: "endpoints",
      component: _ca2e7a16,
      name: "test-index-endpoints"
    }, {
      path: "example",
      component: _51b854a1,
      name: "test-index-example"
    }, {
      path: "grape",
      component: _1e2e07c2,
      name: "test-index-grape"
    }, {
      path: "input",
      component: _6be9727e,
      name: "test-index-input"
    }, {
      path: "layout",
      component: _3bb40343,
      name: "test-index-layout"
    }, {
      path: "nav",
      component: _5c9be14c,
      name: "test-index-nav"
    }, {
      path: "table",
      component: _2472ee76,
      name: "test-index-table"
    }, {
      path: "tabs",
      component: _953cc452,
      name: "test-index-tabs"
    }]
  }, {
    path: "/tevep",
    component: _016745f9,
    name: "tevep"
  }, {
    path: "/tevep2",
    component: _58b6f649,
    name: "tevep2"
  }, {
    path: "/user",
    component: _30815dc0,
    name: "user"
  }, {
    path: "/auth/password",
    component: _ab2ee08c,
    name: "auth-password"
  }, {
    path: "/auth/register",
    component: _22d1bfc2,
    name: "auth-register"
  }, {
    path: "/dashboard/settings",
    component: _69e79260,
    name: "dashboard-settings"
  }, {
    path: "/dashboard/users",
    component: _155ddb2b,
    name: "dashboard-users"
  }, {
    path: "/user/notifications",
    component: _b6e1ce54,
    name: "user-notifications",
    children: [{
      path: ":id?",
      component: _5346e758,
      name: "user-notifications-id"
    }]
  }, {
    path: "/tevep/:id",
    component: _f85f1abe,
    name: "tevep-id"
  }, {
    path: "/user/:id",
    component: _37685fb0,
    name: "user-id"
  }, {
    path: "/tevep2/:id/:tab?",
    component: _a67ca0f2,
    name: "tevep2-id-tab",
    children: [{
      path: "atendimento",
      component: _7c7f974e,
      name: "tevep2-id-tab-atendimento"
    }, {
      path: "complexidade",
      component: _1288343e,
      name: "tevep2-id-tab-complexidade"
    }, {
      path: "custo",
      component: _1ffd3476,
      name: "tevep2-id-tab-custo"
    }, {
      path: "entrega",
      component: _f6f31e7e,
      name: "tevep2-id-tab-entrega"
    }, {
      path: "expectativas",
      component: _c26cfc9c,
      name: "tevep2-id-tab-expectativas"
    }, {
      path: "inerencias",
      component: _17b1a15a,
      name: "tevep2-id-tab-inerencias"
    }, {
      path: "inovacoes",
      component: _70f8bef8,
      name: "tevep2-id-tab-inovacoes"
    }, {
      path: "logistica",
      component: _464a304a,
      name: "tevep2-id-tab-logistica"
    }, {
      path: "mao-de-obra",
      component: _3f26f725,
      name: "tevep2-id-tab-mao-de-obra"
    }, {
      path: "maquina",
      component: _1e525b2d,
      name: "tevep2-id-tab-maquina"
    }, {
      path: "material",
      component: _337a5424,
      name: "tevep2-id-tab-material"
    }, {
      path: "meio-ambiente",
      component: _19a02545,
      name: "tevep2-id-tab-meio-ambiente"
    }, {
      path: "metodo",
      component: _b25a7236,
      name: "tevep2-id-tab-metodo"
    }, {
      path: "principios",
      component: _5a6c1bf1,
      name: "tevep2-id-tab-principios"
    }, {
      path: "qualidade",
      component: _e300e6fe,
      name: "tevep2-id-tab-qualidade"
    }, {
      path: "relevancia",
      component: _4378772b,
      name: "tevep2-id-tab-relevancia"
    }, {
      path: "rut",
      component: _44d3819a,
      name: "tevep2-id-tab-rut"
    }, {
      path: "seguranca",
      component: _9e36cb74,
      name: "tevep2-id-tab-seguranca"
    }, {
      path: "utilidades",
      component: _1b9eefb5,
      name: "tevep2-id-tab-utilidades"
    }]
  }, {
    path: "/",
    component: _4c6fd2aa,
    name: "index"
  }, {
    path: "/__nuxt_laravel",
    component: _4c6fd2aa,
    name: "__nuxt_laravel"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
