import{_ as m,j as h,r as u,o as _,c,d as l,t as w,a as s,w as a,g as v,h as t,b as x,L as b}from"./entry-c6c6a655.mjs";const y={props:{redirect:{default:!1,type:[Boolean,String]}},data(){return{showPassword:!1,credentials:{email:"",password:""},app:h()}}},g={key:0},k={class:"mb-3"},V=t(" Voc\xEA est\xE1 logado como "),P={class:"fw-bold"},C=t(". "),S=t(" Prosseguir "),B=l("div",{class:"my-4"},null,-1),E=t(" Sair "),L={class:"text-end"},N=t(" Login ");function U(f,o,i,r,e,z){const d=u("v-btn"),p=u("v-text-field");return e.app.user?(_(),c("div",g,[l("div",k,[V,l("span",P,w(e.app.user.name),1),C]),s(d,{color:"primary",block:"",to:i.redirect,nuxt:!0},{default:a(()=>[S]),_:1},8,["to"]),B,s(d,{color:"white",block:"",onClick:o[0]||(o[0]=n=>e.app.logout())},{default:a(()=>[E]),_:1})])):(_(),c("form",{key:1,onSubmit:o[4]||(o[4]=v(n=>e.app.login(e.credentials),["prevent"]))},[s(p,{label:"E-mail",modelValue:e.credentials.email,"onUpdate:modelValue":o[1]||(o[1]=n=>e.credentials.email=n),variant:"underlined"},null,8,["modelValue"]),s(p,{label:"Senha",modelValue:e.credentials.password,"onUpdate:modelValue":o[2]||(o[2]=n=>e.credentials.password=n),variant:"underlined",type:e.showPassword?"text":"password","append-icon":e.showPassword?"mdi-eye":"mdi-eye-off","onClick:append":o[3]||(o[3]=n=>e.showPassword=!e.showPassword)},null,8,["modelValue","type","append-icon"]),l("div",L,[s(d,{color:"primary",type:"submit"},{default:a(()=>[N]),_:1})])],32))}var j=m(y,[["render",U]]);const q={},A=l("h2",{class:"mb-4"},"Login",-1),D=l("div",{class:"mt-2"},null,-1),M=t("Criar cadastro"),T=t("Esqueci minha senha");function $(f,o){const i=j,r=b,e=x;return _(),c("div",null,[s(e,{name:"auth"},{default:a(()=>[A,s(i,{redirect:"/admin"}),D,s(r,{class:"d-block",to:"/auth/register"},{default:a(()=>[M]),_:1}),s(r,{class:"d-block",to:"/auth/password"},{default:a(()=>[T]),_:1})]),_:1})])}var G=m(q,[["render",$]]);export{G as default};