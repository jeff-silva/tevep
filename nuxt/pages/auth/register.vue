<template>
    <div>
        <nuxt-layout name="auth">
            <h2 class="mb-4">Cadastro</h2>
            <app-auth-register></app-auth-register>

            <div class="mt-2"></div>
            <nuxt-link class="d-block" to="/auth">Login</nuxt-link>
            <nuxt-link class="d-block" to="/auth/password">Esqueci minha senha</nuxt-link>
        </nuxt-layout>
    </div>
</template>