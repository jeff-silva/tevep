<template><div>
    <form @submit.prevent="passwordToken()">
        <slot name="token">
            <div class="input-group">
                <input type="text" class="form-control" v-model="post.email" placeholder="Seu e-mail">
                <div class="input-group-append"><div class="input-group-btn">
                    <button type="submit" class="btn btn-primary">
                        Enviar
                    </button>
                </div></div>
            </div>
            <small class="text-danger" v-if="error.email" v-html="error.email.join('<br>')"></small>
        </slot>
    </form>


    <div v-if="tokenGenerated">
        <div class="mb-3"></div>
        
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" v-model="post.token" placeholder="Token" @keyup.enter="tokenInformed=true;">
                <div class="input-group-append"><div class="input-group-btn">
                    <button type="button" class="btn btn-primary" @click="tokenInformed=true;">
                        Ok
                    </button>
                </div></div>
            </div>
            <small class="text-danger" v-if="error.token" v-html="error.token.join('<br>')"></small>
        </div>
        
        <form @submit.prevent="passwordReset()">
            <slot name="reset">
                <div v-if="tokenInformed">
                    <div class="form-group">
                        <ui-password v-model="post.password" placeholder="Senha"></ui-password>
                        <small class="text-danger" v-if="error.password" v-html="error.password.join('<br>')"></small>
                    </div>

                    <div class="form-group">
                        <ui-password v-model="post.password_confirmation" placeholder="Senha" :meter="false"></ui-password>
                        <small class="text-danger" v-if="error.password_confirmation" v-html="error.password_confirmation.join('<br>')"></small>
                    </div>
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary btn-block">Enviar</button>
                </div>
            </slot>
        </form>
    </div>

    <!-- <pre>{{ $store.$auth.user }}</pre> -->
</div></template>

<script>export default {
    name: 'ui-auth-password',

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
        passwordToken() {
            this.$axios.post('/api/auth/password-token', this.post).then((resp) => {
                if (resp.data.error) { return this.error = resp.data.error; }
                this.tokenGenerated = true;
            });
        },
        
        passwordReset() {
            this.error = {};
            this.$axios.post('/api/auth/password-reset', this.post).then((resp) => {
                if (resp.data.error) { return this.error = resp.data.error; }
                this.post = {email: '',password: '',password_confirmation: '',token: ''};
                this.$emit('success', resp.data);
            });
        },
    },

    data() {
        return {
            tokenGenerated: false,
            tokenInformed: false,
            error: {},
            post: {email: '',password: '',password_confirmation: '',token: ''},
        };
    },
};</script>