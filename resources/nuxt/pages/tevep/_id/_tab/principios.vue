<template><div>
    <div class="row no-gutters">

        <!-- Espaço -->
        <div class="col-12 text-center" v-if="node.title">
            <div class="d-flex align-items-center" style="margin:0px 100px;">
                <div class="flex-grow-1 px-3">
                    Início
                    <ui-datetime v-model="node.date_start" @input="tevepTitle(node)"></ui-datetime>
                </div>
                <div><img src="/assets/icons/evento.png" alt="" style="width:70px;"></div>
                <div class="flex-grow-1 px-3">
                    Fim
                    <ui-datetime v-model="node.date_final" @input="tevepTitle(node)"></ui-datetime>
                </div>
            </div>
            <br><br>
        </div>

        <!-- Piloto -->
        <div class="col-4">
            <div v-if="node.espaco">
                <div class="text-center"><img src="/assets/icons/piloto.png" alt="" class="mb-3 mr-2" style="height:60px;"> Pilotos</div>
                <input type="text" class="form-control" v-model="node.piloto">
            </div>
        </div>
        
        <!-- Título -->
        <div class="col-4 px-3">
            <div>&nbsp;</div>
            <div class="input-group">
                <input type="text" class="form-control" v-model="node.title" placeholder="Título" @keyup="tevepTitle(node)">
            </div>
        </div>

        <!-- Pessoas -->
        <div class="col-4">
            <div v-if="node.espaco">
                <div class="text-center">Público <img src="/assets/icons/publico.png" alt="" class="mb-3 ml-2" style="height:60px;"></div>
                <input type="text" class="form-control" v-model="node.pessoa">
            </div>
        </div>

        <!-- Espaços -->
        <div class="col-12 text-center" v-if="node.date_start && node.date_final">
            <br><br>
            <img src="/assets/icons/espaco.png" alt="" class="mb-3" style="width:200px;">
            <div style="max-width:250px; margin:0 auto;">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="node.espaco">
                </div>
            </div>
        </div>
    </div>

    <div v-if="node.title && node.date_start && node.date_final && node.espaco && node.piloto && node.pessoa && $route.params.id!=0">
        <div class="text-center mt-5">
            <a href="javascript:;" @click="pingpong=tevepPingpongDefault()" class="mr-4">
                <img src="/assets/icons/raquete-preta.png" alt="" style="width:50px;">
            </a>
            <a href="javascript:;" v-for="p in tevep.pingpongs" @click="pingpongInfo=p">
                <img :src="p.accepted? '/assets/icons/raquete-verde.png': '/assets/icons/raquete-vermelha.png'" alt="" style="width:50px;">
            </a>
        </div>

        <ui-modal v-model="pingpong">
            <template #header>Enviar pingpong para usuário</template>
            <template #body>
                <ui-user v-model="pingpong.to">
                    <template #append>
                        <button type="button" class="btn btn-primary" @click="sendPingpong(pingpong.to)">
                            <i class="fas fa-fw fa-paper-plane"></i>
                        </button>
                    </template>
                </ui-user>
            </template>
        </ui-modal>

        <ui-modal v-model="pingpongInfo">
            <template #header>Informações de pingpong</template>
            <template #body>
                Para {{ pingpongInfo.user_to_name }} - {{ pingpongInfo.user_to_email }} (convite enviado {{ pingpongInfo.invitations||1 }} vez(es)
                <br>
                <div class="alert alert-success m-0 mt-2" v-if="pingpongInfo.accepted">Aceito</div>
                <div v-if="!pingpongInfo.accepted">
                    <div class="alert alert-danger m-0 mt-2">
                        <a href="javascript:;" class="text-primary font-weight-bold float-right" @click="sendPingpong(pingpongInfo.user_to)">Convidar novamente</a>
                        Não aceito.
                    </div>

                    <a :href="pingpongInfo.user_to_whatsapp|linkWhatsapp(`Olá, participe do meu projeto TEvEP!\n${pingpongInfo.invite_link}`)" target="_blank" class="btn btn-outline-whatsapp btn-block mt-3" v-if="pingpongInfo.user_to_whatsapp">
                        <i class="fab fa-whatsapp mr-1"></i> Enviar convite por whatsapp
                    </a>
                </div>
            </template>
        </ui-modal>
    </div>
</div></template>

<script>
export default {
    props: {
        tevep: Object,
        node: Object,
        uuid: Function,
        tevepLoad: Function,
        tevepDefault: Function,
        tevepInit: Function,
        tevepTitle: Function,
        tevepNodeDefault: Function,
        tevepPingpongDefault: Function,
    },

    data() {
        return {
            pingpong: false,
            pingpongInfo: false,
            props: Object.assign({}, this.$props),
        };
    },

    methods: {
        sendPingpong(userId) {
            this.$axios.post(`/api/tevep/${this.$route.params.id}/pingpong/${userId}`).then(resp => {
                this.$parent.$parent.tevepInit(resp.data);
                this.pingpongInfo = false;
                this.$swal('Enviado', 'Ping pong enviado', 'success');
            });
        },
    },
}
</script>