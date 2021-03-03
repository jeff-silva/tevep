<template><div>
    <div class="row no-gutters">
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

        <div class="col-6 col-md-4 px-1">
            <ui-auth-register></ui-auth-register>
        </div>

        <div class="col-12 col-md-4">
            <ui-auth-password></ui-auth-password>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {};
    },
}
</script>