import{_ as l,M as i,o as u,i as c,w as m,j as b,b as d,d as o,t as f}from"./entry-c6c6a655.mjs";const y={async setup(p,{expose:t}){t();let n,e;const a={app:([n,e]=i(()=>b()),n=await n,e(),n)};return Object.defineProperty(a,"__isScriptSetup",{enumerable:!1,value:!0}),a}},x=o("h1",null,"App",-1);function g(p,t,n,e,r,a){const s=d;return u(),c(s,{name:"test"},{default:m(()=>[x,o("button",{type:"button",class:"btn btn-primary me-1",onClick:t[0]||(t[0]=_=>e.app.login({email:"root@grr.la",password:"321321"}))}," Login "),o("button",{type:"button",class:"btn btn-primary me-1",onClick:t[1]||(t[1]=_=>e.app.logout())}," Logout "),o("pre",null,"app: "+f(e.app),1)]),_:1})}var k=l(y,[["render",g]]);export{k as default};