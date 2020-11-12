<template><div class="user-card bg-white shadow-sm rounded">
	<div class="user-card-bg" :style="`background-image:url(${props.value.meta.background});`" v-if="props.value.meta.background"></div>
	<div class="user-card-bg user-card-pattern" v-else></div>
	<div class="user-card-image shadow-sm" :style="`background-image:url(${props.value.meta.photo});`">
		<slot name="image"></slot>
	</div>
	<div class="user-card-content">
		<div>
			<div class="text-center font-weight-bold text-uppercase mt-2">
				<nuxt-link to="">{{ props.value.name }}</nuxt-link>
			</div>
			<div class="text-center text-muted">{{ props.value.meta.description }}</div>
			<div class="text-center text-muted">{{ props.value.email }}</div>
			<div class="pb-4"></div>
		</div>
	</div>
	<div class="btn-group user-card-actions">
		<slot name="actions"></slot>
	</div>
</div></template>

<style>
.user-card {}
.user-card-content {height:90px; display:flex; align-items:center; justify-content:center;}
.user-card-actions {display:flex;}
.user-card-actions .btn {margin:0px;}
.user-card-image {
	background: center center no-repeat #f5f5f5;
	background-size: cover;
	width: 100px;
	height: 100px;
	margin: -50px auto 0px auto;
	border-radius: 50%;
	border: solid 4px #fff;
	overflow: hidden;
	display: flex;
	align-items: center;
	justify-content: center;
}

.user-card-bg {
	background-size: cover;
	background-position: center center;
	background-repeat: no-repeat;
	height: 200px;
}

.user-card-pattern {
	--stripe: #f5f5f5;
	--bg: #eee;

	background: linear-gradient(135deg, var(--bg) 25%, transparent 25%) -50px 0,
	linear-gradient(225deg, var(--bg) 25%, transparent 25%) -50px 0,
	linear-gradient(315deg, var(--bg) 25%, transparent 25%),
	linear-gradient(45deg, var(--bg) 25%, transparent 25%);
	background-size: 100px 100px;
	background-color: var(--stripe);
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
