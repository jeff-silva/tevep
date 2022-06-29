<template>
    <app-model-place v-model="place"></app-model-place>
</template>

<script>
export default {
    props: {
        modelValue: {default: false, type: [Boolean, Number, String]},
    },

    watch: {
        modelValue(value) {
            this.placeFind(value);
        },
    },

    methods: {
        async placeFind(id) {
            if (!id) return;
            const resp = await this.$axios.get(`/api/places/find/${id}`);
            this.place = resp.data;
        },
    },

    data() {
        return {
            place: {},
        };
    },

    mounted() {
        this.placeFind(this.modelValue);
    },
};
</script>