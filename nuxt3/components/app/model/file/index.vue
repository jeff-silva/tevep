<template>
    <v-sheet elevation="1" style="width:100%; height:auto;">
        <div style="position:relative; height:calc(100% - 36px); min-height:200px; display:flex; align-items:center; justify-content:center;">

            <!-- Image cover -->
            <v-img
                v-if="propsModelValue.id && propsModelValue.type=='image'"
                :src="propsModelValue.url"
                style="height:100%;"
                cover
            />

            <!-- Ext -->
            <div
                v-if="propsModelValue.id && propsModelValue.type!='image'"
            >
                {{ propsModelValue.ext }}
            </div>

            <!-- No image -->
            <div v-if="!propsModelValue.id">
                <v-btn icon="mdi-upload" @click="fileBrowser()"></v-btn>
            </div>
        </div>
        <div class="d-flex">
            <div class="flex-grow-1">
                <v-btn block variant="text" color="primary" rounded="0" @click="fileBrowser()">
                    <v-icon>mdi-upload</v-icon>
                </v-btn>
            </div>
            <div class="flex-grow-1" v-if="propsModelValue.id">
                <v-btn block variant="text" color="error" rounded="0" @click="fileRemove()">
                    <v-icon>mdi-delete</v-icon>
                </v-btn>
            </div>
        </div>
    </v-sheet>
</template>

<script>
export default {
    props: {
        modelValue: {default:()=>({}), type:Object},
        label: {default:'Arquivo', type:String},
    },

    computed: {
        propsModelValue: {
            get() { return this.modelValue; },
            set(value) { this.$emit('update:modelValue', value); },
        },
    },

    data() {
        return {
            fileUrlRandom: ('?'+Math.round(Math.random()*9999)),
        };
    },

    methods: {
        fileUpdate(file) {
            for(let i in file) this.propsModelValue[i] = file[i];
        },

        fileBrowser() {
            Object.assign(document.createElement('input'), {
                type: 'file',
                onchange: (ev) => {
                    const file = ev.target.files[0];
                    this.propsModelValue.content = file;
                    this.fileUpload();
                },
            }).click();
        },

        fileUpload() {
            if (!this.propsModelValue.content) return;
            
            const formData = new FormData();
            for(let i in this.propsModelValue) {
                formData.append(i, this.propsModelValue[i]);
            }

            this.$axios.post('/api/files/save', formData).then(resp => {
                this.fileUrlRandom = ('?'+Math.round(Math.random()*9999));
                this.propsModelValue = resp.data;
            });
        },

        fileRemove() {
            this.propsModelValue = {};
        },
    },
};
</script>