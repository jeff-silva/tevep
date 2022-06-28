<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-card :title="`Arquivos enviados - ${$filters.filesizeHuman(dashboard.resp? dashboard.resp.filesTotalSize: 0)}`">
                            <template #text>
                                <app-chart v-model="filesFormats" :loading="dashboard.loading"></app-chart>
                                <div class="mt-4 text-center" v-if="dashboard.resp.filesTotal">
                                    {{ dashboard.resp.filesTotal }} arquivos totalizando
                                    {{ $filters.filesizeHuman(dashboard.resp.filesTotalSize) }}
                                </div>
                            </template>
                        </v-card>
                    </v-col>
    
                    <v-col cols="12" md="6">
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
                <v-text-field label="Aaa" v-model="test.params.test" />
                <v-btn @click="test.submit()">submit</v-btn>
                <v-btn @click="test.cancel()">cancel</v-btn>
                <v-btn @click="test.reset()">reset</v-btn>
                <v-btn @click="test.clear()">clear</v-btn>
                <pre>test: {{ test }}</pre>
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
            test: useAxios2({
                method: 'get',
                url: '/api/app/dashboard',
                params: {test:1},
                resp: {},
                submit: true,
                onResponse(resp) {
                    console.log('resp:', resp);
                },
                onSubmit(req) {
                    req.params.test = Math.round(Math.random()*999);
                    req.resp = {};
                },
            }),
        };
    },
};
</script>