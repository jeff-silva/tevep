(window.webpackJsonp=window.webpackJsonp||[]).push([[31,12,19,20,21,22,25,26],{550:function(t,e,r){var content=r(558);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(75).default)("039c59a2",content,!0,{sourceMap:!1})},552:function(t,e,r){"use strict";var n=r(13),o=r(3),l=r(4),c=r(135),d=r(20),f=r(16),m=r(405),v=r(48),h=r(134),_=r(404),y=r(5),x=r(93).f,w=r(40).f,S=r(18).f,$=r(406),N=r(554).trim,C="Number",O=o.Number,E=O.prototype,k=o.TypeError,I=l("".slice),F=l("".charCodeAt),j=function(t){var e=_(t,"number");return"bigint"==typeof e?e:J(e)},J=function(t){var e,r,n,o,l,c,d,code,f=_(t,"number");if(h(f))throw k("Cannot convert a Symbol value to a number");if("string"==typeof f&&f.length>2)if(f=N(f),43===(e=F(f,0))||45===e){if(88===(r=F(f,2))||120===r)return NaN}else if(48===e){switch(F(f,1)){case 66:case 98:n=2,o=49;break;case 79:case 111:n=8,o=55;break;default:return+f}for(c=(l=I(f,2)).length,d=0;d<c;d++)if((code=F(l,d))<48||code>o)return NaN;return parseInt(l,n)}return+f};if(c(C,!O(" 0o1")||!O("0b1")||O("+0x1"))){for(var L,T=function(t){var e=arguments.length<1?0:O(j(t)),r=this;return v(E,r)&&y((function(){$(r)}))?m(Object(e),r,T):e},M=n?x(O):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,isFinite,isInteger,isNaN,isSafeInteger,parseFloat,parseInt,fromString,range".split(","),R=0;M.length>R;R++)f(O,L=M[R])&&!f(T,L)&&S(T,L,w(O,L));T.prototype=E,E.constructor=T,d(o,C,T)}},553:function(t,e,r){"use strict";r.r(e);var n=r(21),o=(r(552),r(556),r(190),{props:{label:{default:""},labelWidth:{default:"200px"},error:[Boolean,Number,String,Array,Object],widthBreakpoint:{default:600}},computed:{_compError:function(){var t=[];return"string"==typeof this.error?t=[this.error]:Array.isArray(this.error)?t=this.error:"object"==Object(n.a)(this.error)&&(t=Object.values(this.error)),t.join("<br>")}},data:function(){return{parentWidth:0,isLarge:!1}},methods:{calculateSizes:function(){this.parentWidth=this.$el.offsetWidth,this.isLarge=this.$el.offsetWidth>=this.widthBreakpoint},resizeEventListener:function(t){this.calculateSizes()}},beforeDestroy:function(){window.removeEventListener("resize",this.resizeEventListener)},mounted:function(){this.calculateSizes(),window.addEventListener("resize",this.resizeEventListener)}}),l=(r(557),r(14)),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-field mb-3",class:{"d-flex":t.isLarge,"ui-field-error":t._compError}},[r("div",{class:{"py-2":t.isLarge,"pb-1":!t.isLarge},style:"min-width:"+(t.isLarge?null:t.labelWidth)+"; max-width:"+(t.isLarge?null:t.labelWidth)+";"},[t._t("label",(function(){return[t._v(t._s(t.label))]}))],2),t._v(" "),r("div",{class:{"flex-grow-1":t.isLarge}},[t._t("default"),t._v(" "),t._compError?r("small",{staticClass:"d-block text-danger",domProps:{innerHTML:t._s(t._compError)}}):t._e()],2)])}),[],!1,null,null,null);e.default=component.exports},554:function(t,e,r){var n=r(4),o=r(25),l=r(15),c=r(555),d=n("".replace),f="["+c+"]",m=RegExp("^"+f+f+"*"),v=RegExp(f+f+"*$"),h=function(t){return function(e){var r=l(o(e));return 1&t&&(r=d(r,m,"")),2&t&&(r=d(r,v,"")),r}};t.exports={start:h(1),end:h(2),trim:h(3)}},555:function(t,e){t.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},556:function(t,e,r){var n=r(6),o=r(407).values;n({target:"Object",stat:!0},{values:function(t){return o(t)}})},557:function(t,e,r){"use strict";r(550)},558:function(t,e,r){var n=r(74)(!1);n.push([t.i,".ui-field-error .el-input__inner,.ui-field-error .form-control{border-color:var(--bs-danger);box-shadow:none!important;outline:0!important}",""]),t.exports=n},559:function(t,e,r){"use strict";r.r(e);r(12);var n={props:{value:[Boolean,Object],method:{default:"get"},action:{default:""},mountedSubmit:{default:!1,type:Boolean},successText:{default:""}},data:function(){return{loading:!1,response:!1,error:!1,errorFields:{}}},methods:{submit:function(){var t=this;return this.loading=!0,this.error=!1,this.errorFields={},this.$axios({method:this.method,url:this.action,data:"get"!=this.method?this.value:null,params:"get"==this.method?this.value:null}).then((function(e){var r=t.parseResponseData(e.data);t.loading=!1,t.response=r,t.$emit("success",r),t.$emit("response",r),t.successText&&t.$swal.fire(t.successText)})).catch((function(e){var r=t.parseResponseData(e.response.data);t.loading=!1,t.error=r.message,t.errorFields=r.fields,t.$emit("error",r),t.$emit("response",r)}))},parseResponseData:function(t){return["per_page","page"].forEach((function(e){"string"==typeof t[e]&&(t[e]=parseInt(t[e]))})),t}},mounted:function(){this.mountedSubmit&&this.submit()}},o=r(14),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("form",{attrs:{action:""},on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("default",null,{loading:t.loading,response:t.response,error:t.error,errorFields:t.errorFields})],2)}),[],!1,null,null,null);e.default=component.exports},560:function(t,e,r){"use strict";r.r(e);var n={props:{value:[Boolean,String,Array,Object]},watch:{$props:{deep:!0,handler:function(t){this.props=JSON.parse(JSON.stringify(t))}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{emitValue:function(){this.$emit("value",this.props.value),this.$emit("input",this.props.value),this.$emit("change",this.props.value)}}},o=r(14),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"modal show",staticStyle:{display:"block",background:"#00000044","animation-duration":"200ms"},attrs:{tabindex:"-1"},on:{click:function(e){if(e.target!==e.currentTarget)return null;t.props.value=!1,t.emitValue()}}},[r("div",{staticClass:"modal-dialog"},[r("div",{staticClass:"modal-content"},[r("div",{staticClass:"modal-header"},[t._t("header"),t._v(" "),r("button",{staticClass:"btn-close",attrs:{type:"button"},on:{click:function(e){t.props.value=!1,t.emitValue()}}})],2),t._v(" "),r("div",{staticClass:"modal-body"},[t._t("body")],2),t._v(" "),r("div",{staticClass:"modal-footer"},[t._t("footer")],2)])])]):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},562:function(t,e,r){var content=r(569);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(75).default)("dc996836",content,!0,{sourceMap:!1})},564:function(t,e,r){var content=r(576);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(75).default)("212e4890",content,!0,{sourceMap:!1})},568:function(t,e,r){"use strict";r(562)},569:function(t,e,r){var n=r(74)(!1);n.push([t.i,"@media (max-width:768px){.ui-model-edit-fields{margin-bottom:50px}.ui-model-edit-actions{position:fixed;bottom:0;left:0;width:100%;display:flex}.ui-model-edit-actions>.btn{flex-basis:100%;text-align:center}}",""]),t.exports=n},571:function(t,e,r){"use strict";r.r(e);r(61),r(26),r(191);var n={props:{value:{default:""},returnField:{default:!1,type:[Boolean,String]}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},data:function(){return{search:{params:{q:""},loading:!1,response:!1},props:JSON.parse(JSON.stringify(this.$props))}},methods:{filesSearch:function(){var t=this;this.search.loading=!0,this.__fileSearchTimeout&&clearTimeout(this.__fileSearchTimeout),this.__fileSearchTimeout=setTimeout((function(){t.$axios.get("/api/files/search",{params:t.search.params}).then((function(e){t.search.loading=!1,t.search.response=e.data}))}),1e3)},filesSelect:function(t){t=JSON.parse(JSON.stringify(t)),this.returnField&&(t=t[this.returnField]||!1),this.props.value=t}}},o=r(14),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"input-group form-control p-0"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.search.params.q,expression:"search.params.q"}],staticClass:"form-control border-0 shadow-none",attrs:{type:"text",placeholder:"Buscar arquivo"},domProps:{value:t.search.params.q},on:{keyup:function(e){return t.filesSearch()},input:function(e){e.target.composing||t.$set(t.search.params,"q",e.target.value)}}}),t._v(" "),r("div",{staticClass:"input-group-btn"},[r("button",{directives:[{name:"loading",rawName:"v-loading",value:t.search.loading,expression:"search.loading"}],staticClass:"btn btn-primary border-0 shadow-none rounded-0",attrs:{type:"button"}},[r("i",{staticClass:"fas fa-fw fa-search"})])])]),t._v(" "),t.search.response?r("div",{staticClass:"list-inline p-2 border border-light shadow-sm mt-2"},[0==t.search.response.data.length?r("div",{staticClass:"list-inline-item",staticStyle:{cursor:"pointer"}},[r("div",{staticStyle:{padding:"12px 0",width:"100%","text-align":"center"}},[t._v("Nenhum arquivo encontrado")])]):t._e(),t._v(" "),t._l(t.search.response.data,(function(e){return r("div",{staticClass:"list-inline-item",staticStyle:{cursor:"pointer"},on:{click:function(r){return t.filesSelect(e)}}},["image"==e.type?r("img",{key:e.id,staticStyle:{width:"50px",height:"50px","object-fit":"cover"},attrs:{src:e.url,alt:""}}):r("div",{staticStyle:{padding:"12px 0",width:"50px","text-align":"center"}},[t._v(t._s(e.ext))])])}))],2):t._e()])}),[],!1,null,null,null);e.default=component.exports},573:function(t,e,r){"use strict";r.r(e);r(61);var n=r(579),o={props:{value:[Boolean,String],language:{default:"html"},theme:{default:"vs-dark"}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props)),monaco:!1}},watch:{$props:{deep:!0,handler:function(t){this.$el.contains(document.activeElement)||(this.props=JSON.parse(JSON.stringify(t)),this.setValue(this.props.value))}}},methods:{monacoInit:function(){var t=this;setTimeout((function(){var e=t.$refs.monaco;e&&(t.monaco=n.a.create(e,{value:t.props.value,language:t.props.language,theme:t.props.theme,automaticLayout:!0}),t.monaco.getModel().onDidChangeContent((function(e){t.props.value=t.monaco.getModel().getValue(),t.emitValue()})),t.monaco.getModel().setValue(t.props.value))}),100)},emitValue:function(){this.$emit("value",this.props.value),this.$emit("input",this.props.value),this.$emit("change",this.props.value)},setValue:function(t){this.$el.contains(document.activeElement)||this.monaco.getModel().setValue(t)},getValue:function(){return this.props.value=this.monaco.getModel().getValue()}},mounted:function(){this.monacoInit()}},l=r(14),component=Object(l.a)(o,(function(){var t=this.$createElement;return(this._self._c||t)("div",{ref:"monaco",staticStyle:{width:"100%",height:"150px"}})}),[],!1,null,null,null);e.default=component.exports},574:function(t,e,r){"use strict";r.r(e);var n=r(21),o=(r(552),r(61),r(94),r(409),r(12),{props:{value:{default:function(){return{}},type:[Boolean,Number,String,Object]},modelName:{default:""},modelId:{default:!1,type:[Boolean,Number,String]},singular:{default:"Item"},plural:{default:"Itens"},showActions:{default:!0},redirect:{default:"edit"}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},computed:{_modelId:function(){var t=+this.props.modelId;return"object"==Object(n.a)(this.props.value)&&this.props.value.id&&(t=+this.props.value.id),!isNaN(t)&&t}},data:function(){return{finding:!1,props:JSON.parse(JSON.stringify(this.$props))}},methods:{find:function(){var t=this;this._modelId&&(this.finding=!0,this.$axios.get("/api/".concat(this.modelName,"/find/").concat(this._modelId)).then((function(e){t.finding=!1,t.props.value=e.data})))},onSuccess:function(t){var e=this;this.props.value=t,this.$emit("success",t),this.$swal.fire({title:"Dados de ".concat(this.singular," foram salvos"),confirmButtonText:"Lista de ".concat(this.plural),showCancelButton:!0,cancelButtonText:"Fechar"}).then((function(t){t.isConfirmed&&e.$router.push("/admin/".concat(e.modelName,"/"))}))},successRedirect:function(){"edit"==this.redirect?this.$router.push("/admin/".concat(this.modelName,"/").concat(this.props.value&&this.props.value.id?this.props.value.id:"new")):"back"==this.redirect?this.$router.go(-1):this.$router.push(this.redirect)}},mounted:function(){this.find()}}),l=(r(568),r(14)),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("ui-form",{attrs:{method:"post",action:"/api/"+t.modelName+"/save"},on:{success:t.onSuccess},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.loading,o=e.error,l=e.errorFields;return[r("div",{staticClass:"ui-model-edit-fields bg-white p-3 shadow-sm"},[r("el-collapse-transition",[o?r("div",{staticClass:"alert alert-danger"},[r("a",{staticClass:"float-end text-danger fw-bold",attrs:{href:"javascript:;"},on:{click:function(t){o=!1}}},[r("i",{staticClass:"fas fa-fw fa-times"})]),t._v(" "),r("div",{domProps:{innerHTML:t._s(o)}})]):t._e()]),t._v(" "),t._t("default",null,{value:t.props.value,loading:n,error:o,errorFields:l})],2),t._v(" "),t.showActions?r("div",{staticClass:"ui-model-edit-actions text-end mt-3 p-1 p-md-3 bg-white shadow-sm"},[t._t("actions"),t._v(" "),t.props.value.id?r("nuxt-link",{staticClass:"btn btn-light",attrs:{to:"/admin/"+t.modelName+"/new"}},[t._v("\n            Criar "+t._s(t.singular)+"\n        ")]):t._e(),t._v(" "),r("button",{staticClass:"btn btn-light",attrs:{type:"button"},on:{click:function(e){return t.$router.go(-1)}}},[t._v("\n            Voltar\n        ")]),t._v(" "),r("button",{directives:[{name:"loading",rawName:"v-loading",value:n,expression:"loading"}],staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("\n            Salvar\n        ")])],2):t._e()]}}],null,!0),model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}})}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiForm:r(559).default})},575:function(t,e,r){"use strict";r(564)},576:function(t,e,r){var n=r(74)(!1);n.push([t.i,".ui-file-upload-droparea{border:3px dashed var(--bs-gray-300);display:flex;align-items:center;justify-content:center;height:200px}",""]),t.exports=n},577:function(t,e,r){"use strict";r.r(e);r(61),r(42);var n={props:{type:{default:"base64"},folder:{default:""},multiple:{default:!0},dropArea:{default:!0},uploadOnSelect:{default:!0},dropdownLeft:{default:!0},modalOpen:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},data:function(){return{success:!1,error:!1,uploadPercent:0,uploading:!1,file:!1,save:{folder:this.$props.folder},props:JSON.parse(JSON.stringify(this.$props))}},methods:{openFileBrowser:function(){var t=this;Object.assign(document.createElement("input"),{type:"file",onchange:function(e){t.file=e.target.files[0]}}).click()},fileSave:function(){var t=this,data=new FormData;for(var i in this.save)data.append(i,this.save[i]);this.file&&data.append("file",this.file,this.file.name),this.success=!1,this.error=!1,this.uploadPercent=0,this.uploading=!0,this.$axios.post("/api/files/upload",data,{onUploadProgress:function(t){file.uploadPercent=Math.round(100*t.loaded/t.total)}}).then((function(e){t.uploading=!1,t.success=!0,t.file=!1,t.save={},t.props.modalOpen=!1,t.$emit("success",e.data)})).catch((function(e){t.uploading=!1,t.error=e.response.data.message||"Erro desconhecido",t.$emit("error",e.response.data)}))}}},o=(r(575),r(14)),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticStyle:{position:"relative"}},[r("div",{on:{click:function(e){t.props.modalOpen=!0}}},[t._t("button",(function(){return[t._m(0)]}))],2),t._v(" "),r("ui-modal",{staticStyle:{"text-align":"left!important"},scopedSlots:t._u([{key:"header",fn:function(){return[t._v("Upload")]},proxy:!0},{key:"body",fn:function(){return[r("ui-field",{attrs:{label:"Descrição do arquivo"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.save.name,expression:"save.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.save.name},on:{input:function(e){e.target.composing||t.$set(t.save,"name",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Pasta"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.save.folder,expression:"save.folder"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.save.folder},on:{input:function(e){e.target.composing||t.$set(t.save,"folder",e.target.value)}}})]),t._v(" "),r("el-tabs",{attrs:{value:"upload"}},[r("el-tab-pane",{attrs:{label:"Upload",name:"upload"}},[r("ui-field",{attrs:{label:"Faça upload"}},[r("button",{staticClass:"btn btn-outline-light w-100",attrs:{type:"button"},on:{click:function(e){return t.openFileBrowser()}}},[r("span",[t._v(t._s(t.file?t.file.name:"Upload"))]),t._v(" "),r("i",{staticClass:"fas fa-fw fa-upload"})])])],1),t._v(" "),r("el-tab-pane",{attrs:{label:"URL",name:"url"}},[r("ui-field",{attrs:{label:"Informe a URL externa da imagem"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.save.url,expression:"save.url"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.save.url},on:{input:function(e){e.target.composing||t.$set(t.save,"url",e.target.value)}}})])],1),t._v(" "),r("el-tab-pane",{attrs:{label:"Biblioteca",name:"library"}},[r("ui-field",{attrs:{label:"Selecione da biblioteca"}},[r("ui-file-library",{attrs:{"return-field":"url"},model:{value:t.save.url,callback:function(e){t.$set(t.save,"url",e)},expression:"save.url"}})],1)],1)],1)]},proxy:!0},{key:"footer",fn:function(){return[r("button",{staticClass:"btn btn-light",attrs:{type:"button"},on:{click:function(e){t.props.modalOpen=!1}}},[r("i",{staticClass:"fas fa-fw fa-times"}),t._v(" Cancelar\n            ")]),t._v(" "),r("button",{directives:[{name:"loading",rawName:"v-loading",value:t.uploading,expression:"uploading"}],staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(e){return t.fileSave()}}},[r("i",{staticClass:"fas fa-fw fa-save"}),t._v(" Salvar\n            ")])]},proxy:!0}]),model:{value:t.props.modalOpen,callback:function(e){t.$set(t.props,"modalOpen",e)},expression:"props.modalOpen"}})],1)}),[function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("button",{staticClass:"btn btn-outline-light w-100",attrs:{type:"button"}},[t._v("\n                Upload "),r("i",{staticClass:"fas fa-fw fa-upload"})])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiField:r(553).default,UiFileLibrary:r(571).default,UiModal:r(560).default})},702:function(t,e,r){"use strict";r.r(e);var n={layout:"default/admin",middleware:"auth",head:function(){return{title:"Editar arquivo"}}},o=r(14),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("ui-model-edit",{attrs:{"model-name":"files","model-id":t.$route.params.id,singular:"Arquivo",plural:"Arquivos"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.value,o=e.errorFields;return[n.id?[r("ui-field",{attrs:{label:"Nome",layout:"horizontal",error:o.name}},[r("input",{directives:[{name:"model",rawName:"v-model",value:n.name,expression:"value.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:n.name},on:{input:function(e){e.target.composing||t.$set(n,"name",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Pasta",layout:"horizontal",error:o.folder}},[r("input",{directives:[{name:"model",rawName:"v-model",value:n.folder,expression:"value.folder"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:n.folder},on:{input:function(e){e.target.composing||t.$set(n,"folder",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Arquivo",layout:"horizontal"}},[r("a",{staticClass:"btn btn-light",attrs:{href:n.url,download:n.slug}},[t._v("\n                Download "),r("i",{staticClass:"fas fa-fw fa-download"})]),t._v(" "),"image"==n.type?r("div",{staticClass:"bg-light text-center py-3 mt-3"},[r("img",{staticStyle:{"max-width":"400px","max-height":"50vh","object-fit":"cover"},attrs:{src:n.url,alt:""}})]):t._e(),t._v(" "),r("div",{staticClass:"mb-3"}),t._v(" "),n.is_text?r("ui-code",{staticStyle:{height:"400px"},attrs:{language:n.ext},model:{value:n.content,callback:function(e){t.$set(n,"content",e)},expression:"value.content"}}):t._e()],1)]:[r("ui-field",{attrs:{label:"Upload de arquivo",layout:"horizontal"}},[r("ui-file-upload",{on:{success:function(e){return t.$router.push("/admin/files/"+e.id)}}})],1)]]}}])})}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiField:r(553).default,UiCode:r(573).default,UiFileUpload:r(577).default,UiModelEdit:r(574).default})}}]);