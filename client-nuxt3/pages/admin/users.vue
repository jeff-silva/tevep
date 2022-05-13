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
                        <v-col cols="12" md="4">
                            <app-model-file v-model="crud.edit.photo_id"></app-model-file>
                        </v-col>
                        <v-col cols="12" md="8">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                            <v-text-field label="E-mail" v-model="crud.edit.email"></v-text-field>
                            <app-model-place label="Endereço" v-model="crud.edit.address_id"></app-model-place>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>