<template>
    <component :is="modelValueParsed"></component>
</template>

<script>
export default {
    props: {
        modelValue: {default:'', type:[String, Object]},
    },

    computed: {
        modelValueParsed() {
            if (typeof this.modelValue=='string') {
                try {
                    return (new Function(`return ${this.modelValue}`))();
                }
                catch(err) {
                    return {
                        template: `<div style="color:red;">${err}</div>`,
                    };
                }
            }

            return this.modelValue;
        },
    },
};
</script>