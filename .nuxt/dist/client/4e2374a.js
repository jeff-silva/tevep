(window.webpackJsonp=window.webpackJsonp||[]).push([[14],{230:function(t,e,r){var content=r(380);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(30).default)("113bd0ac",content,!0,{sourceMap:!1})},231:function(t,e,r){var content=r(382);"string"==typeof content&&(content=[[t.i,content,""]]),content.locals&&(t.exports=content.locals);(0,r(30).default)("4378e08c",content,!0,{sourceMap:!1})},235:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{meter:function(){var t=this.props.value,e=0,r="danger";if(t){for(var o=new Object,i=0;i<t.length;i++)o[t[i]]=(o[t[i]]||0)+1,e+=5/o[t[i]];var n={digits:/\d/.test(t),lower:/[a-z]/.test(t),upper:/[A-Z]/.test(t),nonWords:/\W/.test(t)},l=0;for(var c in n)l+=1==n[c]?1:0;e+=10*(l-1),(e=parseInt(e))>=70?r="success":e>=40&&(r="primary")}return{score:e,class:r}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(7),component=Object(n.a)(o,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",[e("div",{staticClass:"progress",staticStyle:{height:"5px"}},[e("div",{staticClass:"progress-bar progress-bar-striped",class:"bg-"+this.meter.class,style:"width:"+this.meter.score+"%;"})])])}),[],!1,null,null,null);e.default=component.exports},236:function(t,e,r){"use strict";r.r(e);r(67);var o={props:{value:{default:""},time:{default:!0}},filters:{pad:function(t){for(var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:2,s=t+"";s.length<e;)s="0"+s;return s}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t),this.valueToFields()}}},methods:{emit:function(){var t=this;setTimeout((function(){var e=t.getDate();t.props.value=e,t.$emit("input",t.props.value),t.$emit("value",t.props.value),t.$emit("change",t.props.value)}),100)},getDate:function(){var t="".concat(this.year,"-").concat(this.month,"-").concat(this.day);return this.time&&(t+=" ".concat(this.hour,":").concat(this.minute,":").concat(this.second)),t},valueToFields:function(){var t=(this.props.value||"").split(/[^0-9]/);this.year=t[0]||(new Date).getFullYear(),this.month=t[1]||"01",this.day=t[2]||"",this.hour=t[3]||"",this.minute=t[4]||"",this.second=t[5]||"00"}},data:function(){var data={};return data.props=Object.assign({},this.$props),data.year=(new Date).getFullYear(),data.month="01",data.day="",data.hour="",data.minute="",data.second="00",data.months=[{month:"01",days:31,name:"Janeiro"},{month:"02",days:29,name:"Fevereiro"},{month:"03",days:31,name:"Março"},{month:"04",days:30,name:"Abril"},{month:"05",days:31,name:"Maio"},{month:"06",days:30,name:"Junho"},{month:"07",days:31,name:"Julho"},{month:"08",days:31,name:"Agosto"},{month:"09",days:30,name:"Setembro"},{month:"10",days:31,name:"Outubro"},{month:"11",days:30,name:"Novembro"},{month:"12",days:31,name:"Dezembro"}],data},mounted:function(){this.valueToFields()}},n=r(7),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",t._l(t.months,(function(e){return e.month==t.month?r("div",{staticClass:"row no-gutters"},[r("div",{staticClass:"col"},[r("select",{directives:[{name:"model",rawName:"v-model",value:t.day,expression:"day"}],staticClass:"form-control",on:{input:function(e){return t.emit()},change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.day=e.target.multiple?r:r[0]}}},t._l(e.days,(function(e){return r("option",{domProps:{value:t._f("pad")(e)}},[t._v(t._s(t._f("pad")(e)))])})),0)]),t._v(" "),r("div",{staticClass:"col"},[r("select",{directives:[{name:"model",rawName:"v-model",value:t.month,expression:"month"}],staticClass:"form-control",on:{input:function(e){return t.emit()},change:function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.month=e.target.multiple?r:r[0]}}},t._l(t.months,(function(e){return r("option",{domProps:{value:e.month}},[t._v(t._s(e.name))])})),0)]),t._v(" "),r("div",{staticClass:"col"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.year,expression:"year"}],staticClass:"form-control",attrs:{type:"number"},domProps:{value:t.year},on:{input:[function(e){e.target.composing||(t.year=e.target.value)},function(e){return t.emit()}]}})]),t._v(" "),t.time?r("div",{staticClass:"col"},[r("div",{staticClass:"input-group form-control p-0"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.hour,expression:"hour"}],staticClass:"form-control border-0 bg-transparent pr-0 text-right",attrs:{type:"number",min:"1",max:"23"},domProps:{value:t.hour},on:{input:[function(e){e.target.composing||(t.hour=e.target.value)},function(e){return t.emit()}]}}),t._v(" "),r("div",{staticClass:"input-group-text border-0 bg-transparent px-0"},[t._v(":")]),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.minute,expression:"minute"}],staticClass:"form-control border-0 bg-transparent px-0",attrs:{type:"number",min:"0",max:"59",step:"5"},domProps:{value:t.minute},on:{input:[function(e){e.target.composing||(t.minute=e.target.value)},function(e){return t.emit()}]}})])]):t._e()]):t._e()})),0)}),[],!1,null,null,null);e.default=component.exports},379:function(t,e,r){"use strict";var o=r(230);r.n(o).a},380:function(t,e,r){(e=r(29)(!1)).push([t.i,".ui-address .leaflet-pane{z-index:1!important}.ui-address-search-results-each{border-bottom:1px solid #eee}.ui-address-search-results-each:hover{background:#eee;cursor:pointer}",""]),t.exports=e},381:function(t,e,r){"use strict";var o=r(231);r.n(o).a},382:function(t,e,r){(e=r(29)(!1)).push([t.i,".ui-modal{position:fixed;top:0;left:0;width:100vw;height:100vh;background:rgba(0,0,0,.2);z-index:99!important;display:flex;align-items:center;justify-content:center}.ui-modal .card{width:600px;max-width:90%!important}",""]),t.exports=e},400:function(t,e,r){"use strict";r.r(e);r(67);var o={props:{value:{default:""},imgMaxWidth:{default:800},imgMaxHeight:{default:600}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)},getPhotoUrl:function(){var t=this;this.$swalPrompt("Informe a URL da imagem",(function(e){t.props.value=e,t.emit()}))},getInputPhoto:function(t){var e=this;if(t.target.files&&t.target.files[0]){var r=t.target.files[0];if("image"!=r.type.split("/")[0])return void alert("O arquivo deve ser uma imagem.");var o=new FileReader;o.onload=function(t){var img=document.createElement("img");img.src=t.target.result,img.onload=function(){var canvas=document.createElement("canvas"),t=canvas.getContext("2d"),r=parseFloat(e.imgMaxWidth),o=parseFloat(e.imgMaxHeight),n=img.width,l=img.height;n>l?n>r&&(l*=r/n,n=r):l>o&&(n*=o/l,l=o),canvas.width=n,canvas.height=l,t.drawImage(img,0,0,n,l);var c=canvas.toDataURL("image/png");e.props.value=c,e.emit()}},o.readAsDataURL(r)}}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(7),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("div",{staticClass:"d-flex align-items-center"},[r("label",{staticClass:"bg-white shadow-sm"},[r("div",{staticStyle:{display:"inline-block","min-width":"70px",height:"70px"}},[r("img",{staticStyle:{height:"100%"},attrs:{src:t.props.value,alt:""}})]),t._v(" "),r("input",{staticClass:"form-control",staticStyle:{display:"none"},attrs:{type:"file"},on:{change:function(e){return t.getInputPhoto(e)}}})]),t._v(" "),r("div",{staticClass:"flex-grow-1 pl-3"},[r("div",{staticClass:"list-inline"},[t.props.value?r("a",{staticClass:"list-inline-item",attrs:{href:"javascript:;"},on:{click:function(e){t.props.value="",t.emit()}}},[t._v("Remover")]):t._e(),t._v(" "),r("a",{staticClass:"list-inline-item",attrs:{href:"javascript:;"},on:{click:function(e){return t.getPhotoUrl()}}},[t._v("Carregar de URL")])])])])])}),[],!1,null,null,null);e.default=component.exports},401:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:""},label:{default:""},placeholder:{default:""},type:{default:"text"},imgMaxWidth:{default:800},imgMaxHeight:{default:600},error:{default:""}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)}},data:function(){return{props:Object.assign({},this.$props)}}},n=r(7),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"form-group"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-12 col-md-4 col-lg-3 p-2"},[r("div",[t._v(t._s(t.label))])]),t._v(" "),r("div",{staticClass:"col-12 col-md-8 col-lg-9"},[t.$slots.field?[t._t("field")]:"textarea"==t.type?[r("textarea",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control",domProps:{value:t.props.value},on:{keyup:function(e){return t.emit()},input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}})]:["checkbox"===t.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control",attrs:{placeholder:t.placeholder,type:"checkbox"},domProps:{checked:Array.isArray(t.props.value)?t._i(t.props.value,null)>-1:t.props.value},on:{keyup:function(e){return t.emit()},change:function(e){var r=t.props.value,o=e.target,n=!!o.checked;if(Array.isArray(r)){var l=t._i(r,null);o.checked?l<0&&t.$set(t.props,"value",r.concat([null])):l>-1&&t.$set(t.props,"value",r.slice(0,l).concat(r.slice(l+1)))}else t.$set(t.props,"value",n)}}}):"radio"===t.type?r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control",attrs:{placeholder:t.placeholder,type:"radio"},domProps:{checked:t._q(t.props.value,null)},on:{keyup:function(e){return t.emit()},change:function(e){return t.$set(t.props,"value",null)}}}):r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value,expression:"props.value"}],staticClass:"form-control",attrs:{placeholder:t.placeholder,type:t.type},domProps:{value:t.props.value},on:{keyup:function(e){return t.emit()},input:function(e){e.target.composing||t.$set(t.props,"value",e.target.value)}}})],t._v(" "),t.props.error?r("small",{staticClass:"d-block text-danger",domProps:{innerHTML:t._s(t.props.error)}}):t._e(),t._v(" "),t.$slots.hint?r("small",{staticClass:"text-muted"},[t._t("hint")],2):t._e()],2)])])}),[],!1,null,null,null);e.default=component.exports},402:function(t,e,r){"use strict";r.r(e);var o={props:{reference:{default:""},refId:{default:""},value:{default:function(){return[]}},loadOnStart:{default:!0}},methods:{list:function(){var t=this,e={ref:this.reference,ref_id:this.refId};this.$axios.get("/api/address/search",{params:e}).then((function(e){t.props.value=e.data}))},add:function(){this.props.value.push({name:"Endereço #".concat(this.props.value.length+1)}),this.edit=this.props.value[this.props.value.length-1]}},data:function(){return{props:Object.assign({},this.$props),edit:!1}},mounted:function(){this.loadOnStart&&this.list()}},n=r(7),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-addresses"},[r("button",{staticClass:"btn btn-outline-primary",attrs:{type:"button"},on:{click:function(e){return t.add()}}},[r("i",{staticClass:"fa fa-fw fa-plus"}),t._v(" Adicionar endereço\r\n    ")]),t._v(" "),0==t.props.value.length?r("div",{staticClass:"text-center text-muted p-3"},[t._v("\r\n        Nenhum endereço cadastrado\r\n    ")]):t._e(),t._v(" "),r("table",{staticClass:"table table-borderless table-striped"},[r("tbody",t._l(t.props.value,(function(e){return r("tr",{on:{click:function(r){t.edit=e}}},[r("td",{staticStyle:{cursor:"pointer"}},[r("strong",{staticClass:"d-block"},[t._v(t._s(e.name||"Sem descrição"))]),t._v(" "),r("small",{staticClass:"d-block text-muted"},[t._v(t._s([e.route,e.district,e.city].join(" ")))])])])})),0)]),t._v(" "),r("ui-modal",{scopedSlots:t._u([{key:"body",fn:function(){return[r("ui-address",{ref:"edit",attrs:{reference:t.reference,"ref-id":t.refId,"show-btn-save":!1},on:{saved:function(e){t.edit=!1,t.list()}},model:{value:t.edit,callback:function(e){t.edit=e},expression:"edit"}})]},proxy:!0},{key:"footer",fn:function(){return[r("button",{staticClass:"btn btn-primary",attrs:{type:"button"},on:{click:function(e){return t.$refs.edit.save()}}},[r("i",{staticClass:"fa fa-fw fa-save"}),t._v(" Salvar\r\n            ")])]},proxy:!0}]),model:{value:t.edit,callback:function(e){t.edit=e},expression:"edit"}})],1)}),[],!1,null,null,null);e.default=component.exports;installComponents(component,{UiAddress:r(406).default,UiModal:r(407).default})},406:function(t,e,r){"use strict";r.r(e);r(123),r(23),r(11),r(51);var o,n={props:{value:{default:function(){return{}}}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},computed:{formattedAddress:function(){var t=this.props.value,e=[];return t.route&&e.push(t.route),t.number&&e.push("Nº ".concat(t.number)),t.complement&&e.push(t.complement),t.zipcode&&e.push("CEP ".concat(t.zipcode)),t.district&&e.push(t.district),t.city&&e.push(t.city),t.state&&e.push(t.state),e.join(", ")}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)},selectPlace:function(t){if(0!=Object.keys(t).length){this.props.value=Object.assign(this.props.value,{lat:t.lat?parseFloat(t.lat):0,lng:t.lon?parseFloat(t.lon):0,route:t.address.road,number:"",complement:"",zipcode:t.address.postcode,district:t.address.suburb,city:t.address.city,state:t.address.state,st:{Acre:"AC",Alagoas:"AL","Amapá":"AP",Amazonas:"AM",Bahia:"BA","Ceará":"CE","Distrito Federal":"DF","Espírito Santo":"ES","Goiás":"GO","Maranhão":"MA","Mato Grosso":"MT","Mato Grosso do Sul":"MS","Minas Gerais":"MG","Pará":"PA","Paraíba":"PB","Paraná":"PR",Pernambuco:"PE","Piauí":"PI","Rio de Janeiro":"RJ","Rio Grande do Norte":"RN","Rio Grande do Sul":"RS","Rondônia":"RO",Roraima:"RR","Santa Catarina":"SC","São Paulo":"SP",Sergipe:"SE",Tocantins:"TO"}[t.address.state]||!1,country:t.address.country,co:t.address.country_code.toUpperCase()}),this.$set(this.props,"value",this.props.value),this.$set(this.search,"results",[]),this.emit()}},autocomplete:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};e=Object.assign({delay:0,isSearch:!0,type:"zipcode"},e),o&&clearTimeout(o),o=setTimeout((function(){var r={};"address"==e.type?r.q="".concat(t.props.value.route," ").concat(t.props.value.district," ").concat(t.props.value.city).trim():"zipcode"==e.type?r.zipcode=t.props.value.zipcode:"latlng"==e.type&&(r.lat=t.props.value.lat,r.lng=t.props.value.lng),t.$axios.get("/api/addresses/autocomplete/",{params:r}).then((function(r){t.loading=!1,e.isSearch?t.$set(t.search,"results",r.data):t.selectPlace(r.data[0]||{})}))}),e.delay)},getAddressByLatLng:function(t){this.props.value.lat=t.target._latlng.lat,this.props.value.lng=t.target._latlng.lng,this.autocomplete({delay:0,isSearch:!1,type:"latlng"})},documentClickHandle:function(t){this.focused=this.$el.contains(t.target)}},data:function(){var data={loading:!1,focused:!1,search:{params:{q:"",format:"json",addressdetails:1},results:[]}};return data.props=Object.assign({},this.$props),data.props.value=Object.assign({lat:0,lng:0,route:"",number:"",complement:"",zipcode:"",district:"",city:"",state:"",st:"",country:"",co:""},data.props.value),data},mounted:function(){window.addEventListener("click",this.documentClickHandle)},beforeDestroy:function(){window.removeEventListener("click",this.documentClickHandle)}},l=(r(379),r(7)),component=Object(l.a)(n,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"ui-address",staticStyle:{position:"relative","z-index":"1"}},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-8 col-md-8"},[r("div",{staticClass:"input-group form-control border-0 p-0"},[t._m(0),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.zipcode,expression:"props.value.zipcode"}],staticClass:"form-control border-0",attrs:{type:"text"},domProps:{value:t.props.value.zipcode},on:{keyup:function(e){t.emit(),t.autocomplete({delay:500,isSearch:!1,type:"zipcode"})},input:function(e){e.target.composing||t.$set(t.props.value,"zipcode",e.target.value)}}})])]),t._v(" "),r("div",{staticClass:"col-12"}),t._v(" "),r("div",{staticClass:"col-12 col-md-8"},[r("div",{staticClass:"input-group form-control border-0 p-0",staticStyle:{height:"auto"}},[t._m(1),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.route,expression:"props.value.route"}],staticClass:"form-control border-0",attrs:{type:"text",placeholder:"Digite endereço, bairro e cidade para autocompletar"},domProps:{value:t.props.value.route},on:{keyup:function(e){return t.autocomplete({delay:500,isSearch:!0,type:"address"})},change:function(e){return t.emit()},input:function(e){e.target.composing||t.$set(t.props.value,"route",e.target.value)}}})]),t._v(" "),r("div",{staticStyle:{position:"relative"}},[r("div",{staticClass:"bg-white shadow-sm",staticStyle:{position:"absolute",top:"0px",left:"0px","z-index":"9","max-height":"40vh",overflow:"auto"}},t._l(t.search.results,(function(e){return r("div",{staticClass:"p-2 ui-address-search-results-each",on:{click:function(r){return t.selectPlace(e)}}},[t._v("\r\n                        "+t._s(e.display_name)+"\r\n                    ")])})),0)])]),t._v(" "),r("div",{staticClass:"col-6 col-md-4"},[r("div",{staticClass:"input-group form-control border-0 p-0"},[t._m(2),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.number,expression:"props.value.number"}],staticClass:"form-control border-0",attrs:{type:"text"},domProps:{value:t.props.value.number},on:{change:function(e){return t.emit()},input:function(e){e.target.composing||t.$set(t.props.value,"number",e.target.value)}}})])]),t._v(" "),r("div",{staticClass:"col-6 col-md-4"},[r("div",{staticClass:"input-group form-control border-0 p-0",attrs:{title:"Complemento"}},[t._m(3),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.complement,expression:"props.value.complement"}],staticClass:"form-control border-0",attrs:{type:"text"},domProps:{value:t.props.value.complement},on:{change:function(e){return t.emit()},input:function(e){e.target.composing||t.$set(t.props.value,"complement",e.target.value)}}})])]),t._v(" "),r("div",{staticClass:"col-6 col-md-4"},[r("div",{staticClass:"input-group form-control border-0 p-0"},[t._m(4),t._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:t.props.value.city,expression:"props.value.city"}],staticClass:"form-control border-0",attrs:{type:"text"},domProps:{value:t.props.value.city},on:{keyup:function(e){return t.autocomplete({delay:500,isSearch:!0,type:"address"})},change:function(e){return t.emit()},input:function(e){e.target.composing||t.$set(t.props.value,"city",e.target.value)}}})])]),t._v(" "),r("div",{staticClass:"col-6 col-md-4"},[r("div",{staticClass:"input-group form-control border-0 p-0"},[t._m(5),t._v(" "),r("select",{directives:[{name:"model",rawName:"v-model",value:t.props.value.st,expression:"props.value.st"}],staticClass:"form-control border-0",on:{change:[function(e){var r=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){return"_value"in t?t._value:t.value}));t.$set(t.props.value,"st",e.target.multiple?r:r[0])},function(e){return t.emit()}]}},[r("option",{attrs:{value:""}},[t._v("Selecionar")]),t._v(" "),r("option",{attrs:{value:"AC"}},[t._v("Acre")]),t._v(" "),r("option",{attrs:{value:"AL"}},[t._v("Alagoas")]),t._v(" "),r("option",{attrs:{value:"AP"}},[t._v("Amapá")]),t._v(" "),r("option",{attrs:{value:"AM"}},[t._v("Amazonas")]),t._v(" "),r("option",{attrs:{value:"BA"}},[t._v("Bahia")]),t._v(" "),r("option",{attrs:{value:"CE"}},[t._v("Ceará")]),t._v(" "),r("option",{attrs:{value:"DF"}},[t._v("Distrito Federal")]),t._v(" "),r("option",{attrs:{value:"ES"}},[t._v("Espírito Santo")]),t._v(" "),r("option",{attrs:{value:"GO"}},[t._v("Goiás")]),t._v(" "),r("option",{attrs:{value:"MA"}},[t._v("Maranhão")]),t._v(" "),r("option",{attrs:{value:"MT"}},[t._v("Mato Grosso")]),t._v(" "),r("option",{attrs:{value:"MS"}},[t._v("Mato Grosso do Sul")]),t._v(" "),r("option",{attrs:{value:"MG"}},[t._v("Minas Gerais")]),t._v(" "),r("option",{attrs:{value:"PA"}},[t._v("Pará")]),t._v(" "),r("option",{attrs:{value:"PB"}},[t._v("Paraíba")]),t._v(" "),r("option",{attrs:{value:"PR"}},[t._v("Paraná")]),t._v(" "),r("option",{attrs:{value:"PE"}},[t._v("Pernambuco")]),t._v(" "),r("option",{attrs:{value:"PI"}},[t._v("Piauí")]),t._v(" "),r("option",{attrs:{value:"RJ"}},[t._v("Rio de Janeiro")]),t._v(" "),r("option",{attrs:{value:"RN"}},[t._v("Rio Grande do Norte")]),t._v(" "),r("option",{attrs:{value:"RS"}},[t._v("Rio Grande do Sul")]),t._v(" "),r("option",{attrs:{value:"RO"}},[t._v("Rondônia")]),t._v(" "),r("option",{attrs:{value:"RR"}},[t._v("Roraima")]),t._v(" "),r("option",{attrs:{value:"SC"}},[t._v("Santa Catarina")]),t._v(" "),r("option",{attrs:{value:"SP"}},[t._v("São Paulo")]),t._v(" "),r("option",{attrs:{value:"SE"}},[t._v("Sergipe")]),t._v(" "),r("option",{attrs:{value:"TO"}},[t._v("Tocantins")])])])])]),t._v(" "),r("l-map",{staticStyle:{height:"200px"},attrs:{zoom:16,center:[t.props.value.lat||0,t.props.value.lng||0]}},[r("l-tile-layer",{attrs:{url:"http://{s}.tile.osm.org/{z}/{x}/{y}.png"}}),t._v(" "),r("l-marker",{attrs:{"lat-lng":[t.props.value.lat||0,t.props.value.lng||0],draggable:!0},on:{moveend:function(e){return t.getAddressByLatLng(e)}}})],1)],1)}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-prepend"},[e("div",{staticClass:"input-group-text border-0",staticStyle:{width:"100px"}},[this._v("\r\n                    CEP\r\n                ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-prepend"},[e("div",{staticClass:"input-group-text border-0",staticStyle:{width:"100px"}},[this._v("\r\n                    Endereço\r\n                ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-prepend"},[e("div",{staticClass:"input-group-text border-0",staticStyle:{width:"100px"}},[this._v("\r\n                    Número\r\n                ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-prepend"},[e("div",{staticClass:"input-group-text border-0",staticStyle:{width:"100px"}},[this._v("\r\n                    Comp.\r\n                ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-prepend"},[e("div",{staticClass:"input-group-text border-0",staticStyle:{width:"100px"}},[this._v("\r\n                    Cidade\r\n                ")])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"input-group-prepend"},[e("div",{staticClass:"input-group-text border-0",staticStyle:{width:"100px"}},[this._v("\r\n                    Estado\r\n                ")])])}],!1,null,null,null);e.default=component.exports},407:function(t,e,r){"use strict";r.r(e);var o={props:{value:{default:!1},tag:{default:"div"}},watch:{$props:{deep:!0,handler:function(t){this.props=Object.assign({},t)}}},methods:{emit:function(){this.$emit("input",this.props.value),this.$emit("value",this.props.value),this.$emit("change",this.props.value)},toggle:function(){this.props.value=!this.props.value}},data:function(){return{props:Object.assign({},this.$props)}}},n=(r(381),r(7)),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("transition",{attrs:{name:"custom-unique-name","enter-active-class":"animate__animated animate__fadeIn","leave-active-class":"animate__animated animate__fadeOut"}},[t.props.value?r("div",{staticClass:"ui-modal",staticStyle:{"animation-duration":"300ms"},on:{click:function(e){if(e.target!==e.currentTarget)return null;t.props.value=!1,t.emit()}}},[r(t.tag,{tag:"component",on:{submit:function(e){return e.preventDefault(),t.$emit("submit",e)}}},[r("div",{staticClass:"card"},[t.$slots.header?r("div",{staticClass:"card-header"},[t._t("header")],2):t._e(),t._v(" "),r("div",{staticClass:"card-body"},[t._t("body")],2),t._v(" "),r("div",{staticClass:"card-footer text-right"},[r("button",{staticClass:"btn pull-left",attrs:{type:"button"},on:{click:function(e){t.props.value=!1,t.emit()}}},[t._v("\r\n                            Ok\r\n                        ")]),t._v(" "),t._t("footer")],2)])])],1):t._e()])],1)}),[],!1,null,null,null);e.default=component.exports},419:function(t,e,r){"use strict";r.r(e);var o={layout:"admin",middleware:"auth",computed:{},methods:{userSave:function(){this.$axios.post("/api/auth/save-me/",this.user).then((function(t){location.reload()}))}},data:function(){return{user:{},addresses:{}}},mounted:function(){var t=this;this.$store.watch((function(e){t.user=Object.assign({},e.auth.user),t.$refs.userAddresses.list()}),(function(){}),{deep:!0})}},n=r(7),component=Object(n.a)(o,(function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",[r("form",{on:{submit:function(e){return e.preventDefault(),t.userSave()}}},[r("fieldset",[r("legend",[t._v("Meus dados")]),t._v(" "),r("ui-field",{attrs:{type:"photo",label:"Foto",placeholder:"Foto"},scopedSlots:t._u([{key:"field",fn:function(){return[r("ui-photo",{model:{value:t.user.photo,callback:function(e){t.$set(t.user,"photo",e)},expression:"user.photo"}})]},proxy:!0}])}),t._v(" "),r("ui-field",{attrs:{type:"text",label:"Nome",placeholder:"Seu nome"},model:{value:t.user.name,callback:function(e){t.$set(t.user,"name",e)},expression:"user.name"}}),t._v(" "),r("ui-field",{attrs:{type:"email",label:"Email",placeholder:"nome@grr.la"},model:{value:t.user.email,callback:function(e){t.$set(t.user,"email",e)},expression:"user.email"}}),t._v(" "),r("ui-field",{attrs:{type:"text",label:"Aniversário",placeholder:"31/12/1989"},scopedSlots:t._u([{key:"field",fn:function(){return[r("ui-datetime",{attrs:{time:!1},model:{value:t.user.birth,callback:function(e){t.$set(t.user,"birth",e)},expression:"user.birth"}})]},proxy:!0}]),model:{value:t.user.birth,callback:function(e){t.$set(t.user,"birth",e)},expression:"user.birth"}}),t._v(" "),r("ui-field",{attrs:{type:"password",label:"Senha",placeholder:"123456"},scopedSlots:t._u([{key:"hint",fn:function(){return[t._v("Sua senha será alterada caso você preencha estes campos.")]},proxy:!0},{key:"field",fn:function(){return[r("div",{staticClass:"row"},[r("div",{staticClass:"col-6"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.user.password,expression:"user.password"}],staticClass:"form-control",attrs:{type:"password",placeholder:"Senha"},domProps:{value:t.user.password},on:{input:function(e){e.target.composing||t.$set(t.user,"password",e.target.value)}}}),t._v(" "),r("ui-password-meter",{staticClass:"mt-1",model:{value:t.user.password,callback:function(e){t.$set(t.user,"password",e)},expression:"user.password"}})],1),t._v(" "),r("div",{staticClass:"col-6"},[r("input",{directives:[{name:"model",rawName:"v-model",value:t.user.password2,expression:"user.password2"}],staticClass:"form-control",attrs:{type:"password",placeholder:"Repita a senha"},domProps:{value:t.user.password2},on:{input:function(e){e.target.composing||t.$set(t.user,"password2",e.target.value)}}})])])]},proxy:!0}])}),t._v(" "),t._m(0)],1)]),t._v(" "),r("hr"),t._v(" "),r("fieldset",[r("legend",[t._v("Meus endereços")]),t._v(" "),r("ui-addresses",{ref:"userAddresses",attrs:{reference:"users","ref-id":t.$store.state.auth.user.id,"load-on-start":!1}})],1)])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"text-right"},[e("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[e("i",{staticClass:"fa fa-fw fa-save"}),this._v(" Salvar\r\n                ")])])}],!1,null,null,null);e.default=component.exports;installComponents(component,{UiPhoto:r(400).default,UiField:r(401).default,UiDatetime:r(236).default,UiPasswordMeter:r(235).default,UiAddresses:r(402).default})}}]);