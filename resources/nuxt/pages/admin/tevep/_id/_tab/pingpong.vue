<template><div>
    Pingpong
    <pre>{{ $data }}</pre>
</div></template>

<script>
export default {
    watch: {
        model: {deep:true, handler(value) {
            this.$store.commit('tevep2/setModel', value);
        }},
    },

    data() {
        return {
            model: JSON.parse(JSON.stringify(this.$store.state.tevep2.model)),
        };
    },
}
</script>