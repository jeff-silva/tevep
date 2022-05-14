<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <form @submit.prevent="formSubmit()" v-if="settings && settings.data && Object.keys(settings.data).length">
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
                            <nuxt-child :settings="settings.data"></nuxt-child>
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
            </v-container>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: this.$route.path.replace('/admin/settings/', ''),
            settings: useAxios({method:'post', url:'/api/settings/save', data:{}}),
        };
    },

    watch: {
        $route: {deep:true, handler(value) {
            this.tab = value.path.replace('/admin/settings/', '');
        }},
    },

    methods: {
        formSubmit() {
            this.settings.submit({method:'post', url:'/api/settings/save'}).then(resp => {
                location.reload();
            });
        },
    },

    async mounted() {
        this.settings.data = (await useAxios({url:"/api/settings/all"}).value.submit()).data;
    },
}
</script>