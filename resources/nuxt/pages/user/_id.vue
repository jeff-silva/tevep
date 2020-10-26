<template><div class="container">
    <form @submit.prevent="userStore()">
        <ui-input v-model="user.name" label="Nome" :error="error.name"></ui-input>
        <ui-input v-model="user.email" label="E-mail" :error="error.email"></ui-input>

        <div class="mt-2 text-right">
            <button type="submit" class="btn btn-primary">
                Salvar
            </button>
        </div>
    </form>
</div></template>

<script>
export default {
    layout: 'admin',

    methods: {
        userFind() {
            this.$axios.get('/api/user/find', {params:{id:this.$route.params.id}}).then((resp) => {
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
            error: {},
            user: {},
        }
    },

    mounted() {
        this.userFind();
    },
}
</script>
