<template>
    <div>
        <ui-field label="Tipo" layout="horizontal">
            <select class="form-control" v-model="value['mail.default']">
                <option value="smtp">SMTP</option>
            </select>
        </ui-field>

        <template v-if="value['mail.default']=='smtp'">
            <ui-field label="Host/porta" layout="horizontal">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="value['mail.mailers.smtp.host']">
                    <input type="text" class="form-control" v-model="value['mail.mailers.smtp.port']" style="max-width:100px;">
                </div>
            </ui-field>
    
            <ui-field label="Usuário" layout="horizontal">
                <input type="text" class="form-control" v-model="value['mail.mailers.smtp.username']">
            </ui-field>
    
            <ui-field label="Senha" layout="horizontal">
                <ui-password v-model="value['mail.mailers.smtp.password']"></ui-password>
            </ui-field>

            <div class="border-bottom border-light mb-3"></div>

            <ui-field label="De nome" layout="horizontal">
                <input type="text" class="form-control" v-model="value['mail.from.name']">
            </ui-field>

            <ui-field label="De e-mail" layout="horizontal">
                <input type="text" class="form-control" v-model="value['mail.from.address']">
            </ui-field>

            <div class="border-bottom border-light mb-3"></div>

            <ui-field layout="horizontal">
                <button type="button" class="btn btn-light" @click="modalEmailTest={to:$auth.user.email, subject:'Assunto', body:'Testando'}">
                    <i class="fas fa-fw fa-envelope"></i> Testar envio de e-mail
                </button>
            </ui-field>

            <ui-modal v-model="modalEmailTest">
                <template #header>Teste de envio de e-mail</template>

                <template #body>
                    <div class="alert alert-danger" v-if="modalEmailTest.error" v-html="modalEmailTest.error"></div>
                    <div class="alert alert-success" v-if="modalEmailTest.success">{{ modalEmailTest.success.failures.length }} erros</div>

                    <ui-field label="Enviar para">
                        <input type="text" class="form-control" v-model="modalEmailTest.to">
                    </ui-field>

                    <ui-field label="Assunto">
                        <input type="text" class="form-control" v-model="modalEmailTest.subject">
                    </ui-field>

                    <ui-field label="Mensagem">
                        <ui-html v-model="modalEmailTest.body"></ui-html>
                    </ui-field>
                </template>

                <template #footer>
                    <button type="button" class="btn btn-primary" @click="mailTestSend()">
                        Enviar
                    </button>
                </template>
            </ui-modal>

        </template>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Configurações de e-mail",
        };
    },

    props: {
        value: {default:()=>({})},
    },

    watch: {
        props: {deep:true, handler(value) {
            for(let i in value) this.$emit(i, value[i]);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
            modalEmailTest: false,
        };
    },

    methods: {
        mailTestSend() {
            delete this.modalEmailTest.error;
            delete this.modalEmailTest.success;
            this.$axios.post('/api/app/mail-test', this.modalEmailTest).then(resp => {
                this.modalEmailTest = {
                    success: resp.data,
                    ...this.modalEmailTest
                };
            }).catch(err => {
                this.modalEmailTest = {
                    error: err.response.data.message,
                    ...this.modalEmailTest
                };
            });
        },
    },
}
</script>