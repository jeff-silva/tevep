<template><div>
	<el-select v-model="props.value" :multiple="props.multiple"
		@change="emitValue()" class="form-control p-0"
		filterable remote :placeholder="props.placeholder"
		reserve-keyword :remote-method="remoteSearch"
	>
		<el-option :value="i.id" :label="i.name||i.id" v-for="i in items" :key="i.id">{{ i.name||i.id }}</el-option>
	</el-select>
</div></template>

<script>
export default {
	name: "ui-user",
	
	props: {
		value: {default:"", type:[Number, String, Array]},
		placeholder: {default:'Selecionar'},
		multiple: {default:false},
	},
	
	watch: {
		$props: {deep:true, handler(value) {
			this.props = JSON.parse(JSON.stringify(value));
			this.remoteSearch('', this.props.value);
		}},
	},
	
	methods: {
		emitValue() {
			this.$emit('input', this.props.value);
			this.$emit('change', this.props.value);
		},
		
		remoteSearch(q='', id=null) {
			this.$axios.get('/api/user/search', {params:{q, id}}).then(resp => {
				this.items = resp.data.data;
			});
		},
	},
	
	data() {
		return {
			props: JSON.parse(JSON.stringify(this.$props)),
			items: [],
		};
	},
}
</script>