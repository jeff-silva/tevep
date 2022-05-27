import{_ as k,j as y,r as n,o as i,c as A,a as t,w as o,d as e,i as h,p as g,h as a}from"./entry-c6c6a655.mjs";const V={props:{settings:Object},computed:{sets(){return this.settings}},methods:{accountJsonParse(_){let s=_[0]||!1;if(!s)return;let d=new FileReader;d.onload=()=>{this.sets["google.account_json"]=d.result},d.readAsText(s)}},data(){return{}},mounted(){y().setTitle("Configura\xE7\xF5es de arquivo")}},j={class:"d-flex align-center"},C={class:"flex-grow-1"},N=a(" Acesso configurado. "),J={class:"ms-2"},O={class:"",style:{"max-width":"400px"}},q=e("strong",null,"Como gerar JSON",-1),B=e("br",null,null,-1),G=a(" Acesse "),P=e("a",{href:"https://console.cloud.google.com/iam-admin/serviceaccounts",target:"_blank"},"https://console.cloud.google.com/iam-admin/serviceaccounts",-1),S=a(". Crie uma "),T=e("strong",null,"conta de servi\xE7o",-1),D=a(' e depois v\xE1 na aba "chaves" dentro da conta criada, Gere uma nova chave e fa\xE7a download do arquivo JSON. '),U=e("br",null,null,-1),E=a(" Depois, basta inserir o arquivo aqui. "),F={class:"d-flex align-center"},I={class:"flex-grow-1"},L={class:"ms-2"},R={class:"",style:{"max-width":"400px"}},z=e("strong",null,"Onde encontrar o c\xF3digo do Analytics?",-1),H=e("br",null,null,-1),K=a(" ... ");function M(_,s,d,Q,W,c){const p=n("v-alert"),x=n("v-file-input"),r=n("v-btn"),u=n("v-card-text"),v=n("v-card"),m=n("v-menu"),f=n("v-col"),b=n("v-text-field"),w=n("v-row");return i(),A("div",null,[t(w,null,{default:o(()=>[t(f,{cols:"12"},{default:o(()=>[e("div",j,[e("div",C,[c.sets["google.account_json"]?(i(),h(p,{key:0,type:"success"},{default:o(()=>[N,e("a",{href:"javascript:;",class:"text-white float-end",onClick:s[0]||(s[0]=l=>c.sets["google.account_json"]="")},"Limpar")]),_:1})):(i(),h(x,{key:1,label:"Google JSON account","onUpdate:modelValue":s[1]||(s[1]=l=>c.accountJsonParse(l)),"hide-details":""}))]),e("div",J,[t(m,{anchor:"start"},{activator:o(({props:l})=>[t(r,g({flat:"",icon:"mdi-help-circle"},l),null,16)]),default:o(()=>[e("div",O,[t(v,null,{default:o(()=>[t(u,null,{default:o(()=>[q,B,G,P,S,T,D,U,E]),_:1})]),_:1})])]),_:1})])])]),_:1}),t(f,{cols:"12"},{default:o(()=>[e("div",F,[e("div",I,[t(b,{label:"Google Analytics ID (GA4)",modelValue:c.sets["google.ga4.id"],"onUpdate:modelValue":s[2]||(s[2]=l=>c.sets["google.ga4.id"]=l),"hide-details":""},null,8,["modelValue"])]),e("div",L,[t(m,{anchor:"start"},{activator:o(({props:l})=>[t(r,g({flat:"",icon:"mdi-help-circle"},l),null,16)]),default:o(()=>[e("div",R,[t(v,null,{default:o(()=>[t(u,null,{default:o(()=>[z,H,K]),_:1})]),_:1})])]),_:1})])])]),_:1})]),_:1})])}var Y=k(V,[["render",M]]);export{Y as default};
