<template><div>
    <button type="button" class="btn btn-outline-primary btn-block mb-2" @click="listAdd()">
        Inserir {{ singular }}
    </button>

    <div class="text-center text-muted mb-2" v-if="props.value.length==0">
        Nenhum(a) {{ singular }}
    </div>

    <draggable v-model="props.value" v-bind="{animation:200, handle:'._handle'}" @end="emit()">
        <div v-for="n in props.value" :key="n.id" class="mb-1">
            <div class="input-group">
                <div class="input-group-prepend _handle"><div class="input-group-text">
                    <i class="fas fa-bars"></i>
                </div></div>

                <slot name="fields" :item="n"></slot>
                <input type="text" class="form-control" v-model="n.name" :placeholder="singular">
                <slot name="fields-after" :item="n"></slot>

                <div class="input-group-append"><div class="input-group-btn">
                    <button type="button" class="btn btn-danger" @click="listRemove(n)">
                        <i class="fas fa-times"></i>	
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
        defaultValue: {default:()=>({name:""})},
        headers: {default:()=>([{id:"medida", name:"Medida"}])},
        singular: {default:'Item'},
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
            let add = Object.assign({
                id: this.uuid(),
                name: '',
            }, this.defaultValue);

            this.props.value.push(add);
            this.emit();
        },
        
        listRemove(item) {
            let index = this.props.value.indexOf(item);
            this.props.value.splice(index, 1);
        },
	},

	data() {
		return {
			props: Object.assign({}, this.$props),
			dropdown: false,
		};
	},
};</script>