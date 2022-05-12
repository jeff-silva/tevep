<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud namespace="emails-templates" :actions-except="['clone', 'delete']">
                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{item}">
                    <td>{{ item.name }}</td>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field label="Nome" v-model="crud.edit.name" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <v-text-field label="Asunto" v-model="crud.edit.subject" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <app-code v-model="crud.edit.body"></app-code>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>