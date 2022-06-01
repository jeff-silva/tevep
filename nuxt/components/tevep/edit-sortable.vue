<template>
    <div class="text-center">
        <div class="mb-3"><strong>{{ plural }}</strong></div>
        <div
            :class="{
                'd-flex flex-column': (layout=='vertical'),
                'd-inline-flex align-center': (layout=='horizontal'),
            }"
        >
            <draggable 
                v-model="propsModelValue"
                :animation="150"
                :class="{
                    'd-flex flex-column':layout=='vertical',
                    'd-flex':layout=='horizontal',
                }"
            >
                <template #item="{ element, index }">
                    <div :class="{'bg-blue-lighten-4':($route.query.meta_ref==element.meta_ref)}">
                        <div class="flex-grow-1 d-flex align-center ma-1" :style="layout=='horizontal'? `width:${(areaWidth/max)-7}px;`: ``">
                            <v-icon class="mx-2" style="cursor:move;">mdi-drag</v-icon>
                            <div class="flex-grow-1">
                                <slot name="item" v-bind="this.slotBind({element})">
                                    <v-text-field :label="`${singular} ${index+1}`" hide-details v-model="element.name"></v-text-field>
                                </slot>
                            </div>
                            <v-btn
                                flat
                                class="ms-2"
                                icon="mdi-dots-vertical"
                                @click="dialogItem(element)"
                            ></v-btn>
                        </div>
    
                        <v-dialog :model-value="dialog && dialog.meta_ref==element.meta_ref" @click:outside="dialogItem(false)">
                            <v-card :title="plural" :subtitle="`Gerenciador de ${singular}`">
                                <v-alert type="error" rounded="0" v-if="error">{{ error }}</v-alert>
                                <v-card-text style="width:600px; max-width:95vw;">
                                    <v-text-field label="Nome" v-model="element.name" hide-details class="mb-5"></v-text-field>
                                    <v-text-field label="Data início" v-model="element.date_start" prepend-inner-icon="mdi-calendar" hide-details class="mb-5"></v-text-field>
                                    <v-text-field label="Data fim" v-model="element.date_final" prepend-inner-icon="mdi-calendar" hide-details class="mb-5"></v-text-field>
                                </v-card-text>
                                <v-card-actions>
                                    <v-spacer></v-spacer>
                                    <v-btn flat color="error" @click="remove(element)">Deletar</v-btn>
                                    <v-btn flat :to="`/admin/teveps?edit=${element.tevep_id}`" v-if="element.tevep_id" color="primary">Acessar projeto</v-btn>
                                    <v-btn flat @click="projectCreate(element)" v-else>Converter em projeto</v-btn>
                                    <v-btn flat color="primary" @click="dialogItem(false)">Ok</v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </div>
                </template>
            </draggable>

            <div
                :class="{
                    'd-flex text-center mt-3':(layout=='vertical'),
                    'd-flex':(layout=='horizontal'),
                }"
            >
                <v-btn
                    icon="mdi-plus"
                    @click="add()"
                    v-if="propsModelValue.length<max"
                    :title="`Adicionar ${singular}`"
                    class="mx-auto"
                ></v-btn>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    props: {
        modelValue: {type: Array, default:()=>([])},
        layout: {default:'horizontal'}, // horizontal, vertical
        max: {default:7},
        singular: {default:'Item'},
        plural: {default:'Itens'},
        areaWidth: {default: 2000},
        methodSave: {default:false, type:[Boolean, Function]},
    },

    components: { draggable },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    data() {
        return {
            dialog: false,
            error: false,
        };
    },

    methods: {
        slotBind(merge={}) {
            return {
                add: this.add,
                remove: this.remove,
                items: this.propsModelValue,
                canAdd: (this.propsModelValue.length<this.max),
                ...merge
            };
        },

        callMethodSave() {
            if (typeof this.methodSave != 'function') return;
            this.methodSave();
        },

        dialogItem(item) {
            this.dialog = item;
        },

        add() {
            this.propsModelValue.push({
                name: '',
            });
        },

        remove(item) {
            this.$confirm(`Deseja remover este ${this.singular}?`).then(resp => {
                const index = this.propsModelValue.indexOf(item);
                this.propsModelValue.splice(index, 1);
                this.dialogItem(false);
            });
        },

        async projectCreate(node) {
            this.error = false;

            try {
                let { data: tevep } = await this.$axios.post('/api/teveps/save', node);
                node.tevep_id = tevep.id;
                this.callMethodSave();
            }
            catch(err) {
                this.error = err.message;
            }
        },
    },
};
</script>