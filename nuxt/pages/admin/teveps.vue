<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="teveps"
                singular="Tevep"
                plural="Teveps"
                :edit-fluid="true"
            >
                <template #search-table-header>
                    <th>Nome</th>
                    <th>Data</th>
                </template>

                <template #search-table-item="{item}">
                    <td>{{ item.name }}</td>
                    <td>
                        <div>De {{ $filters.dateHuman(item.date_start) }}</div>
                        <div>Até {{ $filters.dateHuman(item.date_final) }}</div>
                    </td>
                </template>

                <template #edit-card="crud">
                    <div class="bg-white pa-3" style="margin: 0 -20px 0 -20px;">
                        <tevep-edit v-model="crud.edit" :area-width="1700" :method-save="crud.modelEdit.submit"></tevep-edit>
                        <pre>crud.edit: {{ crud.edit }}</pre>
                    </div>
                    <!-- <v-row>
                        <v-col size="12">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                        </v-col>
                    </v-row> -->
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>