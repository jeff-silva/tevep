<template><div>

    <div v-if="loading">Carregando...</div>

    <form @submit.prevent="userStore()" v-if="user.id">
        <ui-photo v-model="user.meta.photo" ref="userPhoto">
            <template #has-image>&nbsp;</template>
            <template #no-image>&nbsp;</template>
        </ui-photo>

        <ui-photo v-model="user.meta.background" ref="userBackground">
            <template #has-image>&nbsp;</template>
            <template #no-image>&nbsp;</template>
        </ui-photo>

        <form @submit.prevent="userStore($event)">
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <user-card v-model="user">
                        <template #actions>
                            <a href="javascript:;" class="btn btn-light" @click="$refs.userPhoto.toggle()">Foto</a>
                            <a href="javascript:;" class="btn btn-light" @click="$refs.userBackground.toggle()">Background</a>
                        </template>
                    </user-card>
                </div>
                <div class="col-12 col-md-8">
                    <div class="bg-white shadow-sm p-3">
                        <ui-field v-model="user.name" label="Nome" v-bind="{type:'text', layout:'full', error:error.name}"></ui-field>
                        <ui-field v-model="user.email" label="E-mail" v-bind="{type:'email', layout:'full', error:error.email}"></ui-field>
                        <ui-field v-model="user.meta.description" label="Descrição" v-bind="{type:'text', layout:'full'}"></ui-field>
                        <ui-field label="Senha" v-bind="{layout:'full', error:error.password}">
                            <template #field>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="password" class="form-control" v-model="user.password">
                                        <ui-password-meter v-model="user.password"></ui-password-meter>
                                    </div>
                                    <div class="col-6"><input type="password" class="form-control"></div>
                                </div>
                            </template>
                        </ui-field>

                        <div class="pt-3 text-right">
                            <button type="submit" class="btn btn-primary">
                                Salvar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </form>
</div></template>

<script>
export default {
    layout: 'admin',

    methods: {
        userFind() {
            this.loading = true;
            let userId = this.$route.params.id=='me'? this.$auth.user.id: this.$route.params.id;
            this.$axios.get('/api/user/find', {params:{id:userId}}).then((resp) => {
                this.loading = false;
                this.user = resp.data;
            });
        },

        userStore() {
            this.$axios.post('/api/user/store', this.user).then((resp) => {
                if (resp.data.error) { return this.error = resp.data.error; }
                this.$swalSuccess('Sucesso', 'Dados salvos');
            });
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
