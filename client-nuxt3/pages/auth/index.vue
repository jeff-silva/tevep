<template>
    <div>
        <nuxt-layout name="auth">
            <h2 class="mb-4">Login</h2>
            <ui-auth-login redirect="/admin"></ui-auth-login>

            <div class="mt-2"></div>
            <nuxt-link class="d-block" to="/auth/register">Criar cadastro</nuxt-link>
            <nuxt-link class="d-block" to="/auth/password">Esqueci minha senha</nuxt-link>
        </nuxt-layout>
    </div>
</template>