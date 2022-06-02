<template>
    <div>
        <div class="d-inline-flex flex-wrap align-center">
            <div class="pa-3"><strong>Convites</strong></div>
            <div class="pa-3">
                <a href="javascript:;" @click="inviteEditModal=true">
                    <img style="height:40px;" src="/files/icons/raquete-preta.png" alt="">
                </a>
            </div>
            <div class="pa-3" v-for="r in invitesSearch.resp.data">
                <v-tooltip anchor="top">
                    <template #activator="{ props }">
                        <v-btn v-bind="props" flat style="height:auto" @click="inviteViewModal=r.id">
                            <template v-if="r.status=='accepted'">
                                <img style="height:40px;" src="/files/icons/raquete-verde.png">
                            </template>
                            <template v-else-if="r.status=='denied'">
                                <img style="height:40px;" src="/files/icons/raquete-vermelha.png">
                            </template>
                            <template v-else>
                                <img style="height:40px;" src="/files/icons/raquete-amarela.png">
                            </template>
                        </v-btn>
                    </template>

                    <div>
                        {{ r.user_email }}
                    </div>
                </v-tooltip>

                <!-- Modal visualização de convite -->
                <v-dialog :model-value="inviteViewModal==r.id" @click:outside="inviteViewModal=false">
                    <v-card :title="`Convite ${r.user_email}`" subtitle="Detalhes do convite" style="width:600px; max-width:90vw;">
                        <v-card-text>
                            <v-alert type="success" v-if="r.status=='accepted'">{{ r.user_email }} aceitou o convite.</v-alert>
                            <v-alert type="error" v-else-if="r.status=='denied'">{{ r.user_email }} não aceitou o convite.</v-alert>
                            <v-alert type="warning" v-else>{{ r.user_email }} não respondeu ao convite.</v-alert>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn @click="inviteViewModal=false">Ok</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </div>
        </div>

        <!-- Modal criar convite -->
        <v-dialog v-model="inviteEditModal">
            <v-card title="Convite" subtitle="Criar convite" style="width:600px; max-width:90vw;">
                <v-card-text>
                    <v-text-field label="E-mail do usuário" v-model="inviteEdit.data.user_email" hide-details></v-text-field>
                    <div class="text-red" v-if="inviteEdit.err.message">{{ inviteEdit.err.message }}</div>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="inviteEditModal=false">Cancelar</v-btn>
                    <v-btn color="primary" @click="inviteSubmit()">Convidar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <!-- Modal aceitar convite -->
        <template v-for="r in invitesSearch.resp.data">
            <v-dialog :model-value="(r.user_email==app.user.email) && !r.status">
                <v-card title="Convite" style="width:600px; max-width:90vw;">
                    <v-card-text>
                        Você foi convidado a participar deste projeto.
                        <div class="text-red" v-if="inviteEdit.err.message">{{ inviteEdit.err.message }}</div>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn color="success" @click="inviteResponseSubmit(r, 'accepted')">Aceitar</v-btn>
                        <v-btn color="error" @click="inviteResponseSubmit(r, 'denied')">Recusar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>
        </template>
    </div>
</template>


<script>
export default {
    props: {
        modelValue: {type: Object},
    },

    watch: {
        '$props.modelValue': {deep:false, handler(modelValue) {
            this.inviteEdit.data.tevep_id = modelValue.id || false;
            this.inviteResponse.data.tevep_id = modelValue.id || false;
            this.invitesSearch.params.tevep_id = modelValue.id || false;
            this.invitesSearch.submit();
        }},
    },

    methods: {
        async inviteSubmit() {
            await this.inviteEdit.submit();
            this.inviteEditModal = false;
            this.inviteEdit.data.user_email = '';
            await this.invitesSearch.submit();
        },
        async inviteResponseSubmit(data, status) {
            data.status = status;
            this.inviteResponse.data = data;
            await this.inviteResponse.submit();
            await this.invitesSearch.submit();
        },
    },

    data() {
        return {
            inviteEditModal: false,
            inviteViewModal: false,
            inviteEdit: useAxios({
                method: 'post',
                url: `/api/teveps-invites/save`,
                data: {tevep_id: false},
            }),
            inviteResponse: useAxios({
                method: 'post',
                url: `/api/teveps-invites/save`,
                data: {tevep_id: false},
            }),
            invitesSearch: useAxios({
                method: 'get',
                url: `/api/teveps-invites/search`,
                params: {tevep_id:null},
                resp: {data:[]},
            }),
            app: useApp(),
        };
    },
};
</script>