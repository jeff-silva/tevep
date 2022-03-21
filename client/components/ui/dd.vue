<template>
    <div>
        <el-collapse-transition>
            <div class="alert alert-danger m-0 rounded-0 p-2" v-if="parseError" v-html="parseError"></div>
        </el-collapse-transition>
        <ui-code :value="JSON.stringify(value, 2, ' ')" @input="uiCodeOnInput($event)"></ui-code>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:false, type:[Boolean, Number, String, Array, Object, Function]},
    },

    data() {
        return {
            showAll: true,
            valueType: (Array.isArray(this.$props.value)? 'array': (this.$props.value===null? 'boolean': typeof this.$props.value)),
            parseError: false,
        };
    },

    methods: {
        uiCodeOnInput(value) {
            this.parseError = false;

            try {
                value = JSON.parse(value);
            }
            catch(err) {
                this.parseError = err.message;
                return;
            }

            this.$emit('value', value);
        },
    },

    computed: {
        _type() {
            let name = (Array.isArray(this.value)? 'array': typeof this.value);
            let size = ['string', 'array'].indexOf(name) >=0? this.value.length: 0;
            let nameIs = names => names.indexOf(name) >=0;

            return { name, size, nameIs };
        },
    },
}
</script>