(window.webpackJsonp=window.webpackJsonp||[]).push([[59],{769:function(t,e,r){"use strict";r.r(e);var o={layout:"admin",middleware:["auth","permission"],head:function(){return{title:"Buscar usuários"}}},l=r(9),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("ui-model-search",{attrs:{"model-name":"user",singular:"Usuário",plural:"Usuários"},scopedSlots:t._u([{key:"table-header",fn:function(){return[r("td",{attrs:{width:"50px"}}),t._v(" "),r("td",{attrs:{"data-orderby":"name"}},[t._v("Nome")])]},proxy:!0},{key:"table-row",fn:function(e){var o=e.item;return[r("td",[r("el-image",{staticStyle:{width:"50px",height:"50px","border-radius":"50%"},attrs:{src:o.photo?o.photo.url:"",fit:"cover",lazy:""}},[r("div",{staticStyle:{background:"#ddd",height:"50px"},attrs:{slot:"error"},slot:"error"})])],1),t._v(" "),r("td",[r("div",{staticClass:"fw-bold"},[t._v(t._s(o.name))]),t._v(" "),r("div",{staticClass:"text-muted"},[t._v(t._s(o.email))])])]}}])})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiModelSearch:r(602).default})}}]);