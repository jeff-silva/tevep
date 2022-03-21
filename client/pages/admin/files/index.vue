<template>
    <div>
        <ui-model-search model-name="files" singular="Arquivo" plural="Arquivos" ref="modelSearch">
            <template #table-header="">
                <th width="50px">Thumb</th>
                <th data-orderby="name">Nome</th>
            </template>

            <template #table-row="{item}">
                <td><ui-cover :src="item.url">{{ item.ext }}</ui-cover></td>
                <td>
                    <div class="fw-bold">{{ item.name }}</div>
                    <div v-if="item.folder"><small>/{{ item.folder }}</small></div>
                    <div><small>{{ item.size|fileSize }}</small></div>
                </td>
            </template>
        </ui-model-search>
    </div>
</template>

<script>
export default {
    layout: "admin",
    middleware: ['auth', 'permission'],

    head() {
        return {
            title: "Buscar usuários",
        };
    },
}
</script>