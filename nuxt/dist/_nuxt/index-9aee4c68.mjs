import{_ as x,u as v,r as o,o as l,c as s,a as n,w as r,b,d as t,F as w,e as V,t as a}from"./entry-c6c6a655.mjs";const g={data(){return{filter:"",endpoints:v({method:"get",url:"/api/app/endpoints",submit:!0})}},computed:{endpointsResp(){return(this.endpoints.resp||[]).filter(i=>JSON.stringify(i).toLowerCase().includes(this.filter.toLowerCase()))}}},y=t("thead",null,[t("tr",null,[t("th",{width:"40px"}),t("th",{width:"100px"},"Method"),t("th",null,"Route")])],-1);function C(i,u,B,F,d,p){const _=o("v-text-field"),c=o("v-table"),m=o("v-container"),f=b;return l(),s("div",null,[n(f,{name:"admin"},{default:r(()=>[n(m,null,{default:r(()=>[n(_,{label:"Filtrar endpoints",modelValue:d.filter,"onUpdate:modelValue":u[0]||(u[0]=e=>d.filter=e),"hide-details":!0},null,8,["modelValue"]),n(c,null,{default:r(()=>[y,t("tbody",null,[(l(!0),s(w,null,V(p.endpointsResp,(e,h)=>(l(),s("tr",null,[t("td",null,a(h),1),t("td",null,a(e.methods.join(", ")),1),t("td",null,a(e.uri),1)]))),256))])]),_:1})]),_:1})]),_:1})])}var N=x(g,[["render",C]]);export{N as default};
