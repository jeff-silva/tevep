<template><div>
    <form @submit.prevent="submit()">
        <slot name="content">
            <div class="form-group">
                <input type="text" class="form-control" v-model="post.email" placeholder="Seu e-mail">
            </div>

            <div class="form-group">
                <ui-password v-model="post.password" placeholder="Senha" :meter="false"></ui-password>
            </div>

            <div class="form-group text-right">
                <button type="submit" class="btn btn-primary">Login</button>
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
            this.$auth.loginWith('jwt', {data:this.post}).then((resp) => {
                if (resp.data.access_token) {
                    this.$emit('success', resp.data);
                }
            });
        },
    },

    data() {
        return {
            post: {
                email: '',
                password: '',
            },
        };
    },
};</script>