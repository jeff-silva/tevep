(window.webpackJsonp=window.webpackJsonp||[]).push([[5],{367:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{meter:function(){var t=this.props.value,e=0,r="danger";if(t){for(var o=new Object,i=0;i<t.length;i++)o[t[i]]=(o[t[i]]||0)+1,e+=5/o[t[i]];var n={digits:/\d/.test(t),lower:/[a-z]/.test(t),upper:/[A-Z]/.test(t),nonWords:/\W/.test(t)},l=0;for(var c in n)l+=1==n[c]?1:0;e+=10*(l-1),(e=parseInt(e))>=70?r="success":e>=40&&(r="primary")}return{score:e,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(15),component=Object(n.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"progress",staticStyle:{height:"5px"}},[e("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);e.default=component.exports},368:function(t,e,r){"use strict";r.r(e);var o={name:"ui-password",props:{value:{default:""},placeholder:{default:""},meter:{default:!0},type:{default:"password"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(15),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-control p-0 bg-white"},[r("div",{staticClass:"input-group"},["checkbox"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{keyup:function(e){return t.$emit("input",t.props.value)},change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:t.props.type},domProps:{value:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}}),t._v(" "),r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.type="text"==t.props.type?"password":"text"}}},[r("i",{staticClass:"fas fa-eye",class:{"fa-eye-slash":"password"==t.props.type}})])])])]),t._v(" "),t.props.meter?r("ui-password-meter",{model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPasswordMeter:r(367).default})},376:function(t,e,r){"use strict";r.r(e);var o={name:"ui-auth-register",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{submit:function(){var t=this;this.error={},this.$axios.post("/api/user/register/",this.props.value).then((function(e){if(e.data.error)return t.error=e.data.error;t.props.value={name:"",email:"",password:"",password_confirmation:""},t.$emit("success",e.data)}))}},data:function(){return{error:{},props:Object.assign({},this.$props)}}},n=r(15),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("content",[r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.name,expression:"props.value.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Nome"},domProps:{value:t.props.value.name},on:{input:function(e){e.target.composing||t.$set(t.props.value,"name",e.target.value)}}}),t._v(" "),t.error.name?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.name.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.email,expression:"props.value.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:t.props.value.email},on:{input:function(e){e.target.composing||t.$set(t.props.value,"email",e.target.value)}}}),t._v(" "),t.error.email?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.email.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:t.props.value.password,callback:function(e){t.$set(t.props.value,"password",e)},expression:"props.value.password"}}),t._v(" "),t.error.password?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password.join("<br>"))}}):t._e()],1),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{meter:!1,placeholder:"Repita senha"},model:{value:t.props.value.password_confirmation,callback:function(e){t.$set(t.props.value,"password_confirmation",e)},expression:"props.value.password_confirmation"}}),t._v(" "),t.error.password_confirmation?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password_confirmation.join("<br>"))}}):t._e()],1),t._v(" "),t._m(0)])],2)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"form-group text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("Cadastrar")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPassword:r(368).default})},460:function(t,e,r){"use strict";r.r(e);var o={layout:"auth",data:function(){return{error:{},success:!1,post:this.postDefault()}},methods:{postDefault:function(){return{name:"",email:"",password:"",password_confirmation:""}},register:function(){var t=this;this.error={},this.false={},this.$axios.post("/api/auth/register",this.post).then((function(e){e.data.error?t.error=e.data.error:(t.post=t.postDefault(),t.success=e.data.success)}))}}},n=r(15),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"card"},[r("div",{staticClass:"card-header"},[t._v("Cadastre")]),t._v(" "),r("div",{staticClass:"card-body"},[r("ui-auth-register",{on:{success:function(e){return t.$swalSuccess("Sucesso","Cadastro efetuado. Por favor, faça login.")}}}),t._v(" "),r("div",{staticClass:"row mt-3"},[r("div",{staticClass:"col-12 col-md-6"},[r("nuxt-link",{staticClass:"btn btn-link btn-block",attrs:{to:"/auth/"}},[t._v("Login")])],1),t._v(" "),r("div",{staticClass:"col-12 col-md-6"},[r("nuxt-link",{staticClass:"btn btn-link btn-block",attrs:{to:"/auth/password"}},[t._v("Recuperar senha")])],1)])],1)])])}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiAuthRegister:r(376).default})}}]);