<template><div>
    <div v-if="!settings"><i class="fas fa-spin fa-spinner"></i> Carregando...</div>
    
    <ui-form method="post" action="/api/setting/save" v-model="settings" #default="{loading, success, error}" v-if="settings" @success="$swal('', 'Dados salvos', 'success')">
        <ui-field label="Host / Porta">
            <div class="row no-gutters">
                <div class="col-9"><input type="text" class="form-control" v-model="settings['mail.mailers.smtp.host'].value"></div>
                <div class="col-3 pl-1"><input type="text" class="form-control" v-model="settings['mail.mailers.smtp.port'].value"></div>
            </div>
        </ui-field>

        <ui-field :label="settings['mail.mailers.smtp.username'].description" :help="settings['mail.mailers.smtp.username'].help">
            <input type="text" class="form-control" v-model="settings['mail.mailers.smtp.username'].value">
        </ui-field>

        <ui-field :label="settings['mail.mailers.smtp.password'].description" :help="settings['mail.mailers.smtp.password'].help">
            <ui-password v-model="settings['mail.mailers.smtp.password'].value" :meter="false"></ui-password>
        </ui-field>

        <div class="text-right">
            <button type="button" class="btn btn-outline-success" @click="emailTest={email:$auth.user.email, body:'Olá, este é um e-mail de teste.'}">
                Testar e-mail
            </button>
        </div>

        <br>
        <ui-field :label="settings['jwt.ttl'].description">
            <div class="input-group">
                <input type="number" class="form-control" v-model="settings['jwt.ttl'].value">
                <div class="input-group-append"><div class="input-group-text">
                    Minutos
                </div></div>
            </div>
        </ui-field>

        <ui-actions>
            <button type="submit" class="btn btn-primary">
                Salvar <span v-html="loading"></span>
            </button>
        </ui-actions>

        <el-collapse :value="false" accordion class="mt-3">
            <el-collapse-item name="smtp" title="SMTP">
                <p>Para enviar e-mail pelo sistema, é necessário configurar uma caixa de e-mail como local de onde as mensagens partirão.</p>
                <p>Você pode configurar qualquer servidor, desde que saiba corretamente os dados de host e porta, juntamente com seu login e senha.</p>
            </el-collapse-item>
            <el-collapse-item name="smtp-gmail" title="SMTP Gmail">
                <p>Uma das maneiras mais simples de configurar é utilizando sua conta Gmail.</p>    
                <p>Para envio de email através de autenticação SMTP Gmail, siga os passos abaixo:</p>
                <ol class="my-3 mb-0">
                    <li>Acesse a conta de e-mail através do browser;</li>
                    <li>Clique em <a href="https://myaccount.google.com/?utm_source=OGB&tab=mk&utm_medium=act" target="_blank">Gerenciar sua conta do Google</a>;</li>
                    <li>Na lateral esquerda, clique em <a href="https://myaccount.google.com/security?gar=1" target="_blank">Segurança</a>;</li>
                    <li>Clique na opção "Verificação em duas etapas" e proceda com a confirmação de token;</li>
                    <li>Ao concluir, clique na opção "Senhas de app", no select que vai aparecer a seguir, selecione respectivamente "E-mail" e "Outro". Dê um nome personalizado para sua senha e clique em "Gerar".</li>
                </ol>
                <p>Essa será a senha que você vai precisar para que o sistema envie e-mails. <a href="javascript:;" @click="defaultSettings('gmail')">O padrão para conexão Gmail é host <strong>smtp.gmail.com</strong> porta <strong>465</strong></a>.</p>
            </el-collapse-item>
        </el-collapse>
    </ui-form>

    <ui-form method="post" action="/api/email/test" v-model="emailTest" #default="{loading, success}">
        <ui-modal v-model="emailTest">
            <template #header>Teste de envio de e-mail</template>

            <template #body>
                <div class="alert alert-success" v-if="success">E-mail enviado</div>

                <ui-field label="E-mail"><input type="text" class="form-control" v-model="emailTest.email"></ui-field>
                <ui-field label="Assunto"><input type="text" class="form-control" v-model="emailTest.subject"></ui-field>

                <div class="form-group">
                    <label>Mensagem</label>
                    <textarea class="form-control" v-model="emailTest.body"></textarea>
                </div>
            </template>

            <template #footer>
                <button type="submit" class="btn btn-primary">
                    <span v-if="loading" v-html="loading"></span>
                    <i v-else class="fas fa-paper-plane mr-2"></i>
                    Enviar
                </button>
            </template>
        </ui-modal>
    </ui-form>
</div></template>

<script>
export default {
    props: {
        value: Object,
        error: [Object, Boolean],
    },

    data() {
        return {
            settings: false,
            emailTestLoading: 0,
            emailTest: false,
        };
    },

    methods: {
        sendEmailTest() {
            this.emailTestLoading++;
            this.$axios.post('/api/settings/email-test', this.emailTest).then(resp2 => {
                this.emailTestLoading--;
                this.emailTest = false;
            });
        },

        defaultSettings(service) {
            let services = {
                gmail: {
                    'mail.mailers.smtp.host': 'smtp.gmail.com',
                    'mail.mailers.smtp.port': '465',
                },
            };

            if (services[service]) {
                for(let k in services[service]) {
                    this.value[k].value = services[service][k];
                }
            }
        },

        getSettingsAll() {
            this.$axios.get('/api/setting/all').then(resp => {
                this.settings = resp.data;
            });
        },
    },

    mounted() {
        this.getSettingsAll();
    },
};
</script>