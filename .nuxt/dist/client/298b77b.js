(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{229:function(t,e,n){var content=n(378);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,n(30).default)("28759eac",content,!0,{sourceMap:!1})},377:function(t,e,n){"use strict";var r=n(229);n.n(r).a},378:function(t,e,n){(e=n(29)(!1)).push([t.i,".ui-table-td-actions{text-align:right;border:1px solid red}.ui-table-td-actions-aaa{position:relative}",""]),t.exports=e},399:function(t,e,n){"use strict";n.r(e);var r={props:{value:{default:function(){return[]}},items:{default:function(){return[]}},loading:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},o=(n(377),n(7)),component=Object(o.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"ui-table"},[0==t.props.items.length?n("div",[t._t("empty",[t._v("\r\n            Nenhum dado encontrado\r\n        ")])],2):n("div",[n("table",{staticClass:"table table-sm table-borderless bg-white shadow-sm"},[n("tbody",[t._l(t.items,(function(i){return[n("tr",[t._t("item",null,{item:i}),t._v(" "),n("td",{staticClass:"ui-table-td-actions"},[n("div",{staticClass:"ui-table-td-actions-aaa"},[n("div",{staticClass:"btn-group"},[t._t("actions",null,{item:i})],2)])])],2)]}))],2)])])])}),[],!1,null,null,null);e.default=component.exports},414:function(t,e,n){"use strict";n.r(e);var r={layout:"admin",middleware:"auth",data:function(){return{teveps:[]}},methods:{tevepSearch:function(){var t=this,e={user_id:this.$user("id")};this.$axios.get("/api/teveps/search",{params:e}).then((function(e){t.teveps=e.data}))}},mounted:function(){this.tevepSearch()}},o=n(7),component=Object(o.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("ui-table",{attrs:{items:t.teveps},scopedSlots:t._u([{key:"empty",fn:function(){return[t._v("Nenhum projeto encontrado")]},proxy:!0},{key:"item",fn:function(e){var r=e.item;return[n("td",[t._v(t._s(r.title||r.id))])]}},{key:"actions",fn:function(e){var r=e.item;return[n("nuxt-link",{staticClass:"btn btn-primary",attrs:{to:"/tevep/"+r.id+"/"}},[n("i",{staticClass:"fa fa-fw fa-pencil"})]),t._v(" "),n("nuxt-link",{staticClass:"btn btn-danger",attrs:{to:"/tevep/"+r.id+"/"}},[n("i",{staticClass:"fa fa-fw fa-remove"})])]}}])})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiTable:n(399).default})}}]);