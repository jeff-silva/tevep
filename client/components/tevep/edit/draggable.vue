<template>
    <div class="d-flex" :class="{'flex-column':(layout=='vertical')}">
        <draggable v-model="props.value" handle=".draggable" :class="{'d-flex':(layout=='horizontal')}">
            <div v-for="v in props.value" class="p-1" :class="{'flex-grow-1':(layout=='horizontal')}" :style="`${layout=='horizontal'? 'max-width:300px;': ''}`">
                <div class="input-group">
                    <div class="input-group-text draggable">
                        <i class="fas fa-fw fa-bars"></i>
                    </div>
                    <slot :item="v"></slot>
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-danger rounded-0" @click="remove(v)">
                            <i class="fas fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </draggable>
        
        <div class="p-1" v-if="props.value.length<max">
            <button type="button" class="btn btn-light w-100 rounded-0" @click="add()">
                <i class="fas fa-fw fa-plus"></i>
            </button>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    components: {
        draggable,
    },

    props: {
        value: {default:()=>([]), type:Array},
        layout: {default: "horizontal"},
        max: {default: 7},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            // tevep: this.$store.state.tevep.edit,
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        uuid() {
            return ([1e7] + -1e3 + -4e3 + -8e3).replace(/[018]/g, c => (c ^ (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4))) ).toString(16));
        },

        add() {
            this.props.value.push({
                id: this.uuid(),
                tevep_id: false,
            });
        },

        remove(item) {
            let index = this.props.value.indexOf(item);
            this.props.value.splice(index, 1);
        },
    },
}
</script>