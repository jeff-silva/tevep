(window.webpackJsonp=window.webpackJsonp||[]).push([[36,12,22,23,30],{559:function(t,e,o){"use strict";o.r(e);o(12);var n={props:{value:[Boolean,Object],method:{default:"get"},action:{default:""},mountedSubmit:{default:!1,type:Boolean},successText:{default:""}},data:function(){return{loading:!1,response:!1,error:!1,errorFields:{}}},methods:{submit:function(){var t=this;return this.loading=!0,this.error=!1,this.errorFields={},this.$axios({method:this.method,url:this.action,data:"get"!=this.method?this.value:null,params:"get"==this.method?this.value:null}).then((function(e){var o=t.parseResponseData(e.data);t.loading=!1,t.response=o,t.$emit("success",o),t.$emit("response",o),t.successText&&t.$swal.fire(t.successText)})).catch((function(e){var o=t.parseResponseData(e.response.data);t.loading=!1,t.error=o.message,t.errorFields=o.fields,t.$emit("error",o),t.$emit("response",o)}))},parseResponseData:function(t){return["per_page","page"].forEach((function(e){"string"==typeof t[e]&&(t[e]=parseInt(t[e]))})),t}},mounted:function(){this.mountedSubmit&&this.submit()}},r=o(14),component=Object(r.a)(n,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("form",{attrs:{action:""},on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("default",null,{loading:t.loading,response:t.response,error:t.error,errorFields:t.errorFields})],2)}),[],!1,null,null,null);e.default=component.exports},562:function(t,e,o){var content=o(569);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,o(75).default)("dc996836",content,!0,{sourceMap:!1})},568:function(t,e,o){"use strict";o(562)},569:function(t,e,o){var n=o(74)(!1);n.push([t.i,"@media (max-width:768px){.ui-model-edit-fields{margin-bottom:50px}.ui-model-edit-actions{position:fixed;bottom:0;left:0;width:100%;display:flex}.ui-model-edit-actions>.btn{flex-basis:100%;text-align:center}}",""]),t.exports=n},573:function(t,e,o){"use strict";o.r(e);o(61);var n=o(579),r={props:{value:[Boolean,String],language:{default:"html"},theme:{default:"vs-dark"}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props)),monaco:!1}},watch:{$props:{deep:!0,handler:function(t){this.$el.contains(document.activeElement)||(this.props=JSON.parse(JSON.stringify(t)),this.setValue(this.props.value))}}},methods:{monacoInit:function(){var t=this;setTimeout((function(){var e=t.$refs.monaco;e&&(t.monaco=n.a.create(e,{value:t.props.value,language:t.props.language,theme:t.props.theme,automaticLayout:!0}),t.monaco.getModel().onDidChangeContent((function(e){t.props.value=t.monaco.getModel().getValue(),t.emitValue()})),t.monaco.getModel().setValue(t.props.value))}),100)},emitValue:function(){this.$emit("value",this.props.value),this.$emit("input",this.props.value),this.$emit("change",this.props.value)},setValue:function(t){this.$el.contains(document.activeElement)||this.monaco.getModel().setValue(t)},getValue:function(){return this.props.value=this.monaco.getModel().getValue()}},mounted:function(){this.monacoInit()}},l=o(14),component=Object(l.a)(r,(function(){var t=this.$createElement;return(this._self._c||t)("div",{ref:"monaco",staticStyle:{width:"100%",height:"150px"}})}),[],!1,null,null,null);e.default=component.exports},574:function(t,e,o){"use strict";o.r(e);var n=o(21),r=(o(552),o(61),o(94),o(409),o(12),{props:{value:{default:function(){return{}},type:[Boolean,Number,String,Object]},modelName:{default:""},modelId:{default:!1,type:[Boolean,Number,String]},singular:{default:"Item"},plural:{default:"Itens"},showActions:{default:!0},redirect:{default:"edit"}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},computed:{_modelId:function(){var t=+this.props.modelId;return"object"==Object(n.a)(this.props.value)&&this.props.value.id&&(t=+this.props.value.id),!isNaN(t)&&t}},data:function(){return{finding:!1,props:JSON.parse(JSON.stringify(this.$props))}},methods:{find:function(){var t=this;this._modelId&&(this.finding=!0,this.$axios.get("/api/".concat(this.modelName,"/find/").concat(this._modelId)).then((function(e){t.finding=!1,t.props.value=e.data})))},onSuccess:function(t){var e=this;this.props.value=t,this.$emit("success",t),this.$swal.fire({title:"Dados de ".concat(this.singular," foram salvos"),confirmButtonText:"Lista de ".concat(this.plural),showCancelButton:!0,cancelButtonText:"Fechar"}).then((function(t){t.isConfirmed&&e.$router.push("/admin/".concat(e.modelName,"/"))}))},successRedirect:function(){"edit"==this.redirect?this.$router.push("/admin/".concat(this.modelName,"/").concat(this.props.value&&this.props.value.id?this.props.value.id:"new")):"back"==this.redirect?this.$router.go(-1):this.$router.push(this.redirect)}},mounted:function(){this.find()}}),l=(o(568),o(14)),component=Object(l.a)(r,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("ui-form",{attrs:{method:"post",action:"/api/"+t.modelName+"/save"},on:{success:t.onSuccess},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.loading,r=e.error,l=e.errorFields;return[o("div",{staticClass:"ui-model-edit-fields bg-white p-3 shadow-sm"},[o("el-collapse-transition",[r?o("div",{staticClass:"alert alert-danger"},[o("a",{staticClass:"float-end text-danger fw-bold",attrs:{href:"javascript:;"},on:{click:function(t){r=!1}}},[o("i",{staticClass:"fas fa-fw fa-times"})]),t._v(" "),o("div",{domProps:{innerHTML:t._s(r)}})]):t._e()]),t._v(" "),t._t("default",null,{value:t.props.value,loading:n,error:r,errorFields:l})],2),t._v(" "),t.showActions?o("div",{staticClass:"ui-model-edit-actions text-end mt-3 p-1 p-md-3 bg-white shadow-sm"},[t._t("actions"),t._v(" "),t.props.value.id?o("nuxt-link",{staticClass:"btn btn-light",attrs:{to:"/admin/"+t.modelName+"/new"}},[t._v("\n            Criar "+t._s(t.singular)+"\n        ")]):t._e(),t._v(" "),o("button",{staticClass:"btn btn-light",attrs:{type:"button"},on:{click:function(e){return t.$router.go(-1)}}},[t._v("\n            Voltar\n        ")]),t._v(" "),o("button",{directives:[{name:"loading",rawName:"v-loading",value:n,expression:"loading"}],staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("\n            Salvar\n        ")])],2):t._e()]}}],null,!0),model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}})}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiForm:o(559).default})},582:function(t,e,o){"use strict";o.r(e);o(61);var n={props:{value:[Boolean,String]},data:function(){return{codeMode:!1,props:JSON.parse(JSON.stringify(this.$props))}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)),this.setValue(this.props.value))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},methods:{setValue:function(t){this.$refs.editor.innerHTML=t||""},getValue:function(){return this.$refs.editor.innerHTML},command:function(a,b,t){document.execCommand(a,b,t),this.props.value=this.$refs.editor.innerHTML}},mounted:function(){this.setValue(this.props.value)}},r=o(14),component=Object(r.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("div",{staticClass:"ui-editor-html"},[o("div",{staticClass:"p-2 border border-bottom-0"},[o("div",{staticClass:"btn-group me-2",attrs:{role:"group","aria-label":"Paragrafo"}},[o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("bold")}}},[o("i",{staticClass:"fas fa-bold"})]),t._v(" "),o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("italic")}}},[o("i",{staticClass:"fas fa-italic"})]),t._v(" "),o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("strikeThrough")}}},[o("i",{staticClass:"fas fa-strikethrough"})])]),t._v(" "),o("div",{staticClass:"btn-group me-2",attrs:{role:"group","aria-label":"Alinhamento"}},[o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyLeft")}}},[o("i",{staticClass:"fas fa-align-left"})]),t._v(" "),o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyCenter")}}},[o("i",{staticClass:"fas fa-align-center"})]),t._v(" "),o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyFull")}}},[o("i",{staticClass:"fas fa-align-justify"})]),t._v(" "),o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyRight")}}},[o("i",{staticClass:"fas fa-align-right"})])]),t._v(" "),o("div",{staticClass:"btn-group me-2",attrs:{role:"group","aria-label":"Especial"}},[o("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("removeFormat")}}},[o("i",{staticClass:"fas fa-remove-format"})]),t._v(" "),o("button",{staticClass:"btn btn-sm",class:{"btn-primary text-white":t.codeMode},attrs:{type:"button"},on:{click:function(e){t.codeMode=!t.codeMode}}},[o("i",{staticClass:"fas fa-code"})])])]),t._v(" "),o("ui-code",{directives:[{name:"show",rawName:"v-show",value:t.codeMode,expression:"codeMode"}],staticStyle:{"min-height":"100px"},attrs:{language:"html"},nativeOn:{keyup:function(e){return t.setValue(t.props.value)}},model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}),t._v(" "),o("div",{directives:[{name:"show",rawName:"v-show",value:!t.codeMode,expression:"!codeMode"}],ref:"editor",staticClass:"form-control rounded-0",staticStyle:{"min-height":"100px"},attrs:{contenteditable:"true"},on:{keyup:function(e){t.props.value=e.target.innerHTML||"&nbsp;"}}})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiCode:o(573).default})},583:function(t,e,o){"use strict";o.r(e);o(552),o(61),o(26),o(191);var n={props:{value:{default:"",type:[Boolean,Number,String,Array,Object]},multiple:{default:!1},disabled:{default:!1},loadingText:{default:"Carregando"},modelName:{default:""},singular:{default:"Item"},plural:{default:"Itens"}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},methods:{search:function(){var t=this;this.loading=!0,this.$axios.get("/api/".concat(this.modelName,"/search"),{params:this.searchParams}).then((function(e){t.loading=!1,t.results=e.data}))},remoteMethod:function(t){var e=this;this.searchParams.q=t,this.__remoteMethodTimeout&&clearTimeout(this.__remoteMethodTimeout),this.__remoteMethodTimeout=setTimeout((function(){return e.search()}),1e3)}},data:function(){return{loading:!1,searchParams:{q:"",id:this.value,per_page:10,orderby:"updated_at",order:"desc"},results:{},props:JSON.parse(JSON.stringify(this.$props))}},mounted:function(){this.search()}},r=o(14),component=Object(r.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("el-select",{staticClass:"w-100",attrs:{filterable:"",remote:"",placeholder:"Selecionar "+t.singular,"remote-method":t.remoteMethod,loading:t.loading,multiple:t.props.multiple,disabled:t.props.disabled,"loading-text":t.props.loadingText,"no-match-text":"Nenhum(a) "+t.singular+" encontrado(a)","no-data-text":"Nenhum(a) "+t.singular+" encontrado(a)"},on:{change:function(e){t.searchParams.q=""},blur:function(e){t.searchParams.q=""}},model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}},[t._l(t.results.data,(function(e){return[t._t("option",(function(){return[o("el-option",{key:e.id,attrs:{value:e.id,label:e.name}},[t._v("\n                "+t._s(e.name)+"\n            ")])]}),{item:e})]}))],2)}),[],!1,null,null,null);e.default=component.exports},596:function(t,e,o){"use strict";o.r(e);o(94);var n={props:{value:{default:""},size:{default:"300x300"}},computed:{_qrcodeUrl:function(){return"https://chart.googleapis.com/chart?cht=qr&chs=".concat(this.size,"&chl=").concat(this.value)}}},r=o(14),component=Object(r.a)(n,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("img",{attrs:{src:t._qrcodeUrl,alt:""}})}),[],!1,null,null,null);e.default=component.exports},704:function(t,e,o){"use strict";o.r(e);o(12),o(27),o(28),o(570),o(408);var n={layout:"default/admin",middleware:"auth",head:function(){return{title:"Editar coleira"}},data:function(){return{baseUrl:new URL(location.href).protocol+"//"+new URL(location.href).host+"/"}}},r=o(14),component=Object(r.a)(n,(function(){var t=this,e=t.$createElement,o=t._self._c||e;return o("ui-model-edit",{attrs:{"model-name":"petqr-collars","model-id":t.$route.params.id,singular:"Coleira",plural:"Coleiras"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.value,r=e.errorFields;return[o("ui-field",{attrs:{label:"Nome do pet",layout:"horizontal",error:r.name}},[o("input",{directives:[{name:"model",rawName:"v-model",value:n.name,expression:"value.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:n.name},on:{input:function(e){e.target.composing||t.$set(n,"name",e.target.value)}}})]),t._v(" "),o("ui-field",{attrs:{label:"Proprietário",layout:"horizontal",error:r.owner_id}},[o("ui-model-select",{attrs:{"model-name":"user"},model:{value:n.owner_id,callback:function(e){t.$set(n,"owner_id",e)},expression:"value.owner_id"}})],1),t._v(" "),o("ui-field",{attrs:{label:"Foto do pet",layout:"horizontal",error:r.pet_photo_id}},[o("ui-file-select",{model:{value:n.pet_photo_id,callback:function(e){t.$set(n,"pet_photo_id",e)},expression:"value.pet_photo_id"}})],1),t._v(" "),o("ui-field",{attrs:{label:"Descrição",layout:"horizontal",error:r.description}},[o("ui-html",{model:{value:n.description,callback:function(e){t.$set(n,"description",e)},expression:"value.description"}})],1),t._v(" "),n.links&&n.links.qrcode?o("ui-field",{attrs:{label:"QR code",layout:"horizontal"}},[o("div",{staticClass:"text-center"},[o("ui-qrcode",{model:{value:n.links.page,callback:function(e){t.$set(n.links,"page",e)},expression:"value.links.page"}}),o("br"),t._v(" "),o("a",{attrs:{href:n.links.page,target:"_blank"}},[t._v("Acessar")])],1)]):t._e()]}}])})}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiField:o(553).default,UiModelSelect:o(583).default,UiFileSelect:o(595).default,UiHtml:o(582).default,UiQrcode:o(596).default,UiModelEdit:o(574).default})}}]);