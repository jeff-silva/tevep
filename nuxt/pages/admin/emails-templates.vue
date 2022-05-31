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

            <v-dialog v-model="mailTest.dialog">
                <v-card :title="mailTest.data.name" :subtitle="`Testar envio de ${mailTest.data.name} para:`" width="900px" max-width="90vw">
                    <v-card-text>
                        <v-text-field label="E-mail" hide-details :model-value="app.user.email"></v-text-field>
                    </v-card-text>
                    <v-card-actions>
                        <v-btn color="primary" @click="mailTestOpen(false)">Enviar</v-btn>
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
                this.mailTest.dialog = false;
                this.mailTest.data = {};
                return;
            }

            this.mailTest.dialog = true;
            this.mailTest.data = data;
        },
    },

    data() {
        return {
            mailTest: {
                dialog: false,
                data: {},
            },
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
        };
    },
};
</script>