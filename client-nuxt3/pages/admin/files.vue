<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud namespace="files" :actions-except="['clone']">
                <template #search-table-header>
                    <th width="50px"></th>
                    <th>Nome</th>
                    <th width="100px">Mime</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <v-avatar color="primary" class="elevation-2">
                            <img :src="item.url" alt="" v-if="item.type=='image'">
                            <span v-else class="text-uppercase">{{ item.ext }}</span>
                        </v-avatar>
                    </td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.mime }}</td>
                </template>
                
                <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download" :href="item.url" :download="`${item.slug}.${item.ext}`"></v-btn>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="12" md="8">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                            <v-text-field label="Pasta" v-model="crud.edit.folder"></v-text-field>
                        </v-col>
                        <v-col cols="12" md="4">
                            <img :src="crud.edit.url" :alt="crud.edit.name" v-if="crud.edit.type=='image'" style="width:100%; height:200px; object-fit:contain;" />
                            <v-file-input label="File input" :hide-details="true" @update:modelValue="crud.edit.content=$event[0]||null"></v-file-input>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>