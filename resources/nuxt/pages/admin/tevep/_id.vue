<template><div>
    <nuxt-child></nuxt-child>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    mounted() {
        this.$store.dispatch('tevep2/find', +this.$route.params.id).then(resp => {
            if (3==this.$route.path.split('/').filter(item => !!item).length) {
                this.$router.push(`/admin/tevep/${this.$route.params.id}/principios/`);
            }
        });
    },
}
</script>