<template>
    <div>
        <nuxt-layout name="test">
            <template v-if="app.auth.user">
                <button type="button" class="btn btn-primary" @click="app.logout()">Logout</button>
            </template>

            <template v-else>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" class="form-control" v-model="auth.email" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Senha</label>
                    <input type="text" class="form-control" v-model="auth.password" placeholder="Senha">
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary" @click="app.login(auth)">Login</button>
                </div>
            </template>

            <pre>app: {{ app }}</pre>
            <pre>auth: {{ auth }}</pre>
        </nuxt-layout>
    </div>
</template>

<script setup>
let app = useApp();

const auth = ref({
    email: "root@grr.la",
    password: "321321",
});
</script>