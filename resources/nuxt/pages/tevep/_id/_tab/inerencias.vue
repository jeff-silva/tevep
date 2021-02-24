<template><div>
    <div class="d-flex">
        <div style="width:400px;">
            Inerências
        </div>
        <div class="flex-grow-1"><principios v-bind="$props"></principios></div>
    </div>
</div></template>

<script>
import Principios from '@/pages/tevep/_id/_tab/principios';

export default {
    components: { Principios },

    props: {
        node: {default:()=>({})},
    },
}
</script>