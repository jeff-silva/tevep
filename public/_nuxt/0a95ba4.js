(window.webpackJsonp=window.webpackJsonp||[]).push([[56],{373:function(t,e,r){"use strict";r.r(e);var o={name:"ui-password",props:{value:{default:""},placeholder:{default:""},meter:{default:!0},type:{default:"password"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t,this.props)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-control p-0 bg-white"},[r("div",{staticClass:"input-group"},["checkbox"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{input:function(e){return t.$emit("input",t.props.value)},change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{input:function(e){return t.$emit("input",t.props.value)},change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:t.props.type},domProps:{value:t.props.value},on:{input:[function(e){e.target.composing||t.$set(t.props,"value",e.target.value)},function(e){return t.$emit("input",t.props.value)}]}}),t._v(" "),r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.type="text"==t.props.type?"password":"text"}}},[r("i",{staticClass:"fas fa-eye",class:{"fa-eye-slash":"password"==t.props.type}})])])])]),t._v(" "),t.props.meter?r("ui-password-meter",{model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPasswordMeter:r(375).default})},374:function(t,e,r){var content=r(380);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(39).default)("b8d0879e",content,!0,{sourceMap:!1})},375:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{meter:function(){var t=this.props.value,e=0,r="danger";if(t){for(var o=new Object,i=0;i<t.length;i++)o[t[i]]=(o[t[i]]||0)+1,e+=5/o[t[i]];var n={digits:/\d/.test(t),lower:/[a-z]/.test(t),upper:/[A-Z]/.test(t),nonWords:/\W/.test(t)},l=0;for(var c in n)l+=1==n[c]?1:0;e+=10*(l-1),(e=parseInt(e))>=70?r="success":e>=40&&(r="primary")}return{score:e,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"progress",staticStyle:{height:"5px"}},[e("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);e.default=component.exports},379:function(t,e,r){"use strict";var o=r(374);r.n(o).a},380:function(t,e,r){(e=r(38)(!1)).push([t.i,".ui-modal{position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,.2);z-index:9999!important;display:flex;align-items:center;justify-content:center;padding:0!important}.ui-modal .card{width:600px;max-width:90vw!important;max-height:90vh;margin:0!important;overflow:auto!important}",""]),t.exports=e},381:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1},tag:{default:"div"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{emit:function(){this.$emit("input",this.props.value)},toggle:function(){this.props.value=!this.props.value,this.$emit("value",this.props.value),this.emit()}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(379),r(14)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"modal fade show",staticStyle:{display:"block",background:"#00000044","animation-duration":"200ms"},attrs:{tabindex:"-1","aria-labelledby":"exampleModalLiveLabel","aria-modal":"true",role:"dialog"},on:{click:function(e){return e.target!==e.currentTarget?null:t.toggle()}}},[r("div",{staticClass:"modal-dialog"},[r("div",{staticClass:"modal-content"},[r("div",{staticClass:"modal-header"},[t.$slots.header&&t.$scopedSlots.header?r("h5",{staticClass:"modal-title"},[t._t("header")],2):t._e(),t._v(" "),r("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"},on:{click:function(e){return t.toggle()}}},[r("span",{attrs:{"aria-hidden":"true"}},[t._v("×")])])]),t._v(" "),r("div",{staticClass:"modal-body"},[t._t("body")],2),t._v(" "),t.$slots.footer&&t.$scopedSlots.footer?r("div",{staticClass:"modal-footer"},[t._t("footer")],2):t._e()])])]):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},392:function(t,e,r){var content=r(431);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(39).default)("d8c97870",content,!0,{sourceMap:!1})},394:function(t,e,r){"use strict";r.r(e);var o={name:"ui-auth-register",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{submit:function(){var t=this;this.error={},this.$axios.post("/api/user/register/",this.props.value).then((function(e){if(e.data.error)return t.error=e.data.error;t.props.value={name:"",email:"",password:"",password_confirmation:""},t.$emit("success",e.data)}))}},data:function(){return{error:{},props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t._t("content",[r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.name,expression:"props.value.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Nome"},domProps:{value:t.props.value.name},on:{input:function(e){e.target.composing||t.$set(t.props.value,"name",e.target.value)}}}),t._v(" "),t.error.name?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.name.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.email,expression:"props.value.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:t.props.value.email},on:{input:function(e){e.target.composing||t.$set(t.props.value,"email",e.target.value)}}}),t._v(" "),t.error.email?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.email.join("<br>"))}}):t._e()]),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:t.props.value.password,callback:function(e){t.$set(t.props.value,"password",e)},expression:"props.value.password"}}),t._v(" "),t.error.password?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password.join("<br>"))}}):t._e()],1),t._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{meter:!1,placeholder:"Repita senha"},model:{value:t.props.value.password_confirmation,callback:function(e){t.$set(t.props.value,"password_confirmation",e)},expression:"props.value.password_confirmation"}}),t._v(" "),t.error.password_confirmation?r("small",{staticClass:"text-danger",domProps:{innerHTML:t._s(t.error.password_confirmation.join("<br>"))}}):t._e()],1),t._v(" "),t._m(0)])],2)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"form-group text-right"},[e("button",{staticClass:"btn btn-primary btn-block",attrs:{type:"submit"}},[this._v("Cadastrar")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPassword:r(373).default})},430:function(t,e,r){"use strict";var o=r(392);r.n(o).a},431:function(t,e,r){(e=r(38)(!1)).push([t.i,".user-card-content{height:90px;display:flex;align-items:center;justify-content:center}.user-card-actions{display:flex}.user-card-actions .btn{margin:0}.user-card-image{background:50% no-repeat #f5f5f5;background-size:cover;width:100px;height:100px;margin:-50px auto 0;border-radius:50%;border:4px solid #fff;overflow:hidden;display:flex;align-items:center;justify-content:center}.user-card-bg{background-size:cover;background-position:50%;background-repeat:no-repeat;height:200px}.user-card-pattern{--stripe:#f5f5f5;--bg:#eee;background:linear-gradient(135deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(225deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(315deg,var(--bg) 25%,transparent 0),linear-gradient(45deg,var(--bg) 25%,transparent 0);background-size:100px 100px;background-color:var(--stripe)}",""]),t.exports=e},444:function(t,e,r){"use strict";r.r(e);var o={name:"user-card",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(430),r(14)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"user-card bg-white shadow-sm rounded"},[t.props.value.meta.background?r("div",{staticClass:"user-card-bg",style:"background-image:url("+t.props.value.meta.background+");"}):r("div",{staticClass:"user-card-bg user-card-pattern"}),t._v(" "),r("div",{staticClass:"user-card-image shadow-sm",style:"background-image:url("+t.props.value.meta.photo+");"},[t._t("image")],2),t._v(" "),r("div",{staticClass:"user-card-content"},[r("div",[r("div",{staticClass:"text-center font-weight-bold text-uppercase mt-2"},[r("nuxt-link",{attrs:{to:""}},[t._v(t._s(t.props.value.name))])],1),t._v(" "),r("div",{staticClass:"text-center text-muted"},[t._v(t._s(t.props.value.meta.description))]),t._v(" "),r("div",{staticClass:"text-center text-muted"},[t._v(t._s(t.props.value.email))]),t._v(" "),r("div",{staticClass:"pb-4"})])]),t._v(" "),r("div",{staticClass:"btn-group user-card-actions"},[t._t("actions")],2)])}),[],!1,null,null,null);e.default=component.exports},541:function(t,e,r){"use strict";r.r(e);var o={layout:"admin",methods:{userSearch:function(){var t=this;this.user.loading=!0,this.$axios.get("/api/user/search").then((function(e){t.user.loading=!1,t.user.resp=e.data}))}},data:function(){return{user:{loading:!1,edit:!1,params:{},resp:{}}}},mounted:function(){this.userSearch()}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"text-right mb-3"},[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(e){t.user.edit={}}}},[r("i",{staticClass:"fa fa-fw fa-plus"}),t._v(" Novo usuário\r\n        ")])]),t._v(" "),r("ui-modal",{scopedSlots:t._u([{key:"header",fn:function(){return[t._v("\r\n            "+t._s(t.user.edit.name||"Criar")+"\r\n        ")]},proxy:!0},{key:"body",fn:function(){return[r("ui-auth-register",{on:{success:function(e){t.user.edit=!1,t.userSearch()}},model:{value:t.user.edit,callback:function(e){t.$set(t.user,"edit",e)},expression:"user.edit"}})]},proxy:!0}]),model:{value:t.user.edit,callback:function(e){t.$set(t.user,"edit",e)},expression:"user.edit"}}),t._v(" "),t.user.loading?r("div",{staticClass:"text-center"},[t._v("\r\n        Carregando...\r\n    ")]):t._e(),t._v(" "),r("div",{staticClass:"row"},t._l(t.user.resp.data,(function(u){return r("div",{key:u.id,staticClass:"col-12 col-md-3 mb-5",staticStyle:{position:"relative"}},[r("user-card",{staticStyle:{position:"relative",height:"100%"},attrs:{value:u},scopedSlots:t._u([{key:"actions",fn:function(){return[r("nuxt-link",{directives:[{name:"tooltip",rawName:"v-tooltip.top-center",value:"Editar",expression:"'Editar'",modifiers:{"top-center":!0}}],staticClass:"btn btn-light",attrs:{to:"/user/"+u.id}},[r("i",{staticClass:"fas fa-edit"})]),t._v(" "),r("nuxt-link",{directives:[{name:"tooltip",rawName:"v-tooltip.top-center",value:"Projetos",expression:"'Projetos'",modifiers:{"top-center":!0}}],staticClass:"btn btn-light",attrs:{to:"/tevep/?user="+u.id}},[r("i",{staticClass:"fas fa-shopping-bag"})])]},proxy:!0}],null,!0)})],1)})),0)],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiAuthRegister:r(394).default,UiModal:r(381).default,UserCard:r(444).default})}}]);