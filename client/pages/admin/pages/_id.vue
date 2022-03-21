<template>
    <ui-model-edit model-name="pages" :model-id="$route.params.id" singular="Página" plural="Páginas" #default="{value, errorFields}">
        <ui-field label="Nome da página" layout="horizontal" :error="errorFields.name">
            <input type="text" class="form-control" v-model="value.name">
        </ui-field>

        <ui-field label="URL" layout="horizontal" :error="errorFields.slug">
            <div class="input-group form-control p-0">
                <div class="input-group-text border-0 bg-transparent">{{ baseUrl }}</div>
                <input type="text" class="form-control border-0 bg-transparent" v-model="value.slug">
                <div class="input-group-btn">
                    <a :href="baseUrl+value.slug" target="_blank" class="btn">
                        <i class="fas fa-fw fa-link"></i>
                    </a>
                </div>
            </div>
        </ui-field>

        <ui-field label="Proprietário" layout="horizontal" :error="errorFields.owner">
            <ui-model-select model-name="user" v-model="value.owner"></ui-model-select>
        </ui-field>

        <ui-field label="Conteúdo" layout="horizontal" :error="errorFields.content">
            <ui-content v-model="value.content" :edit="true"></ui-content>
        </ui-field>
    </ui-model-edit>
</template>

<script>
export default {
    layout: "admin",
    middleware: ["auth", "permission"],

    head() {
        return {
            title: "Editar página",
        };
    },

    data() {
        return {
            baseUrl: ((new URL(location.href)).protocol+ '//'+ (new URL(location.href)).host +'/'),
        };
    },
}
</script>