<template><div>
    <div class="row no-gutters">
        <div class="col-2">
            <div class="nav nav-pills flex-column">
                <nuxt-link to="/test" class="nav-link">Home</nuxt-link>
                <nuxt-link to="/test" class="nav-link">Endpoints</nuxt-link>
                <nuxt-link to="/test" class="nav-link">Data generator</nuxt-link>
            </div>
        </div>
        <div class="col">
            
            <div class="row">
                <div class="col-12 bg-primary mb-4 text-white">
                    <div class="d-flex p-3" v-if="$store.$auth.user">
                        <div class="flex-grow-1">{{ $store.$auth.user.name }} - {{ $store.$auth.user.email }}</div>
                        <div><a href="javascript:;" @click="$auth.logout()" class="text-white">Sair</a></div>
                    </div>

                    <div class="p-3" v-else>Deslogado</div>
                </div>
                <div class="col-6 col-md-4">
                    <ui-auth-login></ui-auth-login>                    
                </div>
                <div class="col-6 col-md-4">
                    <ui-auth-register></ui-auth-register>
                </div>
                <div class="col-12 col-md-4">
                    <ui-auth-password></ui-auth-password>
                </div>
            </div>

            <table class="table table-borderless table-striped">
                <thead>
                    <tr>
                        <th>Método</th>
                        <th>Endpoint</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="e in endpoints">
                        <td>{{ e.methods.join(' / ') }}</td>
                        <td>{{ e.uri }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            endpoints: [],
        }
    },

    mounted() {
        this.$axios.get('/api/').then((resp) => {
            this.endpoints = resp.data;
        });
    },
}
</script>