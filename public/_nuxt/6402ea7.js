(window.webpackJsonp=window.webpackJsonp||[]).push([[22],{595:function(e,t,r){"use strict";r.r(t);r(61),r(25),r(75),r(29),r(192);var n={props:{value:{default:!1,type:[Boolean,Object]},folder:{default:""},preview:{default:!0},previewHeight:{default:"200px"}},watch:{$props:{deep:!0,handler:function(e){this.__preventRecursive||(this.props=JSON.parse(JSON.stringify(e)))}},props:{deep:!0,handler:function(e){var t=this;for(var i in this.__preventRecursive=!0,this.$emit("input",e.value||!1),e)this.$emit("update:".concat(i),e[i]);setTimeout((function(){t.__preventRecursive=!1}),10)}}},data:function(){return{props:JSON.parse(JSON.stringify(this.$props))}},methods:{fileBrowser:function(){var e=this;Object.assign(document.createElement("input"),{type:"file",onchange:function(t){e.fileGet(t.target.files[0])}}).click()},fileGet:function(e){var t=this,r=new FileReader;r.readAsDataURL(e),r.onload=function(){t.props.value={name:e.name.replace(/(.+)\.[a-zA-Z0-9]{2,}$/g,"$1"),folder:t.props.folder,size:e.size,mime:e.type,type:e.type.split("/").shift(),ext:e.name.split(".").pop(),content:r.result},t.$emit("input",t.props.value),t.$emit("file-get",e)}},fileClear:function(){this.props.value=!1,this.$emit("file-clear",!1)}}},l=n,o=r(11),component=Object(o.a)(l,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"ui-file",on:{dragover:function(e){e.preventDefault()},drop:function(t){return t.preventDefault(),e.fileGet(t.dataTransfer.files[0])}}},[r("div",{staticClass:"d-flex align-items-center"},[e.props.value?e._e():r("div",{staticClass:"flex-grow-1"},[r("button",{staticClass:"btn btn-light w-100",attrs:{type:"button"},on:{click:function(t){return e.fileBrowser()}}},[e.props.value?r("div",[e._v(e._s(e.props.value.name))]):r("div",[e._v("Browse")])])]),e._v(" "),e.props.value?r("div",{staticClass:"flex-grow-1"},[r("input",{directives:[{name:"model",rawName:"v-model",value:e.props.value.name,expression:"props.value.name"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:e.props.value.name},on:{input:function(t){t.target.composing||e.$set(e.props.value,"name",t.target.value)}}})]):e._e(),e._v(" "),e.props.value?r("div",{staticClass:"ms-2"},[r("button",{staticClass:"btn btn-light w-100",attrs:{type:"button"},on:{click:function(t){return e.fileClear()}}},[r("i",{staticClass:"fas fa-fw fa-times"})])]):e._e(),e._v(" "),e._t("actions")],2),e._v(" "),e.props.preview?r("div",{staticClass:"bg-light mt-2 d-flex align-items-center justify-content-center",style:"height:calc("+e.previewHeight+" + 30px);"},[e._t("preview",(function(){return[e.props.value&&e.props.value.type.includes("image")?r("div",[r("img",{style:"height:"+e.previewHeight+"; max-width:300px; object-fit:cover;",attrs:{src:e.props.value.content,alt:""}}),e._v(" "),r("small",{staticClass:"d-block text-center"},[e._v(e._s(e._f("fileSize")(e.props.value.size)))])]):e.props.value?r("div",[r("div",{staticStyle:{"font-size":"40px","line-height":"35px","text-transform":"uppercase"}},[e._v(e._s(e.props.value.ext))]),e._v(" "),r("small",{staticClass:"d-block text-center"},[e._v(e._s(e._f("fileSize")(e.props.value.size)))])]):r("div",[e._v("Arraste o arquivo aqui")])]}),{value:e.props.value,previewHeight:e.previewHeight})],2):e._e()])}),[],!1,null,null,null);t.default=component.exports}}]);