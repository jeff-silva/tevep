<template><div>
    <div class="d-flex justify-content-center">
        <div @click="inviteOpen()">
            <img src="/assets/icons/raquete-preta.png" alt="Enviar convite" title="Enviar convite" style="width:50px;">
        </div>
        <div v-for="i in invites.data">
            <img src="/assets/icons/raquete-verde.png" alt="Aceito" title="Aceito" style="width:50px;" v-if="i.status=='accepted'">
            <img src="/assets/icons/raquete-vermelha.png" alt="Negado" title="Negado" style="width:50px;" v-else-if="i.status=='denied'">
            <img src="/assets/icons/raquete-amarela.png" alt="Aguardando" title="Aguardando" style="width:50px;" v-else>
        </div>
    </div>

    <ui-modal v-model="invite">
        <template #header>
            Novo convite
        </template>

        <template #body>
            Encontre um usuário para convidá-lo a editar este evento.
            <div class="d-flex mt-2">
                <ui-user class="flex-grow-1" v-model="invite.user_id"></ui-user>
                <button type="button" class="btn btn-primary ml-1">Enviar</button>
            </div>
        </template>

        <template #footer>
            <button type="button" class="btn btn-primary" @click="invite=false">
                Ok
            </button>
        </template>
    </ui-modal>
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
            loading: false,
            invite: false,
            invites: {
                data:[],
            },
        };
    },

    methods: {
        inviteOpen() {
            this.invite = {
                tevep_id: (this.$route.params.id || ""),
                user_id: "",
            };
        },

        invitesLoad() {
            if (! +this.model.id) return;

            let params = {tevep_id:this.model.id};
            this.loading = true;
            this.$axios.get('/api/tevep-invite/search', {params}).then(resp => {
                this.loading = false;
                this.invites = resp.data;
            });
        },
    },

    mounted() {
        this.invitesLoad();
    },
}
</script>