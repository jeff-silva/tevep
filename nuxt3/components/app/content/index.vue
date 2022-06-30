<template>
    <div v-if="propsModelValue.layout">
        <app-content-compile
            :is="propsModelValue.layout.is"
            v-model="propsModelValue.layout.value"
        >
            <div
                v-for="section in propsModelValue.sections"
                :key="$key(section)"
                @click="$emit('section-click', section)"
            >
                <app-content-compile
                    :is="section.is"
                    v-model="section.value"
                ></app-content-compile>
            </div>
        </app-content-compile>
        <pre>{{ propsModelValue }}</pre>
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
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    methods: {
        modelValueParse(value) {
            // if (typeof value!='object') {
            //     value = {};
            // }
            // if (typeof value.layout!='object') {
            //     value.layout = this.layouts[0];
            // }
            // if (!Array.isArray(value.sections)) {
            //     value.sections = [];
            // }
            return value;
        },

        compile(content) {
            content = typeof content=='string'? (new Function(`return ${content};`))(): content;
            try { return content; }
            catch(err) { return {template:`<div style="color:red;">${err}<br><pre>${content}</pre></div>`}; }
        },
    },
};
</script>