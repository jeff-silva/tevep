var j=Object.defineProperty;var b=Object.getOwnPropertySymbols;var U=Object.prototype.hasOwnProperty,C=Object.prototype.propertyIsEnumerable;var w=(l,e,t)=>e in l?j(l,e,{enumerable:!0,configurable:!0,writable:!0,value:t}):l[e]=t,k=(l,e)=>{for(var t in e||(e={}))U.call(e,t)&&w(l,t,e[t]);if(b)for(var t of b(e))C.call(e,t)&&w(l,t,e[t]);return l};import{_ as x,r as m,o as d,c,i as y,k as g,u as N,d as u,t as V,a as i,H as v,w as r,F as B,e as F,h as T,j as q}from"./entry-c6c6a655.mjs";const M={props:{modelValue:Object},methods:{updateModelValue(l){this.modelValue.params.page=l,this.modelValue.submit()}}};function O(l,e,t,S,s,o){const p=m("v-pagination");return d(),c("div",null,[t.modelValue.resp&&t.modelValue.resp.last_page?(d(),y(p,{key:0,length:t.modelValue.resp.last_page,"onUpdate:modelValue":o.updateModelValue},null,8,["length","onUpdate:modelValue"])):g("",!0)])}var W=x(M,[["render",O]]);const A={props:{modelValue:{default:!1,type:[Boolean,Number,String,Object]},returnType:{default:"id",type:String},label:{default:"Selecionar"},sidebarWidth:{default:"150px"},itemSize:{default:"80px"}},mounted(){this.fileFind()},data(){return{fileSelected:!1,fileSearch:N({url:"/api/files/search",params:{q:"",in_folder:"",per_page:15},submit:!0,resp:{data:[],attributes:{folders:[]}}})}},methods:{setValue(l){this.fileSelected=k({},l),this.fileSelected.url+="?"+Math.round(Math.random()*9999),this.returnType=="object"?this.$emit("update:modelValue",l):this.returnType=="id"?this.$emit("update:modelValue",l.id||!1):this.returnType=="url"&&this.$emit("update:modelValue",l.url||!1)},selectedColor(l){let e="grey-lighten-2";return this.returnType=="object"?l.id==this.modelValue.id?e:!1:this.returnType=="id"?l.id==this.modelValue?e:!1:this.returnType=="url"&&l.url==this.modelValue?e:!1},async fileFind(){if(this.returnType=="object")this.fileSelected=this.modelValue;else if(this.returnType=="id"){const l=await this.$axios.get(`/api/files/find/${this.modelValue}`);this.fileSelected=l.data||!1}else if(this.returnType=="url"){const l={url:this.modelValue},e=await this.$axios.get("/api/files/search",{params:l});this.fileSelected=e.data.data[0]||!1}}}},D={class:"elevation-2"},E={class:"d-flex font-weight-bold"},H={class:"flex-grow-1 pa-4"},I={key:0,class:"pe-1",style:{width:"300px"}},K={class:"pe-4",style:{width:"300px"}},L={class:"d-flex"},P={key:1,class:"d-flex align-center justify-center",style:{height:"150px"}},R={class:"text-uppercase"},G={class:"flex-grow-1 bg-grey-lighten-4"},J={class:"pa-2"},Q={key:0,class:"text-center py-3 text-grey"},X={class:"d-flex flex-wrap"},Y=["onClick"];function Z(l,e,t,S,s,o){const p=m("v-select"),f=m("v-text-field"),_=m("v-img"),h=m("v-avatar"),n=m("v-sheet"),z=W;return d(),c("div",D,[u("div",E,[u("div",H,V(t.label),1),s.fileSearch.resp.attributes?(d(),c("div",I,[i(p,{label:"Pasta",modelValue:s.fileSearch.params.in_folder,"onUpdate:modelValue":[e[0]||(e[0]=a=>s.fileSearch.params.in_folder=a),e[1]||(e[1]=a=>s.fileSearch.submit())],"hide-details":"",items:(s.fileSearch.resp.attributes.folders||[]).map(a=>({value:a.name||" ",title:a.name||"Raiz"}))},null,8,["modelValue","items"])])):g("",!0),u("div",K,[i(f,{label:"Filtro",modelValue:s.fileSearch.params.q,"onUpdate:modelValue":e[2]||(e[2]=a=>s.fileSearch.params.q=a),"hide-details":"",onKeyup:e[3]||(e[3]=a=>s.fileSearch.submit({debounce:1500})),"append-icon":"mdi-magnify",loading:s.fileSearch.loading},null,8,["modelValue","loading"])])]),u("div",L,[u("div",{style:v(`min-width:${t.sidebarWidth}; max-width:${t.sidebarWidth};`)},[s.fileSelected&&s.fileSelected.mime.includes("image")?(d(),y(_,{key:0,src:s.fileSelected.url,width:"100%"},null,8,["src"])):g("",!0),s.fileSelected&&!s.fileSelected.mime.includes("image")?(d(),c("div",P,[i(h,{color:"primary",size:"x-large"},{default:r(()=>[u("div",R,V(s.fileSelected.ext),1)]),_:1})])):g("",!0)],4),u("div",G,[u("div",J,[(s.fileSearch.resp.data||[]).length==0?(d(),c("div",Q," Nenhum arquivo encontrado ")):g("",!0),u("div",X,[(d(!0),c(B,null,F(s.fileSearch.resp.data,a=>(d(),c("div",{class:"ma-2",style:v(`width:${t.itemSize};`),onClick:te=>o.setValue(a)},[i(n,{class:"elevation-1 pa-2",color:o.selectedColor(a)},{default:r(()=>[(a.type="image")?(d(),y(_,{src:a.url,width:"100%",height:t.itemSize,style:{"`height":"${}"},key:a.id,class:"ma-0"},{placeholder:r(()=>[u("div",{class:"d-flex align-center justify-center",style:v(`height:calc(${t.itemSize} - 15px);`)},[i(h,{color:"primary"},{default:r(()=>[T(V(a.ext),1)]),_:2},1024)],4)]),_:2},1032,["src","height"])):(d(),c("div",{key:1,class:"d-flex align-center justify-center",style:v(`height:${t.itemSize};`)},[i(h,{color:"primary"},{default:r(()=>[T(V(a.ext),1)]),_:2},1024)],4))]),_:2},1032,["color"])],12,Y))),256))])]),i(z,{modelValue:s.fileSearch,"onUpdate:modelValue":e[4]||(e[4]=a=>s.fileSearch=a)},null,8,["modelValue"])])])])}var $=x(A,[["render",Z]]);const ee={props:{settings:Object},computed:{sets(){return this.settings}},mounted(){q().setTitle("Configura\xE7\xF5es principais")}};function le(l,e,t,S,s,o){const p=m("v-text-field"),f=m("v-col"),_=$,h=m("v-row");return d(),c("div",null,[i(h,null,{default:r(()=>[i(f,{cols:"12"},{default:r(()=>[i(p,{label:"Nome app","hide-details":!0,modelValue:o.sets["app.name"],"onUpdate:modelValue":e[0]||(e[0]=n=>o.sets["app.name"]=n)},null,8,["modelValue"])]),_:1}),i(f,{cols:"12",md:"6"},{default:r(()=>[i(p,{label:"Timezone","hide-details":!0,modelValue:o.sets["app.timezone"],"onUpdate:modelValue":e[1]||(e[1]=n=>o.sets["app.timezone"]=n)},null,8,["modelValue"])]),_:1}),i(f,{cols:"12",md:"6"},{default:r(()=>[i(p,{label:"Idioma","hide-details":!0,modelValue:o.sets["app.locale"],"onUpdate:modelValue":e[2]||(e[2]=n=>o.sets["app.locale"]=n)},null,8,["modelValue"])]),_:1}),i(f,{cols:"12"},{default:r(()=>[i(_,{label:"Selecionar \xEDcone",modelValue:o.sets["app.icon"],"onUpdate:modelValue":e[3]||(e[3]=n=>o.sets["app.icon"]=n),"return-type":"url"},null,8,["modelValue"])]),_:1}),i(f,{cols:"12"},{default:r(()=>[i(_,{label:"Selecionar logo",modelValue:o.sets["app.logo"],"onUpdate:modelValue":e[4]||(e[4]=n=>o.sets["app.logo"]=n),"return-type":"url"},null,8,["modelValue"])]),_:1})]),_:1})])}var ie=x(ee,[["render",le]]);export{ie as default};