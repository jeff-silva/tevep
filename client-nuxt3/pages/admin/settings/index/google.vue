<template>
    <div>
        <v-row>
            <v-col cols="6">
                <v-text-field label="Google Analytics ID (GA4)" v-model="sets['google.ga4.id']"></v-text-field>
            </v-col>
            <v-col cols="6">
                <div class="d-flex align-center">
                    <div class="flex-grow-1">
                        <v-alert type="success" v-if="sets['google.account_json']">
                            Acesso configurado.
                            <a href="javascript:;" class="text-white float-end" @click="sets['google.account_json']=''">Limpar</a>
                        </v-alert>
                        <v-file-input v-else label="Google JSON account" @update:modelValue="accountJsonParse($event)" hide-details></v-file-input>
                    </div>

                    <div class="ms-2">
                        <v-menu anchor="start">
                            <template #activator="{ props }">
                                <v-btn flat icon="mdi-help-circle" v-bind="props"></v-btn>
                            </template>

                            <div class="" style="max-width:400px;">
                                <v-card>
                                    <v-card-text>
                                        <strong>Como gerar JSON</strong><br>
                                        Acesse <a href="https://console.cloud.google.com/iam-admin/serviceaccounts" target="_blank">https://console.cloud.google.com/iam-admin/serviceaccounts</a>.
                                        Crie uma <strong>conta de serviço</strong> e depois vá na aba "chaves" dentro da conta criada,
                                        Gere uma nova chave e faça download do arquivo JSON. <br>
                                        Depois, basta inserir o arquivo aqui.
                                    </v-card-text>
                                </v-card>
                            </div>
                        </v-menu>
                    </div>
                </div>
            </v-col>
        </v-row>
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

    methods: {
        accountJsonParse(files) {
            let file = files[0] || false;
            if (! file) return;
            let f =new FileReader();
            f.onload = () => { this.sets['google.account_json'] = f.result; };
            f.readAsText(file);
        },
    },

    data() {
        return {};
    },

    mounted() {
        useApp().setTitle('Configurações de arquivo');
    },
}
</script>