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
        <v-text-field label="E-mail"
            v-model="credentials.email"
            variant="underlined"
        ></v-text-field>

        <v-text-field label="Senha"
            v-model="credentials.password"
            variant="underlined"
            :type="showPassword? 'text': 'password'"
            :append-icon="showPassword? 'mdi-eye' : 'mdi-eye-off'"
            @click:append="showPassword = !showPassword"
        ></v-text-field>

        <div class="text-end">
            <v-btn color="primary" type="submit">
                Login
            </v-btn>
        </div>
    </form>
</template>

<script>
export default {
    props: {
        redirect: {default:false, type:[Boolean, String]},
    },

    data() {
        return {
            showPassword: false,
            credentials: {
                email: '',
                password: '',
            },
            app: useApp(),
        };
    },
}
</script>