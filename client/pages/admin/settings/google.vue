<template>
    <div>
        <ui-field label="Analytics ID">
            <input type="text" class="form-control" v-model="value['google.analytics.id']">
            <template #info>Acesse o analytics e então vá em Fluxos de dados > seu site. O ID da métrica estará no canto superior direito.</template>
        </ui-field>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Google",
        };
    },

    props: {
        value: {default:()=>({})},
    },

    watch: {
        props: {deep:true, handler(value) {
            for(let i in value) this.$emit(i, value[i]);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>