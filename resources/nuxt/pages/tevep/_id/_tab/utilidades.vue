<template><div style="max-width:600px;">
    <button type="button" class="btn btn-primary btn-block mb-2" @click="itemAdd()">
        <i class="fas fa-plus"></i> Adicionar {{ singular }}
    </button>

    <div class="bg-white p-2 text-center" v-if="node[field].length==0">
        Nenhum item de {{ singular }}
    </div>

    <draggable v-model="node[field]" v-bind="{animation:200, handle:'._handle'}" @end="draggableEnd()">
        <div class="d-flex align-items-center bg-white mt-1 p-1" v-for="i in node[field]">
            <div class="px-2 _handle"><i class="fas fa-bars"></i></div>
            <div class="flex-grow-1">
                <slot name="fields" :item="i">
                    <input type="text" class="form-control" v-model="i.title">
                </slot>
            </div>
            <div class="pl-2">
                <button type="button" class="btn btn-sm btn-danger" @click="itemRemove(i)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </draggable>
</div></template>

<script>
import draggable from 'vuedraggable';

export default {
    components: { draggable },

    props: {
        node: Object,
        uuid: Function,

        singular: {default: "Utilidade"},
        plural: {default: "Utilidades"},
        field: {default: "utilidades"},
        itemFields: {default:()=>({title:""})},
    },

    methods: {
        itemDefault(merge={}) {
            return Object.assign({id:this.uuid()}, this.itemFields, merge);
        },

        itemAdd() {
            let item = this.itemDefault();
            this.node[this.field].unshift(item);
        },

        itemRemove(item) {
            let index = this.node[this.field].indexOf(item);
            this.node[this.field].splice(index, 1);
        },

        draggableEnd() {},
    },
}
</script>