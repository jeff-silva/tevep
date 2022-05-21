<template>
    <div style="height:70vh; max-width:100%; overflow:auto; touch-action: auto;">
        <div :style="`width:${areaWidth}px;`">
            
            <!-- Tempos -->
            <div v-if="propsModelValue.date_start && propsModelValue.date_final">
                <tevep-edit-sortable
                    v-model="propsModelValue.meta.tempos"
                    :area-width="areaWidth"
                    singular="Tempo"
                    plural="Tempos"
                >
                    <template #item="{ element }">
                        <v-text-field label="Data" v-model="element.date_start" hide-details></v-text-field>
                    </template>
                </tevep-edit-sortable>
            </div>

            <v-row class="my-5 align-center" style="min-height:400px;">

                <!-- Pilotos -->
                <v-col cols="3">
                    <tevep-edit-sortable
                        v-model="propsModelValue.meta.pilotos"
                        :area-width="areaWidth"
                        layout="vertical"
                        singular="Piloto"
                        plural="Pilotos"
                        v-if="propsModelValue.meta.lugares.length"
                    >
                        <template #bottom="slot">
                            <v-btn block v-if="slot.canAdd" @click="slot.add()">Add</v-btn>
                            <pre>{{ slot }}</pre>
                        </template>
                    </tevep-edit-sortable>
                </v-col>
                
                <!-- Nome e datas -->
                <v-col cols="6" class="text-center">
                    <div class="d-flex mb-5 mx-auto" style="max-width:600px;" v-if="propsModelValue.name">
                        <div class="flex-grow-1 px-2">
                            <v-text-field label="Data início" hide-details v-model="propsModelValue.date_start"></v-text-field>
                        </div>
                        <div class="flex-grow-1 px-2">
                            <v-text-field label="Data fim" hide-details v-model="propsModelValue.date_final"></v-text-field>
                        </div>
                    </div>
                    <div class="text-center mx-auto mt-5" style="max-width:350px;">
                        <v-text-field label="Nome do evento" hide-details v-model="propsModelValue.name"></v-text-field>
                    </div>
                </v-col>

                <!-- Convidados -->
                <v-col cols="3">
                    <tevep-edit-sortable
                        v-model="propsModelValue.meta.convidados"
                        :area-width="areaWidth"
                        layout="vertical"
                        singular="Convidado"
                        plural="Convidados"
                        v-if="propsModelValue.meta.lugares.length"
                    >
                        <template #bottom="slot">
                            Add
                        </template>
                    </tevep-edit-sortable>
                </v-col>
            </v-row>

            <!-- Lugares -->
            <div v-if="propsModelValue.meta.tempos.length">
                <tevep-edit-sortable
                    v-model="propsModelValue.meta.lugares"
                    :area-width="areaWidth"
                    singular="Lugar"
                    plural="Lugares"
                >
                    <template #right="slot">
                        Add
                    </template>
                </tevep-edit-sortable>
            </div>

            <div class="text-center mt-5">
                <tevep-edit-invites v-model="modelValue"></tevep-edit-invites>
            </div>
        </div>
        <pre>{{ modelValue }}</pre>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {type: Object},
        areaWidth: {default: 2000},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValueValid(this.modelValue); },
            set(value) { this.$emit('update:modelValue', this.modelValueValid(value)); },
        },
    },

    methods: {
        modelValueValid(value) {
            value.name = value.name || '';
            value.date_start = value.date_start || '';
            value.date_final = value.date_final || '';
            value.meta = value.meta || {};
            value.meta.tempos = value.meta.tempos || [];
            value.meta.pilotos = value.meta.pilotos || [];
            value.meta.convidados = value.meta.convidados || [];
            value.meta.lugares = value.meta.lugares || [];
            value.meta.utilidades = value.meta.utilidades || [];
            value.meta.inerencias = value.meta.inerencias || [];
            value.meta.expectativas = value.meta.expectativas || [];
            value.meta.inovacoes = value.meta.inovacoes || [];
            value.meta.logisticas = value.meta.logisticas || [];
            value.meta.relevancias = value.meta.relevancias || [];
            value.meta.complexidades = value.meta.complexidades || [];
            value.meta.custos = value.meta.custos || [];
            value.meta.entregas = value.meta.entregas || [];
            value.meta.segurancas = value.meta.segurancas || [];
            value.meta.atendimentos = value.meta.atendimentos || [];
            value.meta.qualidades = value.meta.qualidades || [];
            value.meta.maquinas = value.meta.maquinas || [];
            value.meta.materiais = value.meta.materiais || [];
            value.meta.maodeobras = value.meta.maodeobras || [];
            value.meta.meioambientes = value.meta.meioambientes || [];
            value.meta.metodos = value.meta.metodos || [];
            return value;
        },
    },
};
</script>