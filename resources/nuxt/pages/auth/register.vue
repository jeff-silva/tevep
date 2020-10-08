<template><div>
    <form @submit.prevent="register()">
        <h2>Cadastre-se <small>e comece a vender imediatamente.</small></h2>
        <div class="mb-3"></div>

        <div class="form-group">
            <label>Informe seu nome</label>
            <input type="text" class="form-control input-lg" v-model="post.name" placeholder="Nome">
            <small class="text-danger" v-html="error.name"></small>
        </div>

        <div class="form-group">
            <label>Qual seu email?</label>
            <input type="email" class="form-control input-lg" v-model="post.email" placeholder="Email">
            <small class="text-danger" v-html="error.email"></small>
        </div>

        <div class="form-group">
            <label>Crie uma senha</label>
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <input type="password" class="form-control input-lg" v-model="post.password" placeholder="Senha">
                    <ui-password-meter v-model="post.password" class="mt-1"></ui-password-meter>
                    <small class="text-danger" v-html="error.password"></small>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6">
                    <input type="password" class="form-control input-lg" v-model="post.password2" placeholder="Repita senha">
                    <small class="text-danger" v-html="error.password2"></small>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Qual a sua data de nasicmento?</label>
            <ui-datetime v-model="post.birth" :time="false"></ui-datetime>
            <small class="text-danger" v-html="error.birth"></small>
        </div>

        <div class="row align-items-center mb-3">
            <div class="col-xs-4 col-md-4">
                <label class="button-checkbox">
                    <button type="button" class="btn">Aceitar</button>
                    <input type="checkbox" value="1">
                </label>
            </div>
            <div class="col-xs-8 col-md-8">
                Clicando em <strong class="label label-primary">Cadastrar</strong>, você concorda com os <a href="javascript:;">Termos e condições</a> e uso de Cookies.
            </div>
        </div>
        
        <div class="row">
            <div class="col-xs-12 col-md-6"><input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
            <div class="col-xs-12 col-md-6"><a href="#" class="btn btn-success btn-block btn-lg">Sign In</a></div>
        </div>
    </form>
</div></template>

<script>export default {
    layout: 'auth',

    data() {
        return {
            error: {},
            post: {
                name: '',
                email: '',
                password: '',
                password2: '',
            },
        };
    },

    methods: {
        register() {
            this.error = {};
            this.$axios.post('/api/user/register', this.post).then((resp) => {
                if (resp.data.error) {
                    this.error = resp.data.error;
                    return;
                }
            });
        },
    },
};</script>
