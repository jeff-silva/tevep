<template><div>
    <div class="d-flex justify-content-center">
        <div class="mr-4">
            <a href="javascript:;" @click="inviteOpen()">
                <el-tooltip content="Convidar">
                    <img src="/assets/icons/raquete-preta.png" alt="Enviar convite" title="Enviar convite" style="width:50px;">
                </el-tooltip>
            </a>
        </div>
        <div v-for="i in invites.data">
            <a href="javascript:;" @click="inviteInfoOpen(i)">
                <el-tooltip :content="i.user.name">
                    <img src="/assets/icons/raquete-verde.png" alt="Aceito" style="width:50px;" v-if="i.status=='accepted'">
                    <img src="/assets/icons/raquete-vermelha.png" alt="Negado" style="width:50px;" v-else-if="i.status=='denied'">
                    <img src="/assets/icons/raquete-amarela.png" alt="Aguardando" style="width:50px;" v-else>
                </el-tooltip>
            </a>
        </div>
    </div>

    <!-- modal convite -->
    <ui-modal v-model="invite">
        <template #header>
            Novo convite
        </template>

        <template #body>
            <div class="form-group">
                <label>Encontre um usuário para convidá-lo a editar este evento.</label>
                <ui-user v-model="invite.user_id"></ui-user>
            </div>

            <div class="form-group">
                <label>Ou convide por e-mail</label>
                <input type="text" class="form-control" v-model="invite.user_email">
            </div>
        </template>

        <template #footer>
            <button type="button" class="btn btn-default" @click="invite=false">
                Cancelar
            </button>

            <button type="button" class="btn btn-primary" @click="inviteSave()">
                Enviar
            </button>
        </template>
    </ui-modal>

    
    
    <!-- modal info -->
    <ui-modal v-model="inviteInfo">
        <template #header>Detalhes</template>
        <template #body>
            <div class="alert alert-danger" v-if="inviteInfo.status=='denied'">{{ inviteInfo.user.name }} recusou o convite</div>
            <div class="alert alert-success" v-else-if="inviteInfo.status=='accepted'">{{ inviteInfo.user.name }} aceitou o convite</div>
            <div class="alert alert-warning" v-else>
                Aguardando resposta de {{ inviteInfo.user.name }}
                <a :href="inviteInfo.links.whatsapp" target="_blank"
                    class="btn bg-whatsapp text-white btn-block mt-3"
                    v-if="inviteInfo.links.whatsapp"
                >
                    <i class="fab fa-whatsapp"></i>
                    Convidar pelo whatsapp
                </a>
            </div>
        </template>
        <template #footer>
            <button type="button" class="btn btn-danger" @click="inviteRemove()">
                Remover convite
            </button>
            <button type="button" class="btn btn-primary" @click="inviteInfo=false">
                Ok
            </button>
        </template>
    </ui-modal>



    <!-- modal convite -->
    <template v-for="i in invites.data" v-if="!i.status && i.user_id==$auth.user.id">
        <ui-modal :value="true">
            <template #header>Você foi convidado para editar este projeto</template>
            <template #body>
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <a href="javascript:;" class="btn btn-primary btn-block"
                            @click="inviteResponse(i, {status:'accepted'})"
                        >Aceitar</a>
                    </div>

                    <div class="flex-grow-1">
                        <a href="javascript:;" class="btn btn-danger btn-block"
                            @click="inviteResponse(i, {status:'denied'})"
                        >Recusar</a>
                    </div>
                </div>
            </template>
        </ui-modal>
    </template>
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
            inviteInfo: false,
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
                user_email: "",
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

        inviteSave() {
            this.$axios.post('/api/tevep-invite/save', this.invite).then(resp => {
                this.invite = false;
                this.invitesLoad();
            });
        },

        inviteResponse(data, merge={}) {
            data = Object.assign({}, data, merge);

            this.loading = true;
            this.$axios.post('/api/tevep-invite/save', data).then(resp => {
                this.loading = false;
                this.invitesLoad();
            });
        },

        inviteInfoOpen(invite) {
            this.inviteInfo = invite;
        },

        inviteRemove() {
            this.$swal('Remover convite', 'Deseja mesmo continuar?').then(resp => {
                if (!resp.value) return;

                this.loading = true;
                this.$axios.post(`/api/tevep-invite/delete/${this.inviteInfo.id}`).then(resp => {
                    this.loading = false;
                    this.inviteInfo = false;
                    this.invitesLoad();
                });
            });
        },
    },

    mounted() {
        this.invitesLoad();
    },
}
</script>