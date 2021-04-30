<template><div>
    <div class="d-flex justify-content-center">
        <div v-for="i in invites.data">
            <img src="/assets/icons/raquete-verde.png" alt="Aceito" title="Aceito" style="width:50px;" v-if="i.status=='accepted'">
            <img src="/assets/icons/raquete-vermelha.png" alt="Negado" title="Negado" style="width:50px;" v-else-if="i.status=='denied'">
            <img src="/assets/icons/raquete-amarela.png" alt="Aguardando" title="Aguardando" style="width:50px;" v-else>
        </div>
    </div>

    <!-- <pre>{{ model }}</pre> -->
    <pre>{{ invites }}</pre>
</div></template>

<script>
export default {
    computed: {
        model() {
            return this.$store.state.tevep2.model;
        },
    },

    data() {
        return {
            invites: {data:[]},
        };
    },

    methods: {
        invitesLoad() {
            if (! +this.model.id) return;

            let params = {tevep_id:this.model.id};
            this.$axios.get('/api/tevep-invite/search', {params}).then(resp => {
                this.invites = resp.data;
            });
        },
    },

    mounted() {
        this.invitesLoad();
    },
}
</script>