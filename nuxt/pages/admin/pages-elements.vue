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
                            <v-text-field label="Tipo" v-model="crud.edit.type" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="12" md="8">
                                    <app-code label="Componente" v-model="crud.edit.comp" language="javascript"></app-code>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-input label="Preview"></v-input>
                                </v-col>
                            </v-row>
                        </v-col>
                        
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="12" md="8">
                                    <app-code label="Editor" v-model="crud.edit.edit" language="javascript"></app-code>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-input label="Preview"></v-input>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>

                    <!-- <pre>{{ crud }}</pre> -->
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>