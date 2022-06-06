<template>
    <div>
        <nuxt-layout name="admin">
            <app-model-crud
                namespace="emails-templates"
                singular="Template de e-mail"
                plural="Templates de e-mails"
                :actions-except="['clone', 'delete', 'new']"
                :table-actions="tableActions"
                :form-actions="formActions"
            >
                <template #search-table-header>
                    <th>Nome</th>
                </template>

                <template #search-table-item="{item}">
                    <td>{{ item.name }}</td>
                </template>

                <template #edit-fields="crud">
                    <v-row>
                        <v-col cols="12">
                            <v-text-field label="Nome" v-model="crud.edit.name" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <v-text-field label="Asunto" v-model="crud.edit.subject" :hide-details="true"></v-text-field>
                        </v-col>
                        
                        <v-col cols="12">
                            <app-html label="Corpo do e-mail" v-model="crud.edit.body"></app-html>
                            <div class="mt-2">
                                <template v-for="p in (crud.edit.params || [])">
                                    <v-chip class="me-2">{{ p.source }}</v-chip>
                                </template>
                            </div>
                        </v-col>
                    </v-row>
                </template>
            </app-model-crud>

            <v-dialog v-model="mailTestDialog">
                <v-card :title="mailTest.data.name" :subtitle="`Testar envio de ${mailTest.data.name} para:`" width="700px" max-width="90vw">
                    <v-progress-linear
                        indeterminate
                        v-if="mailTest.loading"
                    ></v-progress-linear>
                    <v-alert type="success" rounded="0" v-if="mailTest.status==200">Teste enviado</v-alert>
                    <v-alert type="error" rounded="0" v-if="mailTest.err.message">{{ mailTest.err.message }}</v-alert>
                    <v-card-text>
                        <v-text-field label="E-mail" hide-details v-model="mailTest.data.email"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn @click="mailTestOpen(false)">Fechar</v-btn>
                        <v-spacer></v-spacer>
                        <v-btn color="primary" @click="mailTest.submit()" :disabled="mailTest.loading">Enviar</v-btn>
                    </v-card-actions>
                </v-card>
            </v-dialog>

        </nuxt-layout>
    </div>
</template>

<script>
export default {
    methods: {
        mailTestOpen(data) {
            if (!data) {
                this.mailTestDialog = false;
                this.mailTest.status = false;
                this.mailTest.data = {id:'', name:''};
                return;
            }

            this.mailTestDialog = true;
            this.mailTest.data.id = data.id;
            this.mailTest.data.email = this.app.user.email;
        },
    },

    data() {
        return {
            tableActions: {
                clone: false,
                delete: false,
                test: {
                    icon: 'mdi-email-alert-outline',
                    click: (item) => {
                        this.mailTestOpen(item);
                    },
                },
            },
            formActions: {
                test: {
                    name: 'Testar e-mail',
                    icon: 'mdi-email-alert-outline',
                    click: (item) => {
                        this.mailTestOpen(item);
                    },
                },
            },
            app: useApp(),
            mailTest: {
                dialog: false,
                data: {},
            },
            mailTestDialog: false,
            mailTest: useAxios({
                method: 'post',
                url: '/api/emails-templates/test',
                data: {
                    id: '',
                    email: '',
                },
            }),
        };
    },
};
</script>