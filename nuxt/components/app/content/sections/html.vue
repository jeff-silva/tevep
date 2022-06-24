<template>
    <div>
        <div v-if="edit">
            <v-checkbox v-model="value.fluid" label="Largura total"></v-checkbox>
            <app-html v-model="value.content"></app-html>
        </div>

        <div v-else :style="`background-color:${value.backgroundColor};`">
            <v-container :fluid="value.fluid">
                <div v-html="value.content"></div>
            </v-container>
        </div>
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
                content: 'Hello World',
                ...merge
            };
        },
    },
};
</script>