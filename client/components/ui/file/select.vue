<template>
    <div class="d-flex border shadow-sm">
        <div class="border-end p-2 bg-light" style="min-width:200px; max-width:200px;">
            <div class="fw-bold mb-2">Pastas</div>
            <div class="list-group list-group-flush" v-if="search.resp">
                <a href="javascript:;" class="list-group-item p-2" v-for="f in search.resp.folders" @click="search.params.folder=f.name; fileSearch();">
                    /{{ f.name || '.' }}
                </a>
            </div>
        </div>

        <div class="flex-grow-1">
            <div class="bg-light p-2 border-bottom">
                /{{ search.params.folder || '.' }}
            </div>

            <div class="bg-white p-1" style="max-height:400px; overflow:auto;" v-if="search.resp">
                <div class="bg-light py-5 m-2 text-center" v-if="search.resp.data.length==0">
                    Nenhum arquivo
                </div>
                
                <div class="d-inline-block m-2" v-for="f in search.resp.data">
                    <div class="border p-3" :class="{'border-primary':fileSelected(f)}" style="position:relative; width:150px; height:150px; cursor:pointer;" @click="selectToggle(f)">
                        <img :src="f.url" alt="" v-if="f.type=='image'" style="width:100%; height:100%; object-fit:cover;">
                        <div v-else style="width:100%; height:100%;">
                            <div>{{ f.ext }}</div>
                            <div>/{{ f.folder }}</div>
                            <div>{{ f.size|fileSize }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        value: {default:false, type:[Boolean, Number, String, Array, Object]},
        multiple: {default:false},
        selectField: {default:false, type:[Boolean, String]},
    },

    watch: {
        $props: {deep:true, handler(value) {
            if (this.__preventRecursive) return;
            this.props = JSON.parse(JSON.stringify(value));
        }},

        props: {deep:true, handler(value) {
            this.__preventRecursive = true;
            this.$emit('input', value.value||false);
            for(let i in value) { this.$emit(`update:${i}`, value[i]); }
            setTimeout(() => { this.__preventRecursive = false; }, 10);
        }},
    },

    data() {
        return {
            file: false,
            search: {
                loading: false,
                params: {q:"", folder:""},
                resp: false,
            },
            props: JSON.parse(JSON.stringify(this.$props)),
        };
    },

    methods: {
        fileSearch() {
            let { params } = this.search;
            this.$axios.get("/api/files/search/", { params }).then(resp => {
                this.search.resp = resp.data;
            });
        },

        fileSelected(file) {

            // Multiple values
            if (this.props.multiple) {

                // Values forced to array
                let propsValues = this.props.value || [];
                if (!Array.isArray(propsValues)) {
                    if (propsValues) { propsValues = [propsValues]; }
                    else { propsValues = []; }
                }

                if (this.props.selectField) {
                    let fieldValue = file[this.props.selectField] || false;
                    return propsValues.indexOf(fieldValue) >= 0;
                }

                else {
                    return propsValues.filter(item => item.id==file.id).length >0;
                }
            }

            // Single value
            else {
                if (this.props.selectField) {
                    let fieldValue = file[this.props.selectField] || false;
                    return this.props.value == fieldValue;
                }

                else {
                    return (this.props.value && this.props.value.id==file.id);
                }
            }

            return false;
        },

        selectToggle(file) {

            // Multiple values
            if (this.props.multiple) {

                // Values forced to array
                let propsValues = this.props.value || [];
                if (!Array.isArray(propsValues)) {
                    if (propsValues) { propsValues = [propsValues]; }
                    else { propsValues = []; }
                }

                // Select field
                if (this.props.selectField) {
                    let fileField = file[ this.props.selectField ] || false;
                    let index = propsValues.indexOf(fileField);
                    if (index >= 0) { propsValues.splice(index, 1); }
                    else { propsValues.push(fileField); }
                }

                // Select object
                else {
                    let valueIndex = -1;
                    propsValues.forEach((value, index) => {
                        if (value.id==file.id) {
                            valueIndex = index;
                        }
                    });

                    if (valueIndex >= 0) { propsValues.splice(valueIndex, 1); }
                    else { propsValues.push(file); }
                }

                this.props.value = propsValues;
            }


            // Single value
            else {
                
                // Select field
                if (this.props.selectField) {
                    
                    // Deselecionar se clicar no mesmo item selecionado
                    if (this.props.value == file[this.props.selectField]) {
                        this.props.value = false;
                    }
                    else {
                        this.props.value = file[this.props.selectField];
                    }
                }

                // Select object
                else {

                    // Deselecionar se clicar no mesmo item selecionado
                    if (this.props.value && this.props.value.id==file.id) {
                        this.props.value = false;
                    }
                    
                    // Selecionar item
                    else {
                        this.props.value = file;
                    }
                }
            }

            console.log(this.props.value);
            this.$emit('input', this.props.value);
        },
    },

    mounted() {
        this.fileSearch();
    },
}
</script>