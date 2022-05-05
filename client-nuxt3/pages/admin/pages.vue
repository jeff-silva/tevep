<template>
    <div>
        <nuxt-layout name="admin">
            <ui-crud namespace="pages">
                <template #search-table-header>
                    <th>Nome</th>
                    <th width="100px">Mime</th>
                </template>

                <template #search-table-item="{item}">
                    <td>{{ item.name }}</td>
                    <td>{{ item.mime }}</td>
                </template>
                
                <!-- <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download"></v-btn>
                </template> -->

                <template #edit-fields="{item}">
                    <v-row>
                        <v-col size="12">
                            <v-text-field label="Nome" v-model="item.name"></v-text-field>
                        </v-col>
                    </v-row>
                </template>
            </ui-crud>
        </nuxt-layout>
    </div>
</template>