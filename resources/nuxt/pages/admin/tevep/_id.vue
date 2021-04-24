<template><div>
    <nuxt-child></nuxt-child>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    mounted() {
        this.$store.dispatch('tevep2/find', +this.$route.params.id);
    },
}
</script>