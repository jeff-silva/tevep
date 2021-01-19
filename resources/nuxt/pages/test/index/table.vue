<template><div>
    <ui-table :data="tableItems" :select="true" v-model="tableSelecteds" :loading="tableItemsLoading">
        <template #header="{items}">
            <th width="10px">ID</th>
            <th width="50%">Descrição</th>
            <th>Status</th>
        </template>

        <template #item="{item}">
            <td>{{ item.id }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.completed? 'Completo': '' }}</td>
        </template>

        <template #actions="{item}">
            <a href="" class="btn btn-primary"><i class="fa fa-fw fa-upload"></i></a>
            <a href="" class="btn btn-primary"><i class="fa fa-fw fa-download"></i></a>
        </template>

        <template #empty>
            Nenhum item encontrado
        </template>
    </ui-table>

    <ui-table :data="tableSelecteds" :select="false">
        <template #header="{items}">
            <th width="10px">ID</th>
            <th width="50%">Descrição</th>
            <th>Status</th>
        </template>

        <template #item="{item}">
            <td>{{ item.id }}</td>
            <td>{{ item.title }}</td>
            <td>{{ item.completed? 'Completo': '' }}</td>
        </template>

        <template #actions="{item}">
            <a href="" class="btn btn-primary"><i class="fa fa-fw fa-upload"></i></a>
            <a href="" class="btn btn-primary"><i class="fa fa-fw fa-download"></i></a>
        </template>

        <template #empty>
            Nenhum item encontrado
        </template>
    </ui-table>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            tableItemsLoading: false,
            tableItems: [],
            tableSelecteds: [],
        }
    },

    mounted() {
        this.tableItemsLoading = true;
        this.$axios.get('https://jsonplaceholder.typicode.com/todos').then(resp => {
            this.tableItems = resp.data;
            this.tableItemsLoading = false;
        });
    },
}
</script>