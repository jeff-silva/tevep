import{_ as d,M as _,o as i,i as v,w as b,u as p,b as f,d as e,N as h,O as x,P as g,t as a,c,e as y,F as w}from"./entry-c6c6a655.mjs";const B={async setup(m,{expose:r}){r();let t,s;const o=([t,s]=_(()=>p({url:"https://randomuser.me/api/",params:{results:5}})),t=await t,s(),t);o.value.submit();const u=([t,s]=_(()=>p({url:"/api/pages/search",params:{}})),t=await t,s(),t);u.value.submit();const l={users:o,pages:u};return Object.defineProperty(l,"__isScriptSetup",{enumerable:!1,value:!0}),l}},k=e("h1",null,"Axios: Random users",-1),C=e("hr",null,null,-1),A={class:"input-group"},S={class:"input-group-btn"},D=e("hr",null,null,-1),F=e("hr",null,null,-1);function K(m,r,t,s,o,u){const l=f;return i(),v(l,{name:"test"},{default:b(()=>[k,C,e("div",A,[h(e("input",{type:"number",class:"form-control","onUpdate:modelValue":r[0]||(r[0]=n=>s.users.params.results=n),onKeyup:r[1]||(r[1]=g(n=>s.users.submit(),["enter"]))},null,544),[[x,s.users.params.results]]),e("div",S,[e("button",{type:"button",class:"btn btn-primary",onClick:r[2]||(r[2]=n=>s.users.submit())},a(s.users.loading?"Carregando":"Buscar"),1)])]),D,e("div",null,[(i(!0),c(w,null,y(s.users.resp&&s.users.resp.results,n=>(i(),c("div",null,[e("div",null,a(n.name.title)+" "+a(n.name.first)+" "+a(n.name.last),1),e("div",null,a(n.email)+" | "+a(n.cell),1),F]))),256))]),e("pre",null,"pages: "+a(s.pages),1)]),_:1})}var N=d(B,[["render",K]]);export{N as default};
