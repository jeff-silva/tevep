<template>
    <div>
        <nuxt-layout name="admin">
            <v-container>
                <pre>{{ endpoints }}</pre>
                <v-text-field label="Filtrar endpoints" v-model="filter" :hide-details="true"></v-text-field>
    
                <v-table>
                    <thead>
                        <tr>
                            <th width="40px"></th>
                            <th width="100px">Method</th>
                            <th>Route</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        <tr v-for="(r, i) in endpointsResp">
                            <td>{{ i }}</td>
                            <td>{{ r.methods.join(', ') }}</td>
                            <td>{{ r.uri }}</td>
                        </tr>
                    </tbody>
                </v-table>
            </v-container>
        </nuxt-layout>
    </div>
</template>

<script>
export default {
    data() {
        return {
            filter: '',
            endpoints: useAxios({
                method: 'get',
                url: '/api/app/endpoints',
                submit: true,
                resp: [],
            }),
        };
    },

    computed: {
        endpointsResp() {
            return (this.endpoints.resp || []).filter(item => {
                return JSON.stringify(item).toLowerCase().includes(this.filter.toLowerCase());
            });
        },
    },
};
</script>