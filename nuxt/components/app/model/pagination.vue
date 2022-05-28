<template>
    <div class="d-flex align-center">
        <div class="flex-grow-1">
            <v-pagination
                v-if="propsResponse.last_page"
                :length="propsResponse.last_page"
                @update:modelValue="updateModelValue"
            ></v-pagination>
        </div>
        <div class="px-4">
            <v-combobox
                :model-value="propsResponse.per_page"
                :items="[5, 10, 25, 50, 100]"
                label="Resultados por página"
                hide-details
                density="compact"
                @update:modelValue="$emit('per-page', $event)"
            ></v-combobox>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {defalut:1, type:[Boolean, Number, String]},
        response: {type:Object, defalut:()=>({})},
    },

    computed: {
        propsResponse: {
            get() {
                return {
                    // page: 1,
                    // per_page: 15,
                    ...(this.response||{})
                };
            },
            set(value) {
                console.log(value);
            },
        },
    },

    methods: {
        updateModelValue(page) {
            console.log('updateModelValue', page);
            this.$emit('update:modelValue', page);
        },
    },
};
</script>