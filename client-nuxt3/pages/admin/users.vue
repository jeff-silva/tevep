<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud namespace="users" :actions-except="['clone', 'delete']">
                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">{{ item.email }}</div>
                    </td>
                </template>
                
                <!-- <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download"></v-btn>
                </template> -->

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="6">
                            <v-text-field label="Nome" v-model="crud.edit.name" :hide-details="true"></v-text-field>
                        </v-col>
                        <v-col cols="6">
                            <v-text-field label="E-mail" v-model="crud.edit.email" :hide-details="true"></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <app-model-select
                                v-model="crud.edit.address_id"
                                label="Endereço"
                                namespace="places"
                            ></app-model-select>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>