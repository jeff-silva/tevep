<template>
    <div>
        <ui-form method="post" action="/api/auth/password-reset-start" v-model="post" v-if="step=='email'" @success="step='token'" #default="{loading, error, errorFields}">
            <ui-field label="Informe seu e-mail" :error="errorFields.email || error">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="post.email" placeholder="seu@email.com">
                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-primary" v-loading="loading">
                            Enviar
                        </button>
                    </div>
                </div>
            </ui-field>
        </ui-form>

        <ui-form method="post" action="/api/auth/password-reset-change" v-model="post" @success="step='success'" #default="{loading}" v-else>
            <ui-field label="Informe o token recebido" :error="error" v-if="step=='token'">
                <div class="input-group">
                    <input type="text" class="form-control" v-model="post.token" placeholder="Informe o código recebido" @keydown.enter.prevent="step='password'">
                    <div class="input-group-btn">
                        <button type="button" class="btn btn-primary" @click="step='password'" v-loading="loading">
                            Confirmar
                        </button>
                    </div>
                </div>
            </ui-field>

            <template v-if="step=='password'">
                <ui-field label="Informe a senha nova" :error="error">
                    <input type="password" class="form-control" v-model="post.password" placeholder="Senha">
                </ui-field>
    
                <ui-field label="Repita a senha nova" :error="error">
                    <input type="password" class="form-control" v-model="post.password_confirm" placeholder="Senha">
                </ui-field>
    
                <button type="submit" class="btn btn-primary w-100" v-loading="loading">
                    Enviar
                </button>
            </template>

            <div v-if="step=='success'">
                <slot name="success">
                    <div class="text-success fw-bold">Sua senha foi alterada.</div>
                    <div class="text-success">Faça login para prosseguir.</div>
                </slot>
            </div>
        </ui-form>
    </div>
</template>

<script>
export default {
    data() {
        let email = (new URLSearchParams(window.location.search)).get('email');

        return {
            step: (email? 'token': 'email'),
            error: {},
            success: false,
            post: { email },
        };
    },

    methods: {
        passwordResetStart() {
            this.error = false;
            this.$axios.post('/api/password-reset-start/', this.post).then(resp => {
                this.step = 'token';
            }).catch(err => this.error = err.response.data.message);
        },

        passwordResetchange() {
            this.error = false;
            this.$axios.post('/api/password-reset-change/', this.post).then(resp => {
                this.post.token = '';
                this.post.password = '';
                this.post.password_confirm = '';
                this.success = true;
            }).catch(err => this.error = err.response.data.message);
        },
    },
}
</script>