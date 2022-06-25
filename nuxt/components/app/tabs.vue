<template>
    <div class="app-tabs">
        <v-tabs :model-value="modelValue || (items[0]? items[0].value: '')" @update:model-value="$emit('update:modelValue', $event)">
            <v-tab :value="item.value" v-for="item in items" :key="$key(item)">
                {{ item.text }}
            </v-tab>
        </v-tabs>
        <div class="app-tabs-items">
            <div v-for="item in items" :key="$key(item)">
                <div v-if="modelValue==item.value" class="py-5">
                    <slot :name="item.value">
                        &lt;template #{{ item.value }}&gt;&lt;/template&gt;
                    </slot>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {type:String, default:''},
        items: {type:Array, default:()=>([])},
    },
};
</script>