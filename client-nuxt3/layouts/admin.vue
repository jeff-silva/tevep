<template>
    <div>
        <head>
            <title>Admin</title>
        </head>

        <v-app>
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
                <div class="d-lg-none me-2">
                    <v-btn icon="mdi-menu" @click="drawer=true"></v-btn>
                </div>

                <div class="d-none d-md-block me-2">
                    <v-menu anchor="bottom">
                        <template #activator="{ props }">
                            <v-btn icon="mdi-magnify" v-bind="props"></v-btn>
                        </template>
                        
                        <div class="bg-white elevation-1 mt-2" style="width:300px;">
                            <v-text-field
                                label="Busca"
                                v-model="search.params.q"
                                @keyup="search.submit({debounce:2000})"
                                :hide-details="true"
                            ></v-text-field>
                            <v-progress-linear
                                indeterminate
                                v-if="search.loading"
                            ></v-progress-linear>
                            <v-list v-if="search.resp">
                                <template v-for="i in search.resp">
                                    <v-list-item :to="i.url">{{ i.name }}</v-list-item>
        
                                    <template v-for="ii in i.data">
                                        <v-list-item :to="ii.url">{{ ii.name || 'name' }}</v-list-item>
                                    </template>
                                </template>
                            </v-list>
                        </div>
                    </v-menu>
                </div>
                
                <div>{{ app.settings['app.name'] }}</div>
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
            drawer: useWindowSize().width.value>1200,
            app: useApp(),
            search: useAxios({
                url: '/api/app/search',
                params: {q:''},
            }),
        };
    },
}
</script>