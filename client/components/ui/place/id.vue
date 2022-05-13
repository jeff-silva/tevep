<template>
    <div class="ui-place">
        <div class="form-control" @click="modal=true">{{ props.place.name || 'Sem endereço' }}</div>

        <ui-modal v-model="modal" width="600px">
            <template #header>Endereço</template>
            <template #body>
                <ui-place-form :place="props.place" @update:place="placeMerge(props.place, $event)"></ui-place-form>
            </template>

            <template #footer>
                <button type="button" class="btn btn-primary" @click="placeSave()">
                    Salvar
                </button>
            </template>
        </ui-modal>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:"", type:[Boolean, Number, String]},
        place: {type:Object, default:()=>({})},
    },

    data() {
        return {
            search: "",
            modal: false,
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.placeFind();
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    methods: {
        placeSave() {
            this.$axios.post('/api/places/save', this.props.place).then(resp => {
                this.props.value = resp.data.id;
                this.modal = false;
                this.placeFind();
            });
        },
        
        placeFind() {
            if (! this.props.value) return;
            this.$axios.get(`/api/places/find/${this.props.value}`).then(resp => {
                this.props.place = resp.data;
            });
        },

        placeMerge(value, merge={}) {
			for(let i in merge) {
				value[i] = merge[i];
			}
		},
    },
}
</script>