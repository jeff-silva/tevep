<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud namespace="files" :actions-except="['clone', 'add']">
                <template #search-table-header>
                    <th>ARquivo</th>
                    <th width="100px">Mime</th>
                </template>

                <template #search-table-item="{item}">
                    <td>
                        <div class="d-flex align-center">
                            <v-avatar color="grey-lighten-4" class="elevation-2">
                                <img :src="item.url" alt="" v-if="item.type=='image'" style="height:40px;">
                                <span v-else class="text-uppercase">{{ item.ext }}</span>
                            </v-avatar>
                            <div class="ms-3">{{ item.name }}</div>
                        </div>
                    </td>
                    <td>{{ item.mime }}</td>
                </template>
                
                <template #search-table-item-actions="{item}">
                    <v-btn icon="mdi-download" :href="item.url" :download="`${item.slug}.${item.ext}`"></v-btn>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="12" md="4">
                            <app-model-file return-type="object" v-model="crud.edit" @update:modelValue="$router.push(`/admin/files?id=${event.id}`);"></app-model-file>
                        </v-col>
                        <v-col cols="12" md="8">
                            <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                            <v-text-field label="Pasta" v-model="crud.edit.folder"></v-text-field>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>