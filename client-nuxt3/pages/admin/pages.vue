<template>
    <div>
        <nuxt-layout name="admin">
            <ui-model-crud namespace="pages">
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

                <template #edit-fields="crud">
                    <v-row>
                        <v-col size="12">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                        </v-col>
                        
                        <v-col size="12">
                            <ui-content-edit v-model="crud.edit.content" @update:modelValue="$log"></ui-content-edit>
                            <pre>{{ crud.edit }}</pre>
                        </v-col>
                    </v-row>
                </template>
            </ui-model-crud>
        </nuxt-layout>
    </div>
</template>