<template>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th width="50px"></th>
                    <th width="150px">Métodos</th>
                    <th>URI</th>
                    <th>Parâmetros</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(e, i) in endpoints">
                    <td>{{ i }}</td>
                    <td>{{ e.methods.join(' | ') }}</td>
                    <td>
                        <div>{{ e.uri }}</div>
                        <div v-if="e.name" class="text-muted">name: {{ e.name }}</div>
                    </td>
                    <td>{{ e.parameterNames.join(' | ') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    head() {
		return {
			title: "Endpoints",
		};
	},

    data() {
        return {
            endpoints: [],
        };
    },

    methods: {
        endpointsList() {
            this.$axios.get('/api/app/endpoints').then(resp => {
                this.endpoints = resp.data;
            });
        },
    },

    mounted() {
        this.endpointsList();
    },
}
</script>