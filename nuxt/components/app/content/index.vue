<template>
    <div v-if="edit" class="app-content">
        <v-btn @click="editMode=true">Editar</v-btn>

        <v-overlay :model-value="editMode" class="app-content">
            <v-row no-gutters style="width:100vw;">
                <v-col cols="2" style="height:100vh; overflow:auto; background:#f5f5f5; border-right:solid 4px #eee;">
                    <v-card elevation="0">
                        <v-card-title>
                            <span>Editor</span>
                            <v-spacer />
                            <v-btn icon flat @click="editMode=false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-expansion-panels v-model="actionsView">

                            <!-- Tab editar seção -->
                            <v-expansion-panel value="section-edit" title="Editar Seção">
                                <v-expansion-panel-text>
                                    <div v-if="sectionEdit">
                                        <v-text-field
                                            v-model="sectionEdit.name"
                                            label="Nome"
                                            hide-details
                                        ></v-text-field>
                                        <component
                                            v-bind="sectionEdit"
                                            :is="sectionEdit.is"
                                            :edit="true"
                                            v-model="sectionEdit.value"
                                        ></component>
                                    </div>
                                    <div v-else class="text-center">
                                        <v-btn class="my-3" @click="actionsView='section-list-insert'">Inserir seção</v-btn>
                                    </div>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Seções inseridas -->
                            <v-expansion-panel value="section-list-edit" title="Seções inseridas">
                                <v-expansion-panel-text>
                                    <pre>{{ propsModelValue.sections }}</pre>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Inserir seção -->
                            <v-expansion-panel value="section-list-insert" title="Inserir seção">
                                <v-expansion-panel-text>
                                    <v-list dense>
                                        <v-list-item v-for="s in sections" :key="$key(s)">
                                            <template #title>
                                                <v-list-item-title>
                                                    {{ s.name }}
                                                </v-list-item-title>
                                            </template>
                                            <template #append>
                                                <v-list-item-action>
                                                    <v-btn icon flat @click="sectionAdd(s)">
                                                        <v-icon>mdi-plus</v-icon>
                                                    </v-btn>
                                                </v-list-item-action>
                                            </template>
                                        </v-list-item>
                                    </v-list>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Editar Layout -->
                            <v-expansion-panel value="layout-edit" title="Editar Layout">
                                <v-expansion-panel-text>
                                    Layout
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Layouts -->
                            <v-expansion-panel value="layout-list" title="Layouts">
                                <v-expansion-panel-text>
                                    <pre>{{ layouts }}</pre>
                                </v-expansion-panel-text>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card>
                </v-col>
                <v-col cols="10" style="height:100vh; overflow:auto; background:#ffffff;">
                    <template v-for="l in layouts">
                        <template v-if="l.is==propsModelValue.layout.is">
                            <component v-bind="propsModelValue.layout.is" :is="propsModelValue.layout.is" :key="$key(l)">
                                <div v-if="propsModelValue.sections.length==0" class="text-center">
                                    <v-btn class="my-3" @click="actionsView='section-list-insert'">Inserir seção</v-btn>
                                </div>
                                
                                <div
                                    v-for="s in propsModelValue.sections"
                                    @click="sectionEdit=s; actionsView='section-edit'"
                                    :style="sectionEdit==s? `border-left:solid 5px red;`: `border-left:solid 5px transparent;`"
                                    :key="$key(s)"
                                >
                                    <component v-bind="s" :is="s.is" :edit="false" :model-value="s.value"></component>
                                </div>
                            </component>
                        </template>
                    </template>
                </v-col>
            </v-row>
        </v-overlay>
    </div>

    <div v-else>
        <pre>{{ propsModelValue }}</pre>
    </div>
</template>

<script>
import LayoutDefault from './layouts/default.vue';

import SectionTest from './sections/test.vue';

export default {
    props: {
        modelValue: {default:false, type:[Boolean, Object]},
        edit: {default:false, type:[Boolean]},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValueParse(this.modelValue); },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    methods: {
        modelValueParse(value) {
            if (typeof value!='object') {
                value = {};
            }
            if (typeof value.layout!='object') {
                value.layout = this.layouts[0];
            }
            if (!Array.isArray(value.sections)) {
                value.sections = [];
            }
            return value;
        },

        componentDefault(name, is) {
            return { name, value:{}, is };
        },

        sectionAdd(section) {
            const id = 'section-'+ Math.round(Math.random()*99999);
            section = { id, ...section };
            section.value = {...section.value};
            let value = this.propsModelValue;
            value.sections.push(section);
            this.propsModelValue = value;
            this.sectionEdit = section;
            this.actionsView = 'section-edit';
        },
    },

    data() {
        return {
            editMode: false,
            actionsView: 'section-list-insert',
            sectionEdit: false,
            layouts: [
                this.componentDefault('Default', LayoutDefault),
            ],
            sections: [
                this.componentDefault('Test', SectionTest),
                // this.componentDefault('Test', 'app-content-sections-test'),
            ],
        };
    },
}
</script>

<style>
.app-content .v-expansion-panel {
    margin: 0 !important;
}
</style>