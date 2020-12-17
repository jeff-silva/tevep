<template><div class="ui-datepicker form-control border-0 bg-transparent p-0">
	<datetime v-model="props.value"
		:type="type"
		input-class="form-control"
		:placeholder="placeholder"
		@input="$emit('input', props.value)"
		v-bind="compSettings"
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
		type: {default: 'datetime'}, // datetime|date|time
		placeholder: {default: ''},
	},

	computed: {
		compSettings() {
			let settings = {};

			if (this.type=='date') { settings.format = 'dd/MM/yyyy'; }
			else if (this.type=='time') { settings.format = 'HH:mm'; }
			else { settings.format = 'dd/MM/yyyy ~ HH:mm'; }

			return settings;
		},
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
		};
	},
	
	watch: {
		$props: {deep:true, handler(val) {
			this.props = Object.assign({}, val);
        }},
	},
}
</script>


<style>
.ui-datepicker .vdatetime-popup {user-select:none; -moz-user-select:none; -khtml-user-select:none; -webkit-user-select:none; -o-user-select:none;}
</style>