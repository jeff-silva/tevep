<template>
    <div class="app-tabs">
        <v-tabs v-model="tab">
            <v-tab :value="item.value" v-for="item in items" :key="$key(item)">
                {{ item.text }}
            </v-tab>
        </v-tabs>
        <div class="app-tabs-items">
            <template v-for="item in items">
                <div v-if="tab==item.value" :key="$key(item)">
                    <slot :name="item.value">
                        &lt;template #{{ item.value }}&gt;&lt;/template&gt;
                    </slot>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        items: {type:Array, default:()=>([])},
    },
    data() {
        return {
            tab: this.items[0].value,
        };
    },
};
</script>