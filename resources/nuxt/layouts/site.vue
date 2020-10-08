<template><div>
    <ui-navbar v-bind="{fixedTop:true}">
        <template #logo>
            <nuxt-link to="/" class="navbar-brand">Home</nuxt-link>
        </template>

        <template #content>
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active"><nuxt-link class="nav-link" to="/auth">Login</nuxt-link></li>
                <li class="nav-item active"><nuxt-link class="nav-link" to="/auth/register">Cadastre-se</nuxt-link></li>
                <li class="nav-item active"><nuxt-link class="nav-link" to="/auth/password">Recuperar senha</nuxt-link></li>
                <li class="nav-item"><nuxt-link class="nav-link" to="/test">Test</nuxt-link></li>
                <li class="nav-item"><nuxt-link class="nav-link" to="/dashboard">Dashboard</nuxt-link></li>
            </ul>
        </template>
    </ui-navbar>
    <br><br><br><br>
    
    <nuxt />
</div></template>

<script>export default {
    data() {
        return {};
    },
};</script>