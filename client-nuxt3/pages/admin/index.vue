<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <v-row>
                    <v-col cols="6">    
                        <v-card title="Arquivos enviados">
                            <template #text>
                                <app-chart v-model="filesFormats" :loading="dashboard.loading"></app-chart>
                                <div class="mt-2" v-if="dashboard.resp.filesTotal">
                                    {{ dashboard.resp.filesTotal }} arquivos totalizando
                                    {{ $filters.filesizeHuman(dashboard.resp.filesTotalSize) }}
                                </div>
                            </template>
                        </v-card>
                    </v-col>
    
                    <v-col cols="6">
                        <v-card title="Usuários">
                            <v-card-text>
                                <v-table>
                                    <tbody>
                                        <tr>
                                            <th>Usuários cadastrados</th>
                                            <td>{{ dashboard.resp.usersTotal }}</td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
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