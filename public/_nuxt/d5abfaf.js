(window.webpackJsonp=window.webpackJsonp||[]).push([[40,19],{550:function(e,t,r){var content=r(558);content.__esModule&&(content=content.default),"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(75).default)("039c59a2",content,!0,{sourceMap:!1})},552:function(e,t,r){"use strict";var o=r(13),n=r(3),l=r(4),c=r(135),v=r(20),d=r(16),f=r(405),m=r(48),h=r(134),_=r(404),w=r(5),N=r(93).f,E=r(40).f,y=r(18).f,x=r(406),I=r(554).trim,z="Number",P=n.Number,S=P.prototype,j=n.TypeError,A=l("".slice),O=l("".charCodeAt),$=function(e){var t=_(e,"number");return"bigint"==typeof t?t:C(t)},C=function(e){var t,r,o,n,l,c,v,code,d=_(e,"number");if(h(d))throw j("Cannot convert a Symbol value to a number");if("string"==typeof d&&d.length>2)if(d=I(d),43===(t=O(d,0))||45===t){if(88===(r=O(d,2))||120===r)return NaN}else if(48===t){switch(O(d,1)){case 66:case 98:o=2,n=49;break;case 79:case 111:o=8,n=55;break;default:return+d}for(c=(l=A(d,2)).length,v=0;v<c;v++)if((code=O(l,v))<48||code>n)return NaN;return parseInt(l,o)}return+d};if(c(z,!P(" 0o1")||!P("0b1")||P("+0x1"))){for(var L,T=function(e){var t=arguments.length<1?0:P($(e)),r=this;return m(S,r)&&w((function(){x(r)}))?f(Object(t),r,T):t},B=o?N(P):"MAX_VALUE,MIN_VALUE,NaN,NEGATIVE_INFINITY,POSITIVE_INFINITY,EPSILON,MAX_SAFE_INTEGER,MIN_SAFE_INTEGER,isFinite,isInteger,isNaN,isSafeInteger,parseFloat,parseInt,fromString,range".split(","),F=0;B.length>F;F++)d(P,L=B[F])&&!d(T,L)&&y(T,L,E(P,L));T.prototype=S,S.constructor=T,v(n,z,T)}},553:function(e,t,r){"use strict";r.r(t);var o=r(21),n=(r(552),r(556),r(190),{props:{label:{default:""},labelWidth:{default:"200px"},error:[Boolean,Number,String,Array,Object]},computed:{_compError:function(){var e=[];return"string"==typeof this.error?e=[this.error]:Array.isArray(this.error)?e=this.error:"object"==Object(o.a)(this.error)&&(e=Object.values(this.error)),e.join("<br>")}},data:function(){return{width:0,widthBig:!1}},methods:{calculateSizes:function(){this.width=this.$el.offsetWidth,this.widthBig=this.$el.offsetWidth>=600},resizeEventListener:function(e){this.calculateSizes()}},beforeDestroy:function(){window.removeEventListener("resize",this.resizeEventListener)},mounted:function(){this.calculateSizes(),window.addEventListener("resize",this.resizeEventListener)}}),l=(r(557),r(14)),component=Object(l.a)(n,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"ui-field mb-3",class:{"d-flex":e.widthBig,"ui-field-error":e._compError}},[r("div",{class:{"py-2":e.widthBig,"pb-1":!e.widthBig},style:"min-width:"+(e.widthBig?null:e.labelWidth)+"; max-width:"+(e.widthBig?null:e.labelWidth)+";"},[e._t("label",(function(){return[e._v(e._s(e.label))]}))],2),e._v(" "),r("div",{class:{"flex-grow-1":e.widthBig}},[e._t("default"),e._v(" "),e._compError?r("small",{staticClass:"d-block text-danger",domProps:{innerHTML:e._s(e._compError)}}):e._e()],2)])}),[],!1,null,null,null);t.default=component.exports},554:function(e,t,r){var o=r(4),n=r(25),l=r(15),c=r(555),v=o("".replace),d="["+c+"]",f=RegExp("^"+d+d+"*"),m=RegExp(d+d+"*$"),h=function(e){return function(t){var r=l(n(t));return 1&e&&(r=v(r,f,"")),2&e&&(r=v(r,m,"")),r}};e.exports={start:h(1),end:h(2),trim:h(3)}},555:function(e,t){e.exports="\t\n\v\f\r                　\u2028\u2029\ufeff"},556:function(e,t,r){var o=r(6),n=r(407).values;o({target:"Object",stat:!0},{values:function(e){return n(e)}})},557:function(e,t,r){"use strict";r(550)},558:function(e,t,r){var o=r(74)(!1);o.push([e.i,".ui-field>*{transition:all .3s ease}.ui-field-error .el-input__inner,.ui-field-error .form-control{border-color:var(--bs-danger);box-shadow:none!important;outline:0!important}",""]),e.exports=o},694:function(e,t,r){"use strict";r.r(t);var o={head:function(){return{title:"Configurações principais"}},props:{value:{default:function(){return{}}}},watch:{props:{deep:!0,handler:function(e){for(var i in e)this.$emit(i,e[i])}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}}},n=r(14),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("ui-field",{attrs:{label:"Nome da aplicação",layout:"horizontal"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.value["app.name"],expression:"value['app.name']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.value["app.name"]},on:{input:function(t){t.target.composing||e.$set(e.value,"app.name",t.target.value)}}})]),e._v(" "),r("ui-field",{attrs:{label:"Timezone",layout:"horizontal"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.value["app.timezone"],expression:"value['app.timezone']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.value["app.timezone"]},on:{input:function(t){t.target.composing||e.$set(e.value,"app.timezone",t.target.value)}}})]),e._v(" "),r("ui-field",{attrs:{label:"Locale",layout:"horizontal"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.value["app.locale"],expression:"value['app.locale']"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.value["app.locale"]},on:{input:function(t){t.target.composing||e.$set(e.value,"app.locale",t.target.value)}}})]),e._v(" "),r("ui-field",{attrs:{label:"Tempo de autenticação",layout:"horizontal"}},[r("select",{directives:[{name:"model",rawName:"v-model",value:e.value["jwt.ttl"],expression:"value['jwt.ttl']"}],staticClass:"form-control",on:{change:function(t){var r=Array.prototype.filter.call(t.target.options,(function(e){return e.selected})).map((function(e){return"_value"in e?e._value:e.value}));e.$set(e.value,"jwt.ttl",t.target.multiple?r:r[0])}}},[r("option",{domProps:{value:60}},[e._v("1 hora")]),e._v(" "),r("option",{domProps:{value:240}},[e._v("4 horas")]),e._v(" "),r("option",{domProps:{value:480}},[e._v("8 horas")]),e._v(" "),r("option",{domProps:{value:720}},[e._v("12 horas")]),e._v(" "),r("option",{domProps:{value:1440}},[e._v("24 horas")]),e._v(" "),r("option",{domProps:{value:21600}},[e._v("15 dias")]),e._v(" "),r("option",{domProps:{value:43200}},[e._v("30 dias")]),e._v(" "),r("option",{domProps:{value:259200}},[e._v("6 meses")]),e._v(" "),r("option",{domProps:{value:518400}},[e._v("1 ano")])])])],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiField:r(553).default})}}]);