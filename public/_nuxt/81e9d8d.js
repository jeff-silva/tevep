(window.webpackJsonp=window.webpackJsonp||[]).push([[43,22,26],{558:function(e,t,r){"use strict";r.r(t);r(12);var n={props:{value:[Boolean,Object],method:{default:"get"},action:{default:""},mountedSubmit:{default:!1,type:Boolean},successText:{default:""}},data:function(){return{loading:!1,response:!1,error:!1,errorFields:{}}},methods:{submit:function(){var e=this;return this.loading=!0,this.error=!1,this.errorFields={},this.$axios({method:this.method,url:this.action,data:"get"!=this.method?this.value:null,params:"get"==this.method?this.value:null}).then((function(t){var r=e.parseResponseData(t.data);e.loading=!1,e.response=r,e.$emit("success",r),e.$emit("response",r),e.successText&&e.$swal.fire(e.successText)})).catch((function(t){var r=e.parseResponseData(t.response.data);e.loading=!1,e.error=r.message,e.errorFields=r.fields,e.$emit("error",r),e.$emit("response",r)}))},parseResponseData:function(e){return["per_page","page"].forEach((function(t){"string"==typeof e[t]&&(e[t]=parseInt(e[t]))})),e}},mounted:function(){this.mountedSubmit&&this.submit()}},o=r(16),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("form",{attrs:{action:""},on:{submit:function(t){return t.preventDefault(),e.submit()}}},[e._t("default",null,{loading:e.loading,response:e.response,error:e.error,errorFields:e.errorFields})],2)}),[],!1,null,null,null);t.default=component.exports},560:function(e,t,r){var content=r(565);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(74).default)("309f6a21",content,!0,{sourceMap:!1})},564:function(e,t,r){"use strict";r(560)},565:function(e,t,r){var n=r(73)(!1);n.push([e.i,'.ui-model-search-table-actions .btn{padding:4px 6px;margin:0}.ui-model-search-header-actions>*{margin-left:10px}.ui-model-search-search-fields>*{margin-bottom:15px}.ui-model-search [data-orderby]{cursor:pointer}.ui-model-search [data-order=asc]:after{content:"↓";float:right}.ui-model-search [data-order=desc]:after{content:"↑";float:right}',""]),e.exports=n},568:function(e,t,r){"use strict";r.r(t);r(49),r(35),r(41),r(76),r(77);var n=r(29);r(12),r(75),r(26),r(191),r(34),r(27),r(28),r(408),r(94),r(95),r(570);function o(object,e){var t=Object.keys(object);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(object);e&&(r=r.filter((function(e){return Object.getOwnPropertyDescriptor(object,e).enumerable}))),t.push.apply(t,r)}return t}function c(e){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?o(Object(source),!0).forEach((function(t){Object(n.a)(e,t,source[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(source)):o(Object(source)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(source,t))}))}return e}var l={props:{modelName:{default:""},singular:{default:"Item"},plural:{default:"Itens"},changeUrl:{default:!0},actionsDefault:{default:!0}},data:function(){return{searchParams:this.searchParamsDefault(this.$route.query),selecteds:[]}},methods:{submit:function(){var e=this;return new Promise((function(t,r){setTimeout((function(){e.selecteds=[],e.$refs.search.submit().then((function(e){t()})).catch(r)}),10)}))},searchParamsDefault:function(){var e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return e=c({q:"",page:1,per_page:10,orderby:"updated_at",order:"desc",deleted:""},e),["page","per_page"].forEach((function(t){e[t]=parseInt(e[t])})),e},searchParamsUrl:function(){this.changeUrl&&this.$router.push({query:this.searchParams})},orderByArrow:function(){var e=this;this.$el.querySelectorAll("[data-orderby]").forEach((function(t){var r=t.getAttribute("data-orderby");e.searchParams.orderby==r?t.setAttribute("data-order",e.searchParams.order):t.removeAttribute("data-order")}))},orderbyHandleClick:function(){var e=this;this.$el.addEventListener("click",(function(t){var r=t.target.getAttribute("data-orderby");r&&(r==e.searchParams.orderby&&(e.searchParams.order="asc"==e.searchParams.order?"desc":"asc"),e.searchParams.orderby=r,e.orderByArrow(),e.searchParamsUrl(),e.submit())})),this.orderByArrow()},downloadExport:function(e){var u=new URLSearchParams;for(var i in this.searchParams)u.append(i,this.searchParams[i]||"");u.append("format",e),this.$axios({url:"/api/".concat(this.modelName,"/export?").concat(u.toString()),method:"get",responseType:"blob"}).then((function(t){Object.assign(document.createElement("a"),{href:URL.createObjectURL(t.data),download:"data-export.".concat(e)}).click()}))},modelDelete:function(e){var t=this,r=!!this.searchParams.deleted,n=r?"Deseja deletar estes itens permanentemente?\nEsta ação não pode ser desfeita.":"Deseja deletar estes itens?",o=r;this.$confirm(n).then((function(n){t.$axios.post("/api/".concat(t.modelName,"/delete"),{id:e,deleted:o,forced:r}).then((function(e){t.selecteds=[],t.submit()}))}))},modelRestore:function(e){var t=this;this.$confirm("Deseja restaurar este item?").then((function(r){t.$axios.post("/api/".concat(t.modelName,"/restore"),{id:e,deleted:1}).then((function(e){t.submit()}))}))}},mounted:function(){this.orderbyHandleClick()}},d=l,m=(r(564),r(16)),component=Object(m.a)(d,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("ui-form",{ref:"search",staticClass:"ui-model-search",attrs:{method:"get",action:"/api/"+e.modelName+"/search","mounted-submit":!0},on:{response:function(t){return e.searchParamsUrl()}},scopedSlots:e._u([{key:"default",fn:function(t){var n=t.loading,o=t.response;return[r("div",{staticClass:"row g-0"},[r("div",{staticClass:"col-12 pb-3 text-end"},[r("div",{staticClass:"ui-model-search-header-actions d-flex align-items-center justify-content-end"},[e._t("header-actions"),e._v(" "),r("transition",{attrs:{name:"el-fade-in-linear"}},[e.selecteds.length&&!e.searchParams.deleted?r("a",{staticClass:"btn btn-danger",attrs:{href:"javascript:;"},on:{click:function(t){return e.modelDelete(e.selecteds)}}},[r("i",{staticClass:"fas fa-times me-1"}),e._v(" Deletar "+e._s(e.selecteds.length)+"\n                    ")]):e._e()]),e._v(" "),r("transition",{attrs:{name:"el-fade-in-linear"}},[e.selecteds.length&&e.searchParams.deleted?r("a",{staticClass:"btn btn-success",attrs:{href:"javascript:;"},on:{click:function(t){return e.modelRestore(e.selecteds)}}},[r("i",{staticClass:"fas fa-times me-1"}),e._v(" Restaurar "+e._s(e.selecteds.length)+"\n                    ")]):e._e()]),e._v(" "),r("el-dropdown",{attrs:{trigger:"click"}},[r("a",{staticClass:"btn btn-success",attrs:{href:"javascript:;"}},[r("i",{staticClass:"fas fa-download me-1"}),e._v(" Exportar\n                    ")]),e._v(" "),r("el-dropdown-menu",[r("div",{staticStyle:{width:"150px"}},[r("a",{staticClass:"d-block p-2",attrs:{href:"javascript:;"},on:{click:function(t){return e.downloadExport("csv")}}},[e._v("CSV")]),e._v(" "),r("a",{staticClass:"d-block p-2",attrs:{href:"javascript:;"},on:{click:function(t){return e.downloadExport("json")}}},[e._v("JSON")]),e._v(" "),r("a",{staticClass:"d-block p-2",attrs:{href:"javascript:;"},on:{click:function(t){return e.downloadExport("html")}}},[e._v("HTML")])])])],1),e._v(" "),e.actionsDefault?r("nuxt-link",{staticClass:"btn btn-primary",attrs:{to:"/admin/"+e.modelName+"/new"}},[r("i",{staticClass:"fas fa-fw fa-plus me-1"}),e._v(" Novo\n                ")]):e._e()],2)]),e._v(" "),r("div",{staticClass:"col-12 col-md-3"},[r("div",{staticClass:"bg-white shadow-sm p-3",staticStyle:{position:"sticky",top:"0"}},[r("div",{staticClass:"ui-model-search-search-fields mb-4"},[r("div",{staticClass:"input-group form-control p-0"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.searchParams.q,expression:"searchParams.q"}],staticClass:"form-control border-0 bg-transparent",attrs:{type:"text",placeholder:"Buscar "+e.plural},domProps:{value:e.searchParams.q},on:{input:function(t){t.target.composing||e.$set(e.searchParams,"q",t.target.value)}}}),e._v(" "),r("div",{staticClass:"input-group-btn"},[r("button",{directives:[{name:"loading",rawName:"v-loading",value:n,expression:"loading"}],staticClass:"btn border-0 bg-transparent shadow-none",attrs:{type:"submit"}},[r("i",{staticClass:"fas fa-fw fa-search"})])])]),e._v(" "),r("select",{directives:[{name:"model",rawName:"v-model",value:e.searchParams.deleted,expression:"searchParams.deleted"}],staticClass:"form-control",on:{change:[function(t){var r=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.$set(e.searchParams,"deleted",t.target.multiple?r:r[0])},function(t){return e.submit()}]}},[r("option",{attrs:{value:""}},[e._v("Ativos")]),e._v(" "),r("option",{attrs:{value:"1"}},[e._v("Deletados")])]),e._v(" "),e._t("search-fields")],2),e._v(" "),r("button",{directives:[{name:"loading",rawName:"v-loading",value:n,expression:"loading"}],staticClass:"btn btn-primary shadow-none w-100",attrs:{type:"submit"}},[r("i",{staticClass:"fas fa-fw fa-search"}),e._v(" Buscar\n                ")]),e._v(" "),r("button",{staticClass:"btn shadow-none w-100 mt-2",attrs:{type:"button"},on:{click:function(t){e.searchParams=e.searchParamsDefault(),e.submit().then((function(t){return e.searchParamsUrl()}))}}},[r("i",{staticClass:"fas fa-fw fa-times"}),e._v(" Limpar\n                ")]),e._v(" "),e._t("search-actions")],2)]),e._v(" "),r("div",{staticClass:"col-12 col-md-9 pt-3 pt-md-0 ps-md-3"},[r("div",{staticClass:"bg-white shadow-sm"},[r("table",{staticClass:"table table-striped table-hover table-borderless m-0",staticStyle:{"box-shadow":"none"}},[r("thead",[r("tr",[r("th",{attrs:{width:"30px"}},[r("input",{attrs:{type:"checkbox"},on:{click:function(t){e.selecteds=t.target.checked?o.data.map((function(e){return e.id})):[]}}})]),e._v(" "),e._t("table-header",(function(){return[r("th",[e._v("-")])]})),e._v(" "),r("th")],2)]),e._v(" "),r("tbody",[o&&o.data&&0==o.data.length?r("tr",[e._t("table-empty",(function(){return[r("td",{staticClass:"text-center py-3",attrs:{colspan:"10"}},[e._v("\n                                    Nenhum item encontrado\n                                ")])]}))],2):e._e(),e._v(" "),e._l(o.data,(function(i){return r("tr",[r("td",[r("input",{directives:[{name:"model",rawName:"v-model",value:e.selecteds,expression:"selecteds"}],attrs:{type:"checkbox"},domProps:{value:i.id,checked:Array.isArray(e.selecteds)?e._i(e.selecteds,i.id)>-1:e.selecteds},on:{change:function(t){var r=e.selecteds,n=t.target,o=!!n.checked;if(Array.isArray(r)){var c=i.id,l=e._i(r,c);n.checked?l<0&&(e.selecteds=r.concat([c])):l>-1&&(e.selecteds=r.slice(0,l).concat(r.slice(l+1)))}else e.selecteds=o}}})]),e._v(" "),e._t("table-row",(function(){return[r("td",[e._v(e._s(i))])]}),{item:i}),e._v(" "),r("td",{staticClass:"text-end"},[r("div",{staticClass:"ui-model-search-table-actions"},[e._t("table-actions",null,{item:i}),e._v(" "),e._t("table-actions-default",(function(){return[e.actionsDefault?r("nuxt-link",{staticClass:"btn btn-primary",attrs:{to:"/admin/"+e.modelName+"/"+i.id}},[r("i",{staticClass:"fas fa-fw fa-pen"})]):e._e(),e._v(" "),e.actionsDefault&&i.deleted_at?r("button",{staticClass:"btn btn-success",attrs:{type:"button"},on:{click:function(t){return e.modelRestore(i.id)}}},[r("i",{staticClass:"fas fa-fw fa-undo"})]):e._e(),e._v(" "),e.actionsDefault&&!i.deleted_at?r("button",{staticClass:"btn btn-danger",attrs:{type:"button"},on:{click:function(t){return e.modelDelete(i.id)}}},[r("i",{staticClass:"fas fa-fw fa-times"})]):e._e()]}),{item:i})],2)])],2)}))],2)]),e._v(" "),r("div",{staticClass:"p-2"},[r("el-pagination",{attrs:{background:"",layout:"prev, pager, next, sizes","current-page":e.searchParams.page,"page-size":e.searchParams.per_page,"pager-count":11,total:o?o.total:0,"page-sizes":[5,10,25,50,100]},on:{"update:currentPage":function(t){return e.$set(e.searchParams,"page",t)},"update:current-page":function(t){return e.$set(e.searchParams,"page",t)},"update:pageSize":function(t){return e.$set(e.searchParams,"per_page",t)},"update:page-size":function(t){return e.$set(e.searchParams,"per_page",t)},"size-change":function(t){return e.submit()},"current-change":function(t){return e.submit()},"prev-click":function(t){return e.submit()},"next-click":function(t){return e.submit()}}})],1)])])])]}}],null,!0),model:{value:e.searchParams,callback:function(t){e.searchParams=t},expression:"searchParams"}})}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiForm:r(558).default})},692:function(e,t,r){"use strict";r.r(t);var n={layout:"admin",middleware:"auth",head:function(){return{title:"Listar grupos Wordle"}}},o=r(16),component=Object(o.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("ui-model-search",{attrs:{"model-name":"wordle-groups",singular:"Grupo",plural:"Grupos"},scopedSlots:e._u([{key:"table-header",fn:function(){return[r("th",{attrs:{"data-orderby":"name"}},[e._v("Nome")]),e._v(" "),r("th",{attrs:{"data-orderby":"updated_at"}},[e._v("Alteração")])]},proxy:!0},{key:"table-row",fn:function(t){var n=t.item;return[r("td",[e._v(e._s(n.name))]),e._v(" "),r("td",[e._v(e._s(e._f("dateFormat")(n.updated_at)))])]}}])})],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiModelSearch:r(568).default})}}]);