<template>
    <div>
        <div
            class="d-flex"
            :class="{
                'flex-column': (layout=='vertical'),
                'align-center': (layout=='horizontal'),
            }"
        >
            <draggable 
                v-model="propsModelValue"
                class="d-flex"
                :animation="150"
                :class="{
                    'flex-column':layout=='vertical',
                    'noclass':layout=='horizontal',
                }"
            >
                <template #item="{ element, index }">
                    <div class="flex-grow-1 d-flex align-center ma-1" :style="layout=='horizontal'? `min-width:${1940/7}px;`: ``">
                        <v-icon class="mx-2" style="cursor:move;">mdi-drag</v-icon>
                        <div class="flex-grow-1">
                            <slot name="item" v-bind="this.slotBind({element})">
                                <v-text-field :label="`Item ${index+1}`" hide-details v-model="element.name"></v-text-field>
                            </slot>
                        </div>
                        <v-btn
                            class="mx-2"
                            icon="mdi-delete"
                            @click="remove(element)"
                            :title="`Remover ${singular}`"
                        ></v-btn>
                    </div>
                </template>
            </draggable>

            <div
                :class="{
                    'text-center mt-3':(layout=='vertical'),
                    'noclass':(layout=='horizontal'),
                }"
            >
                <v-btn
                    icon="mdi-plus"
                    @click="add()"
                    v-if="propsModelValue.length<max"
                    :title="`Adicionar ${singular}`"
                ></v-btn>
            </div>
        </div>
    </div>
</template>

<script>
import draggable from 'vuedraggable';

export default {
    props: {
        layout: {default:'horizontal'}, // horizontal, vertical
        modelValue: {type: Array, default:()=>([])},
        max: {default:7},
        singular: {default:'Item'},
        plural: {default:'Itens'},
    },

    components: { draggable },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    methods: {
        slotBind(merge={}) {
            return {
                add: this.add,
                remove: this.remove,
                items: this.propsModelValue,
                canAdd: (this.propsModelValue.length<this.max),
                ...merge
            };
        },

        add() {
            this.propsModelValue.push({
                name: '',
            });
        },

        remove(item) {
            const index = this.propsModelValue.indexOf(item);
            this.propsModelValue.splice(index, 1);
        },
    },
};
</script>