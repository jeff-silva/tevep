<template>
    <pre class="bg-grey-darken-3 pa-2 elevation-1" style="color:lime!important; overflow:auto;">{{ type }}: {{ modelValue }}</pre>
</template>

<script>
export default {
    props: {
        modelValue: {type: [Boolean, Number, String, Array, Object]},
    },

    computed: {
        type() {
            if (this.modelValue===null) return 'NULL';
            return this.modelValue.constructor.name;
        },
    },
};
</script>