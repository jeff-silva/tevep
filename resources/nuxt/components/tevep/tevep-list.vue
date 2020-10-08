<template><div>
    <button type="button" class="btn btn-primary btn-block mb-2" @click="listAdd()">
        Inserir
    </button>

    <div class="text-center text-muted mb-2" v-if="props.value.length==0">
        Nenhum item	
    </div>

    <draggable v-model="props.value" v-bind="{animation:200, handle:'._handle'}" @end="emit()">
        <div v-for="n in props.value" :key="n.id" class="mb-1">
            <div class="input-group">
                <div class="input-group-prepend _handle"><div class="input-group-text">
                    <i class="fa fa-fw fa-bars"></i>
                </div></div>

                <input type="text" class="form-control" v-model="n[h.id]" v-for="h in headers">

                <div class="input-group-append"><div class="input-group-btn">
                    <button type="button" class="btn btn-danger">
                        <i class="fa fa-fw fa-remove"></i>	
                    </button>
                </div></div>
            </div>
        </div>
    </draggable>
</div></template>



<script>
import draggable from 'vuedraggable';

export default {
    components: {draggable},

	props: {
		value: {default:()=>([])},
		headers: {default:()=>([{id:"medida", name:"Medida"}])},
    },
    
    watch: {
		$props: {
			deep: true,
			handler(value) { this.props = Object.assign({}, value); },
        },
    },

	methods: {
		uuid(prefix='nodelist', format='xxxxxxxxxx') {
			return prefix+format.replace(/[xy]/g, function(c) {
				var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
				return v.toString(16);
			});
        },
        
        emit() {
            this.$emit('input', this.props.value);
        },

		listAdd() {
			let add = {id:this.uuid()};
			for(var i in this.headers) {
				let head = this.headers[i];
				add[head.id] = '';
			}

            this.props.value.push(add);
            this.emit();
		},
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
			dropdown: false,
		};
	},
};</script>