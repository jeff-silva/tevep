<template>
    <div>
        <head>
            <title>Admin</title>
        </head>

        <v-app>
            <v-navigation-drawer app>
                <v-list>
                    <v-list-item class="px-2">
                        <v-list-item-avatar>
                        <v-img src="https://randomuser.me/api/portraits/women/85.jpg"></v-img>
                        </v-list-item-avatar>
                    </v-list-item>

                    <v-list-item link>
                        <v-list-item-content>
                        <v-list-item-title class="text-h6">
                            Sandra Adams
                        </v-list-item-title>
                        <v-list-item-subtitle>sandra_a88@gmail.com</v-list-item-subtitle>
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
            <v-main>
                <v-container fluid>
                    <slot></slot>
                </v-container>
            </v-main>

            <v-bottom-navigation>
                <slot name="actions"></slot>
            </v-bottom-navigation>

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
                {label: 'Locais', icon: 'mdi-view-dashboard', children: [
                    {label: 'Brasil', icon: 'mdi-view-dashboard', children: [
                        {label: 'Minas Gerais', icon: 'mdi-view-dashboard', children: [
                            {label: 'Belo Horizonte', icon: 'mdi-view-dashboard', to:'?page=belo-horizonte', children: []},
                        ]},
                        {label: 'Varginha', icon: 'mdi-view-dashboard', to:'?page=varginha', children: []},
                    ]},
                    {label: 'Argentina', to:'?page=argentina', children: []},
                ]},
            ],
        };
    },
}
</script>