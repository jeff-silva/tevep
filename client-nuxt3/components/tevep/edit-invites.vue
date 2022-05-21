<template>
    <div>
        <div class="d-inline-flex flex-wrap align-center">
            <div class="pa-3"><strong>Convites</strong></div>
            <div class="pa-3">
                <a href="javascript:;" @click="inviteModal=true">
                    <img style="height:40px;" src="/assets/icons/raquete-preta.png" alt="">
                </a>
            </div>
            <div class="pa-3" v-for="r in invitesSearch.resp.data">
                <template v-if="r.status=='accepted'">
                    <img style="height:40px;" src="/assets/icons/raquete-verde.png">
                </template>
                <template v-else-if="r.status=='rejected'">
                    <img style="height:40px;" src="/assets/icons/raquete-vermelha.png">
                </template>
                <template v-else>
                    <img style="height:40px;" src="/assets/icons/raquete-amarela.png">
                </template>
            </div>
        </div>

        <v-dialog v-model="inviteModal">
            <v-card title="Convite" subtitle="Criar convite" style="width:600px; max-width:90vw;">
                <v-card-text>
                    <v-text-field label="E-mail do usuário" v-model="inviteEdit.data.user_email" hide-details></v-text-field>
                    <!-- <pre>{{ inviteEdit }}</pre> -->
                    <!-- <pre>{{ modelValue }}</pre> -->
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="inviteModal=false">Cancelar</v-btn>
                    <v-btn color="primary" @click="inviteSubmit()">Convidar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
        <pre class="text-left">{{ $data }}</pre>
    </div>
</template>


<script>
export default {
    props: {
        modelValue: {type: Object},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.inviteEdit.data.tevep_id = value.modelValue.id || false;
            this.invitesSearch.params.tevep_id = value.modelValue.id || false;
            this.invitesSearch.submit();
        }},
    },

    methods: {
        async inviteSubmit() {
            await this.inviteEdit.submit();
            this.inviteModal = false;
            this.inviteEdit.data.user_email = '';
            await this.invitesSearch.submit();
        },
    },

    data() {
        return {
            inviteModal: false,
            inviteEdit: useAxios({
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
        };
    },
};
</script>