<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="emails-templates"
                singular="Template de e-mail"
                plural="Templates de e-mails"
                :actions-except="['clone', 'delete', 'new']"
                :table-actions="{test:{name:'Test', icon:'mdi-pencil'}}"
            >
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
                            <app-html label="Corpo do e-mail" v-model="crud.edit.body"></app-html>
                            <div class="mt-2">
                                <template v-for="p in (crud.edit.params || [])">
                                    <v-chip class="me-2">{{ p.source }}</v-chip>
                                </template>
                            </div>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>