<template><div>
    <transition name="custom-unique-name"
        enter-active-class="animate__animated animate__fadeIn"
        leave-active-class="animate__animated animate__fadeOut"
    >
        <div v-if="props.value" class="ui-modal" @click.self="props.value=false; $emit('input', props.value);" style="animation-duration:300ms;">
            <component :is="tag" @submit.prevent="$emit('submit', $event)">
                <div class="card">
                    <div class="card-header" v-if="$slots.header">
                        <slot name="header"></slot>
                    </div>

                    <div class="card-body">
                        <slot name="body"></slot>
                    </div>

                    <div class="card-footer text-right" v-if="$slots && $slots.footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </component>
        </div>
    </transition>
</div></template>

<script>export default {
    props: {
        value: {default: false},
        tag: {default: 'div'},
    },

    watch: {
        $props: {deep: true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    methods: {
        toggle() {
            this.props.value = !this.props.value;
            this.$emit('value', this.props.value);
        },
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },
};</script>

<style>
.ui-modal {
    position: fixed;
    top: 0px;
    left: 0px;
    width: 100vw;
    height: 100vh;
    background: #00000033;
    z-index: 9999 !important;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 !important;
}
.ui-modal .card {
    width: 600px;
    max-width: 90vw !important;
    max-height: 90vh;
    margin: 0 !important;
    overflow: auto !important;
}
</style>