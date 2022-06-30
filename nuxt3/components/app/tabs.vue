<template>
    <div class="app-tabs">
        <v-tabs v-model="tabActive" @update:model-value="$emit('update:modelValue', $event)">
            <v-tab :value="item.value" v-for="item in items" :key="$key(item)">
                {{ item.text }}
            </v-tab>
        </v-tabs>
        <div class="app-tabs-items">
            <div v-for="item in items" :key="$key(item)">
                <div v-if="tabActive==item.value" class="py-5">
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

    data() {
        return {
            tabActive: this.modelValue,
        };
    },

    mounted() {
        if (this.items[0] && !this.tabActive) {
            this.tabActive = this.items[0].value;
        }
    },
};
</script>