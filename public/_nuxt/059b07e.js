(window.webpackJsonp=window.webpackJsonp||[]).push([[40,20,21,24,27,28,31],{558:function(t,e,r){"use strict";var n=r(14),o=r(3),l=r(4),c=r(136),d=r(21),f=r(16),v=r(407),m=r(52),h=r(135),_=r(408),y=r(5),w=r(95).f,x=r(42).f,$=r(18).f,N=r(409),S=r(560).trim,C="Number",O=o.Number,E=O.prototype,k=o.TypeError,I=l("".slice),j=l("".charCodeAt),L=function(t){var e=_(t,"number");return"bigint"==typeof e?e:A(e)},A=function(t){var e,r,n,o,l,c,d,code,f=_(t,"number");if(h(f))throw k("Cannot convert a Symbol value to a number");if("string"==typeof f&&f.length>2)if(f=S(f),43===(e=j(f,0))||45===e){if(88===(r=j(f,2))||120===r)return NaN}else if(48===e){switch(j(f,1)){case 66:case 98:n=2,o=49;break;case 79:case 111:n=8,o=55;break;default:return+f}for(c=(l=I(f,2)).length,d=0;d<c;d++)if((code=j(l,d))<48||code>o)return NaN;return parseInt(l,n)}return+f};if(c(C,!O(" 0o1")||!O("0b1")||O("+0x1"))){for(var T,F=function(t){var e=arguments.length<1?0:O(L(t)),r=this;return m(E,r)&&y((function(){N(r)}))?v(Object(e),r,F):e},R=n?w(O):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,isFinite,isInteger,isNaN,isSafeInteger,parseFloat,parseInt,fromString,range".split(","),J=0;R.length>J;J++)f(O,T=R[J])&&!f(F,T)&&$(F,T,x(O,T));F.prototype=E,E.constructor=F,d(o,C,F)}},559:function(t,e,r){var content=r(566);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(63).default)("039c59a2",content,!0,{sourceMap:!1})},560:function(t,e,r){var n=r(4),o=r(26),l=r(15),c=r(561),d=n("".replace),f="["+c+"]",v=RegExp("^"+f+f+"*"),m=RegExp(f+f+"*$"),h=function(t){return function(e){var r=l(o(e));return 1&t&&(r=d(r,v,"")),2&t&&(r=d(r,m,"")),r}};t.exports={start:h(1),end:h(2),trim:h(3)}},561:function(t,e){t.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},563:function(t,e,r){"use strict";r.r(e);var n=r(20),o=(r(558),r(564),r(191),{props:{label:{default:""},labelWidth:{default:"200px"},info:{default:""},error:[Boolean,Number,String,Array,Object],widthBreakpoint:{default:600}},computed:{_compError:function(){var t=[];return"string"==typeof this.error?t=[this.error]:Array.isArray(this.error)?t=this.error:"object"==Object(n.a)(this.error)&&(t=Object.values(this.error)),t.join("<br>")}},data:function(){return{parentWidth:0,isLarge:!1}},methods:{calculateSizes:function(){this.parentWidth=this.$el.offsetWidth,this.isLarge=this.$el.offsetWidth>=this.widthBreakpoint},resizeEventListener:function(t){this.calculateSizes()}},beforeDestroy:function(){window.removeEventListener("resize",this.resizeEventListener)},mounted:function(){this.calculateSizes(),window.addEventListener("resize",this.resizeEventListener)}}),l=(r(565),r(9)),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-field mb-3",class:{"d-flex":t.isLarge,"ui-field-error":t._compError}},[r("div",{class:{"py-2":t.isLarge,"pb-1":!t.isLarge},style:"min-width:"+(t.isLarge?null:t.labelWidth)+"; max-width:"+(t.isLarge?null:t.labelWidth)+";"},[t._t("label",(function(){return[t._v(t._s(t.label))]})),t._v(" "),r("small",{staticClass:"d-block text-muted"},[t._t("info",(function(){return[r("span",{domProps:{innerHTML:t._s(t.info)}})]}))],2)],2),t._v(" "),r("div",{class:{"flex-grow-1":t.isLarge}},[t._t("default"),t._v(" "),t._compError?r("small",{staticClass:"d-block text-danger",domProps:{innerHTML:t._s(t._compError)}}):t._e()],2)])}),[],!1,null,null,null);e.default=component.exports},564:function(t,e,r){var n=r(6),o=r(410).values;n({target:"Object",stat:!0},{values:function(t){return o(t)}})},565:function(t,e,r){"use strict";r(559)},566:function(t,e,r){var n=r(62)(!1);n.push([t.i,".ui-field-error .el-input__inner,.ui-field-error .form-control{border-color:var(--bs-danger);box-shadow:none!important;outline:0!important}",""]),t.exports=n},567:function(t,e,r){"use strict";r.r(e);var n=r(20),o=(r(25),r(192),r(411),r(572),r(12),r(573),r(574),r(575),r(576),r(577),r(578),r(579),r(580),r(581),r(582),r(583),r(584),r(585),r(586),r(587),r(588),r(589),r(590),r(591),r(592),r(593),r(594),r(595),r(596),r(29),{props:{value:[Boolean,Object],method:{default:"get"},action:{default:""},mountedSubmit:{default:!1,type:Boolean},successText:{default:""}},data:function(){return{loading:!1,response:!1,error:!1,errorFields:{}}},methods:{submit:function(){var t=this,e=this.method,r=this.action,data=null,o=null;if("post"==this.method)for(var l in data=new FormData,this.value){var c=this.value[l];if(Array.isArray(c)){if(0==c.length){data.append("".concat(l),"");continue}for(var i in c)data.append("".concat(l,"[]"),c[i]||"")}else if(c&&"object"==Object(n.a)(c)&&c.mime&&c.content){for(var d=c.content.split(","),f=(d[0].match(/:(.*?);/)[1],atob(d[1])),v=f.length,m=new Uint8Array(v);v--;)m[v]=f.charCodeAt(v);data.append(l,new File([m],c.name,{type:c.mime}))}else data.append(l,c||"")}else o=this.value;return this.loading=!0,this.error=!1,this.errorFields={},this.$axios({method:e,url:r,data:data,params:o,headers:{"Content-Type":"multipart/form-data"}}).then((function(e){var r=t.parseResponseData(e.data);t.loading=!1,t.response=r,t.$emit("success",r),t.$emit("response",r),t.successText&&t.$swal.fire(t.successText)})).catch((function(e){var r=t.parseResponseData(e.response.data);t.loading=!1,t.error=r.message,t.errorFields=r.fields,t.$emit("error",r),t.$emit("response",r)}))},parseResponseData:function(t){return["per_page","page"].forEach((function(e){"string"==typeof t[e]&&(t[e]=parseInt(t[e]))})),t}},mounted:function(){this.mountedSubmit&&this.submit()}}),l=r(9),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement;return(t._self._c||e)("form",{attrs:{action:""},on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("default",null,{loading:t.loading,response:t.response,error:t.error,errorFields:t.errorFields})],2)}),[],!1,null,null,null);e.default=component.exports},569:function(t,e,r){var content=r(571);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(63).default)("dc996836",content,!0,{sourceMap:!1})},570:function(t,e,r){"use strict";r(569)},571:function(t,e,r){var n=r(62)(!1);n.push([t.i,"@media (max-width:768px){.ui-model-edit-fields{margin-bottom:50px}.ui-model-edit-actions{position:fixed;bottom:0;left:0;width:100%;display:flex}.ui-model-edit-actions>.btn{flex-basis:100%;text-align:center;margin-left:5px;margin-right:5px}}",""]),t.exports=n},597:function(t,e,r){"use strict";r.r(e);var n=r(20),o=(r(558),r(51),r(96),r(412),r(12),{props:{value:{default:function(){return{}},type:[Boolean,Number,String,Object]},modelName:{default:""},modelId:{default:!1,type:[Boolean,Number,String]},singular:{default:"Item"},plural:{default:"Itens"},showActions:{default:!0},redirect:{default:"edit"}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},computed:{_modelId:function(){var t=+this.props.modelId;return"object"==Object(n.a)(this.props.value)&&this.props.value.id&&(t=+this.props.value.id),!isNaN(t)&&t}},data:function(){return{finding:!1,backUrl:localStorage.getItem("ui-model-search-".concat(this.modelName,"-url"))||"",props:JSON.parse(JSON.stringify(this.$props))}},methods:{find:function(){var t=this;this._modelId&&(this.finding=!0,this.$axios.get("/api/".concat(this.modelName,"/find/").concat(this._modelId)).then((function(e){t.finding=!1,t.props.value=e.data})))},onSuccess:function(t){var e=this;this.props.value=t,this.$emit("success",t),this.$swal.fire({title:"Dados de ".concat(this.singular," foram salvos"),confirmButtonText:"Lista de ".concat(this.plural),showCancelButton:!0,cancelButtonText:"Fechar"}).then((function(t){t.isConfirmed&&e.$router.push(e.backUrl)})),this.$router.push("/admin/".concat(this.modelName,"/").concat(t.id))},successRedirect:function(){"edit"==this.redirect?this.$router.push("/admin/".concat(this.modelName,"/").concat(this.props.value&&this.props.value.id?this.props.value.id:"new")):"back"==this.redirect?this.$router.go(-1):this.$router.push(this.redirect)}},mounted:function(){this.find()}}),l=(r(570),r(9)),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("ui-form",{attrs:{method:"post",action:"/api/"+t.modelName+"/save"},on:{success:t.onSuccess},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.loading,o=e.error,l=e.errorFields;return[r("div",{staticClass:"ui-model-edit-fields bg-white p-3 shadow-sm"},[r("el-collapse-transition",[o?r("div",{staticClass:"alert alert-danger"},[r("a",{staticClass:"float-end text-danger fw-bold",attrs:{href:"javascript:;"},on:{click:function(t){o=!1}}},[r("i",{staticClass:"fas fa-fw fa-times"})]),t._v(" "),r("div",{domProps:{innerHTML:t._s(o)}})]):t._e()]),t._v(" "),t._t("default",null,{value:t.props.value,loading:n,error:o,errorFields:l})],2),t._v(" "),t.showActions?r("div",{staticClass:"ui-model-edit-actions text-end bg-white shadow-sm py-2 mt-md-3 p-md-3"},[t._t("actions"),t._v(" "),t.props.value.id?r("nuxt-link",{staticClass:"btn btn-light",attrs:{to:"/admin/"+t.modelName+"/new"}},[t._v("\n            Criar "+t._s(t.singular)+"\n        ")]):t._e(),t._v(" "),r("nuxt-link",{staticClass:"btn btn-light",attrs:{to:t.backUrl}},[t._v("\n            Voltar\n        ")]),t._v(" "),r("button",{directives:[{name:"loading",rawName:"v-loading",value:n,expression:"loading"}],staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("\n            Salvar\n        ")])],2):t._e()]}}],null,!0),model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}})}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiForm:r(567).default})},599:function(t,e,r){"use strict";r.r(e);r(51),r(29),r(25),r(192);var n={props:{value:{default:!1,type:[Boolean,Object]},folder:{default:""},file:{default:!1,type:[Boolean,Object]},preview:{default:!0},previewHeight:{default:"200px"}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},computed:{_file:function(){return this.props.value?this.props.value:!!this.props.file&&this.props.file}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{fileBrowser:function(){var t=this;Object.assign(document.createElement("input"),{type:"file",onchange:function(e){t.fileGet(e.target.files[0])}}).click()},fileGet:function(t){var e=this,r=new FileReader;r.readAsDataURL(t),r.onload=function(){e.props.value={name:t.name,folder:e.props.folder,size:t.size,mime:t.type,type:t.type.split("/").shift(),ext:t.name.split(".").pop(),content:r.result},e.$emit("input",e.props.value),e.$emit("file-get",t)}},fileClear:function(){this.props.value=!1,this.$emit("file-clear",!1)}}},o=n,l=r(9),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-file",on:{dragover:function(t){t.preventDefault()},drop:function(e){return e.preventDefault(),t.fileGet(e.dataTransfer.files[0])}}},[r("div",{staticClass:"d-flex align-items-center"},[t.props.value?t._e():r("div",{staticClass:"flex-grow-1"},[r("button",{staticClass:"btn btn-light w-100",attrs:{type:"button"},on:{click:function(e){return t.fileBrowser()}}},[t.props.value?r("div",[t._v(t._s(t.props.value.name))]):r("div",[r("i",{staticClass:"fas fa-fw fa-file"}),t._v(" Browse")])])]),t._v(" "),t.props.value?r("div",{staticClass:"flex-grow-1"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.name,expression:"props.value.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.props.value.name},on:{input:function(e){e.target.composing||t.$set(t.props.value,"name",e.target.value)}}})]):t._e(),t._v(" "),t.props.value?r("div",{staticClass:"ms-2"},[r("button",{staticClass:"btn btn-light w-100",attrs:{type:"button"},on:{click:function(e){return t.fileClear()}}},[r("i",{staticClass:"fas fa-fw fa-times"})])]):t._e(),t._v(" "),t._t("actions")],2),t._v(" "),t.props.preview?r("div",{staticClass:"bg-light mt-2 d-flex align-items-center justify-content-center",style:"height:calc("+t.previewHeight+" + 30px);"},[t._t("preview",(function(){return[t._file&&(t._file.type||"").includes("image")?r("div",[r("img",{style:"height:"+t.previewHeight+"; max-width:300px; object-fit:cover;",attrs:{src:t._file.url||t._file.content,alt:""}}),t._v(" "),r("small",{staticClass:"d-block text-center"},[t._v(t._s(t._f("fileSize")(t._file.size)))])]):t._file?r("div",[r("div",{staticStyle:{"font-size":"40px","line-height":"35px","text-transform":"uppercase"}},[t._v(t._s(t._file.ext))]),t._v(" "),r("small",{staticClass:"d-block text-center"},[t._v(t._s(t._f("fileSize")(t._file.size)))])]):r("div",[t._v("Arraste o arquivo aqui")])]}),{value:t.props.value,previewHeight:t.previewHeight})],2):t._e()])}),[],!1,null,null,null);e.default=component.exports},612:function(t,e,r){"use strict";r.r(e);var n={props:{value:[Boolean,String,Array,Object],width:{default:"400px"}},watch:{$props:{deep:!0,handler:function(t){this.props=JSON.parse(JSON.stringify(t))}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{emitValue:function(){this.$emit("value",this.props.value),this.$emit("input",this.props.value),this.$emit("change",this.props.value),this.props.value?this.$emit("open",this.props.value):this.$emit("close",this.props.value)}}},o=r(9),component=Object(o.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"modal show",staticStyle:{display:"block",background:"#00000044","animation-duration":"200ms"},attrs:{tabindex:"-1"},on:{click:function(e){if(e.target!==e.currentTarget)return null;t.props.value=!1,t.emitValue()}}},[r("div",{staticClass:"modal-dialog",style:"max-width:"+t.width+"!important;"},[r("div",{staticClass:"modal-content"},[r("div",{staticClass:"modal-header"},[t._t("header"),t._v(" "),r("button",{staticClass:"btn-close",attrs:{type:"button"},on:{click:function(e){t.props.value=!1,t.emitValue()}}})],2),t._v(" "),r("div",{staticClass:"modal-body"},[t._t("body")],2),t._v(" "),r("div",{staticClass:"modal-footer"},[t._t("footer")],2)])])]):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},634:function(t,e,r){"use strict";r.r(e);var n=r(20),o=(r(51),r(25),r(78),r(12),r(98),r(28),r(27),r(607),r(413),{props:{value:{default:""},url:{default:""}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{photopeaIframeUrl:function(){var t=Object.assign(new URL(location.href),{pathname:this.props.url}).toString().replace(/\?.+/g,"");return"https://www.photopea.com#"+JSON.stringify({files:[t]})},save:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"jpg",e=this.$refs.photopeaIframe.contentWindow;e.postMessage('activeDocument.saveToOE("'.concat(t,'")'),"*")},photopeaIframeCallback:function(t){var e=this;if("object"==Object(n.a)(t.data)){var r=new Blob([t.data],{type:"image/jpeg"}),o=new FileReader;o.readAsDataURL(r),o.onloadend=function(){e.props.value=o.result,e.$forceUpdate()}}}},mounted:function(){window.addEventListener("message",this.photopeaIframeCallback)},beforeDestroy:function(){window.removeEventListener("message",this.photopeaIframeCallback)}}),l=o,c=r(9),component=Object(c.a)(l,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticStyle:{width:"100%",height:"400px"}},[r("iframe",{ref:"photopeaIframe",staticStyle:{position:"relative",width:"100%",height:"100%",border:"none"},attrs:{src:t.photopeaIframeUrl()}})])}),[],!1,null,null,null);e.default=component.exports},771:function(t,e,r){"use strict";r.r(e);r(51);var n={layout:"admin",middleware:["auth","permission"],head:function(){return{title:"Editar arquivo"}},methods:{photopeaSave:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:"jpg";this.$refs.photopea.save(e),setTimeout((function(){t.$router.push({query:{}})}),100)}}},o=n,l=r(9),component=Object(l.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("ui-model-edit",{attrs:{"model-name":"files","model-id":t.$route.params.id,singular:"Arquivo",plural:"Arquivos"},scopedSlots:t._u([{key:"default",fn:function(e){var n=e.value,o=e.errorFields;return[r("ui-field",{attrs:{label:"Nome",layout:"horizontal",error:o.name}},[r("input",{directives:[{name:"model",rawName:"v-model",value:n.name,expression:"value.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:n.name},on:{input:function(e){e.target.composing||t.$set(n,"name",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Pasta",layout:"horizontal",error:o.folder}},[r("input",{directives:[{name:"model",rawName:"v-model",value:n.folder,expression:"value.folder"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:n.folder},on:{input:function(e){e.target.composing||t.$set(n,"folder",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Arquivo",layout:"horizontal"}},[r("ui-file",{attrs:{file:n},model:{value:n.content,callback:function(e){t.$set(n,"content",e)},expression:"value.content"}})],1),t._v(" "),"image"==n.type?r("ui-modal",{attrs:{value:t.$route.query.contentEdit,width:"90vw"},on:{close:function(e){return t.$router.push({query:{}})}},scopedSlots:t._u([{key:"header",fn:function(){return[t._v("Editar")]},proxy:!0},{key:"body",fn:function(){return[r("ui-photopea",{ref:"photopea",staticStyle:{height:"70vh"},attrs:{url:n.url},model:{value:n.content,callback:function(e){t.$set(n,"content",e)},expression:"value.content"}})]},proxy:!0},{key:"footer",fn:function(){return[r("ui-dropdown",{attrs:{type:"top-right"},scopedSlots:t._u([{key:"dropdown",fn:function(){return[r("div",{staticClass:"p-1",staticStyle:{width:"150px"}},[r("button",{staticClass:"btn btn-primary w-100",attrs:{type:"button"},on:{click:function(e){return t.photopeaSave("jpg")}}},[t._v("\n                            JPG\n                        ")]),t._v(" "),r("button",{staticClass:"btn btn-primary w-100 mt-1",attrs:{type:"button"},on:{click:function(e){return t.photopeaSave("png")}}},[t._v("\n                            PNG\n                        ")])])]},proxy:!0}],null,!0)},[r("button",{staticClass:"btn btn-success",attrs:{type:"button"},on:{click:function(e){return t.photopeaSave()}}},[t._v("\n                    Salvar\n                ")])])]},proxy:!0}],null,!0)}):t._e()]}}])})}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiField:r(563).default,UiFile:r(599).default,UiPhotopea:r(634).default,UiDropdown:r(415).default,UiModal:r(612).default,UiModelEdit:r(597).default})}}]);