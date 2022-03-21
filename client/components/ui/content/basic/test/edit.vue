<template>
    <div>
        <ui-field label="Text">
            <input type="text" class="form-control" v-model="props.text">
        </ui-field>
    </div>
</template>

<script>
export default {
    props: {
        text: {default:""},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            for(let i in value) {
                this.$emit(`update:${i}`, value[i]);
            }
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },
}
</script>