<template>
    <div>
        <head>
            <title>{{ app.title }} | {{ app.settings['app.name'] }}</title>
        </head>

        <v-app>

            <!-- searchDrawer -->
            <v-navigation-drawer temporary position="right" v-model="searchDrawer" width="300">
                <v-card-header>
                    <v-card-title>Busca</v-card-title>
                </v-card-header>

                <div class="pa-2">
                    <v-text-field
                        label="Pesquisar"
                        v-model="search.params.q"
                        @keyup="search.submit({debounce:2000})"
                        :hide-details="true"
                        :loading="search.loading"
                        class="mb-3"
                    ></v-text-field>
                    <v-list v-if="search.resp">
                        <template v-for="i in search.resp">
                            <v-list-item :to="i.url">{{ i.name }}</v-list-item>
    
                            <template v-for="ii in i.data">
                                <v-list-item :to="ii.url">{{ ii.name || 'name' }}</v-list-item>
                            </template>
                        </template>
                    </v-list>
                </div>
            </v-navigation-drawer>
            
            <!-- notificationshDrawer -->
            <v-navigation-drawer temporary position="right" v-model="notificationshDrawer" width="300">
                <v-card-header>
                    <v-card-title>Notificações</v-card-title>
                </v-card-header>

                <v-list>
                    <v-list-item>
                        Sem notificações
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>

            <!-- userDrawer -->
            <v-navigation-drawer temporary position="right" v-model="userDrawer" width="300">
                <v-card-header>
                    <v-card-title>{{ app.user.name }}</v-card-title>
                </v-card-header>

                <v-card-text>
                    <pre>{{ app.user }}</pre>
                </v-card-text>
            </v-navigation-drawer>

            <!-- App drawer -->
            <v-navigation-drawer v-model="drawer">
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

                <app-nav :items="app.adminNav">
                    <template #append>
                        <template v-if="app.devMode">
                            <v-divider></v-divider>
    
                            <v-list-item
                                prepend-icon="mdi-wrench"
                                to="/admin/dev"
                                v-if="app.devMode"
                            >
                                Developers
                            </v-list-item>
                        </template>

                        <v-divider></v-divider>

                        <v-list-item
                            prepend-icon="mdi-power"
                            @click="app.logout().then(resp => $router.push('/auth'))"
                        >
                            Logout
                        </v-list-item>

                        <v-divider></v-divider>
                    </template>
                </app-nav>
            </v-navigation-drawer>

            <v-app-bar app>
                <v-app-bar-nav-icon
                    @click="drawer=true"
                    class="d-lg-none me-2"
                ></v-app-bar-nav-icon>
    
                <v-toolbar-title>
                    {{ app.title }}
                </v-toolbar-title>
    
                <v-spacer></v-spacer>
    
                <v-btn icon="mdi-magnify" @click="searchDrawer=!searchDrawer"></v-btn>
                <v-btn icon="mdi-bell" @click="notificationshDrawer=!notificationshDrawer"></v-btn>
                <v-btn icon="mdi-dots-vertical" @click="userDrawer=!userDrawer"></v-btn>
            </v-app-bar>

            <!-- Sizes your content based upon application components -->
            <v-main class="bg-grey-lighten-4">
                <div class="py-5">
                    <slot></slot>
                </div>
            </v-main>


            <!-- <v-footer app>
                Footer
            </v-footer> -->
        </v-app>
    </div>
</template>

<style>
.v-container:not(.v-container--fluid) {max-width:1200px;}
.layout-admin-actions-lg * {
    margin-left: 15px;
}
</style>

<script>
export default {
    data() {
        return {
            drawer: useWindowSize().width.value>1200,
            searchDrawer: false,
            notificationshDrawer: false,
            userDrawer: false,
            app: useApp(),
            search: useAxios({
                url: '/api/app/search',
                params: {q:''},
            }),
        };
    },
}
</script>