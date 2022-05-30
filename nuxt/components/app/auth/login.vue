<template>
    <div>
        <form @submit.prevent="app.login(credentials)">
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

        <div v-if="app.auths.length">
            <v-list>
                <v-list-item>Ou continuar como</v-list-item>
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