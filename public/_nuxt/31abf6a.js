(window.webpackJsonp=window.webpackJsonp||[]).push([[11],{215:function(t,e,r){"use strict";r.r(e);var o={name:"ui-password",props:{value:{default:""},placeholder:{default:""},meter:{default:!0},type:{default:"password"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-control p-0"},[r("div",{staticClass:"input-group m-0"},["checkbox"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{keyup:function(e){return t.$emit("input",t.props.value)},change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:t.props.type},domProps:{value:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}}),t._v(" "),r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.type="text"==t.props.type?"password":"text"}}},[r("i",{staticClass:"fas fa-eye",class:{"fa-eye-slash":"password"==t.props.type}})])])])]),t._v(" "),t.props.meter?r("ui-password-meter",{model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPasswordMeter:r(217).default})},217:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{meter:function(){var t=this.props.value,e=0,r="danger";if(t){for(var o=new Object,i=0;i<t.length;i++)o[t[i]]=(o[t[i]]||0)+1,e+=5/o[t[i]];var n={digits:/\d/.test(t),lower:/[a-z]/.test(t),upper:/[A-Z]/.test(t),nonWords:/\W/.test(t)},l=0;for(var c in n)l+=1==n[c]?1:0;e+=10*(l-1),(e=parseInt(e))>=70?r="success":e>=40&&(r="primary")}return{score:e,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(11),component=Object(n.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"progress",staticStyle:{height:"5px"}},[e("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);e.default=component.exports},224:function(t,e,r){"use strict";r.r(e);var o={name:"ui-auth-login",props:{value:{default:!1}},methods:{submit:function(){var t=this;this.$auth.loginWith("jwt",{data:this.post}).then((function(e){e.data.access_token&&t.$emit("success",e.data)}))}},data:function(){return{post:{email:"",password:""}}}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("content",[r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.post.email,expression:"post.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Seu e-mail"},domProps:{value:t.post.email},on:{input:function(e){e.target.composing||t.$set(t.post,"email",e.target.value)}}})]),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha",meter:!1},model:{value:t.post.password,callback:function(e){t.$set(t.post,"password",e)},expression:"post.password"}})],1),t._v(" "),t._m(0)])],2)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"form-group text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("Login")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPassword:r(215).default})},225:function(t,e,r){"use strict";r.r(e);var o={name:"ui-auth-register",props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{submit:function(){var t=this;this.error={},this.$axios.post("/api/auth/register/",this.post).then((function(e){if(e.data.error)return t.error=e.data.error;t.post={name:"",email:"",password:"",password_confirmation:""},t.$emit("success",e.data)}))}},data:function(){return{error:{},post:{name:"",email:"",password:"",password_confirmation:""}}}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("content",[r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.post.name,expression:"post.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Nome"},domProps:{value:t.post.name},on:{input:function(e){e.target.composing||t.$set(t.post,"name",e.target.value)}}}),t._v(" "),t.error.name?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.name.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.post.email,expression:"post.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:t.post.email},on:{input:function(e){e.target.composing||t.$set(t.post,"email",e.target.value)}}}),t._v(" "),t.error.email?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.email.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:t.post.password,callback:function(e){t.$set(t.post,"password",e)},expression:"post.password"}}),t._v(" "),t.error.password?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password.join("<br>"))}}):t._e()],1),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{meter:!1,placeholder:"Repita senha"},model:{value:t.post.password_confirmation,callback:function(e){t.$set(t.post,"password_confirmation",e)},expression:"post.password_confirmation"}}),t._v(" "),t.error.password_confirmation?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password_confirmation.join("<br>"))}}):t._e()],1),t._v(" "),t._m(0)])],2)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"form-group text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("Cadastrar")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPassword:r(215).default})},226:function(t,e,r){"use strict";r.r(e);var o={name:"ui-auth-password",props:{value:{default:!1}},methods:{passwordToken:function(){var t=this;this.$axios.post("/api/auth/password-token",this.post).then((function(e){if(e.data.error)return t.error=e.data.error;t.tokenGenerated=!0}))},passwordReset:function(){var t=this;this.error={},this.$axios.post("/api/auth/password-reset",this.post).then((function(e){if(e.data.error)return t.error=e.data.error;t.post={email:"",password:"",password_confirmation:"",token:""},t.$emit("success",e.data)}))}},data:function(){return{tokenGenerated:!1,tokenInformed:!1,error:{},post:{email:"",password:"",password_confirmation:"",token:""}}}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.passwordToken()}}},[t._t("token",[r("div",{staticClass:"input-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.post.email,expression:"post.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Seu e-mail"},domProps:{value:t.post.email},on:{input:function(e){e.target.composing||t.$set(t.post,"email",e.target.value)}}}),t._v(" "),t._m(0)]),t._v(" "),t.error.email?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.email.join("<br>"))}}):t._e()])],2),t._v(" "),t.tokenGenerated?r("div",[r("div",{staticClass:"mb-3"}),t._v(" "),r("div",{staticClass:"form-group"},[r("div",{staticClass:"input-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.post.token,expression:"post.token"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Token"},domProps:{value:t.post.token},on:{keyup:function(e){if(!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter"))return null;t.tokenInformed=!0},input:function(e){e.target.composing||t.$set(t.post,"token",e.target.value)}}}),t._v(" "),r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(e){t.tokenInformed=!0}}},[t._v("\r\n                        Ok\r\n                    ")])])])]),t._v(" "),t.error.token?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.token.join("<br>"))}}):t._e()]),t._v(" "),r("form",{on:{submit:function(e){return e.preventDefault(),t.passwordReset()}}},[t._t("reset",[t.tokenInformed?r("div",[r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:t.post.password,callback:function(e){t.$set(t.post,"password",e)},expression:"post.password"}}),t._v(" "),t.error.password?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password.join("<br>"))}}):t._e()],1),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha",meter:!1},model:{value:t.post.password_confirmation,callback:function(e){t.$set(t.post,"password_confirmation",e)},expression:"post.password_confirmation"}}),t._v(" "),t.error.password_confirmation?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password_confirmation.join("<br>"))}}):t._e()],1)]):t._e(),t._v(" "),t._m(1)])],2)]):t._e()])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-append"},[e("div",{staticClass:"input-group-btn"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("\r\n                        Enviar\r\n                    ")])])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"form-group text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("Enviar")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPassword:r(215).default})},389:function(t,e,r){"use strict";r.r(e);var o={data:function(){return{endpoints:[]}},mounted:function(){var t=this;this.$axios.get("/api/").then((function(e){t.endpoints=e.data}))}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"row no-gutters"},[r("div",{staticClass:"col-2"},[r("div",{staticClass:"nav nav-pills flex-column"},[r("nuxt-link",{staticClass:"nav-link",attrs:{to:"/test"}},[t._v("Home")]),t._v(" "),r("nuxt-link",{staticClass:"nav-link",attrs:{to:"/test"}},[t._v("Endpoints")]),t._v(" "),r("nuxt-link",{staticClass:"nav-link",attrs:{to:"/test"}},[t._v("Data generator")])],1)]),t._v(" "),r("div",{staticClass:"col"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 bg-primary mb-4 text-white"},[t.$store.$auth.user?r("div",{staticClass:"d-flex p-3"},[r("div",{staticClass:"flex-grow-1"},[t._v(t._s(t.$store.$auth.user.name)+" - "+t._s(t.$store.$auth.user.email))]),t._v(" "),r("div",[r("a",{staticClass:"text-white",attrs:{href:"javascript:;"},on:{click:function(e){return t.$auth.logout()}}},[t._v("Sair")])])]):r("div",{staticClass:"p-3"},[t._v("Deslogado")])]),t._v(" "),r("div",{staticClass:"col-6 col-md-4"},[r("ui-auth-login")],1),t._v(" "),r("div",{staticClass:"col-6 col-md-4"},[r("ui-auth-register")],1),t._v(" "),r("div",{staticClass:"col-12 col-md-4"},[r("ui-auth-password")],1)]),t._v(" "),r("table",{staticClass:"table table-borderless table-striped"},[t._m(0),t._v(" "),r("tbody",t._l(t.endpoints,(function(e){return r("tr",[r("td",[t._v(t._s(e.methods.join(" / ")))]),t._v(" "),r("td",[t._v(t._s(e.uri))])])})),0)])])])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("thead",[e("tr",[e("th",[this._v("Método")]),this._v(" "),e("th",[this._v("Endpoint")])])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiAuthLogin:r(224).default,UiAuthRegister:r(225).default,UiAuthPassword:r(226).default})}}]);