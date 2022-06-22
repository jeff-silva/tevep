<template>
    <div>
        <div v-if="edit">
            <v-checkbox v-model="propsModelValue.fluid" label="Largura total"></v-checkbox>
            <v-text-field v-model="propsModelValue.hello" label="Hello"></v-text-field>
            <v-color-picker v-model="propsModelValue.backgroundColor" label="Cor"></v-color-picker>
        </div>

        <div v-else :style="`background-color:${propsModelValue.backgroundColor};`">
            <v-container :fluid="propsModelValue.fluid">
                {{ propsModelValue.hello }}
            </v-container>
        </div>

        <!-- <pre>$props: {{ $props }}</pre> -->
    </div>
</template>

<script>
import base from '../base.vue';

export default {
    extends: base,

    methods: {
        modelValueDefault(merge={}) {
            return {
                fluid: false,
                hello: 'Hello World',
                ...merge
            };
        },
    },
};
</script>