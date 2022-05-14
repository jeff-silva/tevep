<template>
    <div class="elevation-2">
        <div class="d-flex font-weight-bold">
            <div class="flex-grow-1 pa-4">{{ label }}</div>
            <div class="pe-4" style="width:300px;">
                <v-text-field
                    label="Filtro"
                    v-model="fileSearch.params.q"
                    hide-details
                    @keyup="fileSearch.submit({debounce:1500})"
                    append-icon="mdi-magnify"
                    :loading="fileSearch.loading"
                ></v-text-field>
            </div>
        </div>
        <div class="d-flex">
            <div :style="`min-width:${sidebarWidth}; max-width:${sidebarWidth};`">
                <v-img
                    v-if="fileSelected && fileSelected.mime.includes('image')"
                    :src="fileSelected.url"
                    width="100%"
                ></v-img>
                <div
                    v-if="fileSelected && !fileSelected.mime.includes('image')"
                    class="d-flex align-center justify-center" style="height:150px;"
                >
                    <v-avatar color="primary" size="x-large">
                        <div class="text-uppercase">
                            {{ fileSelected.ext }}
                        </div>
                    </v-avatar>
                </div>
            </div>
            <div class="flex-grow-1 bg-grey-lighten-4">
                <div class="pa-2">
                    <div class="text-center py-3 text-grey" v-if="(fileSearch.resp.data||[]).length==0">
                        Nenhum arquivo encontrado
                    </div>
                    <div class="d-flex flex-wrap">
                        <div class="ma-2"
                            v-for="f in fileSearch.resp.data"
                            :style="`width:${itemSize};`"
                            @click="setValue(f)"
                        >
                            <v-sheet class="elevation-1 pa-2" :color="selectedColor(f)">
                                <v-img :src="f.url" width="100%" :height="itemSize" style="`height:${};`" v-if="f.type='image'" :key="f.id" class="ma-0">
                                    <template #placeholder>
                                        <div class="d-flex align-center justify-center" :style="`height:calc(${itemSize} - 15px);`">
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
        sidebarWidth: {default:'150px'},
        itemSize: {default:'80px'},
    },

    mounted() {
        this.fileFind();
    },

    data() {
        return {
            fileSelected: false,
            fileSearch: useAxios({
                url: '/api/files/search',
                params: {q:'', folder:'', per_page:15},
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
            this.fileSelected = {...item};
            this.fileSelected.url += ('?'+Math.round(Math.random()*9999));

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

        async fileFind() {
            if (this.returnType=='object') {
                this.fileSelected = this.modelValue;
            }
            else if (this.returnType=='id') {
                const resp = await this.$axios.get(`/api/files/find/${this.modelValue}`);
                this.fileSelected = resp.data || false;
            }
            else if (this.returnType=='url') {
                const params = { url: this.modelValue };
                const resp = await this.$axios.get('/api/files/search', { params });
                this.fileSelected = resp.data.data[0] || false;
            }
        },
    },
};
</script>