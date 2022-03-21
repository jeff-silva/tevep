<template>
    <div>
        <div>{{ props.text }}</div>
        <pre>{{ props.prices }}</pre>
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
        prices: {default:()=>([]), type:Array},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
        }},

        // props: {deep:true, handler(value) {
        //     for(let i in value) {
        //         this.$emit(`update:${i}`, value[i]);
        //     }
        // }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>