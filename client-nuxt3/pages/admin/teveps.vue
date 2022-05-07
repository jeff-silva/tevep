<template>
    <div>
        <nuxt-layout name="admin">
            <ui-crud namespace="teveps">
                <template #search-table-header>
                    <th>Nome</th>
                    <th>Data</th>
                </template>

                <template #search-table-item="{item}">
                    <td>{{ item.name }}</td>
                    <td>
                        <div>De {{ $helpers.dateFormat(item.date_start) }}</div>
                        <div>Até {{ $helpers.dateFormat(item.date_final) }}</div>
                    </td>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col size="12">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                        </v-col>
                    </v-row>
                </template>
            </ui-crud>
        </nuxt-layout>
    </div>
</template>