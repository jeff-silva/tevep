<template><div v-if="value['mail.mailers.smtp.host']">
    <ui-field label="Host / Porta">
        <div class="row no-gutters">
            <div class="col-9"><input type="text" class="form-control" v-model="value['mail.mailers.smtp.host'].value"></div>
            <div class="col-3 pl-1"><input type="text" class="form-control" v-model="value['mail.mailers.smtp.port'].value"></div>
        </div>
    </ui-field>

    <ui-field label="Login">
        <input type="text" class="form-control" v-model="value['mail.mailers.smtp.username'].value">
    </ui-field>

    <ui-field label="Senha">
        <ui-password v-model="value['mail.mailers.smtp.password'].value" :meter="false"></ui-password>
    </ui-field>

    <div class="text-right">
        <button type="button" class="btn btn-outline-success" @click="emailTest={email:$auth.user.email, body:'Olá, este é um e-mail de teste.'}">
            Testar e-mail
        </button>
    </div>

    <ui-modal v-model="emailTest">
        <template #header>Teste de envio de e-mail</template>

        <template #body>
            <ui-field label="E-mail"><input type="text" class="form-control" v-model="emailTest.email"></ui-field>
            <ui-field label="Mensagem"><textarea class="form-control" v-model="emailTest.body"></textarea></ui-field>
        </template>

        <template #footer>
            <button type="button" class="btn btn-primary" @click="sendEmailTest()">
                <div v-if="emailTestLoading"><i class="fas fa-spin fa-spinner"></i> Enviando</div>    
                <div v-else><i class="fas fa-paper-plane mr-2"></i> Enviar</div>
            </button>
        </template>
    </ui-modal>
</div></template>

<script>
export default {
    props: {
        value: Object,
        error: [Object, Boolean],
    },

    data() {
        return {
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
    },
};
</script>