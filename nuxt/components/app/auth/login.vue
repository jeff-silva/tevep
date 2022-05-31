<template>
    <div>
        <form @submit.prevent="app.login(credentials).then(resp => $router.push(redirect))">
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

        <div class="mt-5" v-if="app.auths.length">
            <v-divider></v-divider>
            <v-list>
                <v-list-subheader>Ou continuar como</v-list-subheader>
                <v-list-item v-for="(a, i) in app.auths" :key="i">
                    <div class="d-flex" style="width:100%;">
                        <div class="flex-grow-1">
                            <v-btn @click="app.authSwitch(a.email)" block flat>
                                {{ a.email }}
                            </v-btn>
                        </div>
                        <v-btn @click="app.authRemove(a.email)" flat>Sair</v-btn>
                    </div>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
        </div>
    </div>
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