<template><div>
    <div class="row no-gutters">
        <div class="col-4 pr-3">
            <div class="bg-white shadow-sm p-4 mb-3"></div>
            <div class="bg-white shadow-sm p-4 mb-3"></div>
            <div class="bg-white shadow-sm p-4 mb-3"></div>
            <div class="bg-white shadow-sm p-4 mb-3"></div>
            <div class="bg-white shadow-sm p-4 mb-3"></div>
            <div class="bg-white shadow-sm p-4 mb-3"></div>
        </div>

        <div class="col-8">
            <basico></basico>
        </div>
    </div>
</div></template>

<script>
export default {
    components: {
        basico: require('./basico.vue').default,
    },

    computed: {
        model() {
            return this.$store.state.tevep2.model;
        },
    },
}
</script>