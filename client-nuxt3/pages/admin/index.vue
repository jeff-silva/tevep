<template>
    <div>
        <nuxt-layout name="admin">
            <v-row>
                <v-col cols="4">
                    <v-card title="Formatos de arquivos existentes">
                        <v-card-text>
                            <app-chart v-model="filesFormats" :loading="dashboard.loading"></app-chart>
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    mounted() {
        useApp().setTitle('Dashboard');
    },

    computed: {
        filesFormats() {
            let labels = (this.dashboard.resp.filesFormats || []).map(item => item.ext);
            let series = (this.dashboard.resp.filesFormats || []).map(item => parseInt(item.total));
            return { labels, series, chart: { type: 'donut' }};
        },
    },

    data() {
        return {
            dashboard: useAxios({
                method: 'get',
                url: '/api/app/dashboard',
                resp: {},
                submit: true,
            }),
        };
    },
};
</script>