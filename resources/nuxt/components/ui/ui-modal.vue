<template><div>
    <transition name="custom-unique-name"
        enter-active-class="animate__animated animate__fadeIn"
        leave-active-class="animate__animated animate__fadeOut"
    >
        <div v-if="props.value" class="ui-modal" @click.self="props.value=false; emit();" style="animation-duration:300ms;">
            <component :is="tag" @submit.prevent="$emit('submit', $event)">
                <div class="card">
                    <div class="card-header" v-if="$slots.header">
                        <slot name="header"></slot>
                    </div>

                    <div class="card-body">
                        <slot name="body"></slot>
                    </div>

                    <div class="card-footer text-right">
                        <button type="button" class="btn pull-left" @click="props.value=false; emit();">
                            Ok
                        </button>
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
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
            },
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        toggle() {
            this.props.value = !this.props.value;
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
    z-index: 99 !important;
    display: flex;
    align-items: center;
    justify-content: center;
}
.ui-modal .card {
    width: 600px;
    max-width: 90% !important;
}
</style>