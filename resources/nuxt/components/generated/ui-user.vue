<template><div>
    <el-select v-model="props.value" class="d-block" :placeholder="placeholder"
        :loading="loading" filterable remote :remote-method="getResults"
        @change="emitValue()"
    >
        <el-option :value="i.id" :label="i.name" v-for="i in items" :key="i.id">{{ i.name }}</el-option>
    </el-select>
</div></template>

<script>
export default {
    props: {
        value: {default:""},
        placeholder: {default:'Buscar usuário'},
    },

    data() {
        return {
            loading: false,
            items: [],
            props: Object.assign({}, this.$props),
        };
    },

    methods: {
        emitValue() {
            this.$emit('input', this.props.value);
        },

        getResults(search) {
            this.loading = true;
            this.$axios.get('/api/user/search', {params:{search}}).then(resp => {
                this.loading = false;
                this.items = resp.data.data;
            });
        },
    },

    mounted() {
        this.getResults(this.props.value);
    },
};
</script>