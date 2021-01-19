<template><div>
    <table class="table table-borderless table-striped">
        <thead>
            <tr>
                <th>Método</th>
                <th>Endpoint</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="e in endpoints">
                <td>{{ e.methods.join(' / ') }}</td>
                <td>{{ e.uri }}</td>
            </tr>
        </tbody>
    </table>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            endpoints: [],
        }
    },

    mounted() {
        this.$axios.get('/api/').then((resp) => {
            this.endpoints = resp.data;
        });
    },
}
</script>