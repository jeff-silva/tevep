<template><div>
    <form @submit.prevent="submit()">
        <div class="alert alert-danger" v-if="error" v-html="error"></div>
        <slot name="content">
            <div class="form-group">
                <input type="text" class="form-control" v-model="post.email" placeholder="Seu e-mail">
            </div>

            <div class="form-group">
                <ui-password v-model="post.password" placeholder="Senha" :meter="false"></ui-password>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
        </slot>
    </form>
</div></template>

<script>export default {
    name: 'ui-auth-login',

    props: {
        value: {default:false},
    },

    // watch: {
    //     $props: {
    //         deep: true,
    //         handler(value) {
    //             this.props = Object.assign({}, value);
    //         },
    //     },
    // },

    methods: {
        submit() {
            this.error = false;
            this.$auth.loginWith('jwt', {data:this.post}).then((resp) => {
                if (resp.data.access_token) {
                    this.$emit('success', resp.data);
                }
            }).catch(err => {
                this.error = 'Usuário ou senha inválido';
            });
        },
    },

    data() {
        return {
            error: false,
            post: {
                email: '',
                password: '',
            },
        };
    },
};</script>