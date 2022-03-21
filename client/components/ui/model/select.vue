<template>
    <el-select v-model="props.value" class="w-100"
        filterable remote
        :placeholder="`Selecionar ${singular}`"
        :remote-method="remoteMethod"
        :loading="loading"
        :multiple="props.multiple"
        :disabled="props.disabled"
        :loading-text="props.loadingText"
        :no-match-text="`Nenhum(a) ${singular} encontrado(a)`"
        :no-data-text="`Nenhum(a) ${singular} encontrado(a)`"
        @change="searchParams.q=''"
        @blur="searchParams.q=''"
    >
        <template v-for="d in results.data">
            <slot name="option" :item="d">
                <el-option :value="String(d.id)" :key="d.id" :label="d.name">
                    {{ d.name }}
                </el-option>
            </slot>
        </template>
    </el-select>
</template>

<script>
export default {
    props: {
        value: {default:"", type:[Boolean, Number, String]},
        multiple: {default:false},
        disabled: {default:false},
        loadingText: {default:"Carregando"},
        modelName: {default:""},
        singular: {default:"Item"},
        plural: {default:"Itens"},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.search();
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    methods: {
        search() {
            this.loading = true;
            let params = {...this.searchParams};
            delete params.id;
            this.$axios.get(`/api/${this.modelName}/search`, {params}).then(resp => {
                this.loading = false;
                this.results = resp.data;
            });
        },

        remoteMethod(query) {
            this.searchParams.q = query;
            if (this.__remoteMethodTimeout) clearTimeout(this.__remoteMethodTimeout);
            this.__remoteMethodTimeout = setTimeout(() => this.search(), 1000);
        },
    },

    data() {
        return {
            loading: false,
            searchParams: {
                q: '',
                id: this.value,
                per_page: 10,
                orderby: 'updated_at',
                order: 'desc',
            },
            results: {},
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    mounted() {
        // this.search();
    },
}
</script>