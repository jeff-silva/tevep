<template>
    <div>
        <nuxt-layout name="admin">
            <ui-crud namespace="pages">
                <template #search-table-header>
                    <th>Página</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">/{{ item.slug }}</div>
                    </td>
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