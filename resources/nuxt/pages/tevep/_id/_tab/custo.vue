<template><div>
    <sub-component v-bind="$props">
        <template #fields="{item}">
            <div class="d-flex">
                <div class="flex-grow-1"><input type="text" class="form-control" v-model="item.title"></div>
                <div class="flex-grow-1"><ui-money v-model="item.value"></ui-money></div>
            </div>
        </template>
    </sub-component>
</div></template>

<script>
import SubComponent from '@/pages/tevep/_id/_tab/utilidades';

export default {
    components: { SubComponent },

    props: {
        node: Object,
        uuid: Function,

        singular: {default: "Custo"},
        plural: {default: "Custos"},
        field: {default: "custos"},
        itemFields: {default:()=>({title:"", value:0})},
    },
};
</script>