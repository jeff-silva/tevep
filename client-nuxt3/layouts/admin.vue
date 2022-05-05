<template>
    <div>
        <head>
            <title>Admin</title>
        </head>

        <v-app>
            <v-navigation-drawer app>
                <v-list>
                    <!-- <v-list-item class="px-2">
                        <v-list-item-avatar>
                            <v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
                        </v-list-item-avatar>
                    </v-list-item> -->

                    <v-list-item link>
                        <v-list-item-content>
                            <v-list-item-title class="text-h6">
                                {{ app.user.name }}
                            </v-list-item-title>
                            <v-list-item-subtitle>{{ app.user.email }}</v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>

                <v-divider></v-divider>

                <ui-nav :items="navItems"></ui-nav>
            </v-navigation-drawer>

            <v-app-bar app>
                app-bar
            </v-app-bar>

            <!-- Sizes your content based upon application components -->
            <v-main style="background:#f5f5f5;">
                <v-container fluid>
                    <slot></slot>
                </v-container>
            </v-main>

            <!-- <v-footer app>
                Footer
            </v-footer> -->
        </v-app>
    </div>
</template>

<style>
.layout-admin-actions-lg * {
    margin-left: 15px;
}
</style>

<script>
export default {
    data() {
        return {
            navItems: [
                {to: '/admin', icon :'mdi-view-dashboard', label :'Dashboard'},
                {icon :'mdi-view-dashboard', label :'Teveps', children: [
                    {icon :'mdi-view-dashboard', label :'Procurar', to:'/admin/teveps'},
                    {icon :'mdi-view-dashboard', label :'Novo', to:'/admin/teveps?id=new'},
                ]},
                {icon :'mdi-view-dashboard', label :'Páginas', children: [
                    {icon :'mdi-view-dashboard', label :'Procurar', to:'/admin/pages'},
                    {icon :'mdi-view-dashboard', label :'Novo', to:'/admin/pages?id=new'},
                ]},
                {icon :'mdi-view-dashboard', label :'Usuários', children: [
                    {icon :'mdi-view-dashboard', label :'Procurar', to:'/admin/users'},
                    {icon :'mdi-view-dashboard', label :'Novo', to:'/admin/users?id=new'},
                ]},
                {icon :'mdi-view-dashboard', label :'Configurações', children: [
                    {to: '/admin/settings', icon :'file-search-outline', label :'Configurações'},
                    {to: '/admin/files', icon :'file-search-outline', label :'Arquivos'},
                    {to: '/admin/places', icon :'file-search-outline', label :'Endereços'},
                ]},
            ],
            app: useApp(),
        };
    },
}
</script>