<template>
    <div>
        <transition name="custom-unique-name" enter-active-class="animate__animated animate__fadeIn" leave-active-class="animate__animated animate__fadeOut">
            <div class="modal show" tabindex="-1" style="display:block; background:#00000044; animation-duration:200ms;" v-if="props.value" @click.self="props.value=false">
                <div class="modal-dialog" :style="`max-width:${width}!important;`">
                    <div class="modal-content">
                        <div class="modal-header">
                            <slot name="header"></slot>
                            <button type="button" class="btn-close" @click="props.value=false"></button>
                        </div>
                        <div class="modal-body">
                            <slot name="body"></slot>
                        </div>
                        <div class="modal-footer">
                            <slot name="footer"></slot>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
export default {
    props: {
        value: [Boolean, String, Array, Object],
        width: {default:"400px"},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
            this.emitOpenClose();
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
            this.emitOpenClose();
        }},
    },

    data() {
        return {
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        show() {
            this.props.value = true;
            this.$emit('input', this.props.value);
        },

        documentKeyup(ev) {
            if (ev.key!='Escape') return;
            this.props.value = false;
            this.$emit('input', this.props.value);
        },

        emitOpenClose() {
            if (this.props.value) { this.$emit('open', this.props.value); }
            else { this.$emit('close', this.props.value); }
        },
    },

    mounted() {
        document.addEventListener('keyup', this.documentKeyup);
    },

    beforeDestroy() {
        document.removeEventListener('keyup', this.documentKeyup);
    },
}
</script>