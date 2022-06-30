<template>
    <div>
        <div style="width:100%; overflow:auto;">
            <div :style="$vuetify.display.mobile? ``: `min-width:${areaWidth}px;`">
                <v-row no-gutters class="mx-5 mx-md-0">

                    <!-- Tempos -->
                    <v-col class="tevep-col pb-5" order="1" order-md="0" cols="12" md="12">
                        <tevep-edit-sortable
                            v-model="propsModelValue.meta.tempos"
                            :area-width="areaWidth"
                            :layout="$vuetify.display.mobile? 'vertical': 'horizontal'"
                            singular="Tempo"
                            plural="Tempos"
                            :method-save="methodSave"
                        >
                            <template #item="{ element }">
                                <v-text-field label="Data" v-model="element.date_start" hide-details></v-text-field>
                            </template>
                        </tevep-edit-sortable>
                    </v-col>

                    <!-- Pilotos -->
                    <v-col class="tevep-col pb-5 pb-md-0" order="2" order-md="1" cols="12" md="4">
                        <tevep-edit-sortable
                            v-model="propsModelValue.meta.pilotos"
                            :area-width="areaWidth"
                            layout="vertical"
                            singular="Piloto"
                            plural="Pilotos"
                            :method-save="methodSave"
                            v-if="propsModelValue.meta.lugares.length"
                        >
                            <template #bottom="slot">
                                <v-btn block v-if="slot.canAdd" @click="slot.add()">Add</v-btn>
                                <pre>{{ slot }}</pre>
                            </template>
                        </tevep-edit-sortable>
                    </v-col>

                    <!-- Tevep -->
                    <v-col class="tevep-col px-md-5 mb-5 mb-md-0 d-flex align-center" order="0" order-md="2" cols="12" md="4">
                        <div class="flex-grow-1">
                            <v-text-field
                                label="Data início"
                                prepend-inner-icon="mdi-calendar"
                                v-model="propsModelValue.date_start"
                                v-if="propsModelValue.name"
                            ></v-text-field>

                            <v-text-field
                                label="Data fim"
                                prepend-inner-icon="mdi-calendar"
                                v-model="propsModelValue.date_final"
                                v-if="propsModelValue.name"
                            ></v-text-field>

                            <v-text-field
                                label="Nome do evento"
                                v-model="propsModelValue.name"
                            ></v-text-field>

                            <v-btn
                                block
                                :to="`/admin/teveps?edit=${propsModelValue.parent_id}&meta_ref=${propsModelValue.meta_ref}`"
                                v-if="propsModelValue.parent_id"
                            >Acessar evento pai</v-btn>
                        </div>
                    </v-col>

                    <!-- Convidados -->
                    <v-col class="tevep-col pb-5 pb-md-0" order="3" order-md="3" cols="12" md="4">
                        <tevep-edit-sortable
                            v-model="propsModelValue.meta.convidados"
                            :area-width="areaWidth"
                            layout="vertical"
                            singular="Convidado"
                            plural="Convidados"
                            :method-save="methodSave"
                            v-if="propsModelValue.meta.lugares.length"
                        >
                            <template #bottom="slot">
                                Add
                            </template>
                        </tevep-edit-sortable>
                    </v-col>

                    <!-- Lugares -->
                    <v-col class="tevep-col pb-5 pt-md-5" order="4" order-md="4" cols="12" md="12">
                        <tevep-edit-sortable
                            v-model="propsModelValue.meta.lugares"
                            :area-width="areaWidth"
                            :layout="$vuetify.display.mobile? 'vertical': 'horizontal'"
                            singular="Lugar"
                            plural="Lugares"
                            :method-save="methodSave"
                        >
                            <template #right="slot">
                                Add
                            </template>
                        </tevep-edit-sortable>
                    </v-col>
                </v-row>
            </div>
        </div>
                
        <tevep-edit-invites
            v-model="modelValue"
            v-if="+$route.query.edit"
            class="mt-5 mx-5 mx-md-0"
        ></tevep-edit-invites>
        
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {type: Object},
        areaWidth: {default: 2000},
        methodSave: {default:false, type:[Boolean, Function]},
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