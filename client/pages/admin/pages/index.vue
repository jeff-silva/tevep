<template>
    <div>
        <ui-model-search model-name="pages" singular="Página" plural="Páginas">
            <template #table-header="">
                <td data-orderby="name">Página</td>
            </template>

            <template #table-row="{item}">
                <td>{{ item.name }}</td>
            </template>
        </ui-model-search>
    </div>
</template>

<script>
export default {
    layout: "admin",
    middleware: ["auth", "permission"],

    head() {
        return {
            title: "Listar páginas",
        };
    },
}
</script>