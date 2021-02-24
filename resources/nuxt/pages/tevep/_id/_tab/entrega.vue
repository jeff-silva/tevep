<template><div>
    <sub-component v-bind="$props"></sub-component>
</div></template>

<script>
import SubComponent from '@/pages/tevep/_id/_tab/utilidades';

export default {
    components: { SubComponent },

    props: {
        node: Object,
        uuid: Function,

        singular: {default: "Entrega"},
        plural: {default: "Entregas"},
        field: {default: "entregas"},
        itemFields: {default:()=>({title:""})},
    },
};
</script>