(window.webpackJsonp=window.webpackJsonp||[]).push([[9],{554:function(e,t,o){"use strict";o.r(t);var r={props:{value:[Boolean,Object],method:{default:"get"},action:{default:""},mountedSubmit:{default:!1,type:Boolean}},data:function(){return{loading:!1,response:!1,error:!1,errorFields:{}}},methods:{submit:function(){var e=this;this.loading=!0,this.error=!1,this.errorFields={},("post"==this.method?this.$axios.post(this.action,this.value):this.$axios.get(this.action,{params:this.value})).then((function(t){e.loading=!1,e.response=t.data,e.$emit("success",t.data)})).catch((function(t){e.loading=!1,e.error=t.response.data.message,e.errorFields=t.response.data.fields,e.$emit("error",t.response.data)}))}},mounted:function(){this.mountedSubmit&&this.submit()}},n=o(19),component=Object(n.a)(r,(function(){var e=this,t=e.$createElement;return(e._self._c||t)("form",{attrs:{action:""},on:{submit:function(t){return t.preventDefault(),e.submit()}}},[e._t("default",null,{loading:e.loading,response:e.response,error:e.error,errorFields:e.errorFields})],2)}),[],!1,null,null,null);t.default=component.exports}}]);