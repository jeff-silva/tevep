(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{216:function(t,e,n){var content=n(219);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,n(39).default)("2ab2de5e",content,!0,{sourceMap:!1})},218:function(t,e,n){"use strict";var r=n(216);n.n(r).a},219:function(t,e,n){(e=n(38)(!1)).push([t.i,".ui-laravel-table-td-actions{text-align:right;border:1px solid red}.ui-laravel-table-td-actions-aaa{position:relative}",""]),t.exports=e},227:function(t,e,n){"use strict";n.r(e);var r={props:{value:{default:function(){return{}}},loading:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){var data={};return data.props=Object.assign({},this.$props),data.props.value=Object.assign({current_page:1,data:[],first_page_url:"",from:"",last_page:"",last_page_url:"",next_page_url:"",path:"",prev_page_url:"",to:"",total:""},data.props.value),data}},l=(n(218),n(11)),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"ui-laravel-table"},[n("div",{staticClass:"progress rounded-0",staticStyle:{height:"5px"},style:{opacity:t.props.loading?1:0}},[n("div",{staticClass:"progress-bar progress-bar-striped progress-bar-animated",staticStyle:{width:"100%"}})]),t._v(" "),0==t.props.loading&&t.props.value.data&&0==t.props.value.data.length?n("div",{staticClass:"bg-white p-3 text-muted shadow-sm"},[t._t("empty",[t._v("\r\n            Nenhum dado encontrado\r\n        ")])],2):n("div",[n("div",{staticClass:"bg-white shadow-sm"},[n("table",{staticClass:"table table-sm table-hover table-borderless m-0"},[n("tbody",[t._l(t.props.value.data,(function(i){return[n("tr",[t._t("item",[t._v('\r\n                                <template #item="{item}">'),n("br"),t._v("\r\n                                     <td>"),n("span",{pre:!0},[t._v("{{ item.name }}")]),t._v("</td>"),n("br"),t._v("\r\n                                </template>\r\n                            ")],{item:i}),t._v(" "),n("td",{staticClass:"ui-laravel-table-td-actions"},[n("div",{staticClass:"ui-laravel-table-td-actions-aaa"},[n("div",{staticClass:"btn-group"},[t._t("actions",null,{item:i})],2)])])],2)]}))],2)]),t._v(" "),0==t.props.loading?n("div",{staticClass:"text-right py-2",staticStyle:{background:"#f5f5f5"}},[t._m(0)]):t._e()])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group m-0"},[e("div",{staticClass:"input-group-prepend input-group-btn"},[e("button",{staticClass:"btn btn-white",attrs:{type:"button"}},[e("i",{staticClass:"fa fa-fw fa-caret-left"})])]),this._v(" "),e("div",{staticClass:"input-group-append input-group-btn"},[e("button",{staticClass:"btn btn-white",attrs:{type:"button"}},[e("i",{staticClass:"fa fa-fw fa-caret-right"})])])])}],!1,null,null,null);e.default=component.exports},391:function(t,e,n){"use strict";n.r(e);var r={layout:"admin",middleware:"auth",data:function(){return{tevep:{}}},methods:{tevepsSearch:function(){var t=this;this.$axios.get("/api/tevep/search").then((function(e){t.tevep=e.data}))}},mounted:function(){this.tevepsSearch()}},l=n(11),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("ui-laravel-table",{scopedSlots:t._u([{key:"empty",fn:function(){return[t._v("Nenhum projeto encontrado")]},proxy:!0},{key:"item",fn:function(e){var r=e.item;return[n("td",[t._v(t._s(r.title||r.id))])]}},{key:"actions",fn:function(e){var r=e.item;return[n("nuxt-link",{staticClass:"btn btn-primary",attrs:{to:"/tevep/"+r.id+"/"}},[n("i",{staticClass:"fas fa-edit"})]),t._v(" "),n("nuxt-link",{staticClass:"btn btn-danger",attrs:{to:"/tevep/"+r.id+"/"}},[n("i",{staticClass:"fas fa-times"})])]}}]),model:{value:t.tevep,callback:function(e){t.tevep=e},expression:"tevep"}})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiLaravelTable:n(227).default})}}]);