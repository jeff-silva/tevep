import{_ as d,r,o as i,c as l,a as t,d as a,w as n,h as s,b as h,L as f}from"./entry-c6c6a655.mjs";const v={props:{redirect:{default:!1,type:[Boolean,String]}}},x={action:""},b={class:"text-end"},$=s(" Login ");function g(u,p,_,o,c,L){const e=r("v-text-field"),m=r("v-btn");return i(),l("form",x,[t(e,{label:"Nome",variant:"underlined"}),t(e,{label:"E-mail",variant:"underlined"}),t(e,{label:"Senha",variant:"underlined"}),t(e,{label:"Repita senha",variant:"underlined"}),a("div",b,[t(m,{color:"primary",type:"submit"},{default:n(()=>[$]),_:1})])])}var k=d(v,[["render",g]]);const y={},B=a("h2",{class:"mb-4"},"Cadastro",-1),N=a("div",{class:"mt-2"},null,-1),w=s("Login"),C=s("Esqueci minha senha");function E(u,p){const _=k,o=f,c=h;return i(),l("div",null,[t(c,{name:"auth"},{default:n(()=>[B,t(_),N,t(o,{class:"d-block",to:"/auth"},{default:n(()=>[w]),_:1}),t(o,{class:"d-block",to:"/auth/password"},{default:n(()=>[C]),_:1})]),_:1})])}var S=d(y,[["render",E]]);export{S as default};
