<template>
    <div>
        <v-text-field
            :label="label"
            :hide-details="true"
            @keyup="modelSearch.submit({debounce:1500})"
            v-model="modelSearch.params.q"
        ></v-text-field>

        <v-card v-if="focus.focused">
            <v-list>
                <template v-for="item in (modelSearch.resp.data || [])">
                    <v-list-item @click="setModelValue(item)">
                        <slot name="item" :item="item">
                            {{ item[ fieldName ] }}
                        </slot>
                    </v-list-item>
                </template>
            </v-list>
        </v-card>
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
        setModelValue(item) {
            // if (this.multiple) {
            //     this.propsModelValue = Array.isArray(this.propsModelValue)? this.propsModelValue: [];
            //     this.propsModelValue.push(item.id);
            //     this.items.push(item);
            //     return;
            // }

            this.modelSearch.params.q = item[ this.fieldName ];
            this.propsModelValue = item.id;
            this.items = [ item ];
        },

        modelFind() {
            useAxios({url:`/api/${this.namespace}/search`, params:{id:this.modelValue}})
                .value.submit().then(resp => {
                    if (!this.items[0]) return;
                    this.items = resp.data.data;
                    this.modelSearch.params.q = this.items[0][ this.fieldName ];
                });
        },
    },

    data() {
        return {
            items: [],
            modelSearch: useAxios({
                url: `/api/${this.namespace}/search`,
                params: {q:''},
                submit: true,
            }),
            focus: false,
        };
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },

        itemsLabel() {
            return this.items.map(item => {
                return item[ this.fieldName ] || 'no field';
            }).join(', ');
        },
    },

    mounted() {
        this.modelFind();
        this.focus = useFocusWithin(this.$el);
    },
};
</script>