<template>
    <div>
        <v-btn block color="primary" @click="editorDialog=true"><div class="py-4">Editar</div></v-btn>
        
        <v-dialog v-model="editorDialog" fullscreen>
            <v-card>
                <v-toolbar>
                    <v-toolbar-title>Editar</v-toolbar-title>
                    <v-btn @click="editorDialog=false"><v-icon>mdi-close</v-icon></v-btn>
                </v-toolbar>
                
                <div class="d-flex">
                    <div style="min-width:300px; max-width:300px;">
                        <v-btn @click="sectionAdd()">Add</v-btn>

                        <v-divider></v-divider>
                        <div class="font-weight-bold">Layouts</div>
                        <v-btn block v-for="l in layouts" @click="propsModelValue.layout=l">{{ l.name || 'no name' }}</v-btn>

                        <v-divider></v-divider>
                        <pre>layouts: {{ layouts }}</pre>
                        <pre>sections: {{ sections }}</pre>
                        <pre>propsModelValue: {{ propsModelValue }}</pre>
                    </div>
                    <div class="flex-grow-1">
                        <ui-content v-model="propsModelValue"></ui-content>
                    </div>
                </div>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
const layouts = [
    {
        name: "layoutOne",
        template: `<slot></slot>`,
    },
    {
        name: "layoutTwo",
        template: `<div class="d-flex" style="border:solid 1px red;">Aaa<div><div class="flex-grow-1"><slot></slot></div></div></div>`,
    },
];

const sections = [
    {},
];

export default {
    props: {
        modelValue: {default:false, type:[Boolean, Object]},
        layouts: {default:()=>layouts, type:[Array]},
        sections: {default:()=>sections, type:[Array]},
    },

    data() {
        return {
            editorDialog: false,
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

        sectionAdd() {
            let propsModelValue = this.modelValueParse(this.propsModelValue);
            propsModelValue.sections.push({
                key: this.uuid(),
                is: 'div',
            });
            this.propsModelValue = propsModelValue;
        },
        
        sectionRemove() {},
    },
}
</script>