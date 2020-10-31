<template><div>
    <h1>Meus dados</h1>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    head() {
        return {
            title: "Meus dados",
        };
    },

    data() {
        return {
            // 
        }
    },

    mounted() {
        // console.log(this.$root);
    },
}
</script>