(window.webpackJsonp=window.webpackJsonp||[]).push([[55],{373:function(t,e,r){"use strict";r.r(e);var o={name:"ui-password",props:{value:{default:""},placeholder:{default:""},meter:{default:!0},type:{default:"password"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t,this.props)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-control p-0 bg-white"},[r("div",{staticClass:"input-group"},["checkbox"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{input:function(e){return t.$emit("input",t.props.value)},change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{input:function(e){return t.$emit("input",t.props.value)},change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{placeholder:t.props.placeholder,type:t.props.type},domProps:{value:t.props.value},on:{input:[function(e){e.target.composing||t.$set(t.props,"value",e.target.value)},function(e){return t.$emit("input",t.props.value)}]}}),t._v(" "),r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.type="text"==t.props.type?"password":"text"}}},[r("i",{staticClass:"fas fa-eye",class:{"fa-eye-slash":"password"==t.props.type}})])])])]),t._v(" "),t.props.meter?r("ui-password-meter",{model:{value:t.props.value,callback:function(e){t.$set(t.props,"value",e)},expression:"props.value"}}):t._e()],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPasswordMeter:r(375).default})},374:function(t,e,r){var content=r(380);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(39).default)("b8d0879e",content,!0,{sourceMap:!1})},375:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{meter:function(){var t=this.props.value,e=0,r="danger";if(t){for(var o=new Object,i=0;i<t.length;i++)o[t[i]]=(o[t[i]]||0)+1,e+=5/o[t[i]];var n={digits:/\d/.test(t),lower:/[a-z]/.test(t),upper:/[A-Z]/.test(t),nonWords:/\W/.test(t)},l=0;for(var c in n)l+=1==n[c]?1:0;e+=10*(l-1),(e=parseInt(e))>=70?r="success":e>=40&&(r="primary")}return{score:e,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"progress",staticStyle:{height:"5px"}},[e("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);e.default=component.exports},376:function(t,e,r){var content=r(391);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(39).default)("9ad8599e",content,!0,{sourceMap:!1})},379:function(t,e,r){"use strict";var o=r(374);r.n(o).a},380:function(t,e,r){(e=r(38)(!1)).push([t.i,".ui-modal{position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,.2);z-index:9999!important;display:flex;align-items:center;justify-content:center;padding:0!important}.ui-modal .card{width:600px;max-width:90vw!important;max-height:90vh;margin:0!important;overflow:auto!important}",""]),t.exports=e},381:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1},tag:{default:"div"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{emit:function(){this.$emit("input",this.props.value)},toggle:function(){this.props.value=!this.props.value,this.$emit("value",this.props.value),this.emit()}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(379),r(14)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"modal fade show",staticStyle:{display:"block",background:"#00000044","animation-duration":"200ms"},attrs:{tabindex:"-1","aria-labelledby":"exampleModalLiveLabel","aria-modal":"true",role:"dialog"},on:{click:function(e){return e.target!==e.currentTarget?null:t.toggle()}}},[r("div",{staticClass:"modal-dialog"},[r("div",{staticClass:"modal-content"},[r("div",{staticClass:"modal-header"},[t.$slots.header&&t.$scopedSlots.header?r("h5",{staticClass:"modal-title"},[t._t("header")],2):t._e(),t._v(" "),r("button",{staticClass:"close",attrs:{type:"button","data-dismiss":"modal","aria-label":"Close"},on:{click:function(e){return t.toggle()}}},[r("span",{attrs:{"aria-hidden":"true"}},[t._v("×")])])]),t._v(" "),r("div",{staticClass:"modal-body"},[t._t("body")],2),t._v(" "),t.$slots.footer&&t.$scopedSlots.footer?r("div",{staticClass:"modal-footer"},[t._t("footer")],2):t._e()])])]):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},390:function(t,e,r){"use strict";var o=r(376);r.n(o).a},391:function(t,e,r){(e=r(38)(!1)).push([t.i,".ui-actions-fixed{position:fixed;bottom:0;left:0;width:100%;z-index:999;box-shadow:0 -3px 3px -2px rgb(0 0 0/10%)!important}.ui-actions .d-flex>*{flex-grow:1}.ui-actions .btn{border-radius:0!important;text-transform:uppercase}.ui-actions .btn i{margin-right:5px}",""]),t.exports=e},392:function(t,e,r){var content=r(431);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(39).default)("d8c97870",content,!0,{sourceMap:!1})},395:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:function(){return{}}},method:{default:"post"},action:{default:"api"},showError:{default:!0}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)},submit:function(){var t=this,e=this.$axios[this.method],r="get"==this.method?{params:this.props.value}:this.props.value;this.loading='<i class="fa fa-fw fa-spin fa-spinner"></i>',this.success=!1,this.error=!1,e(this.action,r).then((function(e){t.loading="",t.success=e.data,t.$emit("success",t.success)})).catch((function(e){t.loading="",t.error=e.response.data||{},t.error.fields=t.error.fields.map((function(t){return t.join("<br>")})),t.$emit("error",t.error)}))}},data:function(){return{loading:"",success:!1,error:!1,responseSuccess:!1,responseErrorMessage:!1,responseErrorFields:{},props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("form",{staticClass:"ui-form",attrs:{method:t.method,action:t.action},on:{submit:function(e){return e.preventDefault(),t.submit()}}},[t.responseSuccess&&(t.$slots.success||t.$scopedSlots.success)?r("div",{staticClass:"alert alert-success"},[t._t("success",null,{response:t.responseSuccess})],2):t._e(),t._v(" "),r("transition",{attrs:{name:"ui-form-error","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.error&&t.showError?r("div",{staticClass:"alert alert-danger",staticStyle:{"animation-duration":"200ms"}},[r("a",{staticClass:"float-right text-danger",attrs:{href:"javascript:void(0);"},on:{click:function(e){t.error=!1}}},[r("i",{staticClass:"fas fa-times"})]),t._v(" "),t._t("error",[t._v(t._s(t.error.message||"Erro indefinido"))],{error:t.error})],2):t._e()]),t._v(" "),t._t("default",null,{loading:t.loading,error:t.error,success:t.success})],2)}),[],!1,null,null,null);e.default=component.exports},396:function(t,e,r){"use strict";r.r(e);r(390);var o=r(14),component=Object(o.a)({},(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"ui-actions"},[e("br"),e("br"),this._v(" "),e("div",{staticClass:"ui-actions-fixed bg-white text-center text-md-right"},[e("div",{staticClass:"d-flex d-md-block p-md-1"},[this._t("default")],2)])])}),[],!1,null,null,null);e.default=component.exports},430:function(t,e,r){"use strict";var o=r(392);r.n(o).a},431:function(t,e,r){(e=r(38)(!1)).push([t.i,".user-card-content{height:90px;display:flex;align-items:center;justify-content:center}.user-card-actions{display:flex}.user-card-actions .btn{margin:0}.user-card-image{background:50% no-repeat #f5f5f5;background-size:cover;width:100px;height:100px;margin:-50px auto 0;border-radius:50%;border:4px solid #fff;overflow:hidden;display:flex;align-items:center;justify-content:center}.user-card-bg{background-size:cover;background-position:50%;background-repeat:no-repeat;height:200px}.user-card-pattern{--stripe:#f5f5f5;--bg:#eee;background:linear-gradient(135deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(225deg,var(--bg) 25%,transparent 0) -50px 0,linear-gradient(315deg,var(--bg) 25%,transparent 0),linear-gradient(45deg,var(--bg) 25%,transparent 0);background-size:100px 100px;background-color:var(--stripe)}",""]),t.exports=e},444:function(t,e,r){"use strict";r.r(e);var o={name:"user-card",props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(430),r(14)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"user-card bg-white shadow-sm rounded"},[t.props.value.meta.background?r("div",{staticClass:"user-card-bg",style:"background-image:url("+t.props.value.meta.background+");"}):r("div",{staticClass:"user-card-bg user-card-pattern"}),t._v(" "),r("div",{staticClass:"user-card-image shadow-sm",style:"background-image:url("+t.props.value.meta.photo+");"},[t._t("image")],2),t._v(" "),r("div",{staticClass:"user-card-content"},[r("div",[r("div",{staticClass:"text-center font-weight-bold text-uppercase mt-2"},[r("nuxt-link",{attrs:{to:""}},[t._v(t._s(t.props.value.name))])],1),t._v(" "),r("div",{staticClass:"text-center text-muted"},[t._v(t._s(t.props.value.meta.description))]),t._v(" "),r("div",{staticClass:"text-center text-muted"},[t._v(t._s(t.props.value.email))]),t._v(" "),r("div",{staticClass:"pb-4"})])]),t._v(" "),r("div",{staticClass:"btn-group user-card-actions"},[t._t("actions")],2)])}),[],!1,null,null,null);e.default=component.exports},445:function(t,e,r){"use strict";r.r(e);var o={props:{label:{default:""},error:{default:""}}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group row no-gutters"},[r("div",{staticClass:"col-12 col-md-4 col-lg-3 p-2"},[r("div",[t._v(t._s(t.label))])]),t._v(" "),r("div",{staticClass:"col-12 col-md-8 col-lg-9"},[t._t("default"),t._v(" "),t.error?r("small",{staticClass:"d-block text-danger mt-1 mx-1"},[t._v(t._s(t.error))]):t._e()],2)])}),[],!1,null,null,null);e.default=component.exports},520:function(t,e,r){"use strict";r.r(e);var o={name:"ui-photo",props:{value:{default:""},defaultImage:{default:"data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCINCgkgd2lkdGg9IjYyMS4xMjdweCIgaGVpZ2h0PSI2MjEuMTI3cHgiIHZpZXdCb3g9Ijg5LjQzNyAtMTAuNTYzIDYyMS4xMjcgNjIxLjEyNyINCgkgZW5hYmxlLWJhY2tncm91bmQ9Im5ldyA4OS40MzcgLTEwLjU2MyA2MjEuMTI3IDYyMS4xMjciIHhtbDpzcGFjZT0icHJlc2VydmUiPg0KCTxyZWN0IHg9IjEwOS40MzciIHk9IjEwIiBmaWxsPSIjREFEQkRDIiB3aWR0aD0iNTgxLjEyNyIgaGVpZ2h0PSI1ODAuNTYyIi8+DQoJPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTUuMDAwMDAwLCAtNS4wMDAwMDApIj4NCgkJPHBhdGggZmlsbD0iI0YzRjRGNCIgZD0iTTk0LjQzNy01LjU2M2g2MjEuMTI3djYyMS4xMjdIOTQuNDM3Vi01LjU2M0w5NC40MzctNS41NjN6IE00NzUuMzQ2LDI1NC4wNTdsLTguMTg1LTQ3LjgzMUwyOTkuNjMsMjM1LjY0MQ0KCQkJbDI0LjU1MywxMzkuOTA4bDE2LjYyNy0yLjgxM3YxMi4wMjFoMTcwLjA4N1YyNTQuMDU3SDQ3NS4zNDZMNDc1LjM0NiwyNTQuMDU3eiBNMzQwLjgxMSwzNTguNjY2bC01LjM3MSwxLjAyMWwtMTkuOTUtMTEyLjc5NA0KCQkJbDE0MC40MTktMjQuODEybDUuNjI4LDMxLjk3NEgzNDAuODExVjM1OC42NjZMMzQwLjgxMSwzNTguNjY2TDM0MC44MTEsMzU4LjY2NnogTTQ5Ny4wODcsMzcwLjk0M0gzNTQuNjIxVjI2Ny44NjhoMTQyLjQ2NlYzNzAuOTQzDQoJCQlMNDk3LjA4NywzNzAuOTQzeiBNMzYzLjgyOCwyNzcuMDc1djc2LjQ3NGwyOC45MDMtMTkuMTgxbDE3LjkwMywxMS4yNTJsNDMuNDgtNDcuODI5bDUuNjI5LDIuMzAxbDI4LjEzNCwzMi40ODV2LTU1LjUwMkgzNjMuODI4DQoJCQlMMzYzLjgyOCwyNzcuMDc1TDM2My44MjgsMjc3LjA3NXogTTM5MS40NTEsMzEwLjA2OGMtNi42NDgsMC0xMi4yNzYtNS42MjYtMTIuMjc2LTEyLjI3N2MwLTYuNjUsNS42MjgtMTIuMjc5LDEyLjI3Ni0xMi4yNzkNCgkJCWM2LjY1MSwwLDEyLjI3Niw1LjYyNiwxMi4yNzYsMTIuMjc5QzQwMy43MjksMzA0LjQ0MiwzOTguMTAyLDMxMC4wNjgsMzkxLjQ1MSwzMTAuMDY4TDM5MS40NTEsMzEwLjA2OEwzOTEuNDUxLDMxMC4wNjh6Ii8+DQoJPC9nPg0KPC9zdmc+DQo="}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{compUrl:function(){return this.props.value||this.defaultImage}},methods:{emit:function(){this.$emit("input",this.props.value)},toggle:function(){this.$refs.modal.toggle()},getFile:function(t){var e=this;if(t){var r=new FileReader;r.readAsDataURL(t),r.onload=function(){e.props.value=r.result,e.$emit("input",e.props.value)}}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-photo",attrs:{dropzone:"copy"},on:{drop:function(e){return t.onDrop(e)},dragover:function(t){return t.preventDefault()}}},[r("ui-modal",{ref:"modal",scopedSlots:t._u([{key:"body",fn:function(){return[r("div",{staticClass:"form-group"},[r("label",[t._v("Informe a URL do arquivo:")]),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.props.value},on:{keyup:function(e){return t.$emit("input",t.props.value)},input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}})]),t._v(" "),r("div",{staticClass:"form-group"},[r("label",[t._v("Ou faça upload:")]),t._v(" "),r("input",{staticClass:"form-control",attrs:{type:"file"},on:{change:function(e){t.getFile(e.target.files[0]||!1),e.target.type="text",e.target.type="file",t.modal=!1}}})]),t._v(" "),r("div",{staticClass:"form-group"},[t._v("\r\n                Você também pode arrastar e soltar a imagem aqui ou diretamente na miniatura da foto fora do modal.\r\n            ")])]},proxy:!0},{key:"footer",fn:function(){return[r("a",{staticClass:"btn btn-danger float-left",attrs:{href:"javascript:;"},on:{click:function(e){t.props.value="",t.$emit("input","")}}},[t._v("Remover imagem")])]},proxy:!0}])}),t._v(" "),t.props.value?r("div",{staticStyle:{cursor:"pointer"},on:{click:function(e){t.props.value="",t.$emit("input","")}}},[t._t("has-image",[r("img",{staticStyle:{width:"100%",margin:"0px!important"},attrs:{src:t.compUrl,alt:""}}),t._v(" "),r("a",{staticClass:"btn btn-outline-danger btn-block",attrs:{href:"javascript:;"},on:{click:function(e){t.props.value="",t.$emit("input","")}}},[r("i",{staticClass:"fas fa-times"}),t._v(" Remover\r\n            ")])])],2):r("div",{staticStyle:{cursor:"pointer"},on:{click:function(e){t.props.modal=!0}}},[t._t("no-image",[r("img",{staticStyle:{width:"100%",margin:"0px!important"},attrs:{src:t.compUrl,alt:""}}),t._v(" "),r("div",{staticClass:"m-0"},[r("div",{staticClass:"btn btn-outline-primary btn-block",on:{click:function(e){t.props.modal=!0}}},[r("i",{staticClass:"fas fa-upload"}),t._v(" Upload\r\n                ")])])])],2)],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiModal:r(381).default})},551:function(t,e,r){"use strict";r.r(e);var o={layout:"admin",methods:{userFind:function(){var t=this;this.loading=!0;var e="me"==this.$route.params.id?this.$auth.user.id:this.$route.params.id;this.$axios.get("/api/user/find",{params:{id:e}}).then((function(e){t.loading=!1,t.user=e.data}))},success:function(t){this.$swalSuccess("Sucesso","Dados salvos"),t.id==this.$auth.user.id&&location.reload()}},data:function(){return{loading:!1,error:{},user:{}}},mounted:function(){this.userFind()}},n=r(14),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[t.loading?r("div",[t._v("Carregando...")]):t._e(),t._v(" "),t.user.id?r("form",{on:{submit:function(e){return e.preventDefault(),t.userStore()}}},[r("ui-photo",{ref:"userPhoto",scopedSlots:t._u([{key:"has-image",fn:function(){return[t._v(" ")]},proxy:!0},{key:"no-image",fn:function(){return[t._v(" ")]},proxy:!0}],null,!1,99489010),model:{value:t.user.meta.photo,callback:function(e){t.$set(t.user.meta,"photo",e)},expression:"user.meta.photo"}}),t._v(" "),r("ui-photo",{ref:"userBackground",scopedSlots:t._u([{key:"has-image",fn:function(){return[t._v(" ")]},proxy:!0},{key:"no-image",fn:function(){return[t._v(" ")]},proxy:!0}],null,!1,99489010),model:{value:t.user.meta.background,callback:function(e){t.$set(t.user.meta,"background",e)},expression:"user.meta.background"}}),t._v(" "),r("ui-form",{attrs:{method:"post",action:"/api/user/store/"},on:{success:function(e){return t.success(e)}},scopedSlots:t._u([{key:"default",fn:function(e){var o=e.loading;e.success,e.error;return[r("div",{staticClass:"row no-gutters"},[r("div",{staticClass:"col-12 col-md-4 mb-4 pr-3"},[r("user-card",{scopedSlots:t._u([{key:"actions",fn:function(){return[r("a",{staticClass:"btn btn-light",attrs:{href:"javascript:;"},on:{click:function(e){return t.$refs.userPhoto.toggle()}}},[t._v("Foto")]),t._v(" "),r("a",{staticClass:"btn btn-light",attrs:{href:"javascript:;"},on:{click:function(e){return t.$refs.userBackground.toggle()}}},[t._v("Background")])]},proxy:!0}],null,!0),model:{value:t.user,callback:function(e){t.user=e},expression:"user"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-8"},[r("ui-field",{attrs:{label:"Nome"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.user.name,expression:"user.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.user.name},on:{input:function(e){e.target.composing||t.$set(t.user,"name",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"E-mail"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.user.email,expression:"user.email"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.user.email},on:{input:function(e){e.target.composing||t.$set(t.user,"email",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Descrição"}},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.user.description,expression:"user.description"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.user.description},on:{input:function(e){e.target.composing||t.$set(t.user,"description",e.target.value)}}})]),t._v(" "),r("ui-field",{attrs:{label:"Senha"}},[r("div",{staticClass:"row no-gutters"},[r("div",{staticClass:"col-12 col-md-6"},[r("ui-password",{attrs:{placeholder:"Senha"},model:{value:t.user.password,callback:function(e){t.$set(t.user,"password",e)},expression:"user.password"}})],1),t._v(" "),r("div",{staticClass:"col-12 col-md-6 pl-md-2"},[r("ui-password",{attrs:{placeholder:"Repita a senha",meter:!1},model:{value:t.user.password,callback:function(e){t.$set(t.user,"password",e)},expression:"user.password"}})],1)])])],1)]),t._v(" "),r("ui-actions",[r("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[r("div",o?[r("span",{domProps:{innerHTML:t._s(o)}}),t._v(" Salvando")]:[r("i",{staticClass:"fas fa-save"}),t._v(" Salvar")])])])]}}],null,!1,1697983105),model:{value:t.user,callback:function(e){t.user=e},expression:"user"}})],1):t._e()])}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPhoto:r(520).default,UserCard:r(444).default,UiField:r(445).default,UiPassword:r(373).default,UiActions:r(396).default,UiForm:r(395).default})}}]);