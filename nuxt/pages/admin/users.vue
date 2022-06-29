<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="users"
                singular="Usuário"
                plural="Usuários"
                :item-actions="{clone:false, delete:false, restore:false}"
            >
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
                <template #edit-form="crud">
                    <v-row>
                        <v-col cols="12" md="3">
                            <app-model-file v-model="crud.edit.photo_id"></app-model-file>
                        </v-col>
                        <v-col cols="12" md="9">
                            <app-tabs
                                :model-value="$route.query.tab || 'info'"
                                @update:model-value="$router.push({ query: { ...$route.query, tab: $event} });"
                                :items="[
                                    {value:'info', text:'Dados'},
                                    {value:'address', text:'Endereço'},
                                    {value:'settings', text:'Configurações'},
                                    {value:'password', text:'Senha'},
                                ]"
                            >
                                <template #info>
                                    <v-text-field
                                        label="Nome"
                                        v-model="crud.edit.name"
                                        :rules="crud.valid.rules('name', ['required'])"
                                    ></v-text-field>
                                    <v-text-field
                                        label="E-mail"
                                        v-model="crud.edit.email"
                                        :rules="crud.valid.rules('email', ['email'])"
                                    ></v-text-field>
                                    <app-model-select label="Grupo" v-model="crud.edit.group_id" namespace="users-groups"></app-model-select>
                                </template>
                                <template #address>
                                    <app-model-place label="Endereço" v-model="crud.edit.address_id"></app-model-place>
                                </template>
                                <template #settings>
                                    <v-row>
                                        <v-col cols="6" v-if="crud.edit.settings">
                                            <v-select
                                                v-model="crud.edit.settings.theme"
                                                label="Tema"
                                                :items="[{value:'light', title:'Light'}, {value:'dark', title:'Dark'}]"
                                                @update:model-value="changeTheme($event, crud.edit.id)"
                                            ></v-select>
                                        </v-col>
                                    </v-row>
                                </template>
                                <template #password>
                                    <v-text-field
                                        label="Senha"
                                        type="password"
                                        v-model="crud.edit.password"
                                    ></v-text-field>
                                    <v-text-field
                                        label="Repita senha"
                                        type="password"
                                        v-model="crud.edit.password_confirmation"
                                    ></v-text-field>
                                </template>
                            </app-tabs>
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
            tab: 'info',
            app: useApp(),
        };
    },
    methods: {
        changeTheme(theme, userId) {
            if (userId != this.app.user.id) return;
            this.$vuetify.theme.name = theme;
        },
    },
};
</script>