<template><div>
    <form action="" @submit.prevent="submit()" style="max-width:800px;">
        <div class="row">
            <div class="col-12 col-md-4 mb-4">
                <user-card v-model="user">
                    <template #image>
                        <ui-photo v-model="user.photo">
                            <template #has-image><i class="fas fa-times"></i></template>
                            <template #no-image><i class="fas fa-camera-retro"></i></template>
                        </ui-photo>
                    </template>
                </user-card>
            </div>
    
            <div class="col-12 col-md-8">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" class="form-control" v-model="user.name">
                </div>
    
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control" v-model="user.email">
                </div>
            </div>
    
            <div class="col-12 text-right">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> &nbsp; Salvar
                </button>
            </div>
        </div>
    </form>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',

    head() {
        return {
            title: "Meus dados",
        };
    },

    data() {
        return {
            user: Object.assign({}, this.$auth.user),
        }
    },

    methods: {
        submit() {
            this.$axios.post('/api/user/save', this.user).then(resp => {
                location.reload();
            });
        },
    },

    mounted() {
        // console.log(this.$root);
    },
}
</script>