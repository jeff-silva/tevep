<template><div>
    <form @submit.prevent="submit()">
        <slot name="content">
            <div class="form-group">
                <input type="text" class="form-control" v-model="post.name" placeholder="Nome">
                <small class="text-danger" v-if="error.name" v-html="error.name.join('<br>')"></small>
            </div>

            <div class="form-group">
                <input type="text" class="form-control" v-model="post.email" placeholder="E-mail">
                <small class="text-danger" v-if="error.email" v-html="error.email.join('<br>')"></small>
            </div>

            <div class="form-group">
                <ui-password v-model="post.password" placeholder="Senha"></ui-password>
                <small class="text-danger" v-if="error.password" v-html="error.password.join('<br>')"></small>
            </div>

            <div class="form-group">
                <ui-password v-model="post.password_confirmation" :meter="false" placeholder="Repita senha"></ui-password>
                <small class="text-danger" v-if="error.password_confirmation" v-html="error.password_confirmation.join('<br>')"></small>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </slot>
    </form>
</div></template>

<script>export default {
    name: 'ui-auth-register',

    props: {
        value: {default:false},
    },

    watch: {
        $props: {deep: true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    methods: {
        submit() {
            this.error = {};
            this.$axios.post('/api/auth/register/', this.post).then((resp) => {
                if (resp.data.error) { return this.error = resp.data.error; }
                this.post = {name: '', email: '', password: '', password_confirmation: ''};
                this.$emit('success', resp.data);
            });
        },
    },

    data() {
        return {
            error: {},
            post: {name: '', email: '', password: '', password_confirmation: ''},
        };
    },
};</script>