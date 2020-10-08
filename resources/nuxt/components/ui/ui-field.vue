<template><div class="form-group">
    <div class="row">
        <div class="col-12 col-md-4 col-lg-3 p-2">
            <div>{{ label }}</div>
        </div>
        <div class="col-12 col-md-8 col-lg-9">
            <template v-if="$slots.field"><slot name="field"></slot></template>

            <template v-else-if="type=='textarea'">
                <textarea class="form-control" v-model="props.value" @keyup="emit()"></textarea>
            </template>

            <template v-else>
                <input :type="type" class="form-control"
                    :placeholder="placeholder" v-model="props.value" @keyup="emit()" >
            </template>

            <small class="d-block text-danger" v-if="props.error" v-html="props.error"></small>
            <small class="text-muted" v-if="$slots.hint"><slot name="hint"></slot></small>
        </div>
    </div>
</div></template>

<script>export default {
    props: {
        value: {default: ''},
        label: {default: ''},
        placeholder: {default: ''},
        type: {default: 'text'},
        imgMaxWidth: {default: 800},
        imgMaxHeight: {default: 600},
        error: {default: ''},
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
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },
};</script>
