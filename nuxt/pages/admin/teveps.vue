<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="teveps"
                singular="Tevep"
                plural="Teveps"
                :edit-fluid="true"
                :search-params="{user_id:'me'}"
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
                    </div>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>