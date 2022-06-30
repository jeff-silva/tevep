<template>
    <div class="app-content">
        <v-btn @click="editView=true">Editar</v-btn>

        <v-overlay :model-value="editView" class="app-content">
            <v-row no-gutters style="width:100vw;">
                <v-col cols="3" style="height:100vh; overflow:auto; background:#f5f5f5; border-right:solid 4px #eee;">
                    <v-card elevation="0">
                        <v-card-title>
                            <span>Editor</span>
                            <v-spacer />
                            <v-btn icon flat @click="editView=false">
                                <v-icon>mdi-close</v-icon>
                            </v-btn>
                        </v-card-title>
                        <v-expansion-panels v-model="actionsView">

                            <!-- Tab editar seção -->
                            <v-expansion-panel value="section-edit" title="Editar Seção">
                                <v-expansion-panel-text>
                                    <div v-if="sectionEditData">
                                        <v-text-field
                                            v-model="sectionEditData.name"
                                            label="Nome"
                                            hide-details
                                        ></v-text-field>

                                        <div class="my-3"></div>
                                        <div
                                            v-for="s in sections"
                                            :key="$key(s)"
                                        >
                                            <app-content-compile
                                                v-if="sectionEditData.id==s.id"
                                                :is="s.edit.compiled"
                                                v-model="sectionEditData.value"
                                            ></app-content-compile>
                                        </div>
                                    </div>
                                    <div v-else class="text-center">
                                        <v-btn class="my-3" @click="actionsView='section-list-insert'">Inserir seção</v-btn>
                                    </div>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Seções inseridas -->
                            <v-expansion-panel value="section-list-edit" title="Seções inseridas">
                                <v-expansion-panel-text>
                                    <app-content-editor-list v-model="propsModelValue.sections">
                                        <template #item="{ item }">
                                            {{ item.name }}
                                        </template>
                                        <template #actions="{ item }">
                                            <v-btn icon="mdi-pencil" flat @click="sectionEdit(item)"></v-btn>
                                            <v-btn icon="mdi-delete" flat @click="sectionDelete(item)"></v-btn>
                                        </template>
                                    </app-content-editor-list>
                                    <v-btn class="mt-2" @click="actionsView='section-list-insert'" block>Inserir seção</v-btn>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Inserir seção -->
                            <v-expansion-panel value="section-list-insert" title="Inserir seção">
                                <v-expansion-panel-text>
                                    <app-content-editor-list v-model="sections" :reorder="false">
                                        <template #item="{ item }">
                                            {{ item.name }}
                                        </template>
                                        <template #actions="{ item }">
                                            <v-btn icon="mdi-plus" flat @click="sectionAdd(item)"></v-btn>
                                        </template>
                                    </app-content-editor-list>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Editar Layout -->
                            <v-expansion-panel value="layout-edit" title="Editar Layout">
                                <v-expansion-panel-text>
                                    <!--  -->
                                    <div
                                        v-for="l in layouts"
                                        :key="$key(l)"
                                    >
                                        <app-content-compile
                                            v-if="l.id==propsModelValue.layout.id"
                                            :is="l.edit.compiled"
                                            v-model="propsModelValue.layout.value"
                                        ></app-content-compile>
                                    </div>
                                </v-expansion-panel-text>
                            </v-expansion-panel>

                            <!-- Layouts -->
                            <v-expansion-panel value="layout-list" title="Layouts">
                                <v-expansion-panel-text>
                                    <app-content-editor-list v-model="layouts" :reorder="false">
                                        <template #item="{ item }">
                                            {{ item.name }}
                                        </template>
                                        <template #actions="{ item }">
                                            <v-btn icon="mdi-plus" flat @click="layoutSet(item)"></v-btn>
                                        </template>
                                    </app-content-editor-list>
                                </v-expansion-panel-text>
                            </v-expansion-panel>
                        </v-expansion-panels>
                    </v-card>

                    <slot name="sidebar"></slot>

                    <pre>sectionEditData: {{ sectionEditData }}</pre>
                </v-col>
                <v-col cols="9" style="height:100vh; overflow:auto; background:#ffffff;">
                    <app-content
                        v-model="propsModelValue"
                        @section-click="sectionEdit($event)"
                    ></app-content>
                </v-col>
            </v-row>
        </v-overlay>
    </div>
</template>

<script>
// import aaa from '../info';

const sections = [
    {
        name: 'Aaa',
        value: {},
        is: {
            template: `<div>aaa</div>`,
        },
    },
];

export default {
    props: {
        modelValue: {default:false, type:[Boolean, Object]},
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

        layoutSet(layout) {
            this.propsModelValue.layout = {
                id: layout.id,
                name: layout.name,
                value: {},
                is: layout.view.compiled,
            };

            this.layoutEdit(layout);
        },

        layoutEdit(layout) {
            this.actionsView = 'layout-edit';
        },

        sectionAdd(section) {
            const sectionNew = {
                id: section.id,
                name: section.name,
                value: {},
                is: section.view.compiled,
            };

            let value = this.propsModelValue;
            value.sections.push(sectionNew);
            this.propsModelValue = value;
            this.sectionEdit(sectionNew);
        },

        sectionEdit(section) {
            if (Array.isArray(section.value)) {
                section.value = {};
            }

            this.sectionEditData = section;
            this.actionsView = 'section-edit';
        },
        
        sectionDelete(section) {
            this.propsModelValue.sections.forEach((sect, index) => {
                if (section.id != sect.id) return;
                this.propsModelValue.sections.splice(index, 1);
            });
        },
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValueParse(this.modelValue); },
            set(value) { this.$emit('update:modelValue', value); },
        },
        layouts() {
            if (this.elements.resp && this.elements.resp.data) {
                return this.elements.resp.data.filter(item => item.type=='layout');
            }

            return [];
        },
        sections() {
            if (this.elements.resp && this.elements.resp.data) {
                return this.elements.resp.data.filter(item => item.type=='section');
            }

            return [];
        },
    },

    data() {
        return {
            editView: true,
            actionsView: 'section-list-insert',
            sectionEditData: false,
            elements: useAxios({
                method: 'get',
                url: '/api/pages-elements/search',
                submit: true,
                params: {per_page:100},
            }),
        };
    },
}
</script>

<style>
.app-content .v-expansion-panel {
    margin: 0 !important;
}
</style>