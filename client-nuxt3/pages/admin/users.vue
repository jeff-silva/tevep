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

                <!-- Edit -->
                <template #edit-fields="crud">
                    <v-tabs v-model="tab" class="mb-4">
                        <v-tab value="home">Dados</v-tab>
                        <v-tab value="address">Endereço</v-tab>
                    </v-tabs>

                    <v-window v-model="tab">
                        <v-window-item value="home">
                            <v-row>
                                <v-col cols="12" md="4">
                                    <app-model-file v-model="crud.edit.photo_id"></app-model-file>
                                </v-col>
                                <v-col cols="12" md="8">
                                    <v-text-field label="Nome" v-model="crud.edit.name"></v-text-field>
                                    <v-text-field label="E-mail" v-model="crud.edit.email"></v-text-field>
                                    <app-model-select label="Grupo" v-model="crud.edit.group_id" namespace="users-groups"></app-model-select>
                                    <div class="d-flex">
                                        <v-text-field label="Senha" type="password" v-model="crud.edit.password"></v-text-field>
                                        <v-text-field label="Repita senha" type="password" v-model="crud.edit.password_confirmation" class="ms-2"></v-text-field>
                                    </div>
                                </v-col>
                            </v-row>
                        </v-window-item>
                        <v-window-item value="address">
                            <app-model-place label="Endereço" v-model="crud.edit.address_id"></app-model-place>
                        </v-window-item>
                    </v-window>
                </template>
            </app-model-crud>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: 'home',
        };
    },
};
</script>