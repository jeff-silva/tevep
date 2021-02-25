<template><form class="ui-form" :method="method" :action="action" @submit.prevent="submit()">
    <div v-if="responseSuccess && ($slots.success || $scopedSlots.success)" class="alert alert-success">
        <slot name="success" :response="responseSuccess"></slot>
    </div>

    <transition name="ui-form-error" enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
        <div v-if="error && error.message && showError" class="alert alert-danger">
            <slot name="error" :error="error">{{ error.message }}</slot>
        </div>
    </transition>


    <slot :loading="loading" :error="error" :success="success"></slot>
</form></template>

<script>export default {
    props: {
        value: {default: ()=>({})},
        method: {default: 'post'},
        action: {default: 'api'},
        showError: {default: true},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
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
            this.success = false;
            this.error = false;

            method(this.action, params).then((resp) => {
                this.loading = '';
                this.success = resp.data;
                this.$emit('success', this.success);
            }).catch((err) => {
                this.loading = '';
                this.error = err.response.data||{};
                this.error.fields = this.error.fields.map(errs => errs.join('<br>'));
                this.$emit('error', this.error);
            });
        },
    },

    data() {
        return {
            loading: '',
            success: false,
            error: false,

            responseSuccess: false,
            responseErrorMessage: false,
            responseErrorFields: {},
            props: Object.assign({}, this.$props),
        };
    },
};</script>