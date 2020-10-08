<template><div>
    <form action="" style="max-width:400px; margin:0 auto;" @submit.prevent="login()">
        <h2>Cadastre-se <small>e comece a vender imediatamente.</small></h2>
        <div class="mb-3"></div>
        <div class="form-group">
            <input type="text" class="form-control input-lg" v-model="user.email" placeholder="Email">
            <!-- <small class="text-danger" v-html="error.name"></small> -->
        </div>
        <div class="form-group">
            <input type="password" class="form-control input-lg" v-model="user.password" placeholder="Senha">
            <!-- <small class="text-danger" v-html="error.email"></small> -->
        </div>

        <div class="text-right">
            <button type="submit" class="btn btn-primary">
                Login
            </button>
        </div>
    </form>
</div></template>

<script>
// import User from '@/models/User';

export default {
    layout: 'auth',

    data() {
        return {
            user: {
                email: '',
                password: '',
            },
        };
    },

    methods: {
        loginThen(resp) {
            location.reload();
        },
        loginCatch(error) {
            console.log(error);
        },
        async login() {
            try {
                this.$store.dispatch('auth/login', this.user).then((resp) => {
                    this.$router.push('/dashboard');
                })
            }
            catch(err) {
                // console.log(err);
            }
        },
    },
};</script>