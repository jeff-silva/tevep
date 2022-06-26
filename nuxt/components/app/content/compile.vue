<template>
    <component
        :is="compiled"
        v-model="propsModelValue"
    >
        <slot />
    </component>
</template>

<script>
export default {
    props: {
        modelValue: {
            type: [Boolean, Object],
            default: false,
        },
        is: {
            type: [Boolean, Object],
            default: false,
        },
        onthefly: {
            type: [Boolean, Object],
            default: false,
        },
    },

    watch: {
        is: {deep:true, handler(value) {
            this.compiled = this.compile(value);
        }},
        onthefly: {deep:true, handler(value) {
            if (!value) return;
            let compiled = this.compile(value.compiled);
            compiled.template = `<div>${value.template}</div>`;
            this.compiled = compiled;
        }},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue || {}; },
            set(value) { this.$emit('update:modelValue', value || {}); },
        },
    },

    methods: {
        compile(value) {
            try {
                if (typeof value=='string') {
                    value = (new Function(`return ${value};`))();
                }

                return value;
            }
            catch(err) {
                return {
                    template: `<div style="color:red;">${err}<br><pre>${value}</pre></div>`,
                };
            };
        },
    },

    data() {
        return {
            compiled: this.compile(this.is),
        };
    },
};
</script>