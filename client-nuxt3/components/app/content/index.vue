<template>
    <div class="elevation-1 ma-2 pa-3">
        <component :is="propsModelValue.layout.is">
            <template v-for="s in propsModelValue.sections">
                <component :is="s.is" @click.native="$emit('section', s)"></component>
            </template>
        </component>
        <pre>propsModelValue: {{ propsModelValue }}</pre>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:false, type:[Boolean, Object]},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValueParse(this.modelValue); },
            set(value) { this.$emit('update:modelValue', value); console.log('value', value); },
        },
    },

    methods: {
        modelValueParse(value) {
            if (typeof value!='object') {
                value = {};
            }
            if (typeof value.layout!='object') {
                value.layout = {is:'div'};
            }
            if (!Array.isArray(value.sections)) {
                value.sections = [];
            }
            return value;
        },
    },
}
</script>