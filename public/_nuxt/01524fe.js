(window.webpackJsonp=window.webpackJsonp||[]).push([[56,13,21,26,28,31],{554:function(t,e,r){"use strict";var o=r(14),n=r(3),l=r(4),c=r(136),d=r(21),m=r(16),v=r(405),f=r(51),h=r(135),_=r(406),y=r(5),w=r(95).f,C=r(42).f,E=r(18).f,x=r(407),T=r(556).trim,$="Number",N=n.Number,O=N.prototype,S=n.TypeError,k=l("".slice),M=l("".charCodeAt),j=function(t){var e=_(t,"number");return"bigint"==typeof e?e:L(e)},L=function(t){var e,r,o,n,l,c,d,code,m=_(t,"number");if(h(m))throw S("Cannot convert a Symbol value to a number");if("string"==typeof m&&m.length>2)if(m=T(m),43===(e=M(m,0))||45===e){if(88===(r=M(m,2))||120===r)return NaN}else if(48===e){switch(M(m,1)){case 66:case 98:o=2,n=49;break;case 79:case 111:o=8,n=55;break;default:return+m}for(c=(l=k(m,2)).length,d=0;d<c;d++)if((code=M(l,d))<48||code>n)return NaN;return parseInt(l,o)}return+m};if(c($,!N(" 0o1")||!N("0b1")||N("+0x1"))){for(var P,I=function(t){var e=arguments.length<1?0:N(j(t)),r=this;return f(O,r)&&y((function(){x(r)}))?v(Object(e),r,I):e},z=o?w(N):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,isFinite,isInteger,isNaN,isSafeInteger,parseFloat,parseInt,fromString,range".split(","),A=0;z.length>A;A++)m(N,P=z[A])&&!m(I,P)&&E(I,P,C(N,P));I.prototype=O,O.constructor=I,d(n,$,I)}},555:function(t,e,r){var content=r(562);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(74).default)("039c59a2",content,!0,{sourceMap:!1})},556:function(t,e,r){var o=r(4),n=r(26),l=r(15),c=r(557),d=o("".replace),m="["+c+"]",v=RegExp("^"+m+m+"*"),f=RegExp(m+m+"*$"),h=function(t){return function(e){var r=l(n(e));return 1&t&&(r=d(r,v,"")),2&t&&(r=d(r,f,"")),r}};t.exports={start:h(1),end:h(2),trim:h(3)}},557:function(t,e){t.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},559:function(t,e,r){"use strict";r.r(e);var o=r(20),n=(r(554),r(560),r(191),{props:{label:{default:""},labelWidth:{default:"200px"},info:{default:""},error:[Boolean,Number,String,Array,Object],widthBreakpoint:{default:600}},computed:{_compError:function(){var t=[];return"string"==typeof this.error?t=[this.error]:Array.isArray(this.error)?t=this.error:"object"==Object(o.a)(this.error)&&(t=Object.values(this.error)),t.join("<br>")}},data:function(){return{parentWidth:0,isLarge:!1}},methods:{calculateSizes:function(){this.parentWidth=this.$el.offsetWidth,this.isLarge=this.$el.offsetWidth>=this.widthBreakpoint},resizeEventListener:function(t){this.calculateSizes()}},beforeDestroy:function(){window.removeEventListener("resize",this.resizeEventListener)},mounted:function(){this.calculateSizes(),window.addEventListener("resize",this.resizeEventListener)}}),l=(r(561),r(11)),component=Object(l.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-field mb-3",class:{"d-flex":t.isLarge,"ui-field-error":t._compError}},[r("div",{class:{"py-2":t.isLarge,"pb-1":!t.isLarge},style:"min-width:"+(t.isLarge?null:t.labelWidth)+"; max-width:"+(t.isLarge?null:t.labelWidth)+";"},[t._t("label",(function(){return[t._v(t._s(t.label))]})),t._v(" "),r("small",{staticClass:"d-block text-muted"},[t._t("info",(function(){return[r("span",{domProps:{innerHTML:t._s(t.info)}})]}))],2)],2),t._v(" "),r("div",{class:{"flex-grow-1":t.isLarge}},[t._t("default"),t._v(" "),t._compError?r("small",{staticClass:"d-block text-danger",domProps:{innerHTML:t._s(t._compError)}}):t._e()],2)])}),[],!1,null,null,null);e.default=component.exports},560:function(t,e,r){var o=r(6),n=r(408).values;o({target:"Object",stat:!0},{values:function(t){return n(t)}})},561:function(t,e,r){"use strict";r(555)},562:function(t,e,r){var o=r(73)(!1);o.push([t.i,".ui-field-error .el-input__inner,.ui-field-error .form-control{border-color:var(--bs-danger);box-shadow:none!important;outline:0!important}",""]),t.exports=o},594:function(t,e,r){"use strict";r.r(e);r(61);var o=r(598),n={props:{value:[Boolean,String],language:{default:"html"},theme:{default:"vs-dark"}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props)),monaco:!1}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)),this.setValue(this.props.value||""))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},methods:{monacoInit:function(){var t=this;setTimeout((function(){var e=t.$refs.monaco;t.monaco=o.a.create(e,{value:t.props.value||"",language:t.props.language,theme:t.props.theme,automaticLayout:!0}),t.monaco.getModel().onDidChangeContent((function(e){t.props.value=t.monaco.getModel().getValue()})),t.monaco.getModel().setValue(t.props.value)}),100)},setValue:function(t){this.$el.contains(document.activeElement)||this.monaco.getModel().setValue(t)},getValue:function(){return this.props.value=this.monaco.getModel().getValue()},resizeHandler:function(){this.monaco.layout({width:0})}},mounted:function(){this.monacoInit(),window.addEventListener("resize",this.resizeHandler)},beforeDestroy:function(){window.removeEventListener("resize",this.resizeHandler)}},l=r(11),component=Object(l.a)(n,(function(){var t=this.$createElement;return(this._self._c||t)("div",{ref:"monaco",staticStyle:{width:"100%",height:"150px"}})}),[],!1,null,null,null);e.default=component.exports},596:function(t,e,r){"use strict";r.r(e);r(61);var o={props:{value:{default:""},show:{default:!1},placeholder:{default:""}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"input-group form-control p-0"},["checkbox"==(t.props.show?"text":"password")?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"==(t.props.show?"text":"password")?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:t.props.show?"text":"password"},domProps:{value:t.props.value},on:{input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}}),t._v(" "),r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.show=!t.props.show}}},[t.props.show?r("i",{staticClass:"fas fa-eye"}):r("i",{staticClass:"fas fa-eye-slash"})])])])}),[],!1,null,null,null);e.default=component.exports},612:function(t,e,r){"use strict";r.r(e);var o={props:{value:[Boolean,String,Array,Object],width:{default:"400px"}},watch:{$props:{deep:!0,handler:function(t){this.props=JSON.parse(JSON.stringify(t))}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{emitValue:function(){this.$emit("value",this.props.value),this.$emit("input",this.props.value),this.$emit("change",this.props.value),this.props.value?this.$emit("open",this.props.value):this.$emit("close",this.props.value)}}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"modal show",staticStyle:{display:"block",background:"#00000044","animation-duration":"200ms"},attrs:{tabindex:"-1"},on:{click:function(e){if(e.target!==e.currentTarget)return null;t.props.value=!1,t.emitValue()}}},[r("div",{staticClass:"modal-dialog",style:"max-width:"+t.width+"!important;"},[r("div",{staticClass:"modal-content"},[r("div",{staticClass:"modal-header"},[t._t("header"),t._v(" "),r("button",{staticClass:"btn-close",attrs:{type:"button"},on:{click:function(e){t.props.value=!1,t.emitValue()}}})],2),t._v(" "),r("div",{staticClass:"modal-body"},[t._t("body")],2),t._v(" "),r("div",{staticClass:"modal-footer"},[t._t("footer")],2)])])]):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},633:function(t,e,r){"use strict";r.r(e);r(61);var o={props:{value:[Boolean,String]},data:function(){return{codeMode:!1,props:JSON.parse(JSON.stringify(this.$props))}},watch:{$props:{deep:!0,handler:function(t){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(t)),this.setValue(this.props.value))}},props:{deep:!0,handler:function(t){var e=this;for(var i in this.__preventRecursive=!0,this.$emit("input",t.value||!1),t)this.$emit("update:".concat(i),t[i]);setTimeout((function(){e.__preventRecursive=!1}),10)}}},methods:{setValue:function(t){this.$refs.editor.innerHTML=t||""},getValue:function(){return this.$refs.editor.innerHTML},command:function(a,b,t){document.execCommand(a,b,t),this.props.value=this.$refs.editor.innerHTML}},mounted:function(){this.setValue(this.props.value)}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-editor-html"},[r("div",{staticClass:"p-2 border border-bottom-0"},[r("div",{staticClass:"btn-group me-2",attrs:{role:"group","aria-label":"Paragrafo"}},[r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("bold")}}},[r("i",{staticClass:"fas fa-bold"})]),t._v(" "),r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("italic")}}},[r("i",{staticClass:"fas fa-italic"})]),t._v(" "),r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("strikeThrough")}}},[r("i",{staticClass:"fas fa-strikethrough"})])]),t._v(" "),r("div",{staticClass:"btn-group me-2",attrs:{role:"group","aria-label":"Alinhamento"}},[r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyLeft")}}},[r("i",{staticClass:"fas fa-align-left"})]),t._v(" "),r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyCenter")}}},[r("i",{staticClass:"fas fa-align-center"})]),t._v(" "),r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyFull")}}},[r("i",{staticClass:"fas fa-align-justify"})]),t._v(" "),r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("justifyRight")}}},[r("i",{staticClass:"fas fa-align-right"})])]),t._v(" "),r("div",{staticClass:"btn-group me-2",attrs:{role:"group","aria-label":"Especial"}},[r("button",{staticClass:"btn btn-sm",attrs:{type:"button",disabled:t.codeMode},on:{click:function(e){return t.command("removeFormat")}}},[r("i",{staticClass:"fas fa-remove-format"})]),t._v(" "),r("button",{staticClass:"btn btn-sm",class:{"btn-primary text-white":t.codeMode},attrs:{type:"button"},on:{click:function(e){t.codeMode=!t.codeMode}}},[r("i",{staticClass:"fas fa-code"})])])]),t._v(" "),r("ui-code",{directives:[{name:"show",rawName:"v-show",value:t.codeMode,expression:"codeMode"}],staticStyle:{"min-height":"100px"},attrs:{language:"html"},nativeOn:{keyup:function(e){return t.setValue(t.props.value)}},model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}),t._v(" "),r("div",{directives:[{name:"show",rawName:"v-show",value:!t.codeMode,expression:"!codeMode"}],ref:"editor",staticClass:"form-control rounded-0",staticStyle:{"min-height":"100px"},attrs:{contenteditable:"true"},on:{keyup:function(e){t.props.value=e.target.innerHTML||"&nbsp;"}}})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiCode:r(594).default})},767:function(t,e,r){"use strict";r.r(e);r(52),r(30),r(43),r(12),r(77),r(36),r(78);var o=r(32);function n(object,t){var e=Object.keys(object);if(Object.getOwnPropertySymbols){var r=Object.getOwnPropertySymbols(object);t&&(r=r.filter((function(t){return Object.getOwnPropertyDescriptor(object,t).enumerable}))),e.push.apply(e,r)}return e}function l(t){for(var i=1;i<arguments.length;i++){var source=null!=arguments[i]?arguments[i]:{};i%2?n(Object(source),!0).forEach((function(e){Object(o.a)(t,e,source[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(source)):n(Object(source)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(source,e))}))}return t}var c={middleware:["auth","permission"],head:function(){return{title:"Configurações de e-mail"}},props:{value:{default:function(){return{}}}},watch:{props:{deep:!0,handler:function(t){for(var i in t)this.$emit(i,t[i])}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props)),modalEmailTest:!1}},methods:{mailTestSend:function(){var t=this;delete this.modalEmailTest.error,delete this.modalEmailTest.success,this.$axios.post("/api/app/mail-test",this.modalEmailTest).then((function(e){t.modalEmailTest=l({success:e.data},t.modalEmailTest)})).catch((function(e){t.modalEmailTest=l({error:e.response.data.message},t.modalEmailTest)}))}}},d=r(11),component=Object(d.a)(c,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("ui-field",{attrs:{label:"Tipo",layout:"horizontal"}},[r("select",{directives:[{name:"model",rawName:"v-model",value:t.value["mail.default"],expression:"value['mail.default']"}],staticClass:"form-control",on:{change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.value,"mail.default",e.target.multiple?r:r[0])}}},[r("option",{attrs:{value:"smtp"}},[t._v("SMTP")])])]),t._v(" "),"smtp"==t.value["mail.default"]?[r("ui-field",{attrs:{label:"Host/porta",layout:"horizontal"}},[r("div",{staticClass:"input-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.value["mail.mailers.smtp.host"],expression:"value['mail.mailers.smtp.host']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.value["mail.mailers.smtp.host"]},on:{input:function(e){e.target.composing||t.$set(t.value,"mail.mailers.smtp.host",e.target.value)}}}),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.value["mail.mailers.smtp.port"],expression:"value['mail.mailers.smtp.port']"}],staticClass:"form-control",staticStyle:{"max-width":"100px"},attrs:{type:"text"},domProps:{value:t.value["mail.mailers.smtp.port"]},on:{input:function(e){e.target.composing||t.$set(t.value,"mail.mailers.smtp.port",e.target.value)}}})])]),t._v(" "),r("ui-field",{attrs:{label:"Usuário",layout:"horizontal"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.value["mail.mailers.smtp.username"],expression:"value['mail.mailers.smtp.username']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.value["mail.mailers.smtp.username"]},on:{input:function(e){e.target.composing||t.$set(t.value,"mail.mailers.smtp.username",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Senha",layout:"horizontal"}},[r("ui-password",{model:{value:t.value["mail.mailers.smtp.password"],callback:function(e){t.$set(t.value,"mail.mailers.smtp.password",e)},expression:"value['mail.mailers.smtp.password']"}})],1),t._v(" "),r("div",{staticClass:"border-bottom border-light mb-3"}),t._v(" "),r("ui-field",{attrs:{label:"De nome",layout:"horizontal"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.value["mail.from.name"],expression:"value['mail.from.name']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.value["mail.from.name"]},on:{input:function(e){e.target.composing||t.$set(t.value,"mail.from.name",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"De e-mail",layout:"horizontal"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.value["mail.from.address"],expression:"value['mail.from.address']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.value["mail.from.address"]},on:{input:function(e){e.target.composing||t.$set(t.value,"mail.from.address",e.target.value)}}})]),t._v(" "),r("div",{staticClass:"border-bottom border-light mb-3"}),t._v(" "),r("ui-field",{attrs:{layout:"horizontal"}},[r("button",{staticClass:"btn btn-light",attrs:{type:"button"},on:{click:function(e){t.modalEmailTest={to:t.$auth.user.email,subject:"Assunto",body:"Testando"}}}},[r("i",{staticClass:"fas fa-fw fa-envelope"}),t._v(" Testar envio de e-mail\n            ")])]),t._v(" "),r("ui-modal",{scopedSlots:t._u([{key:"header",fn:function(){return[t._v("Teste de envio de e-mail")]},proxy:!0},{key:"body",fn:function(){return[t.modalEmailTest.error?r("div",{staticClass:"alert alert-danger",domProps:{innerHTML:t._s(t.modalEmailTest.error)}}):t._e(),t._v(" "),t.modalEmailTest.success?r("div",{staticClass:"alert alert-success"},[t._v(t._s(t.modalEmailTest.success.failures.length)+" erros")]):t._e(),t._v(" "),r("ui-field",{attrs:{label:"Enviar para"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.modalEmailTest.to,expression:"modalEmailTest.to"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.modalEmailTest.to},on:{input:function(e){e.target.composing||t.$set(t.modalEmailTest,"to",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Assunto"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.modalEmailTest.subject,expression:"modalEmailTest.subject"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.modalEmailTest.subject},on:{input:function(e){e.target.composing||t.$set(t.modalEmailTest,"subject",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Mensagem"}},[r("ui-html",{model:{value:t.modalEmailTest.body,callback:function(e){t.$set(t.modalEmailTest,"body",e)},expression:"modalEmailTest.body"}})],1)]},proxy:!0},{key:"footer",fn:function(){return[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(e){return t.mailTestSend()}}},[t._v("\n                    Enviar\n                ")])]},proxy:!0}],null,!1,2406433369),model:{value:t.modalEmailTest,callback:function(e){t.modalEmailTest=e},expression:"modalEmailTest"}})]:t._e()],2)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiField:r(559).default,UiPassword:r(596).default,UiHtml:r(633).default,UiModal:r(612).default})}}]);