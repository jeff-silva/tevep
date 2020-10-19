<template><div>
    <table class="table table-borderless table-striped bg-white shadow-sm">
        <colgroup>
            <col width="200px">
            <col width="*">
        </colgroup>
        <thead>
            <tr>
                <th>Métodos</th>
                <th>Rota</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="r in routes">
                <td>{{ r.methods.join(', ') }}</td>
                <td>{{ r.uri }}</td>
            </tr>
        </tbody>
    </table>
</div></template>

<script>
export default {
	layout: 'admin',
    middleware: 'auth',

    data() {
        return {
            routes: [],
        };
    },

	mounted() {
        this.$axios.get('/api/').then((resp) => {
            this.routes = resp.data;
        });
    },
}
</script>