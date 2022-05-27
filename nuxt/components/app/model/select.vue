<template>
    <div>
        <v-menu v-model="focus.focused">
            <template #activator="{ props }">
                <v-text-field
                    :label="label"
                    v-model="modelSearch.params.q"
                    v-bind="props"
                    @keyup="modelSearch.submit({debounce:1500})"
                    :loading="modelSearch.loading"
                ></v-text-field>
            </template>

            <v-list class="mt-2" style="margin-left:-15px;">
                <v-list-item v-if="(modelSearch.resp? modelSearch.resp.data: []).length==0">
                    Pesquise um item
                </v-list-item>

                <template v-for="item in (modelSearch.resp? modelSearch.resp.data: [])">
                    <v-list-item @click="selectItemHandler(item)">
                        <slot name="item" :item="item">
                            {{ item.name }}
                        </slot>
                    </v-list-item>
                </template>
            </v-list>
        </v-menu>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:false, type:[Boolean, Number, String, Array]},
        multiple: {default:false},
        label: {default:""},
        namespace: {default:""},
        fieldId: {default:"id"},
        fieldName: {default:"name"},
    },

    methods: {
        modelFind() {
            useAxios({url:`/api/${this.namespace}/search`, params:{id:this.modelValue}})
                .value.submit().then(resp => {
                    if (!resp.data.data[0]) return;
                    this.modelSearch.params.q = resp.data.data[0][ this.fieldName ];
                });
        },

        async keyupHandler(ev) {
            this.modelSearch.params.q = ev.target.value;
            await this.modelSearch.submit({debounce:2000});
            ev.target.value = '';
        },

        selectItemHandler(item) {
            this.modelSearch.params.q = item[ this.fieldName ];
            this.$emit('update:modelValue', item[this.fieldId]);
        },
    },

    data() {
        return {
            focus: false,
            modelSearch: useAxios({
                url: `/api/${this.namespace}/search`,
                params: {q:''},
                resp: {data:[]},
            }),
        };
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    mounted() {
        this.modelFind();
        this.focus = useFocusWithin(this.$el);
    },
};
</script>