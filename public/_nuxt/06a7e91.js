(window.webpackJsonp=window.webpackJsonp||[]).push([[16],{238:function(t,e,r){"use strict";r.r(e);var o={name:"ui-password",props:{value:{default:""},placeholder:{default:""},meter:{default:!0},type:{default:"password"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(5),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-control p-0"},[r("div",{staticClass:"input-group m-0"},["checkbox"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{keyup:function(e){return t.$emit("input",t.props.value)},change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0",attrs:{placeholder:t.props.placeholder,type:t.props.type},domProps:{value:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}}),t._v(" "),r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.type="text"==t.props.type?"password":"text"}}},[r("i",{staticClass:"fas fa-eye",class:{"fa-eye-slash":"password"==t.props.type}})])])])]),t._v(" "),t.props.meter?r("ui-password-meter",{model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPasswordMeter:r(239).default})},239:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{meter:function(){var t=this.props.value,e=0,r="danger";if(t){for(var o=new Object,i=0;i<t.length;i++)o[t[i]]=(o[t[i]]||0)+1,e+=5/o[t[i]];var n={digits:/\d/.test(t),lower:/[a-z]/.test(t),upper:/[A-Z]/.test(t),nonWords:/\W/.test(t)},l=0;for(var c in n)l+=1==n[c]?1:0;e+=10*(l-1),(e=parseInt(e))>=70?r="success":e>=40&&(r="primary")}return{score:e,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(5),component=Object(n.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"progress",staticStyle:{height:"5px"}},[e("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);e.default=component.exports},240:function(t,e,r){var content=r(246);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(25).default)("b8d0879e",content,!0,{sourceMap:!1})},241:function(t,e,r){var content=r(248);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(25).default)("d8c97870",content,!0,{sourceMap:!1})},243:function(t,e,r){"use strict";r.r(e);var o={name:"ui-auth-register",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{submit:function(){var t=this;this.error={},this.$axios.post("/api/auth/register/",this.props.value).then((function(e){if(e.data.error)return t.error=e.data.error;t.props.value={name:"",email:"",password:"",password_confirmation:""},t.$emit("success",e.data)}))}},data:function(){return{error:{},props:Object.assign({},this.$props)}}},n=r(5),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("content",[r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.name,expression:"props.value.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Nome"},domProps:{value:t.props.value.name},on:{input:function(e){e.target.composing||t.$set(t.props.value,"name",e.target.value)}}}),t._v(" "),t.error.name?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.name.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.email,expression:"props.value.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:t.props.value.email},on:{input:function(e){e.target.composing||t.$set(t.props.value,"email",e.target.value)}}}),t._v(" "),t.error.email?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.email.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:t.props.value.password,callback:function(e){t.$set(t.props.value,"password",e)},expression:"props.value.password"}}),t._v(" "),t.error.password?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password.join("<br>"))}}):t._e()],1),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{meter:!1,placeholder:"Repita senha"},model:{value:t.props.value.password_confirmation,callback:function(e){t.$set(t.props.value,"password_confirmation",e)},expression:"props.value.password_confirmation"}}),t._v(" "),t.error.password_confirmation?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password_confirmation.join("<br>"))}}):t._e()],1),t._v(" "),t._m(0)])],2)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"form-group text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("Cadastrar")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPassword:r(238).default})},245:function(t,e,r){"use strict";var o=r(240);r.n(o).a},246:function(t,e,r){(e=r(24)(!1)).push([t.i,".ui-modal{position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,.2);z-index:9999!important;display:flex;align-items:center;justify-content:center}.ui-modal .card{width:600px;max-width:90%!important;margin:0!important;overflow:auto!important}",""]),t.exports=e},247:function(t,e,r){"use strict";var o=r(241);r.n(o).a},248:function(t,e,r){(e=r(24)(!1)).push([t.i,".user-card-actions{display:flex}.user-card-actions .btn{margin:0}.user-card-image{background:50% no-repeat #f5f5f5;background-size:cover;width:100px;height:100px;margin:-50px auto 0;border-radius:50%;border:4px solid #fff;overflow:hidden;display:flex;align-items:center;justify-content:center}.user-card-bg{background-size:cover;background-position:50%;background-repeat:no-repeat;height:200px}.user-card-pattern{--stripe:#f5f5f5;--bg:#eee;background:linear-gradient(135deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(225deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(315deg,var(--bg) 25%,transparent 0),linear-gradient(45deg,var(--bg) 25%,transparent 0);background-size:100px 100px;background-color:var(--stripe)}",""]),t.exports=e},254:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1},tag:{default:"div"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{toggle:function(){this.props.value=!this.props.value,this.$emit("value",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(245),r(5)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"ui-modal",staticStyle:{"animation-duration":"300ms"},on:{click:function(e){if(e.target!==e.currentTarget)return null;t.props.value=!1,t.$emit("input",t.props.value)}}},[r(t.tag,{tag:"component",on:{submit:function(e){return e.preventDefault(),t.$emit("submit",e)}}},[r("div",{staticClass:"card"},[t.$slots.header?r("div",{staticClass:"card-header"},[t._t("header")],2):t._e(),t._v(" "),r("div",{staticClass:"card-body"},[t._t("body")],2),t._v(" "),r("div",{staticClass:"card-footer text-right"},[r("button",{staticClass:"btn pull-left",attrs:{type:"button"},on:{click:function(e){t.props.value=!1,t.$emit("input",t.props.value)}}},[t._v("\r\n                            Ok\r\n                        ")]),t._v(" "),t._t("footer")],2)])])],1):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},255:function(t,e,r){"use strict";r.r(e);var o={name:"user-card",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(247),r(5)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"user-card bg-white shadow-sm rounded"},[t.props.value.meta.background?r("div",{staticClass:"user-card-bg",style:"background-image:url("+t.props.value.meta.background+");"}):r("div",{staticClass:"user-card-bg user-card-pattern"}),t._v(" "),r("div",{staticClass:"user-card-image shadow-sm",style:"background-image:url("+t.props.value.meta.photo+");"},[t._t("image")],2),t._v(" "),r("div",{staticClass:"text-center font-weight-bold text-uppercase mt-2"},[r("nuxt-link",{attrs:{to:""}},[t._v(t._s(t.props.value.name))])],1),t._v(" "),r("div",{staticClass:"text-center text-muted"},[t._v(t._s(t.props.value.meta.description))]),t._v(" "),r("div",{staticClass:"text-center text-muted"},[t._v(t._s(t.props.value.email))]),t._v(" "),r("div",{staticClass:"pb-4"}),t._v(" "),r("div",{staticClass:"btn-group user-card-actions"},[t._t("actions")],2)])}),[],!1,null,null,null);e.default=component.exports},424:function(t,e,r){"use strict";r.r(e);var o={layout:"admin",methods:{userSearch:function(){var t=this;this.user.loading=!0,this.$axios.get("/api/user/search").then((function(e){t.user.loading=!1,t.user.resp=e.data}))}},data:function(){return{user:{loading:!1,edit:!1,params:{},resp:{}}}},mounted:function(){this.userSearch()}},n=r(5),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"text-right mb-3"},[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(e){t.user.edit={}}}},[r("i",{staticClass:"fa fa-fw fa-plus"}),t._v(" Novo usuário\r\n        ")])]),t._v(" "),r("ui-modal",{scopedSlots:t._u([{key:"header",fn:function(){return[t._v("\r\n            "+t._s(t.user.edit.name||"Criar")+"\r\n        ")]},proxy:!0},{key:"body",fn:function(){return[r("ui-auth-register",{on:{success:function(e){t.user.edit=!1,t.userSearch()}},model:{value:t.user.edit,callback:function(e){t.$set(t.user,"edit",e)},expression:"user.edit"}})]},proxy:!0}]),model:{value:t.user.edit,callback:function(e){t.$set(t.user,"edit",e)},expression:"user.edit"}}),t._v(" "),t.user.loading?r("div",{staticClass:"text-center"},[t._v("\r\n        Carregando...\r\n    ")]):t._e(),t._v(" "),r("div",{staticClass:"row"},t._l(t.user.resp.data,(function(u){return r("div",{key:u.id,staticClass:"col-12 col-md-4 mb-5"},[r("user-card",{attrs:{value:u},scopedSlots:t._u([{key:"actions",fn:function(){return[r("button",{staticClass:"btn btn-light",attrs:{type:"button"},on:{click:function(e){t.user.edit=u}}},[t._v("Editar")]),t._v(" "),r("nuxt-link",{staticClass:"btn btn-light",attrs:{to:"/tevep/?user="+u.id}},[t._v("Projetos")])]},proxy:!0}],null,!0)})],1)})),0)],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiAuthRegister:r(243).default,UiModal:r(254).default,UserCard:r(255).default})}}]);