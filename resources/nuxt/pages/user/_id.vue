<template><div>

    <div v-if="loading">Carregando...</div>

    <form @submit.prevent="userStore()" v-if="user.id">
        <!-- <ui-photo v-model="user.meta.photo" ref="userPhoto">
            <template #has-image>&nbsp;</template>
            <template #no-image>&nbsp;</template>
        </ui-photo>

        <ui-photo v-model="user.meta.background" ref="userBackground">
            <template #has-image>&nbsp;</template>
            <template #no-image>&nbsp;</template>
        </ui-photo> -->

        <ui-form method="post" action="/api/user/save/" v-model="user" @success="success($event)" #default="{loading, success, error}">
            <div class="row no-gutters">
                <div class="col-12 col-md-4 mb-4 pr-3">
                    <user-card v-model="user">
                        <template #actions>
                            <a href="javascript:;" class="btn btn-light" @click="$refs.userPhoto.toggle()">Foto</a>
                            <a href="javascript:;" class="btn btn-light" @click="$refs.userBackground.toggle()">Background</a>
                        </template>
                    </user-card>
                </div>
                <div class="col-12 col-md-8">
                    <ui-field label="Nome">
                        <input type="text" class="form-control" v-model="user.name">
                    </ui-field>

                    <ui-field label="E-mail">
                        <input type="text" class="form-control" v-model="user.email">
                    </ui-field>

                    <ui-field label="Descrição">
                        <input type="text" class="form-control" v-model="user.description">
                    </ui-field>

                    <ui-field label="Senha">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-6">
                                <ui-password v-model="user.password" placeholder="Senha"></ui-password>
                            </div>
                            <div class="col-12 col-md-6 pl-md-2">
                                <ui-password v-model="user.password" placeholder="Repita a senha" :meter="false"></ui-password>
                            </div>
                        </div>
                    </ui-field>

                    <ui-field label="Whatsapp">
                        <ui-phone v-model="user.whatsapp"></ui-phone>
                    </ui-field>
                </div>
            </div>

            <ui-actions>
                <button type="submit" class="btn btn-primary">
                    <div v-if="loading"><span v-html="loading"></span> Salvando</div>
                    <div v-else><i class="fas fa-save"></i> Salvar</div>
                </button>
            </ui-actions>
        </ui-form>
    </form>
</div></template>

<script>
export default {
    layout: 'admin',

    methods: {
        userFind() {
            this.loading = true;
            let userId = this.$route.params.id=='me'? this.$auth.user.id: this.$route.params.id;
            this.$axios.get(`/api/user/find/${userId}`).then((resp) => {
                this.loading = false;
                this.user = resp.data;
            });
        },

        success(user) {
            this.$swal('', 'Dados salvos', 'success');
            if (user.id==this.$auth.user.id) {
                location.reload();
            }
        },
    },

    data() {
        return {
            loading: false,
            error: {},
            user: {},
        }
    },

    mounted() {
        this.userFind();
    },
}
</script>
