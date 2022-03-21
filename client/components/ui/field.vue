<template>
    <div class="ui-field mb-3" :class="{'d-flex':isLarge, 'ui-field-error':_compError}">
        <div :class="{'py-2':isLarge, 'pb-1':!isLarge}" :style="`min-width:${isLarge? null: labelWidth}; max-width:${isLarge? null: labelWidth};`">
            <slot name="label">{{ label }}</slot>
            
            <small class="d-block text-muted">
                <slot name="info">
                    <span v-html="info"></span>
                </slot>
            </small>
        </div>

        <div :class="{'flex-grow-1':isLarge}">
            <slot></slot>
            <small class="d-block text-danger" v-if="_compError" v-html="_compError"></small>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        label: {default:''},
        labelWidth: {default:'200px'},
        info: {default:''},
        error: [Boolean, Number, String, Array, Object],
        widthBreakpoint: {default:600},
    },

    computed: {
        _compError() {
            let error = [];

            if (typeof this.error=='string') {
                error = [this.error];
            }
            else if (Array.isArray(this.error)) {
                error = this.error;
            }
            else if (typeof this.error=='object') {
                error = Object.values(this.error);
            }

            return error.join('<br>');
        },
    },

    data() {
        return {
            parentWidth: 0,
            isLarge: false,
        };
    },

    methods: {
        calculateSizes() {
            this.parentWidth = this.$el.offsetWidth;
            this.isLarge = this.$el.offsetWidth>=this.widthBreakpoint;
        },

        resizeEventListener(ev) {
            this.calculateSizes();
        },
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.resizeEventListener);
    },

    mounted() {
        this.calculateSizes();
        window.addEventListener('resize', this.resizeEventListener);
    },
}
</script>

<style>
/* .ui-field > * {transition: all 300ms ease;} */
.ui-field-error .form-control,
.ui-field-error .el-input__inner {
    border-color: var(--bs-danger);
    box-shadow: none !important;
    outline: 0 !important;
}
</style>