<template>
    <div>
        <v-btn block color="primary" @click="editorDialog=true"><div class="py-4">Editar</div></v-btn>
        
        <v-dialog v-model="editorDialog" fullscreen>
            <v-card>
                <v-toolbar>
                    <v-toolbar-title>Editar</v-toolbar-title>
                    <v-btn @click="editorDialog=false"><v-icon>mdi-close</v-icon></v-btn>
                </v-toolbar>
                
                <div class="d-flex" style="height:calc(100vh - 55px); overflow:auto;">
                    <div style="min-width:300px; max-width:300px;">
                        <v-btn @click="sectionAdd(elements[2])">Add</v-btn>

                        <v-divider></v-divider>
                        
                        <div class="font-weight-bold">Layouts</div>
                        <v-btn
                            block
                            v-for="e in elements"
                            @click="layoutSet(e)"
                        >{{ e.name || 'no name' }}</v-btn>

                        <div v-if="elementEdit">
                            <component :is="elementEdit.edit"></component>
                        </div>
                    </div>
                    <div class="flex-grow-1 pa-3">
                        <app-content v-model="propsModelValue" @section="elementEdit=$event"></app-content>
                    </div>
                </div>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
const elements = [
    {
        name: "Layout 1",
        type: "layout",
        is: {
            template: `<slot>Conteúdo</slot>`,
        },
        edit: {
            template: `<div>edit layout 1</div>`,
        },
    },
    {
        name: "Layout 2",
        type: "layout",
        is: {
            template: `<div class="d-flex">
                <div style="min-width:300px; max-width:300px;">Coluna</div>
                <div class="flex-grow-1">
                    <div>Conteúdo</div>
                    <slot></slot>
                </div>
            </div>`,
        },
        edit: {
            template: `<div>edit layout 2</div>`,
        },
    },
    {
        name: "Section 1",
        type: "section",
        is: {
            template: `<div>Hello</div>`,
        },
        edit: {
            template: `<div>edit section 1</div>`,
        },
    },
];

export default {
    props: {
        modelValue: {default:false, type:[Boolean, Object]},
        elements: {default:()=>elements, type:[Array]},
    },

    data() {
        return {
            editorDialog: true,
            elementEdit: false,
        };
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValueParse(this.modelValue); },
            set(value) { this.$emit('update:modelValue', value); console.log('value', value); },
        },
    },

    methods: {
        modelValueParse(value) {
            if (typeof value!='object') {
                value = {};
            }
            if (typeof value.layout!='object') {
                value.layout = {is:'div'};
            }
            if (!Array.isArray(value.sections)) {
                value.sections = [];
            }
            return value;
        },

        uuid() {
            return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c => {
                return (c ^ (crypto.getRandomValues(new Uint8Array(1))[0] & (15 >> (c / 4)))).toString(16);
            });
        },

        sectionAdd(section) {
            section = JSON.parse(JSON.stringify(section));
            let propsModelValue = this.modelValueParse(this.propsModelValue);
            propsModelValue.sections.push({ key: this.uuid(), ...section });
            this.propsModelValue = propsModelValue;
        },

        sectionRemove(section) {},

        layoutSet(layout) {
            this.propsModelValue.layout = layout;
        },
    },
};
</script>