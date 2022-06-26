<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="pages-elements"
                singular="Elementos de página"
                plural="Elementos de páginas"
            >
                <template #search-table-header>
                    <th>Página</th>
                    <th>Tipo</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">/{{ item.slug }}</div>
                    </td>
                    <td>{{ item.type }}</td>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="12" md="8">
                            <v-text-field label="Nome" v-model="crud.edit.name" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12" md="4">
                            <v-select v-model="crud.edit.type" hide-details label="Tipo" :items="['layout', 'section']"></v-select>
                        </v-col>
                    </v-row>

                    <div class="my-3"></div>

                    <v-row v-if="crud.edit.edit && crud.edit.view">
                        <v-col cols="12" md="6">
                            <div class="font-weight-bold">Edição</div>
                            <app-tabs :items="[{value:'template', text:'Template'}, {value:'script', text:'Script'}, {value:'style', text:'CSS'}]">
                                <template #template>
                                    <app-code
                                        v-model="crud.edit.edit.template"
                                        style="height:300px;"
                                        language="html"
                                        :filter="filterTemplate"
                                    ></app-code>
                                </template>
                                <template #script>
                                    <app-code
                                        v-model="crud.edit.edit.script"
                                        style="height:300px;"
                                        language="javascript"
                                    ></app-code>
                                </template>
                                <template #style>
                                    <app-code
                                        v-model="crud.edit.edit.style"
                                        style="height:300px;"
                                        language="css"
                                    ></app-code>
                                </template>
                            </app-tabs>

                            <app-content-compile
                                :is="crud.edit.edit.compiled"
                                :onthefly="crud.edit.edit"
                                v-model="valueEdit"
                            ></app-content-compile>
                        </v-col>

                        <v-col cols="12" md="6">
                            <div class="font-weight-bold">View</div>
                            <app-tabs :items="[{value:'template', text:'Template'}, {value:'script', text:'Script'}, {value:'style', text:'CSS'}]">
                                <template #template>
                                    <app-code
                                        v-model="crud.edit.view.template"
                                        style="height:300px;"
                                        language="html"
                                        :filter="filterTemplate"
                                    ></app-code>
                                </template>
                                <template #script>
                                    <app-code
                                        v-model="crud.edit.view.script"
                                        style="height:300px;"
                                        language="javascript"
                                    ></app-code>
                                </template>
                                <template #style>
                                    <app-code
                                        v-model="crud.edit.view.style"
                                        style="height:300px;"
                                        language="css"
                                    ></app-code>
                                </template>
                            </app-tabs>

                            <app-content-compile
                                :is="crud.edit.view.compiled"
                                :onthefly="crud.edit.view"
                                v-model="valueEdit"
                            ></app-content-compile>
                        </v-col>
                    </v-row>

                    <pre>{{ valueEdit }}</pre>
                    <pre>{{ crud.edit }}</pre>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>

<script>
import VRuntimeTemplate from 'vue3-runtime-template';

export default {
    components: { VRuntimeTemplate },
    data() {
        return {
            tabEdit: 'view',
            valueEdit: {},
        };
    },
    methods: {
        filterTemplate(value) {
            return value.replace(/`/g, '\\`');
        },
    },
};
</script>