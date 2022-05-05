<template>
    <div>
        <nuxt-layout name="admin">
            <ui-crud namespace="users" :actions-except="['clone', 'delete']">
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

                <template #edit-fields="{item}">
                    <v-row>
                        <v-col size="6">
                            <v-text-field label="Nome" v-model="item.name"></v-text-field>
                        </v-col>
                        <v-col size="6">
                            <v-text-field label="E-mail" v-model="item.email"></v-text-field>
                        </v-col>
                    </v-row>
                </template>
            </ui-crud>
        </nuxt-layout>
    </div>
</template>