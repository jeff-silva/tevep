import{_ as p,q as V,r as i,o as h,c as f,a as e,w as t,d,b as w,t as r}from"./entry-c6c6a655.mjs";import{_ as b}from"./crud-49fc240a.mjs";import"./actions-b79a095e.mjs";const I={props:{modelValue:{default:""},label:{default:""},language:{default:"html"},theme:{default:"vs-dark"},disabled:{default:!1}},watch:{"$props.modelValue":{handler(o){this.monacoInit().getModel().setValue(o),this.$emit("update:modelValue",o)}}},data(){return{monacoId:!1,monacoEditor:!1}},methods:{monacoInit(){if(window.monacoInstances=window.monacoInstances||{},this.monacoId)return window.monacoInstances[this.monacoId];let o=V.create(this.$refs.monacoRef,{value:this.modelValue,language:this.language,theme:this.theme,readOnly:this.disabled,autoIndent:!0,automaticLayout:!0});return o.getModel().onDidChangeContent(c=>{this.$emit("update:modelValue",o.getValue())}),this.monacoId="monaco-"+Math.round(Math.random()*9999),window.monacoInstances[this.monacoId]=o,o},resizeHandler(){let o=this.monacoInit();!o||o.layout({width:0})}},mounted(){this.monacoInit(),window.addEventListener("resize",this.resizeHandler)},unmounted(){window.removeEventListener("resize",this.resizeHandler),delete window.monacoInstances[this.monacoId]}},x={class:"app-code"},$={ref:"monacoRef",style:{"min-height":"300px"}};function E(o,c,m,n,u,_){const s=i("v-input");return h(),f("div",x,[e(s,{label:m.label,"hide-details":!0},{default:t(()=>[d("div",$,null,512)]),_:1},8,["label"])])}var y=p(I,[["render",E]]);const U={},z=d("th",null,"P\xE1gina",-1),C=d("th",null,"Tipo",-1),M={class:"font-weight-bold"},k={class:"font-weight-thin"};function B(o,c){const m=i("v-text-field"),n=i("v-col"),u=y,_=i("v-input"),s=i("v-row"),v=b,g=w;return h(),f("div",null,[e(g,{name:"admin"},{default:t(()=>[e(v,{namespace:"pages-elements",singular:"Elementos de p\xE1gina",plural:"Elementos de p\xE1ginas"},{"search-table-header":t(()=>[z,C]),"search-table-item":t(({item:a})=>[d("td",null,[d("div",M,r(a.name),1),d("div",k,"/"+r(a.slug),1)]),d("td",null,r(a.type),1)]),"edit-fields":t(a=>[e(s,null,{default:t(()=>[e(n,{cols:"12",md:"8"},{default:t(()=>[e(m,{label:"Nome",modelValue:a.edit.name,"onUpdate:modelValue":l=>a.edit.name=l,"hide-details":!0},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1024),e(n,{cols:"12",md:"4"},{default:t(()=>[e(m,{label:"Tipo",modelValue:a.edit.type,"onUpdate:modelValue":l=>a.edit.type=l,"hide-details":!0},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1024),e(n,{cols:"12"},{default:t(()=>[e(s,null,{default:t(()=>[e(n,{cols:"12",md:"8"},{default:t(()=>[e(u,{label:"Componente",modelValue:a.edit.comp,"onUpdate:modelValue":l=>a.edit.comp=l,language:"javascript"},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1024),e(n,{cols:"12",md:"4"},{default:t(()=>[e(_,{label:"Preview"})]),_:1})]),_:2},1024)]),_:2},1024),e(n,{cols:"12"},{default:t(()=>[e(s,null,{default:t(()=>[e(n,{cols:"12",md:"8"},{default:t(()=>[e(u,{label:"Editor",modelValue:a.edit.edit,"onUpdate:modelValue":l=>a.edit.edit=l,language:"javascript"},null,8,["modelValue","onUpdate:modelValue"])]),_:2},1024),e(n,{cols:"12",md:"4"},{default:t(()=>[e(_,{label:"Preview"})]),_:1})]),_:2},1024)]),_:2},1024)]),_:2},1024)]),_:1})]),_:1})])}var P=p(U,[["render",B]]);export{P as default};
