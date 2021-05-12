(window.webpackJsonp=window.webpackJsonp||[]).push([[75],{528:function(e,t,r){var content=r(536);"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(30).default)("b8d0879e",content,!0,{sourceMap:!1})},529:function(e,t,r){"use strict";r.r(t);var o={name:"ui-password",props:{value:{default:""},placeholder:{default:""},toggleShow:{default:!0},meter:{default:!0},type:{default:"password"}},watch:{$props:{deep:!0,handler:function(e){this.props=Object.assign({},e,this.props)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(12),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"form-control p-0 bg-white"},[r("div",{staticClass:"input-group"},["checkbox"===e.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:e.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(e.props.value)?e._i(e.props.value,null)>-1:e.props.value},on:{input:function(t){return e.$emit("input",e.props.value)},change:function(t){var r=e.props.value,o=t.target,n=!!o.checked;if(Array.isArray(r)){var l=e._i(r,null);o.checked?l<0&&e.$set(e.props,"value",r.concat([null])):l>-1&&e.$set(e.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else e.$set(e.props,"value",n)}}}):"radio"===e.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:e.props.placeholder,type:"radio"},domProps:{checked:e._q(e.props.value,null)},on:{input:function(t){return e.$emit("input",e.props.value)},change:function(t){return e.$set(e.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:e.props.placeholder,type:e.props.type},domProps:{value:e.props.value},on:{input:[function(t){t.target.composing||e.$set(e.props,"value",t.target.value)},function(t){return e.$emit("input",e.props.value)}]}}),e._v(" "),e.props.toggleShow?r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("div",{staticClass:"btn",on:{click:function(t){e.props.type="text"==e.props.type?"password":"text"}}},[r("i",{staticClass:"fas fa-eye",class:{"fa-eye-slash":"password"==e.props.type}})])])]):e._e()]),e._v(" "),e.props.meter?r("ui-password-meter",{staticStyle:{"margin-top":"-4px"},model:{value:e.props.value,callback:function(t){e.$set(e.props,"value",t)},expression:"props.value"}}):e._e()],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiPasswordMeter:r(532).default})},531:function(e,t,r){"use strict";r.r(t);var o={props:{value:{default:function(){return{}}},method:{default:"post"},action:{default:"api"}},watch:{$props:{deep:!0,handler:function(e){this.props=Object.assign({},e)}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)},submit:function(){var e=this,t=this.$axios[this.method],r="get"==this.method?{params:this.props.value}:this.props.value;this.loading='<i class="fa fa-fw fa-spin fa-spinner"></i>',this.responseSuccess=!1,this.responseErrorMessage=!1,this.responseErrorFields={},t(this.action,r).then((function(t){e.loading="",e.responseSuccess=t.data,e.$emit("success",e.responseSuccess)})).catch((function(t){for(var i in e.loading="",e.responseErrorMessage=t.response.data.message||"Erro",e.responseErrorFields=t.response.data.fields||{},e.responseErrorFields)Array.isArray(e.responseErrorFields[i])&&(e.responseErrorFields[i]=e.responseErrorFields[i].join("<br>"));e.$emit("error",e.responseErrorFields)}))}},data:function(){return{loading:"",responseSuccess:!1,responseErrorMessage:!1,responseErrorFields:{},props:Object.assign({},this.$props)}}},n=r(12),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("form",{staticClass:"ui-form",attrs:{method:e.method,action:e.action},on:{submit:function(t){return t.preventDefault(),e.submit()}}},[e.responseSuccess&&(e.$slots.success||e.$scopedSlots.success)?r("div",{staticClass:"alert alert-success"},[e._t("success",null,{response:e.responseSuccess})],2):e._e(),e._v(" "),e.responseErrorMessage?e._t("error",[e.responseErrorMessage?r("div",{staticClass:"alert alert-danger",domProps:{innerHTML:e._s(e.responseErrorMessage)}}):e._e()],{errorMessage:e.responseErrorMessage,fields:e.responseErrorFields}):e._e(),e._v(" "),e._t("default",null,{loading:e.loading,error:e.responseErrorFields,errorMessage:e.responseErrorMessage,success:e.responseSuccess})],2)}),[],!1,null,null,null);t.default=component.exports},532:function(e,t,r){"use strict";r.r(t);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(e){this.props=Object.assign({},e)}}},computed:{meter:function(){var e=this.props.value,t=0,r="danger";if(e){for(var o=new Object,i=0;i<e.length;i++)o[e[i]]=(o[e[i]]||0)+1,t+=5/o[e[i]];var n={digits:/\d/.test(e),lower:/[a-z]/.test(e),upper:/[A-Z]/.test(e),nonWords:/\W/.test(e)},l=0;for(var c in n)l+=1==n[c]?1:0;t+=10*(l-1),(t=parseInt(t))>=70?r="success":t>=40&&(r="primary")}return{score:t,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(12),component=Object(n.a)(o,(function(){var e=this.$createElement,t=this._self._c||e;return t("div",[t("div",{staticClass:"progress",staticStyle:{height:"5px"}},[t("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);t.default=component.exports},535:function(e,t,r){"use strict";var o=r(528);r.n(o).a},536:function(e,t,r){(t=r(29)(!1)).push([e.i,".ui-modal{position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,.2);z-index:9999!important;display:flex;align-items:center;justify-content:center;padding:0!important}.ui-modal .card{width:600px;max-width:90vw!important;max-height:90vh;margin:0!important;overflow:auto!important}",""]),e.exports=t},539:function(e,t,r){"use strict";r.r(t);var o={props:{value:{default:!1},tag:{default:"div"}},watch:{$props:{deep:!0,handler:function(e){this.props=Object.assign({},e)}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)},toggle:function(){this.props.value=!this.props.value,this.emit()}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(535),r(12)),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[e.props.value?r("div",{staticClass:"modal fade show",staticStyle:{display:"block",background:"#00000044","animation-duration":"200ms"},attrs:{tabindex:"-1","aria-labelledby":"exampleModalLiveLabel","aria-modal":"true",role:"dialog"},on:{click:function(t){return t.target!==t.currentTarget?null:e.toggle()}}},[r("div",{staticClass:"modal-dialog"},[r("div",{staticClass:"modal-content"},[r("div",{staticClass:"modal-header"},[e.$slots.header&&e.$scopedSlots.header?r("h5",{staticClass:"modal-title"},[e._t("header")],2):e._e(),e._v(" "),r("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"},on:{click:function(t){return e.toggle()}}},[r("span",{attrs:{"aria-hidden":"true"}},[e._v("×")])])]),e._v(" "),r("div",{staticClass:"modal-body"},[e._t("body")],2),e._v(" "),e.$slots.footer&&e.$scopedSlots.footer?r("div",{staticClass:"modal-footer"},[e._t("footer")],2):e._e()])])]):e._e()])],1)}),[],!1,null,null,null);t.default=component.exports},549:function(e,t,r){"use strict";r.r(t);var o={name:"ui-auth-register",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(e){this.props=Object.assign({},e)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(12),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("ui-form",{attrs:{method:"post",action:"/api/user/save/"},scopedSlots:e._u([{key:"success",fn:function(t){var o=t.response;return[e._v("Olá "+e._s(o.name)+". Seu cadastro foi concluído, agora é só "),r("nuxt-link",{attrs:{to:"/auth"}},[e._v("fazer login")]),e._v(".")]}},{key:"default",fn:function(t){var o=t.loading,n=t.error;return[e._t("content",[r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value.name,expression:"props.value.name"}],staticClass:"form-control",attrs:{type:"text",placeholder:"Nome"},domProps:{value:e.props.value.name},on:{input:function(t){t.target.composing||e.$set(e.props.value,"name",t.target.value)}}}),e._v(" "),n.name?r("small",{staticClass:"text-danger",domProps:{innerHTML:e._s(n.name)}}):e._e()]),e._v(" "),r("div",{staticClass:"form-group"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value.email,expression:"props.value.email"}],staticClass:"form-control",attrs:{type:"text",placeholder:"E-mail"},domProps:{value:e.props.value.email},on:{input:function(t){t.target.composing||e.$set(e.props.value,"email",t.target.value)}}}),e._v(" "),n.email?r("small",{staticClass:"text-danger",domProps:{innerHTML:e._s(n.email)}}):e._e()]),e._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:e.props.value.password,callback:function(t){e.$set(e.props.value,"password",t)},expression:"props.value.password"}}),e._v(" "),n.password?r("small",{staticClass:"text-danger",domProps:{innerHTML:e._s(n.password)}}):e._e()],1),e._v(" "),r("div",{staticClass:"form-group"},[r("ui-password",{attrs:{meter:!1,placeholder:"Repita senha"},model:{value:e.props.value.password_confirmation,callback:function(t){e.$set(e.props.value,"password_confirmation",t)},expression:"props.value.password_confirmation"}}),e._v(" "),n.password_confirmation?r("small",{staticClass:"text-danger",domProps:{innerHTML:e._s(n.password_confirmation)}}):e._e()],1),e._v(" "),r("div",{staticClass:"form-group text-right"},[r("button",{staticClass:"btn btn-primary btn-block",attrs:{type:"submit"}},[e._v("\r\n                        Cadastrar "),r("span",{domProps:{innerHTML:e._s(o)}})])])])]}}],null,!0),model:{value:e.props.value,callback:function(t){e.$set(e.props,"value",t)},expression:"props.value"}})],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiPassword:r(529).default,UiForm:r(531).default})},572:function(e,t,r){var content=r(621);"string"==typeof content&&(content=[[e.i,content,""]]),content.locals&&(e.exports=content.locals);(0,r(30).default)("d8c97870",content,!0,{sourceMap:!1})},620:function(e,t,r){"use strict";var o=r(572);r.n(o).a},621:function(e,t,r){(t=r(29)(!1)).push([e.i,".user-card-content{height:90px;display:flex;align-items:center;justify-content:center}.user-card-actions{display:flex}.user-card-actions .btn{margin:0}.user-card-image{background:50% no-repeat #f5f5f5;background-size:cover;width:100px;height:100px;margin:-50px auto 0;border-radius:50%;border:4px solid #fff;overflow:hidden;display:flex;align-items:center;justify-content:center}.user-card-bg{background-size:cover;background-position:50%;background-repeat:no-repeat;height:200px}.user-card-pattern{--stripe:#f5f5f5;--bg:#eee;background:linear-gradient(135deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(225deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(315deg,var(--bg) 25%,transparent 0),linear-gradient(45deg,var(--bg) 25%,transparent 0);background-size:100px 100px;background-color:var(--stripe)}",""]),e.exports=t},628:function(e,t,r){"use strict";r.r(t);var o={name:"user-card",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(e){this.props=Object.assign({},e)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(620),r(12)),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"user-card bg-white shadow-sm rounded"},[e.props.value.meta.background?r("div",{staticClass:"user-card-bg",style:"background-image:url("+e.props.value.meta.background+");"}):r("div",{staticClass:"user-card-bg user-card-pattern"}),e._v(" "),r("div",{staticClass:"user-card-image shadow-sm",style:"background-image:url("+e.props.value.meta.photo+");"},[e._t("image")],2),e._v(" "),r("div",{staticClass:"user-card-content"},[r("div",[r("div",{staticClass:"text-center font-weight-bold text-uppercase mt-2"},[r("nuxt-link",{attrs:{to:""}},[e._v(e._s(e.props.value.name))])],1),e._v(" "),r("div",{staticClass:"text-center text-muted"},[e._v(e._s(e.props.value.meta.description))]),e._v(" "),r("div",{staticClass:"text-center text-muted"},[e._v(e._s(e.props.value.email))]),e._v(" "),r("div",{staticClass:"pb-4"})])]),e._v(" "),r("div",{staticClass:"btn-group user-card-actions"},[e._t("actions")],2)])}),[],!1,null,null,null);t.default=component.exports},712:function(e,t,r){"use strict";r.r(t);var o={layout:"admin",methods:{userSearch:function(){var e=this;this.user.loading=!0,this.$axios.get("/api/user/search").then((function(t){e.user.loading=!1,e.user.resp=t.data}))}},data:function(){return{user:{loading:!1,edit:!1,params:{},resp:{}}}},mounted:function(){this.userSearch()}},n=r(12),component=Object(n.a)(o,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",[r("div",{staticClass:"text-right mb-3"},[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(t){e.user.edit={}}}},[r("i",{staticClass:"fa fa-fw fa-plus"}),e._v(" Novo usuário\r\n        ")])]),e._v(" "),r("ui-modal",{scopedSlots:e._u([{key:"header",fn:function(){return[e._v("\r\n            "+e._s(e.user.edit.name||"Criar")+"\r\n        ")]},proxy:!0},{key:"body",fn:function(){return[r("ui-auth-register",{on:{success:function(t){e.user.edit=!1,e.userSearch()}},model:{value:e.user.edit,callback:function(t){e.$set(e.user,"edit",t)},expression:"user.edit"}})]},proxy:!0}]),model:{value:e.user.edit,callback:function(t){e.$set(e.user,"edit",t)},expression:"user.edit"}}),e._v(" "),e.user.loading?r("div",{staticClass:"text-center"},[e._v("\r\n        Carregando...\r\n    ")]):e._e(),e._v(" "),r("div",{staticClass:"row"},e._l(e.user.resp.data,(function(u){return r("div",{key:u.id,staticClass:"col-12 col-md-3 mb-5",staticStyle:{position:"relative"}},[r("user-card",{staticStyle:{position:"relative",height:"100%"},attrs:{value:u},scopedSlots:e._u([{key:"actions",fn:function(){return[r("nuxt-link",{directives:[{name:"tooltip",rawName:"v-tooltip.top-center",value:"Editar",expression:"'Editar'",modifiers:{"top-center":!0}}],staticClass:"btn btn-light",attrs:{to:"/user/"+u.id}},[r("i",{staticClass:"fas fa-edit"})]),e._v(" "),r("nuxt-link",{directives:[{name:"tooltip",rawName:"v-tooltip.top-center",value:"Projetos",expression:"'Projetos'",modifiers:{"top-center":!0}}],staticClass:"btn btn-light",attrs:{to:"/tevep/?user="+u.id}},[r("i",{staticClass:"fas fa-shopping-bag"})])]},proxy:!0}],null,!0)})],1)})),0)],1)}),[],!1,null,null,null);t.default=component.exports;installComponents(component,{UiAuthRegister:r(549).default,UiModal:r(539).default,UserCard:r(628).default})}}]);