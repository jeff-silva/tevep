(window.webpackJsonp=window.webpackJsonp||[]).push([[14],{390:function(t,e,n){var content=n(398);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,n(27).default)("2ab2de5e",content,!0,{sourceMap:!1})},397:function(t,e,n){"use strict";var r=n(390);n.n(r).a},398:function(t,e,n){(e=n(26)(!1)).push([t.i,".ui-laravel-table td{padding:15px}.ui-laravel-table-td-actions{text-align:right;padding:5px!important}.ui-laravel-table-td-actions .btn{margin:0}.ui-laravel-table-td-actions-aaa{position:relative}@media (max-width:768px){.ui-laravel-table-td-actions-aaa .btn-group .btn-group{position:absolute;right:45px}}",""]),t.exports=e},412:function(t,e,n){"use strict";n.r(e);var r={props:{value:{default:function(){return{}}},loading:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){var data={show:!1};return data.props=Object.assign({},this.$props),data.props.value=Object.assign({current_page:1,data:[],first_page_url:"",from:"",last_page:"",last_page_url:"",next_page_url:"",path:"",prev_page_url:"",to:"",total:""},data.props.value),data}},l=(n(397),n(6)),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"ui-laravel-table"},[n("div",{staticClass:"progress rounded-0",staticStyle:{height:"5px"},style:{opacity:t.props.loading?1:0}},[n("div",{staticClass:"progress-bar progress-bar-striped progress-bar-animated",staticStyle:{width:"100%"}})]),t._v(" "),0==t.props.loading&&t.props.value.data&&0==t.props.value.data.length?n("div",{staticClass:"bg-white p-3 text-muted shadow-sm"},[t._t("empty",[t._v("\r\n            Nenhum dado encontrado\r\n        ")])],2):n("div",[n("div",{staticClass:"bg-white shadow-sm"},[n("table",{staticClass:"table table-sm table-hover table-striped table-borderless m-0"},[n("tbody",[t._l(t.props.value.data,(function(i){return[n("tr",[t._t("item",[t._v('\r\n                                <template #item="{item}">'),n("br"),t._v("\r\n                                     <td>"),n("span",{pre:!0},[t._v("{{ item.name }}")]),t._v("</td>"),n("br"),t._v("\r\n                                </template>\r\n                            ")],{item:i}),t._v(" "),n("td",{staticClass:"ui-laravel-table-td-actions"},[n("div",{staticClass:"ui-laravel-table-td-actions-aaa"},[n("div",{staticClass:"btn-group"},[n("div",{staticClass:"btn-group m-0 d-md-flex",class:{"d-none":t.show!=i}},[t._t("actions",null,{item:i})],2),t._v(" "),n("a",{staticClass:"btn d-md-none",attrs:{href:"javascript:;"},on:{click:function(e){t.show=t.show!=i&&i}}},[n("i",{staticClass:"fas fa-plus"})])])])])],2)]}))],2)]),t._v(" "),0==t.props.loading?n("div",{staticClass:"text-right py-2",staticStyle:{background:"#f5f5f5"}},[t._m(0)]):t._e()])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group m-0"},[e("div",{staticClass:"input-group-prepend input-group-btn"},[e("button",{staticClass:"btn btn-white",attrs:{type:"button"}},[e("i",{staticClass:"fa fa-fw fa-caret-left"})])]),this._v(" "),e("div",{staticClass:"input-group-append input-group-btn"},[e("button",{staticClass:"btn btn-white",attrs:{type:"button"}},[e("i",{staticClass:"fa fa-fw fa-caret-right"})])])])}],!1,null,null,null);e.default=component.exports},423:function(t,e,n){"use strict";n.r(e);var r={layout:"admin",middleware:"auth",data:function(){return{tevep:{}}},methods:{tevepsSearch:function(){var t=this,e=this.$route.query.user||this.$auth.user.id;this.$axios.get("/api/tevep/search",{params:{user_id:e}}).then((function(e){t.tevep=e.data}))},tevepsDelete:function(t){var e=this;confirm("Deseja deletar?")&&this.$axios.post("/api/tevep/delete/".concat(t.id)).then((function(t){e.$swalSuccess("Sucesso","Projeto deletado"),e.tevepsSearch()}))}},mounted:function(){this.tevepsSearch()}},l=n(6),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",[n("ui-laravel-table",{scopedSlots:t._u([{key:"empty",fn:function(){return[t._v("Nenhum projeto encontrado")]},proxy:!0},{key:"item",fn:function(e){var r=e.item;return[n("td",[t._v(t._s(r.title||r.id))])]}},{key:"actions",fn:function(e){var r=e.item;return[n("nuxt-link",{staticClass:"btn btn-primary",attrs:{to:"/tevep/"+r.id+"/"}},[n("i",{staticClass:"fas fa-edit"})]),t._v(" "),n("a",{staticClass:"btn btn-danger",attrs:{href:"javascript:;"},on:{click:function(e){return t.tevepsDelete(r)}}},[n("i",{staticClass:"fas fa-times"})])]}}]),model:{value:t.tevep,callback:function(e){t.tevep=e},expression:"tevep"}})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiLaravelTable:n(412).default})}}]);