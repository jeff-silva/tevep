(window.webpackJsonp=window.webpackJsonp||[]).push([[15],{499:function(t,e,l){"use strict";l.r(e);var o={layout:"coreui/admin",data:function(){return{}}},r=l(5),component=Object(r.a)(o,(function(){var t=this,e=t.$createElement,l=t._self._c||e;return l("div",[l("div",{staticClass:"row no-gutters"},[l("div",{staticClass:"col-12 bg-primary mb-4 text-white"},[t.$store.$auth.user?l("div",{staticClass:"d-flex p-3"},[l("div",{staticClass:"flex-grow-1"},[t._v(t._s(t.$store.$auth.user.name)+" - "+t._s(t.$store.$auth.user.email))]),t._v(" "),l("div",[l("a",{staticClass:"text-white",attrs:{href:"javascript:;"},on:{click:function(e){return t.$auth.logout()}}},[t._v("Sair")])])]):l("div",{staticClass:"p-3"},[t._v("Deslogado")])]),t._v(" "),l("div",{staticClass:"col-6 col-md-4"},[l("ui-auth-login")],1),t._v(" "),l("div",{staticClass:"col-6 col-md-4 px-1"},[l("ui-auth-register")],1),t._v(" "),l("div",{staticClass:"col-12 col-md-4"},[l("ui-auth-password")],1)])])}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiAuthLogin:l(278).default,UiAuthRegister:l(279).default,UiAuthPassword:l(284).default})}}]);