<template><div>
    <basico></basico>
    <pingpong></pingpong>
</div></template>

<script>
export default {
    components: {
        basico: require('./basico.vue').default,
        pingpong: require('./pingpong.vue').default,
    },

    computed: {
        model() {
            return this.$store.state.tevep2.model;
        },
    },
}
</script>