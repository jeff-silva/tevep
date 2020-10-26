<template><div>
    <div class="card">
        <div class="card-header">Recuperar senha</div>
        <div class="card-body">
            <ui-auth-password></ui-auth-password>
            <div class="row mt-3">
                <div class="col-12 col-md-6"><nuxt-link to="/auth/" class="btn btn-link btn-block">Login</nuxt-link></div>
                <div class="col-12 col-md-6"><nuxt-link to="/auth/register" class="btn btn-link btn-block">Cadastrar</nuxt-link></div>
            </div>
        </div>
    </div>
</div></template>

<script>export default {
    layout: 'auth',
    
    data() {
        return {};
    },
};</script>