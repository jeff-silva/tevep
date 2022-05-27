<template>
    <div>
        <v-pagination
            v-if="modelValue.resp && modelValue.resp.last_page"
            :length="modelValue.resp.last_page"
            @update:modelValue="updateModelValue"
        ></v-pagination>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: Object,
    },

    methods: {
        updateModelValue(page) {
            this.modelValue.params.page = page;
            this.modelValue.submit();
        },
    },
};
</script>