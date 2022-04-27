<template>
    <div class="ui-field-float mb-2" :class="{'ui-field-error':(Array.isArray(validate) && validate.length>0)}">
        <div class="input-group">
            <slot name="prepend"></slot>
            <div class="form-floating flex-grow-1">
                <slot></slot>
                <label class="ui-field-label">
                    <slot name="label">{{ label }}</slot>
                </label>
            </div>
            <slot name="append"></slot>
        </div>

        <el-collapse-transition>
            <small class="d-block text-danger" v-if="errorText" v-html="errorText"></small>
        </el-collapse-transition>

        <el-collapse-transition>
            <small class="d-block text-dark" v-if="info" v-html="info"></small>
        </el-collapse-transition>
    </div>
</template>

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

        let input = this.$el.querySelector('.form-floating > .form-control');
        if (input) { input.placeholder = this.label; }
    },
}
</script>

<style>
.ui-field-float .form-control:focus {outline:0!important; box-shadow:none;}

.ui-field-error .form-control,
.ui-field-error .el-input__inner {
    border-color: red;
    box-shadow: none !important;
    outline: 0 !important;
}
</style>