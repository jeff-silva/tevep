(window.webpackJsonp=window.webpackJsonp||[]).push([[10,18,22,28],{549:function(e,t,r){var content=r(557);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(74).default)("039c59a2",content,!0,{sourceMap:!1})},550:function(e,t,r){"use strict";var o=r(13),n=r(3),l=r(4),c=r(135),d=r(20),f=r(15),m=r(405),v=r(48),h=r(134),_=r(404),x=r(5),y=r(93).f,w=r(40).f,N=r(18).f,E=r(406),C=r(553).trim,$="Number",k=n.Number,I=k.prototype,A=n.TypeError,S=l("".slice),F=l("".charCodeAt),O=function(e){var t=_(e,"number");return"bigint"==typeof t?t:j(t)},j=function(e){var t,r,o,n,l,c,d,code,f=_(e,"number");if(h(f))throw A("Cannot convert a Symbol value to a number");if("string"==typeof f&&f.length>2)if(f=C(f),43===(t=F(f,0))||45===t){if(88===(r=F(f,2))||120===r)return NaN}else if(48===t){switch(F(f,1)){case 66:case 98:o=2,n=49;break;case 79:case 111:o=8,n=55;break;default:return+f}for(c=(l=S(f,2)).length,d=0;d<c;d++)if((code=F(l,d))<48||code>n)return NaN;return parseInt(l,o)}return+f};if(c($,!k(" 0o1")||!k("0b1")||k("+0x1"))){for(var T,P=function(e){var t=arguments.length<1?0:k(O(e)),r=this;return v(I,r)&&x((function(){E(r)}))?m(Object(t),r,P):t},M=o?y(k):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,isFinite,isInteger,isNaN,isSafeInteger,parseFloat,parseInt,fromString,range".split(","),R=0;M.length>R;R++)f(k,T=M[R])&&!f(P,T)&&N(P,T,w(k,T));P.prototype=I,I.constructor=P,d(n,$,P)}},552:function(e,t,r){"use strict";r.r(t);var o=r(21),n=(r(550),r(555),r(190),{props:{label:{default:""},layout:{default:"vertical"},labelWidth:{default:"200px"},error:[Boolean,Number,String,Array,Object]},computed:{compError:function(){var e=[];return"string"==typeof this.error?e=[this.error]:Array.isArray(this.error)?e=this.error:"object"==Object(o.a)(this.error)&&(e=Object.values(this.error)),e.join("<br>")}}}),l=(r(556),r(16)),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",["horizontal"==e.layout?r("div",{staticClass:"d-flex align-items-center mb-3"},[r("div",{staticClass:"pe-3",style:{minWidth:e.labelWidth,maxWidth:e.labelWidth}},[e._t("label",(function(){return[e._v(e._s(e.label))]}))],2),e._v(" "),r("div",{staticClass:"flex-grow-1"},[e._t("default"),e._v(" "),r("div",{staticClass:"ui-field-info"},[e._t("info")],2),e._v(" "),e.compError?r("small",{staticClass:"d-block text-danger pt-1",domProps:{innerHTML:e._s(e.compError)}}):e._e()],2)]):r("div",{staticClass:"mb-3"},[r("div",{staticClass:"form-label"},[e._t("label",(function(){return[e._v(e._s(e.label))]}))],2),e._v(" "),e._t("default"),e._v(" "),r("div",{staticClass:"ui-field-info"},[e._t("info")],2),e._v(" "),e.compError?r("small",{staticClass:"d-block text-danger pt-1",domProps:{innerHTML:e._s(e.compError)}}):e._e()],2)])}),[],!1,null,null,null);t.default=component.exports},553:function(e,t,r){var o=r(4),n=r(25),l=r(14),c=r(554),d=o("".replace),f="["+c+"]",m=RegExp("^"+f+f+"*"),v=RegExp(f+f+"*$"),h=function(e){return function(t){var r=l(n(t));return 1&e&&(r=d(r,m,"")),2&e&&(r=d(r,v,"")),r}};e.exports={start:h(1),end:h(2),trim:h(3)}},554:function(e,t){e.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},555:function(e,t,r){var o=r(6),n=r(407).values;o({target:"Object",stat:!0},{values:function(e){return n(e)}})},556:function(e,t,r){"use strict";r(549)},557:function(e,t,r){var o=r(73)(!1);o.push([e.i,".ui-field-info *{font-size:12px;color:var(--bs-gray)!important}",""]),e.exports=o},558:function(e,t,r){"use strict";r.r(t);r(12);var o={props:{value:[Boolean,Object],method:{default:"get"},action:{default:""},mountedSubmit:{default:!1,type:Boolean},successText:{default:""}},data:function(){return{loading:!1,response:!1,error:!1,errorFields:{}}},methods:{submit:function(){var e=this;return this.loading=!0,this.error=!1,this.errorFields={},this.$axios({method:this.method,url:this.action,data:"get"!=this.method?this.value:null,params:"get"==this.method?this.value:null}).then((function(t){var r=e.parseResponseData(t.data);e.loading=!1,e.response=r,e.$emit("success",r),e.$emit("response",r),e.successText&&e.$swal.fire(e.successText)})).catch((function(t){var r=e.parseResponseData(t.response.data);e.loading=!1,e.error=r.message,e.errorFields=r.fields,e.$emit("error",r),e.$emit("response",r)}))},parseResponseData:function(e){return["per_page","page"].forEach((function(t){"string"==typeof e[t]&&(e[t]=parseInt(e[t]))})),e}},mounted:function(){this.mountedSubmit&&this.submit()}},n=r(16),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("form",{attrs:{action:""},on:{submit:function(t){return t.preventDefault(),e.submit()}}},[e._t("default",null,{loading:e.loading,response:e.response,error:e.error,errorFields:e.errorFields})],2)}),[],!1,null,null,null);t.default=component.exports},567:function(e,t,r){"use strict";r.r(t);var o={props:{value:{default:""},show:{default:!1},placeholder:{default:""}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{emitvalue:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}}},n=r(16),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"input-group form-control p-0"},["checkbox"==(e.props.show?"text":"password")?r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:e.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(e.props.value)?e._i(e.props.value,null)>-1:e.props.value},on:{keyup:function(t){return e.emitvalue()},change:function(t){var r=e.props.value,o=t.target,n=!!o.checked;if(Array.isArray(r)){var l=e._i(r,null);o.checked?l<0&&e.$set(e.props,"value",r.concat([null])):l>-1&&e.$set(e.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else e.$set(e.props,"value",n)}}}):"radio"==(e.props.show?"text":"password")?r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:e.props.placeholder,type:"radio"},domProps:{checked:e._q(e.props.value,null)},on:{keyup:function(t){return e.emitvalue()},change:function(t){return e.$set(e.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:e.props.placeholder,type:e.props.show?"text":"password"},domProps:{value:e.props.value},on:{keyup:function(t){return e.emitvalue()},input:function(t){t.target.composing||e.$set(e.props,"value",t.target.value)}}}),e._v(" "),r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(t){e.props.show=!e.props.show}}},[e.props.show?r("i",{staticClass:"fas fa-eye"}):r("i",{staticClass:"fas fa-eye-slash"})])])])}),[],!1,null,null,null);t.default=component.exports},590:function(e,t,r){"use strict";r.r(t);var o={data:function(){return{loading:!1,post:{}}},methods:{submit:function(){var e=this;this.loading=!0,this.$axios.post("/api/register",this.post).then((function(t){e.loading=!1})).catch((function(t){e.loading=!1}))}}},n=r(16),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("ui-form",{attrs:{method:"post",action:"/api/auth/register"},scopedSlots:e._u([{key:"default",fn:function(t){var o=t.loading,n=t.errorFields;return[e._t("fields",(function(){return[r("ui-field",{attrs:{label:"Nome",error:n.name}},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.post.name,expression:"post.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Name"},domProps:{value:e.post.name},on:{input:function(t){t.target.composing||e.$set(e.post,"name",t.target.value)}}})]),e._v(" "),r("ui-field",{attrs:{label:"E-mail",error:n.email}},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.post.email,expression:"post.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:e.post.email},on:{input:function(t){t.target.composing||e.$set(e.post,"email",t.target.value)}}})]),e._v(" "),r("ui-field",{attrs:{label:"Senha",error:n.password}},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:e.post.password,callback:function(t){e.$set(e.post,"password",t)},expression:"post.password"}})],1)]})),e._v(" "),e._t("action",(function(){return[r("button",{directives:[{name:"loading",rawName:"v-loading",value:o,expression:"loading"}],staticClass:"btn btn-primary w-100",attrs:{type:"submit",disabled:o}},[e._v("\n                Cadastrar\n            ")])]}))]}}],null,!0),model:{value:e.post,callback:function(t){e.post=t},expression:"post"}})],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiField:r(552).default,UiPassword:r(567).default,UiForm:r(558).default})}}]);