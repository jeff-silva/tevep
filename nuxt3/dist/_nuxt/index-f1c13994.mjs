import{_ as f,A as $,r,o as i,c as d,d as l,a as t,k as m,j as w,u as T,w as s,b as k,t as p}from"./entry-c6c6a655.mjs";const z={props:{modelValue:{type:Object},loading:{default:!1,type:Boolean}},watch:{modelValue:{deep:!0,handler(e){let o=this.apexData(e);!this.apexCharts||this.apexCharts.updateOptions(o)}}},mounted(){this.apexInit()},methods:{apexInit(){setTimeout(()=>{let e=this.apexData(this.modelValue);this.apexCharts=new $(this.$refs.apexRef,e),this.apexCharts.render()},50)},apexData(e){return e=JSON.parse(JSON.stringify(e)),e.chart=e.chart||{},e.chart.width=this.$el.offsetWidth,e.chart.height=this.$el.offsetHeight,e}},data(){return{apexCharts:!1}}},A={style:{position:"relative",height:"300px"}},F={ref:"apexRef"},N={key:0,style:{position:"absolute",top:"0",left:"0",width:"100%",height:"100%",background:"#ffffffaa",display:"flex","align-items":"center","justify-content":"center"}};function S(e,o,n,v,a,c){const u=r("v-progress-circular");return i(),d("div",A,[l("div",F,null,512),n.loading?(i(),d("div",N,[t(u,{indeterminate:""})])):m("",!0)])}var B=f(z,[["render",S]]);const O={mounted(){w().setTitle("Dashboard")},computed:{filesFormats(){let e=(this.dashboard.resp.filesFormats||[]).map(n=>n.ext),o=(this.dashboard.resp.filesFormats||[]).map(n=>parseInt(n.total));return{labels:e,series:o,chart:{type:"donut"}}}},data(){return{dashboard:T({method:"get",url:"/api/app/dashboard",resp:{},submit:!0})}}},j={key:0,class:"mt-4 text-center"},H=l("th",null,"Usu\xE1rios cadastrados",-1);function I(e,o,n,v,a,c){const u=B,_=r("v-card"),h=r("v-col"),x=r("v-table"),b=r("v-card-text"),g=r("v-row"),y=r("v-container"),C=k;return i(),d("div",null,[t(C,{name:"admin"},{default:s(()=>[t(y,null,{default:s(()=>[t(g,null,{default:s(()=>[t(h,{cols:"12",md:"6"},{default:s(()=>[t(_,{title:`Arquivos enviados - ${e.$filters.filesizeHuman(a.dashboard.resp?a.dashboard.resp.filesTotalSize:0)}`},{text:s(()=>[t(u,{modelValue:c.filesFormats,"onUpdate:modelValue":o[0]||(o[0]=V=>c.filesFormats=V),loading:a.dashboard.loading},null,8,["modelValue","loading"]),a.dashboard.resp.filesTotal?(i(),d("div",j,p(a.dashboard.resp.filesTotal)+" arquivos totalizando "+p(e.$filters.filesizeHuman(a.dashboard.resp.filesTotalSize)),1)):m("",!0)]),_:1},8,["title"])]),_:1}),t(h,{cols:"12",md:"6"},{default:s(()=>[t(_,{title:"Usu\xE1rios"},{default:s(()=>[t(b,null,{default:s(()=>[t(x,null,{default:s(()=>[l("tbody",null,[l("tr",null,[H,l("td",null,p(a.dashboard.resp.usersTotal),1)])])]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})]),_:1})])}var q=f(O,[["render",I]]);export{q as default};