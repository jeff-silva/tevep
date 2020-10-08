<template><div>
    <form @submit.prevent="userSave()">
        <fieldset><legend>Meus dados</legend>
            <ui-field type="photo" label="Foto" placeholder="Foto">
                <template #field>
                    <ui-photo v-model="user.photo"></ui-photo>
                </template>
            </ui-field>
            <ui-field type="text" label="Nome" placeholder="Seu nome" v-model="user.name"></ui-field>
            <ui-field type="email" label="Email" placeholder="nome@grr.la" v-model="user.email"></ui-field>
            <ui-field type="text" label="Aniversário" placeholder="31/12/1989" v-model="user.birth">
                <template #field>
                    <ui-datetime v-model="user.birth" :time="false"></ui-datetime>
                </template>
            </ui-field>

            <ui-field type="password" label="Senha" placeholder="123456">
                <template #hint>Sua senha será alterada caso você preencha estes campos.</template>

                <template #field>
                    <div class="row">
                        <div class="col-6">
                            <input type="password" class="form-control" v-model="user.password" placeholder="Senha">
                            <ui-password-meter v-model="user.password" class="mt-1"></ui-password-meter>
                        </div>
                        <div class="col-6"><input type="password" class="form-control" v-model="user.password2" placeholder="Repita a senha"></div>
                    </div>
                </template>
            </ui-field>

            <div class="text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-fw fa-save"></i> Salvar
                </button>
            </div>
        </fieldset>
    </form>

    <hr>

    <fieldset><legend>Meus endereços</legend>
        <ui-addresses reference="users"
            :ref-id="$store.state.auth.user.id"
            :load-on-start="false"
            ref="userAddresses"
        ></ui-addresses>
    </fieldset>
</div></template>

<script>
import { mapGetters, mapState } from 'vuex';

export default {
    layout: 'admin',
    middleware: 'auth',

    computed: {
        // ...mapGetters({
        //     user: 'auth/user',
        // }),
    },

    methods: {
        userSave() {
            this.$axios.post('/api/auth/save-me/', this.user).then((resp) => {
                location.reload();
            });
        },
    },

    data() {
        return {
            user: {},
            addresses: {},
        };
    },

    mounted() {
        this.$store.watch((state) => {
            this.user = Object.assign({}, state.auth.user);
            this.$refs.userAddresses.list();
        }, () => {}, {deep: true});
    },
};</script>