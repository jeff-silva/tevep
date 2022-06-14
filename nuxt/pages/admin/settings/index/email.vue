<template>
    <div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    label="Tipo de conexão"
                    :hide-details="true"
                    v-model="sets['mail.default']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="8">
                <v-text-field
                    label="Host"
                    :hide-details="true"
                    v-model="sets['mail.mailers.smtp.host']"
                ></v-text-field>
            </v-col>

            <v-col cols="12" md="4">
                <v-text-field
                    label="Porta"
                    :hide-details="true"
                    v-model="sets['mail.mailers.smtp.port']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field
                    label="Usuário"
                    :hide-details="true"
                    v-model="sets['mail.mailers.smtp.username']"
                ></v-text-field>
            </v-col>
            
            <v-col cols="12" md="6">
                <v-text-field
                    label="Senha"
                    :hide-details="true"
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
                        <v-text-field v-model="test.data.to" label="Para"></v-text-field>
                        <v-text-field v-model="test.data.subject" label="Assunto"></v-text-field>
                        <app-html v-model="test.data.body" label="Corpo do e-mail"></app-html>
                    </v-card-text>
                    <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn type="submit" color="primary">Enviar</v-btn>
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
        return {
            testDialog: false,
            test: useAxios({
                method: 'post',
                url: '/api/app/mail-test',
                data: {
                    to: '',
                    subject: '',
                    body: '',
                },
            }),
        };
    },

    mounted() {
        useApp().setTitle('Configurações de e-mail');
    },
};
</script>