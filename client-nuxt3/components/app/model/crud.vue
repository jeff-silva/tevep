<template>
    <div>
        <!-- Edit -->
        <div v-if="$route.query.id">
            <form @submit.prevent="save.submit({data:edit}).then(saveSuccess);">
                <v-container fluid :style="editWidth? `max-width:${editWidth}`: null">
                    <v-card prepend-icon="mdi-pencil" v-if="edit">
                        <template #title>{{ edit.id? 'Editar': 'Criar' }}</template>
                        <v-progress-linear
                            indeterminate
                            v-if="save.loading"
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
                    <v-col cols="12" v-if="$slots['search-header']">
                        <slot name="search-header" v-bind="slotBind()"></slot>
                    </v-col>
    
                    <v-col cols="12" lg="9">
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
                                                    v-if="search.loading"
                                                ></v-progress-linear>
                                            </td>
                                        </tr>
                                        <tr v-if="search.resp && (search.resp.data && search.resp.data.length==0)">
                                            <td class="text-center" :colspan="tableSearchCols">
                                                Nenhum resultado encontrado
                                            </td>
                                        </tr>
                                        <tr v-for="item in search.resp.data" v-if="search.resp && search.resp.data">
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
                                                            <v-btn icon="mdi-delete"></v-btn>
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
                                    {{ search.resp.total }} resultados
                                </div>
    
                                <div class="flex-grow-1">
                                    <v-pagination
                                        v-if="search.resp && search.resp.last_page"
                                        v-model="search.params.page"
                                        :length="search.resp.last_page"
                                        @update:modelValue="searchRedirect()"
                                    ></v-pagination>
                                </div>
    
                                <div class="pa-2 d-none d-md-block">
                                    <v-combobox
                                        v-model="search.params.per_page"
                                        :items="[5, 10, 25, 50, 100]"
                                        label="Resultados por página"
                                        :hide-details="true"
                                        @update:modelValue="searchRedirect()"
                                        density="compact"
                                    ></v-combobox>
                                </div>
                            </div>
                        </div>
                    </v-col>
        
                    <v-col cols="12" lg="3">
                        <v-card>
                            <v-card-header>
                                <div>Busca</div>
                            </v-card-header>
                            <v-card-text>
                                <form @submit.prevent="searchRedirect()">
                                    <v-text-field label="Buscar" v-model="search.params.q"></v-text-field>
                                    <slot name="search-fields" v-bind="slotBind()"></slot>
    
                                    <v-btn type="submit" color="primary" block :disabled="search.loading">
                                        {{ search.loading? 'Carregando': 'Buscar' }}
                                    </v-btn>
                                    
                                    <v-btn type="button" color="white" block class="mt-3" @click="search.clear().then(searchRedirect)">
                                        Limpar
                                    </v-btn>
                                </form>
                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
            
            <v-bottom-navigation style="margin-left:-15px;">
                <v-btn icon="mdi-magnify"></v-btn>
                <v-btn icon="mdi-plus-circle" :to="`/admin/${namespace}?id=new`"></v-btn>
                
                <v-menu anchor="top">
                    <template #activator="{ props }">
                        <v-btn icon="mdi-cloud-download" v-bind="props"></v-btn>
                    </template>
    
                    <v-list style="width:180px;">
                        <v-list-item
                            :title="e.name"
                            v-for="e in search.resp.exportUrls"
                            @click="exportDownload(e)"
                        ></v-list-item>
                    </v-list>
                </v-menu>
                
                <template v-if="selects.length">
                    <v-btn icon="mdi-delete"></v-btn>
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
        searchWidth: {default:'1000px'},
        editWidth: {default:'1000px'},
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
                search: this.search,
                editUpdate: this.editUpdate,
                searchSubmit: this.searchSubmit,
                searchRedirect: this.searchRedirect,
                ...merge
            };
        },

        selectAll(checked) {
            if (!checked) {
                return this.selects = [];
            }

            let selects = [];
            this.search.resp.data.forEach(item => {
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
            this.tableSearchCols = this.$el.querySelectorAll('.ui-crud-search-table thead th').length;
            this.search.params = {...this.$route.query};
            await this.search.submit();
            this.$emit('search', this.slotBind());
        },

        async searchRedirect() {
            this.$router.push({
                query: this.search.params,
            });
        },

        async searchSubmit() {
            this.search.cancel();
            const params = {...this.search.params, ...this.$route.query};
            this.search.params = params;
            this.search.submit({ params }).then(resp => {
                this.$emit('search', this.slotBind());
            });
        },

        async editInit() {
            let id = this.$route.query.id || false;
            if (!id || isNaN(id)) return this.edit = {};
            this.edit = false;
            (await useAxios({method: "get", url: `/api/${this.namespace}/find/${id}`})).value.submit().then(resp => {
                this.edit = resp.data;
            });
        },

        exportDownload(item) {
            this.$axios.get(item.url).then(resp => {
                Object.assign(document.createElement('a'), {
                    href: resp.data.base64,
                    download: resp.data.name,
                }).click();
            });
        },
    },

    data() {
        return {
            tableSearchCols: 2,
            backUrl: false,
            selects: [],
            edit: false,
            search: useAxios({
                method: "get",
                url: `/api/${this.namespace}/search`,
                params: {q:'', page:1, per_page:10, ...this.$route.query},
            }),
            save: useAxios({
                method: "post",
                url: `/api/${this.namespace}/save`,
                data: {},
            }),
        };
    },

    mounted() {
        this.editInit();
        this.searchInit();
    },
}
</script>