<template><div>
    
    <a href="javascript:;" @click="showModalInvite()">
        <img src="/assets/icons/raquete-preta.png" alt="" style="width:50px;">
    </a>

    <a href="javascript:;" v-for="i in invites.data" :key="i.id" @click="inviteInfo=i">
        <img src="/assets/icons/raquete-verde.png" alt="" style="width:50px;" v-if="i.status=='accepted'">
        <img src="/assets/icons/raquete-vermelha.png" alt="" style="width:50px;" v-else-if="i.status=='rejected'">
        <img src="/assets/icons/raquete-amarela.png" alt="" style="width:50px;" v-else>
    </a>

    <ui-modal v-model="invite">
        <template #header>Enviar ping-pong</template>
        <template #body>
            <div class="input-group">
                <input type="text" class="form-control" v-model="invite.user_id" placeholder="Informe o e-mail do usuário" @keyup.prevent.enter="inviteSend()">
                <div class="input-group-append"><div class="input-group-btn">
                    <button type="button" class="btn btn-primary" @click="inviteSend()">
                        <i class="fas fa-spin fa-spinner" v-if="loading"></i>
                        <i class="fas fa-paper-plane" v-else></i>
                    </button>
                </div></div>
            </div>
        </template>
    </ui-modal>

    <!-- Invite info -->
    <ui-modal v-model="inviteInfo">
        <template #header>{{ inviteInfo.user.name }}</template>
        <template #body>
            
            <!-- Aceito -->
            <div v-if="inviteInfo.status=='accepted'">
                <div class="alert alert-success">
                    {{ inviteInfo.user.name }} aceitou
                </div>
            </div>

            <!-- Rejeitado -->
            <div v-else-if="inviteInfo.status=='rejected'">
                <div class="alert alert-success">
                    {{ inviteInfo.user.name }} rejeitou
                </div>
            </div>

             <!-- Aguardando -->
             <div v-else>
                <div class="alert alert-warning">
                    Aguardando resposta de {{ inviteInfo.user.name }}
                </div>

                <a :href="inviteInfo.user.whatsapp|linkWhatsapp(`Olá, participe do meu projeto TEvEP!\n${inviteInfo.invite_link}`)" target="_blank" class="btn btn-outline-whatsapp btn-block mt-3" v-if="inviteInfo.user.whatsapp">
                    <i class="fab fa-whatsapp mr-1"></i> Enviar convite por whatsapp
                </a>
                
                <a href="javascript:;" class="btn btn-outline-dark btn-block" @click="$copy(inviteInfo.invite_link).then(r => $swal('', 'Texto copiado', 'success'))"  v-tooltip="'Você pode copiar o link para enviar diretamente por outros meios'">
                    <i class="far fa-copy mr-1"></i> Copiar link do convite
                </a>
            </div>
        </template>
        <template #footer>
            <button type="button" class="btn btn-danger" v-if="inviteInfo.status" @click="inviteDelete(inviteInfo)">
                Remover {{ inviteInfo.user.name }}
            </button>

            <button type="button" class="btn btn-primary" @click="inviteInfo=false">
                Ok
            </button>
        </template>
    </ui-modal>

    <!-- Aceitando convite -->
    <div v-if="$route.query.invite">
        <div v-for="i in invites.data" :key="i.id" v-if="i.id==$route.query.invite && !i.status">
            <ui-modal :value="true">
                <template #header>Convite Ping Pong</template>
                <template #body>
                    Você recebeu um convite para editar este evento, como deseja proceder?
                </template>
                <template #footer>
                    <a href="javascript:;" class="btn btn-danger" @click="inviteResponse(i, 'rejected', 'Resposta enviada')">
                        Recusar
                    </a>

                    <a href="javascript:;" class="btn btn-success" @click="inviteResponse(i, 'accepted', 'Resposta enviada')">
                        Aceitar
                    </a>
                </template>
            </ui-modal>
        </div>
    </div>
</div></template>

<script>
export default {
    props: {
        value: Object,
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    data() {
        return {
            loading: 0,
            invites: {data:[]},
            invite: false,
            inviteInfo: false,
            props: Object.assign({}, this.$props),
        };
    },

    methods: {
        getInvites() {
            this.loading++;
            this.$axios.get(`/api/tevep-invite/search?tevep_id=${this.value.id}`).then(resp => {
                this.loading--;
                this.invites = resp.data||{};
            });
        },

        showModalInvite() {
            this.invite = {
                tevep_id: this.$route.params.id,
                tevep_node: this.$route.query.node,
                user_id: "",
            };
        },

        inviteSend() {
            this.loading++;
            this.$axios.post('/api/tevep-invite/save', this.invite).then(resp => {
                this.loading--;
                this.$swal('Enviado', `O convite foi enviado para ${this.invite.user_id}`, 'success');
                this.invite = false;
                this.getInvites();
            });
        },

        inviteResponse(merge={}, status='', message='') {
            merge.status = status;
            this.loading++;
            this.$axios.post('/api/tevep-invite/save', merge).then(resp => {
                this.loading--;
                this.$swal('Enviado', message, 'success');
                this.getInvites();

                let query = Object.assign({}, this.$route.query);
                delete query.invite;
                this.$router.push({query});
            });
        },

        inviteDelete(invite) {
            this.$swal('Confirmação', `Tem certeza que deseja remover o convite de ${invite.user.name}?`, 'warning').then(resp => {
                if (! resp.isConfirmed) return;

                this.loading++;
                this.$axios.post(`/api/tevep-invite/delete/${invite.id}`).then(resp2 => {
                    this.loading--;
                    this.inviteInfo = false;
                    this.getInvites();
                    this.$swal('', 'Convite removido', 'success');
                });
            });
        },
    },

    mounted() {
        this.getInvites();
    },
}
</script>