<template><div>
	<flat-pickr class="form-control"
		v-model="props.value"
		@on-close="emit();"
		:config="compConfig"
		:placeholder="placeholder"
	></flat-pickr>

	<div style="display:none;"><div ref="footer"><div>
		<div class="row no-gutters">
			<div class="col-6"><button type="button" class="btn btn-link btn-sm btn-block" @click="calendarClear()">Cancelar</button></div>
			<div class="col-6"><button type="button" class="btn btn-link btn-sm btn-block" @click="calendarOk()">Ok</button></div>
		</div>
		<slot name="footer"></slot>
	</div></div></div>
</div></template>

<script>
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import lang from 'flatpickr/dist/l10n/pt.js';

export default {
	components: {flatPickr},

	props: {
		value: {default: ()=>({})},
		config: {default: ()=>({})},
		date: {default: true},
		time: {default: true},
		placeholder: {default: ''},
	},

	watch: {
		$props: {deep:true, handler(val, old) {
            this.props = Object.assign({}, val);
        }},
	},

	methods: {
		emit() {
			setTimeout(() => {
				this.$emit('input', this.props.value);
				this.$emit('value', this.props.value);
				this.$emit('change', this.props.value);
			}, 100);
		},

		calendarClear() {
			if (!this.flatpickr) return;
			this.props.value = '';
			this.emit();
			this.flatpickr.close();
		},
		
		calendarOk() {
			if (!this.flatpickr) return;
			this.flatpickr.close();
		},
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
			flatpickr: false,
		};
	},

	computed: {
		compConfig() {
			let data = Object.assign({
				locale: lang.pt,
			}, this.config);

			data.altInput = true;
			data.altInputClass = 'form-control';

			if (this.date && !this.time) {
				data.dateFormat = 'Y-m-d H:i:S';
				data.altFormat = 'd/m/Y';
			}

			else if (!this.date && this.time) {
				data.dateFormat = 'H:i:S';
				data.altFormat = 'H:i:S';
				data.time_24hr = true;
				data.enableTime = true;
				data.noCalendar = true;
			}

			else {
				data.dateFormat = 'Y-m-d H:i:S';
				data.altFormat = 'd/m/Y H:i:S';
				data.time_24hr = true;
				data.enableTime = true;
			}

			data.onOpen = [(dates, dateStr, fp) => {
				this.flatpickr = fp;

				let footer = document.createElement('div');
				footer.appendChild(this.$refs.footer);
				fp.calendarContainer.appendChild(footer);
			}];

			return data;
		},
	},
}
</script>


<style>
.flatpickr-calendar * {
	-webkit-user-select: none;
	-moz-user-select: none;
	-ms-user-select: none;
	user-select: none;
}
</style>