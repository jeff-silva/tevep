<template>
    <div>
        <ui-form method="post"
            action="/api/auth/register"
            :params="post"
            #default="{loading, response, validate}"
            @success="post={}"
        >
            <div class="alert alert-success" v-if="response">
                Seu registro foi concluído. Agora é só fazer login :)
            </div>

            <slot name="fields">
                <ui-field label="Nome" :validate="validate.test('name')">
                    <input type="text" class="form-control" v-model="post.name" placeholder="Name">
                </ui-field>

                <ui-field label="E-mail" :validate="validate.test('email')">
                    <input type="text" class="form-control" v-model="post.email" placeholder="E-mail">
                </ui-field>

                <ui-field label="Senha" :validate="validate.test('password')">
                    <ui-password v-model="post.password" placeholder="Senha"></ui-password>
                </ui-field>

                <!-- <ui-field label="Repita a senha" :validate="validate.test('password_confirmation')">
                    <input type="password" class="form-control" v-model="post.password_confirmation" placeholder="Repita senha">
                </ui-field> -->
            </slot>

            <slot name="action">
                <button type="submit" class="btn btn-primary w-100" :disabled="loading" v-loading="loading">
                    Cadastrar
                </button>
            </slot>
        </ui-form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
            post: {},
        };
    },

    methods: {
        submit() {
            this.loading = true;
            this.$axios.post('/api/register', this.post).then(resp => {
                this.loading = false;
            }).catch(err => {
                this.loading = false;
            });
        },
    },
}
</script>