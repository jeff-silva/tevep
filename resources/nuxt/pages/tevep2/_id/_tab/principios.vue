<template><div>
    <div class="row no-gutters">

        <!-- Espaço -->
        <div class="col-12 text-center" v-if="node.title">
            <div class="d-flex align-items-center" style="margin:0px 100px;">
                <div class="flex-grow-1 px-3">
                    Início
                    <ui-datetime v-model="node.date_start" @input="tevepRefresh()"></ui-datetime>
                </div>
                <div><img :src="require('@/assets/icons/evento.png')" alt="" style="width:70px;"></div>
                <div class="flex-grow-1 px-3">
                    Fim
                    <ui-datetime v-model="node.date_final" @input="tevepRefresh()"></ui-datetime>
                </div>
            </div>
            <br><br>
        </div>

        <!-- Piloto -->
        <div class="col-4">
            <div v-if="node.espaco">
                <div>Piloto</div>
                <input type="text" class="form-control" v-model="node.piloto">
            </div>
        </div>
        
        <!-- Título -->
        <div class="col-4 px-3">
            <div>&nbsp;</div>
            <div class="input-group">
                <input type="text" class="form-control" v-model="node.title" placeholder="Título" @keyup="tevepRefresh()">
            </div>
        </div>

        <!-- Pessoas -->
        <div class="col-4">
            <div v-if="node.espaco">
                <div class="text-right">Pessoas</div>
                <input type="text" class="form-control" v-model="node.pessoa">
            </div>
        </div>

        <!-- Espaços -->
        <div class="col-12 text-center" v-if="node.date_start && node.date_final">
            <br><br>
            <img :src="require('@/assets/icons/espaco.png')" alt="" class="mb-3" style="width:200px;">
            <div style="max-width:250px; margin:0 auto;">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="node.espaco">
                </div>
            </div>
        </div>
    </div>

    <!-- <pre>node: {{ node }}</pre> -->
</div></template>

<script>
export default {
    props: {
        tevep: {default:()=>({})},
        node: {default:()=>({})},
        tevepRefresh: Function,
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },
}
</script>