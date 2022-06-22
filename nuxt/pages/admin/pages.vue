<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="pages"
                singular="Página"
                plural="Páginas"
            >
                <template #search-table-header>
                    <th>Página</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="font-weight-bold">{{ item.name }}</div>
                        <div class="font-weight-thin">/{{ item.slug }}</div>
                    </td>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <app-content v-model="crud.edit.content" :edit="true" @update:modelValue="$log"></app-content>
                            <!-- <app-content :model-value="crud.edit.content"></app-content> -->
                            <pre>{{ crud.edit }}</pre>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>