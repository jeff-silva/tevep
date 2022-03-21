<template>
    <div>
        <!-- Logged -->
        <div v-if="$auth.user">
            <nuxt-link :to="redirect||''" class="btn btn-primary w-100">
                Continuar como {{ $auth.user.name }}
            </nuxt-link>

            <div class="mb-2"></div>

            <ui-auth-logout class="btn btn-light w-100" redirect="/">
                Sair
            </ui-auth-logout>
        </div>

        <!-- Unlogged -->
        <form action="" @submit.prevent="submit()" v-else>
            <slot name="body">
                <ui-field label="Email">
                    <input type="text" class="form-control" v-model="post.email">
                </ui-field>
    
                <ui-field label="Senha">
                    <ui-password v-model="post.password"></ui-password>
                </ui-field>
            </slot>
    
            <slot name="action">
                <button type="submit" class="btn btn-primary w-100" v-loading="loading">
                    Entrar
                </button>
            </slot>

            <div v-if="error">
                <slot name="error">
                    <div class="text-danger text-center fw-bold mt-2">Usuário ou senha incorreto</div>
                </slot>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        redirect: {value:""},
    },

    data() {
        return {
            error: false,
            loading: false,
            post: {
                email: "",
                password: "",
            },
        };
    },

    methods: {
        submit() {
            this.error = false;
            this.loading = true;
            this.$auth.loginWith('jwt', {data:this.post}).then(resp => {
                this.loading = false;
                if (this.redirect) {
                    this.$router.push(this.redirect);
                }
            }).catch(err => {
                this.error = true;
                this.loading = false;
                console.log('Erro:', err);
            });
        },
    },
}
</script>