<template>
    <div>
        <!-- Edit -->
        <div v-if="$route.query.id">
            <form @submit.prevent="modelSave.submit({data:edit}).then(saveSuccess);">
                <v-container fluid :style="editWidth? `max-width:${editWidth}`: null">
                    <v-card v-if="edit">
                        <v-alert type="success" v-if="modelSave.status==200">Dados salvos</v-alert>
                        <v-progress-linear
                            indeterminate
                            v-if="modelSave.loading"
                        ></v-progress-linear>
                        <v-card-text>
                            <slot name="edit-fields" v-bind="slotBind()"></slot>
                        </v-card-text>
                    </v-card>
                </v-container>
    
                <v-bottom-navigation style="margin-left:-15px;">
                    <v-btn icon="mdi-close" @click="navigateBack()"></v-btn>
                    <v-btn icon="mdi-plus-circle" :to="`/admin/${namespace}?id=new`"></v-btn>
                    <v-btn icon="mdi-content-save" type="submit"></v-btn>
                </v-bottom-navigation>
            </form>
        </div>

        <!-- Search -->
        <div v-if="!$route.query.id">
            <v-container fluid :style="searchWidth? `max-width:${searchWidth}`: null">
                <v-row>

                    <!-- Search header -->
                    <v-col cols="12" v-if="$slots['search-header']">
                        <slot name="search-header" v-bind="slotBind()"></slot>
                    </v-col>
    
                    <!-- Search table -->
                    <v-col cols="12" md="8">
                        <div class="bg-white elevation-1">
                            <slot name="search-table" v-bind="slotBind()">
                                <v-table
                                    fixed-header
                                    class="ui-crud-search-table"    
                                >
                                    <thead>
                                        <tr class="text-uppercase">
                                            <th class="pe-0" width="30px">
                                                <v-checkbox
                                                    @click="selectAll($event.target.checked)"
                                                    :hide-details="true"
                                                    class="mx-auto"
                                                ></v-checkbox>
                                            </th>
                                            <slot name="search-table-header" v-bind="slotBind()"></slot>
                                            <th width="50px" class="app-model-crud-table-actions"></th>
                                        </tr>
                                    </thead>
                
                                    <tbody>
                                        <tr>
                                            <td
                                                :colspan="tableSearchCols"
                                                class="px-0"
                                                style="height:3px; border:none;"
                                            >
                                                <v-progress-linear
                                                    indeterminate
                                                    color="primary"
                                                    height="3"
                                                    v-if="modelSearch.loading"
                                                ></v-progress-linear>
                                            </td>
                                        </tr>
                                        <tr v-if="modelSearch.resp && (modelSearch.resp.data && modelSearch.resp.data.length==0)">
                                            <td class="text-center" :colspan="tableSearchCols">
                                                Nenhum resultado encontrado
                                            </td>
                                        </tr>
                                        <tr v-for="item in modelSearch.resp.data" :key="item.id" v-if="modelSearch.resp && modelSearch.resp.data">
                                            <td class="pe-0">
                                                <v-checkbox
                                                    v-model="selects"
                                                    :value="item.id"
                                                    :hide-details="true"
                                                    class="mx-auto"
                                                ></v-checkbox>
                                            </td>
                                            
                                            <!-- Item -->
                                            <slot name="search-table-item" v-bind="slotBind({item})"></slot>
    
                                            <!-- Actions -->
                                            <td class="app-model-crud-table-actions py-1">
                                                <v-menu anchor="start">
                                                    <template #activator="{ props }">
                                                        <v-btn icon="mdi-dots-vertical" v-bind="props" flat></v-btn>
                                                    </template>
                
                                                    <div class="search-table-item-actions">
                                                        <slot name="search-table-item-actions" v-bind="slotBind({item})"></slot>
                                                        <template v-if="!actionsExcept.includes('edit')">
                                                            <v-btn icon="mdi-pencil" :to="`/admin/${namespace}?id=${item.id}`"></v-btn>
                                                        </template>
                                                        <template v-if="!actionsExcept.includes('delete')">
                                                            <v-btn icon="mdi-delete" @click="searchDelete([item.id])"></v-btn>
                                                        </template>
                                                        <template v-if="!actionsExcept.includes('clone')">
                                                            <v-btn icon="mdi-content-copy"></v-btn>
                                                        </template>
                                                    </div>
                                                </v-menu>
                                            </td>
                                        </tr>
                                    </tbody>
                                </v-table>
                            </slot>
    
                            <v-divider></v-divider>
            
                            <div class="d-flex align-center">
                                <div class="pa-2 d-none d-md-block">
                                    {{ modelSearch.resp.total }} resultados
                                </div>
    
                                <div class="flex-grow-1">
                                    <v-pagination
                                        v-if="modelSearch.resp && modelSearch.resp.last_page"
                                        v-model="modelSearch.params.page"
                                        :length="modelSearch.resp.last_page"
                                        @update:modelValue="searchSubmit()"
                                    ></v-pagination>
                                </div>
    
                                <div class="pa-2 d-none d-md-block">
                                    <v-combobox
                                        v-model="modelSearch.params.per_page"
                                        :items="[5, 10, 25, 50, 100]"
                                        label="Resultados por página"
                                        :hide-details="true"
                                        @update:modelValue="searchSubmit()"
                                        density="compact"
                                    ></v-combobox>
                                </div>
                            </div>
                        </div>
                    </v-col>
        
                    <!-- Search filter -->
                    <v-col cols="12" md="4">
                        <v-card>
                            <v-card-header>
                                <div>Busca</div>
                            </v-card-header>
                            <v-card-text>
                                <form @submit.prevent="searchSubmit()">
                                    <v-text-field label="Buscar" v-model="modelSearch.params.q"></v-text-field>
                                    
                                    <slot name="search-fields" v-bind="slotBind()"></slot>
    
                                    <v-btn type="submit" color="primary" block :disabled="modelSearch.loading" :loading="modelSearch.loading">
                                        Buscar
                                    </v-btn>
                                    
                                    <v-btn type="button" color="white" block class="mt-3" @click="modelSearch.clear().then(searchSubmit)">
                                        Limpar
                                    </v-btn>
                                </form>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            
            <!-- Search bottom actions -->
            <v-bottom-navigation style="margin-left:-15px;">
                <v-btn icon="mdi-magnify"></v-btn>

                <template v-if="!actionsExcept.includes('add')">
                    <v-btn icon="mdi-plus-circle" :to="`/admin/${namespace}?id=new`"></v-btn>
                </template>
                
                <v-menu anchor="top">
                    <template #activator="{ props }">
                        <v-btn icon="mdi-cloud-download" v-bind="props"></v-btn>
                    </template>
    
                    <v-list style="width:180px;">
                        <v-list-item
                            :title="e.name"
                            v-for="e in modelSearch.resp.exportUrls"
                            @click="exportDownload(e)"
                        ></v-list-item>
                    </v-list>
                </v-menu>
                
                <template v-if="selects.length && !actionsExcept.includes('delete')">
                    <v-btn icon="mdi-delete" @click="searchDelete()"></v-btn>
                </template>
            </v-bottom-navigation>
        </div>
    </div>
</template>

<style>
.search-table-item-actions {
    max-width: 300px;
}
.search-table-item-actions > * {
    margin-right: 10px;
    margin-bottom: 10px;
}

.app-model-crud-table-actions {position: sticky; right: 0;}
</style>

<script>
export default {
    props: {
        namespace: {default:''},
        actionsExcept: {default:()=>([]), type:Array},
        singular: {default:'Item'},
        plural: {default:'Itens'},
        searchWidth: {default:'1100px'},
        editWidth: {default:'1100px'},
    },

    watch: {
        $route: {deep:true, handler(to, from) {
            this.searchInit();
            this.editInit();
        }},
    },

    methods: {
        slotBind(merge={}) {
            return {
                edit: this.edit,
                search: this.modelSearch,
                editUpdate: this.editUpdate,
                searchSubmit: this.searchSubmit,
                ...merge
            };
        },

        selectAll(checked) {
            if (!checked) {
                return this.selects = [];
            }

            let selects = [];
            this.modelSearch.resp.data.forEach(item => {
                selects.push(item.id);
            });
            this.selects = selects;
        },

        navigateBack() {
            // if (this.backUrl) {
            //     return this.$router.push(this.backUrl);
            // }
            this.$router.go(-1);
        },

        saveSuccess(resp) {
            this.editUpdate(resp.data);
            this.$router.push({
                query: {id: resp.data.id},
            });
        },

        editUpdate(edit) {
            this.edit = edit;
        },

        async searchInit() {
            if (this.$route.query.id) return;
            this.edit = false;
            this.tableSearchCols = this.$el.querySelectorAll('.ui-crud-search-table thead th').length;
            this.modelSearch.params = this.paramsDefault(this.$route.query);
            this.modelSearch.cancel();
            const resp = await this.modelSearch.submit();
            this.$emit('search', this.slotBind());
            this.app.setTitle(`Pesquisar ${this.plural}`);
        },

        async searchSubmit() {
            if (this.$route.query.id) return;
            setTimeout(() => {
                this.$router.push({
                    query: this.modelSearch.params,
                });
            }, 100);
        },

        async editInit() {
            let id = this.$route.query.id || false;
            if (!id || isNaN(id)) return this.edit = {};
            this.edit = false;
            this.modelSave.status = false;
            let resp = await useAxios({method: "get", url: `/api/${this.namespace}/find/${id}`}).value.submit();
            this.edit = resp.data;
            this.app.setTitle(`Editar ${this.singular} | ${resp.data.name}`);
        },

        exportDownload(item) {
            this.$axios.get(item.url).then(resp => {
                Object.assign(document.createElement('a'), {
                    href: resp.data.base64,
                    download: resp.data.name,
                }).click();
            });
        },

        paramsDefault(merge={}) {
            merge = {q:'', page:1, per_page:10, ...merge};
            merge.page = parseInt(merge.page);
            merge.per_page = parseInt(merge.per_page);
            return merge;
        },

        searchDelete(id=null) {
            this.$helpers.confirm('Deseja deletar?').then(() => {
                id = Array.isArray(id)? id: this.selects;
                // this.$axios.post(`/api/${this.namespace}/delete`, { id }).then(resp => {
                // });
                alert('aaa');
            });
        },
    },

    data() {
        return {
            tableSearchCols: 2,
            backUrl: false,
            selects: [],
            edit: false,
            modelSearch: useAxios({
                method: "get",
                url: `/api/${this.namespace}/search`,
                params: this.paramsDefault(this.$route.query),
            }),
            modelSave: useAxios({
                method: "post",
                url: `/api/${this.namespace}/save`,
                data: {},
            }),
            app: useApp(),
        };
    },

    mounted() {
        this.editInit();
        this.searchInit();
    },
}
</script>