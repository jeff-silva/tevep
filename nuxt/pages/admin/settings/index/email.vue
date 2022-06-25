<template>
    <div>
        <v-row>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Email"
                    hide-details
                    v-model="sets['mail.from.address']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="6">
                <v-text-field
                    label="Nome"
                    hide-details
                    v-model="sets['mail.from.name']"
                ></v-text-field>
            </v-col>

            <v-col cols="12">
                <v-divider />
            </v-col>

            <v-col cols="12">
                <v-select
                    label="Tipo de conexão"
                    hide-details
                    v-model="sets['mail.default']"
                    :items="['smtp']"
                ></v-select>
            </v-col>
            
            <v-col cols="12" md="8">
                <v-text-field
                    label="Host"
                    hide-details
                    v-model="sets['mail.mailers.smtp.host']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
                <v-text-field
                    label="Porta"
                    hide-details
                    v-model="sets['mail.mailers.smtp.port']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field
                    label="Usuário"
                    hide-details
                    v-model="sets['mail.mailers.smtp.username']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field
                    label="Senha"
                    hide-details
                    v-model="sets['mail.mailers.smtp.password']"
                ></v-text-field>
            </v-col>

            <v-col cols="12">
                <v-btn @click="testDialog=true">Testar</v-btn>
            </v-col>
        </v-row>

        <v-dialog v-model="testDialog">
            <form @submit.prevent="test.submit()">
                <v-card title="Teste de envio de e-mail" width="500px">
                    <v-card-text>
                        <v-alert type="error" class="mb-5" v-if="test.err.message">
                            {{ test.err.message }}
                        </v-alert>
                        <v-alert type="success" class="mb-5" v-if="test.status==200">
                            Teste enviado
                        </v-alert>
                        <v-text-field v-model="test.data.to" label="Para"></v-text-field>
                        <v-text-field v-model="test.data.subject" label="Assunto"></v-text-field>
                        <app-html v-model="test.data.body" label="Corpo do e-mail"></app-html>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            type="submit"
                            color="primary"
                            :loading="test.loading"
                            :disabled="test.loading"
                        >Enviar</v-btn>
                    </v-card-actions>
                </v-card>
            </form>
        </v-dialog>
    </div>
</template>

<script>
export default {
    props: {
        settings: Object,
    },

    computed: {
        sets() {
            return this.settings;
        },
    },

    data() {
        let app = useApp();
        return {
            testDialog: false,
            test: useAxios({
                method: 'post',
                url: '/api/app/mail-test',
                data: {
                    to: app.user.email,
                    subject: 'Testando e-mail',
                    body: `Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis adipisci totam optio quaerat quia eos odio alias eum! Nobis molestias maxime eaque sit cum ab voluptates illo reprehenderit culpa ipsum?`,
                },
            }),
        };
    },

    mounted() {
        useApp().setTitle('Configurações de e-mail');
    },
};
</script>