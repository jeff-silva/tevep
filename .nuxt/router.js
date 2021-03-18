import Vue from 'vue'
import Router from 'vue-router'
import { interopDefault } from './utils'
import scrollBehavior from './router.scrollBehavior.js'

const _b8d5c64c = () => interopDefault(import('..\\resources\\nuxt\\pages\\admin\\index.vue' /* webpackChunkName: "pages/admin/index" */))
const _c854e07a = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\index.vue' /* webpackChunkName: "pages/auth/index" */))
const _6017fe16 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\index.vue' /* webpackChunkName: "pages/dashboard/index" */))
const _47b87d60 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index.vue' /* webpackChunkName: "pages/docs/index" */))
const _3961a710 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\auth.vue' /* webpackChunkName: "pages/docs/index/auth" */))
const _819b8fa0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\carousel.vue' /* webpackChunkName: "pages/docs/index/carousel" */))
const _622fba40 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\colors.vue' /* webpackChunkName: "pages/docs/index/colors" */))
const _2d8e4d41 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\drawer.vue' /* webpackChunkName: "pages/docs/index/drawer" */))
const _c627e844 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\endpoints.vue' /* webpackChunkName: "pages/docs/index/endpoints" */))
const _d03d27ac = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\input.vue' /* webpackChunkName: "pages/docs/index/input" */))
const _0530c518 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\input\\index.vue' /* webpackChunkName: "pages/docs/index/input/index" */))
const _5d224502 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\input\\loading.vue' /* webpackChunkName: "pages/docs/index/input/loading" */))
const _144bbca6 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\input\\select.vue' /* webpackChunkName: "pages/docs/index/input/select" */))
const _88c6a3a4 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\table.vue' /* webpackChunkName: "pages/docs/index/table" */))
const _58eca74e = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\tabs.vue' /* webpackChunkName: "pages/docs/index/tabs" */))
const _49960e62 = () => interopDefault(import('..\\resources\\nuxt\\pages\\docs\\index\\test.vue' /* webpackChunkName: "pages/docs/index/test" */))
const _08491073 = () => interopDefault(import('..\\resources\\nuxt\\pages\\inspire.vue' /* webpackChunkName: "pages/inspire" */))
const _4646bde8 = () => interopDefault(import('..\\resources\\nuxt\\pages\\settings\\index.vue' /* webpackChunkName: "pages/settings/index" */))
const _d1dadace = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index.vue' /* webpackChunkName: "pages/test/index" */))
const _3fc42301 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\auth.vue' /* webpackChunkName: "pages/test/index/auth" */))
const _53c6c239 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\carousel.vue' /* webpackChunkName: "pages/test/index/carousel" */))
const _75413289 = () => interopDefault(import('..\\resources\\nuxt\\pages\\test\\index\\colors.vue' /* webpackChunkName: "pages/test/index/colors" */))
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
const _30815dc0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\index.vue' /* webpackChunkName: "pages/user/index" */))
const _547954cb = () => interopDefault(import('..\\resources\\nuxt\\pages\\admin\\settings.vue' /* webpackChunkName: "pages/admin/settings" */))
const _b3fdd552 = () => interopDefault(import('..\\resources\\nuxt\\pages\\admin\\settings\\index.vue' /* webpackChunkName: "pages/admin/settings/index" */))
const _5485c321 = () => interopDefault(import('..\\resources\\nuxt\\pages\\admin\\settings\\email.vue' /* webpackChunkName: "pages/admin/settings/email" */))
const _a9155318 = () => interopDefault(import('..\\resources\\nuxt\\pages\\admin\\settings\\email-sent.vue' /* webpackChunkName: "pages/admin/settings/email-sent" */))
const _797a5b8d = () => interopDefault(import('..\\resources\\nuxt\\pages\\admin\\settings\\email-templates.vue' /* webpackChunkName: "pages/admin/settings/email-templates" */))
const _ab2ee08c = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\password.vue' /* webpackChunkName: "pages/auth/password" */))
const _22d1bfc2 = () => interopDefault(import('..\\resources\\nuxt\\pages\\auth\\register.vue' /* webpackChunkName: "pages/auth/register" */))
const _69e79260 = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\settings.vue' /* webpackChunkName: "pages/dashboard/settings" */))
const _155ddb2b = () => interopDefault(import('..\\resources\\nuxt\\pages\\dashboard\\users.vue' /* webpackChunkName: "pages/dashboard/users" */))
const _b6e1ce54 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\notifications.vue' /* webpackChunkName: "pages/user/notifications" */))
const _5346e758 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\notifications\\_id.vue' /* webpackChunkName: "pages/user/notifications/_id" */))
const _37685fb0 = () => interopDefault(import('..\\resources\\nuxt\\pages\\user\\_id.vue' /* webpackChunkName: "pages/user/_id" */))
const _3f3ab192 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab.vue' /* webpackChunkName: "pages/tevep/_id/_tab" */))
const _8fb98aae = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\atendimento.vue' /* webpackChunkName: "pages/tevep/_id/_tab/atendimento" */))
const _2ef41024 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\complexidade.vue' /* webpackChunkName: "pages/tevep/_id/_tab/complexidade" */))
const _157b6815 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\custo.vue' /* webpackChunkName: "pages/tevep/_id/_tab/custo" */))
const _33891f11 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\entrega.vue' /* webpackChunkName: "pages/tevep/_id/_tab/entrega" */))
const _74c74562 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\expectativas.vue' /* webpackChunkName: "pages/tevep/_id/_tab/expectativas" */))
const _40ac910a = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\inerencias.vue' /* webpackChunkName: "pages/tevep/_id/_tab/inerencias" */))
const _6a091948 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\inovacoes.vue' /* webpackChunkName: "pages/tevep/_id/_tab/inovacoes" */))
const _3f5a8a9a = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\logistica.vue' /* webpackChunkName: "pages/tevep/_id/_tab/logistica" */))
const _3589fd75 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\mao-de-obra.vue' /* webpackChunkName: "pages/tevep/_id/_tab/mao-de-obra" */))
const _6555ed06 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\maquina.vue' /* webpackChunkName: "pages/tevep/_id/_tab/maquina" */))
const _1795f19e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\material.vue' /* webpackChunkName: "pages/tevep/_id/_tab/material" */))
const _035ad795 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\meio-ambiente.vue' /* webpackChunkName: "pages/tevep/_id/_tab/meio-ambiente" */))
const _30990e95 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\metodo.vue' /* webpackChunkName: "pages/tevep/_id/_tab/metodo" */))
const _6fa7793e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\pingpong.vue' /* webpackChunkName: "pages/tevep/_id/_tab/pingpong" */))
const _f931e8be = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\principios.vue' /* webpackChunkName: "pages/tevep/_id/_tab/principios" */))
const _f0e0325e = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\qualidade.vue' /* webpackChunkName: "pages/tevep/_id/_tab/qualidade" */))
const _6c7366db = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\relevancia.vue' /* webpackChunkName: "pages/tevep/_id/_tab/relevancia" */))
const _02ec502c = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\rut.vue' /* webpackChunkName: "pages/tevep/_id/_tab/rut" */))
const _ac1616d4 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\seguranca.vue' /* webpackChunkName: "pages/tevep/_id/_tab/seguranca" */))
const _4499df65 = () => interopDefault(import('..\\resources\\nuxt\\pages\\tevep\\_id\\_tab\\utilidades.vue' /* webpackChunkName: "pages/tevep/_id/_tab/utilidades" */))
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
    path: "/admin",
    component: _b8d5c64c,
    name: "admin"
  }, {
    path: "/auth",
    component: _c854e07a,
    name: "auth"
  }, {
    path: "/dashboard",
    component: _6017fe16,
    name: "dashboard"
  }, {
    path: "/docs",
    component: _47b87d60,
    name: "docs",
    children: [{
      path: "auth",
      component: _3961a710,
      name: "docs-index-auth"
    }, {
      path: "carousel",
      component: _819b8fa0,
      name: "docs-index-carousel"
    }, {
      path: "colors",
      component: _622fba40,
      name: "docs-index-colors"
    }, {
      path: "drawer",
      component: _2d8e4d41,
      name: "docs-index-drawer"
    }, {
      path: "endpoints",
      component: _c627e844,
      name: "docs-index-endpoints"
    }, {
      path: "input",
      component: _d03d27ac,
      children: [{
        path: "",
        component: _0530c518,
        name: "docs-index-input"
      }, {
        path: "loading",
        component: _5d224502,
        name: "docs-index-input-loading"
      }, {
        path: "select",
        component: _144bbca6,
        name: "docs-index-input-select"
      }]
    }, {
      path: "table",
      component: _88c6a3a4,
      name: "docs-index-table"
    }, {
      path: "tabs",
      component: _58eca74e,
      name: "docs-index-tabs"
    }, {
      path: "test",
      component: _49960e62,
      name: "docs-index-test"
    }]
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
      path: "colors",
      component: _75413289,
      name: "test-index-colors"
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
    path: "/user",
    component: _30815dc0,
    name: "user"
  }, {
    path: "/admin/settings",
    component: _547954cb,
    children: [{
      path: "",
      component: _b3fdd552,
      name: "admin-settings"
    }, {
      path: "email",
      component: _5485c321,
      name: "admin-settings-email"
    }, {
      path: "email-sent",
      component: _a9155318,
      name: "admin-settings-email-sent"
    }, {
      path: "email-templates",
      component: _797a5b8d,
      name: "admin-settings-email-templates"
    }]
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
    path: "/user/:id",
    component: _37685fb0,
    name: "user-id"
  }, {
    path: "/tevep/:id/:tab?",
    component: _3f3ab192,
    name: "tevep-id-tab",
    children: [{
      path: "atendimento",
      component: _8fb98aae,
      name: "tevep-id-tab-atendimento"
    }, {
      path: "complexidade",
      component: _2ef41024,
      name: "tevep-id-tab-complexidade"
    }, {
      path: "custo",
      component: _157b6815,
      name: "tevep-id-tab-custo"
    }, {
      path: "entrega",
      component: _33891f11,
      name: "tevep-id-tab-entrega"
    }, {
      path: "expectativas",
      component: _74c74562,
      name: "tevep-id-tab-expectativas"
    }, {
      path: "inerencias",
      component: _40ac910a,
      name: "tevep-id-tab-inerencias"
    }, {
      path: "inovacoes",
      component: _6a091948,
      name: "tevep-id-tab-inovacoes"
    }, {
      path: "logistica",
      component: _3f5a8a9a,
      name: "tevep-id-tab-logistica"
    }, {
      path: "mao-de-obra",
      component: _3589fd75,
      name: "tevep-id-tab-mao-de-obra"
    }, {
      path: "maquina",
      component: _6555ed06,
      name: "tevep-id-tab-maquina"
    }, {
      path: "material",
      component: _1795f19e,
      name: "tevep-id-tab-material"
    }, {
      path: "meio-ambiente",
      component: _035ad795,
      name: "tevep-id-tab-meio-ambiente"
    }, {
      path: "metodo",
      component: _30990e95,
      name: "tevep-id-tab-metodo"
    }, {
      path: "pingpong",
      component: _6fa7793e,
      name: "tevep-id-tab-pingpong"
    }, {
      path: "principios",
      component: _f931e8be,
      name: "tevep-id-tab-principios"
    }, {
      path: "qualidade",
      component: _f0e0325e,
      name: "tevep-id-tab-qualidade"
    }, {
      path: "relevancia",
      component: _6c7366db,
      name: "tevep-id-tab-relevancia"
    }, {
      path: "rut",
      component: _02ec502c,
      name: "tevep-id-tab-rut"
    }, {
      path: "seguranca",
      component: _ac1616d4,
      name: "tevep-id-tab-seguranca"
    }, {
      path: "utilidades",
      component: _4499df65,
      name: "tevep-id-tab-utilidades"
    }]
  }, {
    path: "/",
    component: _4c6fd2aa,
    name: "index"
  }],

  fallback: false
}

export function createRouter () {
  return new Router(routerOptions)
}
