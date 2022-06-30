<template>
    <app-model-file
        v-model="file"
        @update:model-value="$emit('update:modelValue', $event.id)"
    ></app-model-file>
</template>

<script>
export default {
    props: {
        modelValue: {default:false, type:[Boolean, Number, String]},
    },
    watch: {
        modelValue(value) {
            this.fileFind(value);
        },
    },
    methods: {
        async fileFind(id) {
            if (!id) return;
            const resp = await this.$axios.get(`/api/files/find/${id}`);
            this.file = resp.data;
        },
    },
    data() {
        return {
            file: {},
        };
    },
};
</script>