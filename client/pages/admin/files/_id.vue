<template>
    <ui-model-edit
        model-name="files"
        :model-id="$route.params.id"
        singular="Arquivo"
        plural="Arquivos"
        #default="{value, errorFields}"
    >
        <ui-field label="Nome" layout="horizontal" :error="errorFields.name">
            <input type="text" class="form-control" v-model="value.name">
        </ui-field>
    
        <ui-field label="Pasta" layout="horizontal" :error="errorFields.folder">
            <input type="text" class="form-control" v-model="value.folder">
        </ui-field>
        
        <ui-field label="Arquivo" layout="horizontal">
            <ui-file v-model="value.content" :file="value"></ui-file>
        </ui-field>

        <ui-modal :value="$route.query.contentEdit" width="90vw" v-if="value.type=='image'" @close="$router.push({query:{}})">
            <template #header>Editar</template>
            <template #body>
                <ui-photopea v-model="value.content" :url="value.url" ref="photopea" style="height:70vh;"></ui-photopea>
            </template>
            <template #footer>
                <ui-dropdown type="top-right">
                    <button type="button" class="btn btn-success" @click="photopeaSave()">
                        Salvar
                    </button>

                    <template #dropdown>
                        <div class="p-1" style="width:150px;">
                            <button type="button" class="btn btn-primary w-100" @click="photopeaSave('jpg')">
                                JPG
                            </button>

                            <button type="button" class="btn btn-primary w-100 mt-1" @click="photopeaSave('png')">
                                PNG
                            </button>
                        </div>
                    </template>
                </ui-dropdown>
            </template>
        </ui-modal>

    </ui-model-edit>
</template>

<script>
export default {
    layout: "admin",
    middleware: ['auth', 'permission'],

    head() {
        return {
            title: "Editar arquivo",
        };
    },

    methods: {
        photopeaSave(type="jpg") {
            this.$refs.photopea.save(type);
            setTimeout(() => {
                this.$router.push({query:{}});
            }, 100);
        },
    },
}
</script>