<template><div>
    <div class="row no-gutters">
        <div class="col-5">
            <button type="button" class="btn btn-outline-primary btn-block" @click="add()">
                <i class="fas fa-plus"></i> Adicionar
            </button>

            <ui-draggable v-model="node.inerencias" handle="._handle">
                <div class="my-2 p-1 bg-white shadow-sm" v-for="i in node.inerencias" :key="i.id">
                    <div class="input-group">
                        <div class="input-group-prepend"><div class="input-group-btn">
                            <a href="javascript:;" class="btn _handle" style="cursor:move;">
                                <i class="fas fa-arrows-alt"></i>
                            </a>
                        </div></div>

                        <div class="input-group-prepend"><div class="input-group-text">
                            Nome
                        </div></div>

                        <input type="text" class="form-control" v-model="i.name">

                        <div class="input-group-append"><div class="input-group-btn">
                            <a href="javascript:;" class="btn btn-danger" @click="remove(i)">
                                <i class="fas fa-times"></i>
                            </a>
                        </div></div>
                    </div>

                    <div class="row no-gutters mt-1">
                        <div class="col">
                            <div class="text-center mb-1">
                                <img src="/assets/icons/ampulheta.png" alt="" style="height:30px;">
                            </div>
                            <select class="form-control" v-model="i.tempo">
                                <option :value="false">Tempo</option>
                                <option :value="o.id" v-for="o in node.tempos">{{ o.title }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="text-center mb-1">
                                <img src="/assets/icons/espaco.png" alt="" style="width:100%; margin:8px auto;">
                            </div>
                            <select class="form-control" v-model="i.espaco">
                                <option :value="false">Espaço</option>
                                <option :value="o.id" v-for="o in node.espacos">{{ o.title }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="text-center mb-1">
                                <img src="/assets/icons/piloto.png" alt="" style="height:30px;">
                            </div>
                            <select class="form-control" v-model="i.piloto">
                                <option :value="false">Piloto</option>
                                <option :value="o.id" v-for="o in node.pilotos">{{ o.title }}</option>
                            </select>
                        </div>
                        <div class="col">
                            <div class="text-center mb-1 font-weight-bold" style="margin:9.5px auto;">R</div>
                            <select class="form-control"></select>
                        </div>
                        <div class="col">
                            <div class="text-center mb-1 font-weight-bold" style="margin:9.5px auto;">C</div>
                            <select class="form-control"></select>
                        </div>
                    </div>
                </div>
            </ui-draggable>
        </div>

        <div class="col-7 pl-3">
            <principios v-bind="$props"></principios>
        </div>
    </div>
</div></template>

<script>
import Principios from '@/pages/tevep/_id/_tab/principios';

export default {
    components: { Principios },

    props: {
        tevep: Object,
        node: Object,
        uuid: Function,
        tevepTitle: Function,
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    methods: {
        add() {
            this.node.inerencias.unshift({
                id: this.uuid('i'),
                name: '',
                tempo: false,
                espaco: false,
                piloto: false,
            });
        },

        remove(item) {
            let index = this.node.inerencias.indexOf(item);
            this.node.inerencias.splice(index, 1);
        },
    },
}
</script>