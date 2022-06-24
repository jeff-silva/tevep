<template>
    <div v-if="edit">
        Edit
    </div>

    <div v-else>
        View
    </div>
</template>

<script>
// import base from '../base.vue';

export default {
    // extends: base,

    props: {
        edit: {default:false, type:Boolean},
        modelValue: {type:Object, default:()=>({})},
    },

    computed: {
        value: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    // watch: {
    //     value: {deep:true, handler(value) {
    //         this.$emit('update:modelValue', value);
    //     }},
    // },

    methods: {
        modelValueDefault(merge={}) {
            return { ...merge };
        },
    },

    data() {
        return {
            // value: this.modelValueDefault(this.modelValue),
        };
    },
};
</script>