<template><div class="user-card bg-white shadow-sm rounded">
	<div :style="`background:url(${props.value.background}) center center no-repeat; background-size:cover; height:200px;`"></div>
	<div class="user-card-image shadow-sm" :style="`background-image:url(${props.value.photo});`">
		<slot name="image"></slot>
	</div>
	<div class="text-center font-weight-bold text-uppercase mt-2">
		<nuxt-link to="">{{ props.value.name }}</nuxt-link>
	</div>
	<div class="text-center">{{ props.value.email }}</div>
	<div class="pb-4"></div>

	<div class="btn-group user-card-actions">
		<slot name="actions"></slot>
	</div>
</div></template>

<style>
.user-card-actions {display:flex;}
.user-card-actions .btn {margin:0px;}
.user-card-image {
	background: center center no-repeat #f5f5f5;
	background-size: cover;
	width: 100px;
	height: 100px;
	margin: -50px auto 0 auto;
	border-radius: 50%;
	border: solid 4px #fff;
	overflow: hidden;
	display: flex;
	align-items: center;
	justify-content: center;
}
</style>

<script>
export default {
	name: "user-card",

	props: {
		value: {default:() => ({})},
	},

	watch: {
		$props: {deep:true, handler(value) {
			this.props = Object.assign({}, value);
		}},
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
		};
	},
};
</script>
