(window.webpackJsonp=window.webpackJsonp||[]).push([[67,71],{398:function(t,e,n){"use strict";n.r(e);var l=n(422),d={components:{draggable:n.n(l).a},props:{node:Object,uuid:Function,singular:{default:"Utilidade"},plural:{default:"Utilidades"},field:{default:"utilidades"},itemFields:{default:function(){return{title:""}}}},methods:{itemDefault:function(){var t=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};return Object.assign({id:this.uuid()},this.itemFields,t)},itemAdd:function(){var t=this.itemDefault();this.node[this.field].unshift(t)},itemRemove:function(t){var e=this.node[this.field].indexOf(t);this.node[this.field].splice(e,1)},draggableEnd:function(){}}},o=n(14),component=Object(o.a)(d,(function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticStyle:{"max-width":"600px"}},[n("button",{staticClass:"btn btn-primary btn-block mb-2",attrs:{type:"button"},on:{click:function(e){return t.itemAdd()}}},[n("i",{staticClass:"fas fa-plus"}),t._v(" Adicionar "+t._s(t.singular)+"\r\n    ")]),t._v(" "),0==t.node[t.field].length?n("div",{staticClass:"bg-white p-2 text-center"},[t._v("\r\n        Nenhum item de "+t._s(t.singular)+"\r\n    ")]):t._e(),t._v(" "),n("draggable",t._b({on:{end:function(e){return t.draggableEnd()}},model:{value:t.node[t.field],callback:function(e){t.$set(t.node,t.field,e)},expression:"node[field]"}},"draggable",{animation:200,handle:"._handle"},!1),t._l(t.node[t.field],(function(i){return n("div",{staticClass:"d-flex align-items-center bg-white mt-1 p-1"},[n("div",{staticClass:"px-2 _handle"},[n("i",{staticClass:"fas fa-bars"})]),t._v(" "),n("div",{staticClass:"flex-grow-1"},[t._t("fields",[n("input",{directives:[{name:"model",rawName:"v-model",value:i.title,expression:"i.title"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:i.title},on:{input:function(e){e.target.composing||t.$set(i,"title",e.target.value)}}})],{item:i})],2),t._v(" "),n("div",{staticClass:"pl-2"},[n("button",{staticClass:"btn btn-sm btn-danger",attrs:{type:"button"},on:{click:function(e){return t.itemRemove(i)}}},[n("i",{staticClass:"fas fa-times"})])])])})),0)],1)}),[],!1,null,null,null);e.default=component.exports},605:function(t,e,n){"use strict";n.r(e);var l={components:{SubComponent:n(398).default},props:{node:Object,uuid:Function,singular:{default:"Qualidade"},plural:{default:"Qualidades"},field:{default:"qualidades"},itemFields:{default:function(){return{title:""}}}}},d=n(14),component=Object(d.a)(l,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("sub-component",this._b({},"sub-component",this.$props,!1))],1)}),[],!1,null,null,null);e.default=component.exports}}]);