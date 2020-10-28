<template><div>
	<datetime v-model="props.value"
		type="datetime"
		input-class="form-control"
		:minute-step="5"
		@input="$emit('input', props.value)"
	></datetime>
</div></template>

<script>
import Vue from 'vue'
import { Datetime } from 'vue-datetime'
import 'vue-datetime/dist/vue-datetime.css'
Vue.use(Datetime);

export default {
	components: {Datetime},

	props: {
		value: {default: ''},
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
		};
	},
	
	watch: {
		$props: {deep:true, handler(val, old) {
			this.props = Object.assign({}, val);
        }},
	},
}
</script>