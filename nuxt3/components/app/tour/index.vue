<template>
    <div class="app-tour" :style="appTourStyle">
        <slot></slot>
        <input type="number" v-model="index" min="0" :max="steps.length-1">
        <pre>appTourStyle: {{ appTourStyle }}</pre>
        <pre>$data: {{ $data }}</pre>
        <pre>step: {{ step }}</pre>
        <pre>steps: {{ steps }}</pre>
    </div>
</template>

<script>
import { useElementBounding, useElementSize } from '@vueuse/core';

export default {
    data() {
        return {
            index: 0,
        };
    },

    computed: {
        step() {
            let lastIndex = this.steps.length-1;
            let index = Math.min(lastIndex, Math.max(0, this.index));
            const current = this.steps[ index ];
            const elem = document.querySelector(current.target);
            const bound = { ...useElementBounding(elem), ...useElementSize(elem) };
            console.log(elem);
            return {
                index,
                lastIndex,
                bound,
                current,
                prev: (this.steps[ index-1 ] || false),
                next: (this.steps[ index+1 ] || false),
            };
        },

        steps() {
            return this.$slots.default().map((slot, step) => {
                return { step, target: slot.props.target };
            });
        },

        appTourStyle() {
            return [
                `transition: all 300ms ease;`,
                `position: fixed;`,
                `top: ${this.step.bound.top.value}px;`,
                `left: ${this.step.bound.left.value}px;`,
                `max-width: 500px;`,
                `overflow: auto;`,
                `border: solid 1px red;`,
            ].join(' ');
        },
    },
};
</script>