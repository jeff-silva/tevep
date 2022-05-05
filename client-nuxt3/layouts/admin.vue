<template>
    <div>
        <head>
            <title>Admin</title>
        </head>

        <v-app>
            <v-navigation-drawer app>
                drawer
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

            <v-bottom-navigation v-model="value">
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