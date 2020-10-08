<template><div class="business-category">
    <ui-select v-model="props.value" :items="categories" item-key="slug" @input="emit()">
        <template #item="{item}"><div class="d-flex align-items-center">
            <div class="p-1">
                <div :style="`width:40px; height:50px; background:url(${item.photo}) center center no-repeat; background-size:cover;`"></div>
            </div>
            <div class="pl-2">
                <div><strong>{{ item.name }}</strong></div>
                <div><small class="text-muted">{{ item.description }}</small></div>
            </div>
        </div></template>
    </ui-select>
</div></template>


<script>
export default {
    props: {
        value: {default:()=>([])},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                value = Object.assign({}, this.props||{});
                this.$set(this, 'props', value);
            }
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('change', this.props.value);
            this.$emit('value', this.props.value);
        },
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
            categories: this.modelDefault('productCategories'),
        };
    },
};</script>

<style>
.business-category {}
</style>