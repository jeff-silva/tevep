<!-- Clone from auth/index.vue -->

<template><div>
    <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
            <ui-auth-login @success="onSuccess()"></ui-auth-login>
            <div class="row mt-3">
                <div class="col-12 col-md-6"><nuxt-link to="/auth/register" class="btn btn-link btn-block">Cadastrar</nuxt-link></div>
                <div class="col-12 col-md-6"><nuxt-link to="/auth/password" class="btn btn-link btn-block">Recuperar senha</nuxt-link></div>
            </div>
        </div>
    </div>
</div></template>

<script>
export default {
    layout: 'auth',

    methods: {
        onSuccess() {
            let redirect = this.$route.query.redirect||'/dashboard';
            this.$router.push({path:redirect});
        },
    },
};</script>