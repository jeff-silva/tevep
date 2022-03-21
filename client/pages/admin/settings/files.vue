<template>
    <div>
        <ui-field label="Salvar uploads em:">
            <select class="form-control" v-model="value['app_model_files.storage_type']">
                <option value="database">Banco de dados</option>
                <option value="file">Pasta de uploads</option>
            </select>
        </ui-field>

        <ui-field label="Tamanho máximo de upload">
            <select class="form-control" v-model="value['app_model_files.max_upload_size']">
                <option :value="1024*1024*n" v-for="n in [0.5, 1, 2, 8, 10, 20, 100]">{{ 1024*1024*n|fileSize }}</option>
            </select>
        </ui-field>
        
        <ui-field label="Gerenciar arquivos">
            <nuxt-link to="/admin/files" class="btn btn-light">Arquivos</nuxt-link>
        </ui-field>
    </div>
</template>

<script>
export default {
    middleware: ["auth", "permission"],
    
    head() {
        return {
            title: "Configurações de arquivos",
        };
    },

    props: {
        value: {default:()=>({})},
    },

    watch: {
        props: {deep:true, handler(value) {
            for(let i in value) this.$emit(i, value[i]);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>