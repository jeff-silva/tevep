<template>
    <div class="bg-light text-center" style="height:100vh; display:flex; align-items:center; justify-content:center;">
        <div>
            <div class="mb-4" v-html="props.text" style="max-width:500px;">{{ props.text }}</div>
            <div class="list-inline">
                <div class="list-inline-item" v-for="c in props.ctas">
                    <a :href="c.href||'javascript:;'" :target="c.target" :class="c.class">{{ c.label||'' }}</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
        ctas: {default:()=>([]), type:Array},
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