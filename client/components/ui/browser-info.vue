<template>
    <span></span>
</template>

<script>
export default {
    props: {
        value: {type:[Boolean, Object]},
    },

    methods: {
        emitValue() {
            this.$emit('input', {
                width: window.innerWidth,
                height: window.innerHeight,
                mobile: (window.innerWidth <= 768),
            });
        },
    },

    mounted() {
        this.emitValue();
        window.addEventListener('resize', this.emitValue);
    },

    beforeDestroy() {
        window.removeEventListener('resize', this.emitValue);
    },
}
</script>