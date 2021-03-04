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
            <div v-if="node && node.espacos[0] && node.espacos[0].title">
                <div class="text-center"><img src="/assets/icons/piloto.png" alt="" class="mb-3 mr-2" style="height:60px;"> Pilotos</div>
                <input type="text" class="form-control" v-model="node.pilotos[0].title">
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
            <div v-if="node && node.espacos[0] && node.espacos[0].title">
                <div class="text-center">Público <img src="/assets/icons/publico.png" alt="" class="mb-3 ml-2" style="height:60px;"></div>
                <input type="text" class="form-control" v-model="node.pessoas[0].title">
            </div>
        </div>

        <!-- Espaços -->
        <div class="col-12 text-center" v-if="node.date_start && node.date_final">
            <br><br>
            <img src="/assets/icons/espaco.png" alt="" class="mb-3" style="width:200px;">
            <div style="max-width:250px; margin:0 auto;" v-if="node.espacos[0]">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="node.espacos[0].title">
                </div>
            </div>

            <br><br>
            <div v-if="node.title && node.date_start && node.date_final && $route.params.id!=0">
                <pingpong v-model="tevep"></pingpong>
            </div>
        </div>
    </div>
</div></template>

<script>
export default {
    components: {
        'pingpong': require('./pingpong.vue').default,
    },

    props: {
        tevep: Object,
        node: Object,
        uuid: Function,
        tevepLoad: Function,
        tevepDefault: Function,
        tevepInit: Function,
        tevepTitle: Function,
        tevepNodeDefault: Function,
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
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