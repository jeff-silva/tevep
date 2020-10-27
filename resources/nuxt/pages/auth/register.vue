<template><div>
    <div class="card">
        <div class="card-header">Cadastre</div>
        <div class="card-body">
            <ui-auth-register @success="$swalSuccess('Sucesso', 'Cadastro efetuado. Por favor, faça login.')"></ui-auth-register>
            <div class="row mt-3">
                <div class="col-12 col-md-6"><nuxt-link to="/auth/" class="btn btn-link btn-block">Login</nuxt-link></div>
                <div class="col-12 col-md-6"><nuxt-link to="/auth/password" class="btn btn-link btn-block">Recuperar senha</nuxt-link></div>
            </div>
        </div>
    </div>
</div></template>

<script>export default {
    layout: 'auth',

    data() {
        return {
            error: {},
            success: false,
            post: this.postDefault(),
        };
    },

    methods: {
        postDefault() {
            return {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            };
        },

        register() {
            this.error = {};
            this.false = {};
            this.$axios.post('/api/auth/register', this.post).then((resp) => {
                if (resp.data.error) {
                    this.error = resp.data.error;
                    return;
                }
                this.post = this.postDefault();
                this.success = resp.data.success;
            });
        },
    },
};</script>
