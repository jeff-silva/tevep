<template>
    <div v-if="loaded">
        <ui-app ref="app">
            <template #content>
                <nuxt></nuxt>
            </template>

            <!-- <template #nav-header>
                <div class="py-5 text-center border-bottom">
                    Bem vindo {{ $auth.user.name }}
                </div>
            </template> -->

            <template #nav-body>
                <ui-nav :items="$store.state.admin.menu" @select="$refs.app.drawerClose()"></ui-nav>
            </template>

            <template #header>
                <div class="flex-grow-1"></div>

                <!-- <ui-autocomplete action="/api/app/search" :params="{q:'', limit:3}" style="max-width:300px;" class="ms-3 d-none d-md-block">
                    <template #input="{ params, loading, search }">
                        <div class="input-group form-control border-0 shadow-none p-0">
                            <input type="text" class="form-control bg-light border-0 shadow-none" v-model="params.q" placeholder="Buscar no sistema" @keyup.enter="search()">

                            <div class="input-group-btn">
                                <button type="button" class="btn btn-light border-0 rounded-0" @click="search()" v-loading="loading">
                                    <i class="fas fa-fw fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </template>

                    <template #response="{loading, response}">
                        <div class="bg-white shadow-sm">
                            <div v-for="r in response" v-if="r.items.length">
                                <div style="background:#ddd; padding:4px; font-size:14px;">{{ r.name }}</div>
                                <div v-for="i in r.items" style="overflow:hidden;">
                                    <nuxt-link :to="i.url" class="d-block p-1" style="color:#666; text-decoration:none;">
                                        {{ i.name }}
                                    </nuxt-link>
                                </div>
                            </div>
                        </div>
                    </template>
                </ui-autocomplete> -->

                <!-- <div class="ms-3">
                    <ui-dropdown type="bottom-right">
                        <i class="fas fa-fw fa-comment"></i>

                        <template #dropdown>
                            <div class="p-2" style="width:200px;">
                                Conversas
                            </div>
                        </template>
                    </ui-dropdown>
                </div> -->
                
                <!-- <div class="ms-3">
                    <ui-dropdown type="bottom-right">
                        <i class="fas fa-fw fa-bullhorn"></i>

                        <template #dropdown>
                            <div class="p-2" style="width:200px;">
                                Notificações
                            </div>
                        </template>
                    </ui-dropdown>
                </div> -->
                
                <div class="ms-3">
                    <ui-dropdown type="bottom-right">
                        {{ $auth.user.name }}

                        <template #dropdown>
                            <div class="list-group list-group-flush" style="width:150px;">
                                <nuxt-link to="/admin/user/me" class="list-group-item p-2">Meus dados</nuxt-link>
                                <ui-auth-logout class="list-group-item p-2">Sair</ui-auth-logout>
                            </div>
                        </template>
                    </ui-dropdown>
                </div>
            </template>
        </ui-app>
    </div>
</template>


<script>
// import Theme from './default/admin';
// import Theme from './flatable/admin';

export default {
    // extends: Theme,

    data() {
        return {
            loaded: false,
            admin_layout: (this.$store.state.settings['app.admin_layout'] || false),
        };
    },

    mounted() {
        if (this.admin_layout) this.$root.setLayout(this.admin_layout);
        this.loaded = true;
    },
}
</script>

<style>
/* @import url('//unpkg.com/bootswatch@5.1.3/dist/zephyr/bootstrap.min.css'); */
</style>