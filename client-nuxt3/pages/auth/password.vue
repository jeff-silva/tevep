<template>
    <div>
        <nuxt-layout name="auth">
            <h2 class="mb-4">Esqueci minha senha</h2>
            <ui-auth-password></ui-auth-password>

            <div class="mt-2"></div>
            <nuxt-link class="d-block" to="/auth">Login</nuxt-link>
            <nuxt-link class="d-block" to="/auth/register">Criar cadastro</nuxt-link>
        </nuxt-layout>
    </div>
</template>