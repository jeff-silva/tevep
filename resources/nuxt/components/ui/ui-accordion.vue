<template><div class="ui-accordion">
    <div class="accordion">
        <slot></slot>
    </div>
</div></template>


<script>
import Vue from 'vue';

Vue.component('ui-accordion-item', {
    props: {
        title: '',
    },

    data() {
        return {
            // id: ('accordion-item-'+Math.round(Math.random()*9999)),
        };
    },

    computed: {
        indexComputed() {
            let index = 0;
            for(let i in this.$parent.$children) {
                if (this.$parent.$children[i]==this) {
                    index = parseInt(i);
                    break;
                }
            }
            return index;
        },
    },

    template: `<div class="card m-0">
        <div class="card-header bg-light">
            <button class="btn btn-block text-left font-weight-bold" type="button" @click="$parent.setValue(indexComputed)">
                {{ title }}
                <i class="fas fa-angle-down float-right" :class="{'fa-rotate-90':!$parent.props.value==indexComputed}" style="transition: all 200ms ease;"></i>
            </button>
        </div>

        <div class="collapse show" :style="{height:($parent.props.value==indexComputed? '100%': '0px')}" style="overflow:hidden; animation-duration:200ms;">
            <div class="card-body">
                <slot></slot>
            </div>
        </div>

    </div>`,
});

export default {
    props: {
        value: {default:0},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
        };
    },

    methods: {
        setValue(value) {
            this.props.value = value;
            this.$emit('input', this.props.value);
        },
    },
}
</script>


<style>
.ui-accordion {}
</style>