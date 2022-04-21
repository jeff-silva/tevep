<template>
    <ui-model-search
        model-name="users"
        singular="Usuário"
        plural="Usuários"
        :actions-except="['delete', 'clone']"
    >
        <template #table-header="">
            <td width="50px"></td>
            <td data-orderby="name">Nome</td>
        </template>

        <template #table-row="{item}">
            <td><ui-cover :src="item.photo_url" :acron="item.name"></ui-cover></td>
            <td>
                <div class="fw-bold">{{ item.name }}</div>
                <div class="text-muted">{{ item.email }}</div>
            </td>
        </template>
    </ui-model-search>
</template>

<script>
export default {
    head() {
        return {
            title: "Buscar usuários",
        };
    },
}
</script>