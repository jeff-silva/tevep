<template>
    <div class="ui-playground shadow-sm">
        <div class="row g-0">
            <div class="col-6 border p-2 bg-light" :style="`height:${height};`">
                <v-runtime-template :template="props.value"></v-runtime-template>
            </div>
            <div class="col-6">
                <ui-code v-model="props.value" :style="`height:${height};`" language="html"></ui-code>
            </div>
        </div>
    </div>
</template>

<script>
import VRuntimeTemplate from "v-runtime-template";

export default {
    components: { VRuntimeTemplate },

    props: {
        value: {default:""},
        height: {default:"300px"},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>