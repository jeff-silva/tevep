<template>
    <nuxt-layout name="test">
        <h1>App</h1>

        <button type="button" class="btn btn-primary me-1" @click="app.login({email:'root@grr.la', password:'321321'})">
            Login
        </button>
        
        <button type="button" class="btn btn-primary me-1" @click="app.logout()">
            Logout
        </button>

        <pre>app: {{ app }}</pre>
    </nuxt-layout>
</template>

<script setup>
const app = await useApp();
</script>