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

                    <app-tabs :items="[{value:'view', text:'View'}, {value:'editor', text:'Editor'}]">
                        <template #view>
                            <v-row no-gutters>
                                <v-col cols="12" md="6">
                                    <app-tabs :items="[{value:'codigo', text:'Código'}, {value:'template', text:'Template'}, {value:'css', text:'CSS'}]">
                                        <template #codigo>
                                            <app-code style="height:300px;" v-model="crud.edit.view_code" language="javascript" label="Aaa"></app-code>
                                        </template>
                                        <template #template>
                                            <app-code style="height:300px;" v-model="crud.edit.view_template" language="html"></app-code>
                                        </template>
                                        <template #css>
                                            <app-code style="height:300px;" v-model="crud.edit.view_style" language="css"></app-code>
                                        </template>
                                    </app-tabs>
                                </v-col>
                                <v-col cols="12" md="6" class="bg-grey">
                                    <div class="pa-3 bg-white font-weight-bold">Preview</div>
                                </v-col>
                            </v-row>
                        </template>
                        <template #editor>
                            <v-row no-gutters>
                                <v-col cols="12" md="6">
                                    <app-tabs :items="[{value:'codigo', text:'Código'}, {value:'template', text:'Template'}, {value:'css', text:'CSS'}]">
                                        <template #codigo>
                                            <app-code style="height:300px;" v-model="crud.edit.editor_code" language="javascript" label="Aaa"></app-code>
                                        </template>
                                        <template #template>
                                            <app-code style="height:300px;" v-model="crud.edit.editor_template" language="html"></app-code>
                                        </template>
                                        <template #css>
                                            <app-code style="height:300px;" v-model="crud.edit.editor_style" language="css"></app-code>
                                        </template>
                                    </app-tabs>
                                </v-col>
                                <v-col cols="12" md="6" class="bg-grey">
                                    <div class="pa-3 bg-white font-weight-bold">Preview</div>
                                </v-col>
                            </v-row>
                        </template>
                    </app-tabs>

                    <pre>{{ crud.edit }}</pre>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tabEdit: 'view',
        };
    },
};
</script>