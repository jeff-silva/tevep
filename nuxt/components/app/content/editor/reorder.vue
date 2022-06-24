<template>
    <div class="app-content-editor-reorder">
        <draggable 
            v-model="value"
            :animation="150"
            handle=".app-content-editor-reorder-drag"
        >
            <template #item="{ element:item }">
                <div class="d-flex align-center">
                    <div class="app-content-editor-reorder-drag">
                        <v-icon>mdi-drag</v-icon>
                    </div>
                    <div class="flex-grow-1">
                        <slot name="item" :item="item">
                            {{ item }}
                        </slot>
                    </div>
                    <div>
                        <slot name="actions" :item="item"></slot>
                    </div>
                </div>
            </template>
        </draggable>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    components: { draggable },
    props: {
        modelValue: {type:Array, default:()=>([])},
    },
    computed: {
        value: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },
};
</script>

<style>
.app-content-editor-reorder-drag {
    cursor: pointer;
}
</style>