<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="files"
                singular="Arquivo"
                plural="Arquivos"
                :item-actions="itemActions"
            >
                <template #search-table-header>
                    <th>Arquivo</th>
                    <th>Pasta</th>
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
                    <td>{{ item.folder }}</td>
                    <td>{{ item.mime }}</td>
                </template>

                <!-- Search fields -->
                <template #search-drawer="crud">
                    <template v-if="crud.search.resp.attributes">
                        <v-select
                            label="Pasta"
                            v-model="crud.search.params.in_folder"
                            :items="crud.search.resp.attributes.folders.map(item => item.name)"
                            @update:modelValue="crud.search.submit()"
                            hide-details
                        ></v-select>
                    </template>
                </template>

                <template #edit-form="crud">
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

<script>
export default {
    data() {
        return {
            itemActions(item) {
                return {
                    download() {
                        return {
                            icon: 'mdi-download',
                            href: item.url,
                            download: `${item.slug}.${item.ext}`,
                        };
                    },
                };
            },
        };
    },
};
</script>