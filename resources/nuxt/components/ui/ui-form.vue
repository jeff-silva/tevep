<template><form class="ui-form" :method="method" :action="action" @submit.prevent="submit()">
    <slot :loading="loading"></slot>
</form></template>

<script>export default {
    props: {
        value: {default: ()=>({})},
        method: {default: 'post'},
        action: {default: 'api'},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
            },
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        submit() {
            let method = this.$axios[this.method];
            let params = this.method=='get'? {params:this.props.value}: this.props.value;

            this.loading = `<i class="fa fa-fw fa-spin fa-spinner"></i>`;
            method(this.action, params).then((resp) => {
                this.loading = false;
                this.$emit('saved', this.props.value);
            }).catch((err, a, b, c, d) => {
                this.loading = false;
                console.log(err, a, b, c, d);
            });
        },
    },

    data() {
        return {
            loading: false,
            props: Object.assign({}, this.$props),
        };
    },
};</script>