(window.webpackJsonp=window.webpackJsonp||[]).push([[14],{222:function(t,e,r){var content=r(377);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(39).default)("2b1291d1",content,!0,{sourceMap:!1})},376:function(t,e,r){"use strict";var o=r(222);r.n(o).a},377:function(t,e,r){(e=r(38)(!1)).push([t.i,".ui-input-label,.ui-input .input-group-btn,.ui-input .input-group-text{border-color:transparent;background:none}.ui-input-label{position:absolute;top:0;left:-1px;width:100%;height:100%;z-index:2;font-weight:400!important;display:flex;align-items:center;transition:all .3s ease}.ui-input-full .ui-input-label{font-size:70%;height:20px}.ui-input>.input-group>.form-control{transition:all .3s ease;padding-top:10px!important}",""]),t.exports=e},381:function(t,e,r){"use strict";r.r(e);var o={name:"ui-input",props:{value:{default:""},type:{default:"text"},label:{default:""},error:{default:[]},options:{default:function(){return[]}},optionsShow:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{selectOption:function(t){this.props.optionsShow=!1}},data:function(){var data={};return data.props=Object.assign({},this.$props),data.props.id=data.props.id||"field-"+Math.round(9999*Math.random()),data}},n=(r(376),r(11)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-input mb-3",class:{"ui-input-full":!!t.props.value},staticStyle:{position:"relative"},on:{keyup:function(e){return t.$emit("input",t.props.value)},click:function(e){return t.$emit("input",t.props.value)}}},[r("div",{staticClass:"input-group form-control p-0 m-0"},[t.$slots.prepend?r("div",{staticClass:"input-group-prepend"},[t._t("prepend")],2):t._e(),t._v(" "),r("div",{staticClass:"form-control p-0 border-0 bg-transparent",staticStyle:{position:"relative"}},[r("label",{staticClass:"form-control ui-input-label",attrs:{for:t.props.id},domProps:{innerHTML:t._s(t.props.label)}}),t._v(" "),"html"==t.props.type?r("div",{staticClass:"form-control d-flex border-0 bg-transparent",staticStyle:{height:"auto"},attrs:{contenteditable:"true"}},[t._v(" ")]):t.props.options.length>0?r("div",{staticClass:"form-control d-flex border-0 bg-transparent"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{type:"text",id:t.props.id},domProps:{value:t.props.value},on:{input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}})]):"checkbox"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{id:t.props.id,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.props.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{id:t.props.id,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control border-0 bg-transparent",attrs:{id:t.props.id,type:t.props.type},domProps:{value:t.props.value},on:{input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}})]),t._v(" "),t.$slots.append?r("div",{staticClass:"input-group-append"},[t._t("append")],2):t._e(),t._v(" "),t.props.options.length>0?r("div",{staticClass:"input-group-append"},[r("div",{staticClass:"input-group-btn"},[r("button",{staticClass:"btn",attrs:{type:"button"},on:{click:function(e){t.props.optionsShow=!t.props.optionsShow}}},[r("i",{staticClass:"fas fa-caret-down"})])])]):t._e()]),t._v(" "),t.props.error.length>0?r("small",{staticClass:"text-danger m-0",domProps:{innerHTML:t._s(t.props.error.join("<br>"))}}):t._e(),t._v(" "),t.props.options.length>0&&t.props.optionsShow?r("div",{staticClass:"bg-white",staticStyle:{position:"absolute",top:"100%",left:"0px",width:"100%","min-width":"200px","z-index":"3","max-height":"200px",overflow:"auto!important"}},t._l(t.props.options,(function(e){return r("div",{staticClass:"p-2",on:{click:function(r){return t.selectOption(e)}}},[t._t("option",[t._v(t._s(e))],{option:e})],2)})),0):t._e()])}),[],!1,null,null,null);e.default=component.exports},395:function(t,e,r){"use strict";r.r(e);var o={layout:"admin",methods:{userFind:function(){var t=this;this.$axios.get("/api/user/find",{params:{id:this.$route.params.id}}).then((function(e){t.user=e.data}))},userStore:function(){var t=this;this.$axios.post("/api/user/store",this.user).then((function(e){if(e.data.error)return t.error=e.data.error;t.$swalSuccess("Sucesso","Dados salvos")}))}},data:function(){return{loading:!1,error:{},user:{}}},mounted:function(){this.userFind()}},n=r(11),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.userStore()}}},[r("ui-input",{attrs:{label:"Nome",error:t.error.name},model:{value:t.user.name,callback:function(e){t.$set(t.user,"name",e)},expression:"user.name"}}),t._v(" "),r("ui-input",{attrs:{label:"E-mail",error:t.error.email},model:{value:t.user.email,callback:function(e){t.$set(t.user,"email",e)},expression:"user.email"}}),t._v(" "),t._m(0)],1)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"mt-2 text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[this._v("\r\n                Salvar\r\n            ")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiInput:r(381).default})}}]);