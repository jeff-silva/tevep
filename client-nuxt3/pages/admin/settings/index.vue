<template>
    <div>
        <nuxt-layout name="admin">
            <form @submit.prevent="formSubmit()">
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
                        <nuxt-child :settings="settings"></nuxt-child>
                    </v-card-text>
                </v-card>
    
                <v-bottom-navigation style="margin-left:-15px;">
                    <v-btn
                        type="submit"
                        icon="mdi-content-save"
                        :disable="settings.loading"
                    ></v-btn>
                </v-bottom-navigation>
            </form>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: this.$route.path.replace('/admin/settings/', ''),
            settings: useAxios({url:"/api/settings/all", submit:true}),
        };
    },

    watch: {
        $route: {deep:true, handler(value) {
            this.tab = value.path.replace('/admin/settings/', '');
        }},
    },

    methods: {
        formSubmit() {
            this.settings.submit({method:'post', url:'/api/settings/save', data:this.settings.resp})
                .then(resp => { location.reload(); });
        },
    },
}
</script>