<template><div class="text-center">
    <code>Pingpong {{ model.title }}</code>
</div></template>

<script>
export default {
    computed: {
        model() {
            return this.$store.state.tevep2.model;
        },
    },
}
</script>