<template><div>
    xxx
</div></template>

<script>
export default {
    components: {
        // basico: require('./basico.vue').default,
        // 'pingpong': require('./pingpong.vue').default,
    },

    data() {
        return {
            pingpong: false,
            pingpongInfo: false,
        };
    },

    methods: {
        // sendPingpong(userId) {
        //     this.$axios.post(`/api/tevep/${this.$route.params.id}/pingpong/${userId}`).then(resp => {
        //         this.$parent.$parent.tevepInit(resp.data);
        //         this.pingpongInfo = false;
        //         this.$swal('Enviado', 'Ping pong enviado', 'success');
        //     });
        // },
    },
}
</script>