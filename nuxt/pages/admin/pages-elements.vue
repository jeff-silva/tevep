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

                    <v-tabs v-model="tabEdit">
                        <v-tab value="view">View</v-tab>
                        <v-tab value="edit">Editor</v-tab>
                    </v-tabs>
                    <v-window v-model="tabEdit">
                        <v-window-item value="view">
                            <v-row no-gutters>
                                <v-col>
                                    <div class="mt-2">Código</div>
                                    <app-code v-model="crud.edit.view_code" language="javascript" label="Aaa"></app-code>
                                    <div class="mt-2">Template</div>
                                    <app-code v-model="crud.edit.view_template" language="html"></app-code>
                                    <div class="mt-2">CSS</div>
                                    <app-code v-model="crud.edit.view_style" language="css"></app-code>
                                </v-col>
                                <v-col>bbb</v-col>
                            </v-row>
                        </v-window-item>
                        <v-window-item value="edit">
                            <v-row no-gutters>
                                <v-col>
                                    <div>Código</div>
                                    <app-code v-model="crud.edit.edit_code" language="javascript"></app-code>
                                    <div>Template</div>
                                    <app-code v-model="crud.edit.edit_template" language="html"></app-code>
                                    <div>CSS</div>
                                    <app-code v-model="crud.edit.edit_style" language="css"></app-code>
                                </v-col>
                                <v-col>bbb</v-col>
                            </v-row>
                        </v-window-item>
                    </v-window>

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