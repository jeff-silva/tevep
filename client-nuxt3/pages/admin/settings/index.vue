<template>
    <div>
        <nuxt-layout name="admin">
            <v-card>
                <v-tabs
                    v-model="tab"
                    background-color="gray"
                    @update:modelValue="$router.push(`/admin/settings/${$event}`)"
                >
                    <v-tab value="">Gerais</v-tab>
                    <v-tab value="email">E-mail</v-tab>
                    <v-tab value="files">Arquivos</v-tab>
                </v-tabs>
                <v-card-text>
                    <nuxt-child></nuxt-child>
                </v-card-text>
            </v-card>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: this.$route.path.replace('/admin/settings/', ''),
        };
    },

    watch: {
        $route: {deep:true, handler(value) {
            this.tab = value.path.replace('/admin/settings/', '');
        }},
    },
}
</script>