<template>
    <div>
        <nuxt-layout name="admin">
            <form @submit.prevent="formSubmit()" v-if="settings && settings.data && Object.keys(settings.data).length">
                <v-container>
                    <v-card>
                        <v-row>
                            <v-col cols="12" lg="2" class="pa-0 bg-grey-lighten-5 elevation-1">
                                <v-tabs
                                    v-model="tab"
                                    @update:modelValue="$router.push(`/admin/settings/${$event}`)"
                                    :direction="$vuetify.display.mobile? 'horizontal': 'vertical'"
                                >
                                    <v-tab
                                        v-for="(t, i) in tabs"
                                        :value="t.value"
                                        :key="i"
                                    >
                                        {{ t.name }}
                                    </v-tab>
                                </v-tabs>
                            </v-col>
                            <v-col cols="12" lg="10" class="pa-3 pa-lg-0 bg-white">
                                <template v-for="t in tabs">
                                    <div
                                        v-if="t.value==tab"
                                        class="pa-3 bg-grey-lighten-5 elevation-1 d-none d-lg-block text-uppercase font-weight-bold"
                                        :key="$key(t)"
                                    >{{ t.name }}</div>
                                </template>
                                <div class="px-3 py-5">
                                    <nuxt-child :settings="settings.data"></nuxt-child>
                                </div>
                            </v-col>
                        </v-row>
                    </v-card>
                </v-container>
                
                <app-actions>
                    <v-btn
                        type="submit"
                        icon="mdi-content-save"
                        :disable="settings.loading"
                    ></v-btn>
                </app-actions>
            </form>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tab: this.$route.path.replace('/admin/settings/', ''),
            settings: useAxios({method:'post', url:'/api/settings/save', data:{}}),
            tabs: [
                {
                    value: '',
                    name: 'Gerais',
                },
                {
                    value: 'email',
                    name: 'E-mail',
                },
                {
                    value: 'files',
                    name: 'Arquivos',
                },
                {
                    value: 'google',
                    name: 'Google',
                },
            ],
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