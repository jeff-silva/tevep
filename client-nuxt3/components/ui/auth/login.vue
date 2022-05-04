<template>
    <div v-if="app.user">
        <div class="mb-3">
            Você está logado como
            <span class="fw-bold">{{ app.user.name }}</span>.
        </div>

        <nuxt-link :to="redirect" class="btn btn-primary w-100 mb-3">
            Prosseguir
        </nuxt-link>

        <a href="javascrit:;" class="btn btn-light w-100" @click="app.logout()">
            Sair
        </a>
    </div>

    <form v-else @submit.prevent="app.login(credentials)">
        <ui-field label="Email">
            <input type="text" class="form-control" v-model="credentials.email">
        </ui-field>

        <ui-field label="Senha">
            <input type="password" class="form-control" v-model="credentials.password">
        </ui-field>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>

        <pre>$data: {{ $data }}</pre>
    </form>
</template>

<script>
export default {
    props: {
        redirect: {default:false, type:[Boolean, String]},
    },

    data() {
        return {
            credentials: {
                email: '',
                password: '',
            },
            app: useApp(),
        };
    },
}
</script>