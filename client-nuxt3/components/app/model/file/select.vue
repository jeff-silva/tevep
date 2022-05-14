<template>
    <div>
        <div class="elevation-1 font-weight-bold" style="padding:17px;">{{ label }}</div>
        <div class="d-flex">
            <div class="elevation-1" :style="`min-width:${sidebarWidth}; max-width:${sidebarWidth};`">
                <v-text-field label="Filtro" v-model="fileSearch.params.q" hide-details @keyup="fileSearch.submit({debounce:1500})"></v-text-field>
                <v-list v-if="fileSearch.resp.attributes">
                    <v-list-item v-for="f in fileSearch.resp.attributes.folders" :key="f.id" @click="fileSearch.params.folder=f.name; fileSearch.submit()">
                        /{{ f.name }}
                    </v-list-item>
                </v-list>
                <v-divider></v-divider>
            </div>
            <div class="elevation-1 flex-grow-1">
                <div class="pa-2">
                    <div class="text-center py-3 text-grey" v-if="(fileSearch.resp.data||[]).length==0">
                        Nenhum arquivo encontrado
                    </div>
                    <div class="d-inline-block ma-2"
                        v-for="f in fileSearch.resp.data"
                        :style="`width:${itemSize};`"
                        @click="setValue(f)"
                    >
                        <v-sheet class="elevation-1 pa-2" :color="selectedColor(f)">
                            <v-img :src="f.url" width="100%" :height="itemSize" v-if="f.type='image'" cover :key="f.id">
                                <template #placeholder>
                                    <div class="d-flex align-center justify-center" :style="`height:${itemSize};`">
                                        <v-avatar color="primary">{{ f.ext }}</v-avatar>
                                    </div>
                                </template>
                            </v-img>
                            <div v-else class="d-flex align-center justify-center" :style="`height:${itemSize};`">
                                <v-avatar color="primary">{{ f.ext }}</v-avatar>
                            </div>
                        </v-sheet>
                    </div>
                </div>
                <app-model-pagination v-model="fileSearch"></app-model-pagination>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modelValue: {default:false, type:[Boolean, Number, String, Object]},
        returnType: {default:'id', type:String}, // object, id, url
        label: {default:'Selecionar'},
        sidebarWidth: {default:'200px'},
        itemSize: {default:'150px'},
    },

    data() {
        return {
            fileSearch: useAxios({
                url: '/api/files/search',
                params: {q:'', folder:'', per_page:9},
                submit: true,
                resp: {
                    data: [],
                    attributes: {
                        folders: [],
                    },
                },
            }),
        };
    },

    methods: {
        setValue(item) {
            if (this.returnType=='object') {
                this.$emit('update:modelValue', item);
            }
            else if (this.returnType=='id') {
                this.$emit('update:modelValue', item.id||false);
            }
            else if (this.returnType=='url') {
                this.$emit('update:modelValue', item.url||false);
            }
        },

        selectedColor(item) {
            let selectedColor = 'grey-lighten-2';
            if (this.returnType=='object') {
                return item.id==this.modelValue.id? selectedColor: false;
            }
            else if (this.returnType=='id') {
                return item.id==this.modelValue? selectedColor: false;
            }
            else if (this.returnType=='url') {
                return item.url==this.modelValue? selectedColor: false;
            }
            return false;
        },
    },
};
</script>