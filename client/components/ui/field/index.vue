<template>
    <div class="ui-field mb-3" :class="{'ui-field-error':(Array.isArray(validate) && validate.length>0)}">
        <label class="ui-field-label form-label">
            <slot name="label">{{ label }}</slot>
        </label>

        <slot></slot>

        <el-collapse-transition>
            <small class="d-block text-danger" v-if="errorText" v-html="errorText"></small>
        </el-collapse-transition>

        <el-collapse-transition>
            <small class="d-block text-dark" v-if="info" v-html="info"></small>
        </el-collapse-transition>
    </div>
</template>

<style>
/*  */
</style>

<script>
export default {
    props: {
        label: {default:''},
        info: {default:''},
        validate: {default:false, type:[Boolean, Array]},
    },

    computed: {
        errorText() {
            let errorText = [];

            if (Array.isArray(this.validate)) {
                errorText = this.validate;
            }

            return errorText.join('<br>');
        },

        bind() {
            return {
                focused: this.focused,
                validate: this.validate,
            };
        },
    },

    data() {
        return {
            focused: false,
        };
    },

    mounted() {
        this.$helpers.event(this, [document], ['now', 'click', 'focus', 'blur', 'keyup'], ev => {
            this.focused = (ev.target && this.$el.contains(ev.target)) || false;
        });
    },
}
</script>

<style>
/* .ui-field > * {transition: all 300ms ease;} */

.ui-field-error .form-control,
.ui-field-error .el-input__inner {
    border-color: red;
    box-shadow: none !important;
    outline: 0 !important;
}
</style>