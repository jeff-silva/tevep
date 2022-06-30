<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <h1>{{ app.settings['app.name'] }}</h1>
            </v-container>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            app: useApp(),
        };
    },
};
</script>