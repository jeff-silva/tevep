<template>

    <!-- Edit -->
    <div v-if="!!$route.query.edit">
        <v-container>
            <v-row>
                <v-col cols="12" lg="8">
                    <v-card>
                        <v-card-text>
                            <pre>modelEdit: {{ modelEdit }}</pre>
                        </v-card-text>
                    </v-card>
                </v-col>
                <v-col cols="12" lg="4">
                    <v-card>
                        <v-card-text>
                            Ações
                        </v-card-text>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>

        <app-actions>
            <v-btn icon="mdi-close" :to="`/admin/${namespace}`"></v-btn>
            <v-btn icon="mdi-plus-circle" :to="`/admin/${namespace}?id=new`"></v-btn>
            <v-btn icon="mdi-content-save" type="submit"></v-btn>
        </app-actions>
    </div>

    <!-- Search -->
    <div v-else>
        <v-container>
            <v-row>
                <v-col cols="12" md="8">
                    <v-table>
                        <thead>
                            <tr>
                                <th class="px-2" width="40px">
                                    <v-checkbox
                                        hide-details
                                    ></v-checkbox>
                                </th>
                                <slot name="search-table-header" v-bind="slotBind()"></slot>
                                <th class="app-model-crud-table-actions" width="30px"></th>
                            </tr>
                        </thead>
    
                        <tbody>
    
                            <!-- Loading -->
                            <tr>
                                <td
                                    colspan="100%"
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
    
                            <!-- Empty -->
                            <tr v-if="!modelSearch.loading && modelSearch.resp.data.length==0">
                                <td colspan="100%">
                                    <div class="text-center">Nenhum item encontrado</div>
                                </td>
                            </tr>
    
                            <!-- Item -->
                            <tr v-for="item in modelSearch.resp.data" :key="item.id">
                                <td class="px-2">
                                    <v-checkbox
                                        hide-details
                                    ></v-checkbox>
                                </td>
                                <slot name="search-table-item" v-bind="slotBind({item})"></slot>
                                <td class="app-model-crud-table-actions pa-1">
                                    <v-menu anchor="start">
                                        <template #activator="{ props }">
                                            <v-btn icon="mdi-dots-vertical" v-bind="props" flat></v-btn>
                                        </template>
    
                                        <div class="search-table-item-actions">
                                            <template v-for="act in getTableActions(item)">
                                                <v-btn v-bind="act" class="me-2" @click="(typeof act.click=='function'? act.click(item, $event): null)"></v-btn>
                                            </template>
                                        </div>
                                    </v-menu>
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                    <v-card>
                        <div class="d-flex align-center">
                            <div class="ps-4">{{ modelSearch.resp.total }} resultados</div>
                            <div class="flex-grow-1">
                                <v-pagination
                                    v-if="modelSearch.resp.last_page"
                                    v-model="modelSearch.params.page"
                                    :length="modelSearch.resp.last_page"
                                    @update:model-value="modelSearch.submit()"
                                ></v-pagination>
                            </div>
                            <div class="px-4">
                                <v-select
                                    v-model="modelSearch.params.per_page"
                                    :items="[5, 10, 15, 25, 50, 100]"
                                    label="Resultados por página"
                                    hide-details
                                    density="compact"
                                    @update:model-value="modelSearch.params.page=1; modelSearch.submit();"
                                ></v-select>
                            </div>
                        </div>
                    </v-card>
                </v-col>
                <v-col cols="12" md="4">
                    <form @submit.prevent="modelSearch.submit()">
                        <v-card>
                            <v-card-content>
                                <v-text-field :label="`Buscar ${plural}`" hide-details v-model="modelSearch.params.q"></v-text-field>

                                <v-card-cations>
                                    <v-btn class="mt-3" type="submit" color="primary" block :disabled="modelSearch.loading">
                                        Buscar
                                    </v-btn>
                                    
                                    <v-btn class="mt-3" color="white" block @click="modelSearch.clear().then(searchSubmit)">
                                        Limpar
                                    </v-btn>
                                </v-card-cations>
                            </v-card-content>
                        </v-card>
                    </form>
                </v-col>
            </v-row>
        </v-container>

        <app-actions>
            <v-btn icon="mdi-magnify"></v-btn>
            <v-btn icon="mdi-plus-circle" :to="`/admin/${namespace}?edit=new`"></v-btn>

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

            <!-- <v-btn icon="mdi-delete" @click="searchDelete()"></v-btn> -->
        </app-actions>
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
        searchFluid: {default:false},
        editFluid: {default:false},
        tableActions: {type:Object, default:()=>({})},
    },

    // watch: {
    //     $route: {deep:true, handler() {
    //         this.modelSearchInit();
    //         this.modelEditInit();
    //     }},
    // },

    data() {
        return {
            modelSearch: useAxios({
                method: "get",
                url: `/api/${this.namespace}/search`,
                params: this.searchParamsDefault(this.$route.query),
                resp: {data:[]},
                onSubmited: (resp) => {
                    this.$router.push({
                        query: this.modelSearch.params,
                    });
                },
            }),
            modelEdit: useAxios({
                method: "post",
                url: `/api/${this.namespace}/save`,
                data: {},
            }),
            app: useApp(),
        };
    },

    methods: {
        slotBind(merge={}) {
            return {
                edit: this.modelEdit.data,
                search: this.modelSearch,
                editUpdate: this.editUpdate,
                searchSubmit: this.searchSubmit,
                ...merge
            };
        },

        searchParamsDefault(params={}) {
            params = { q: '', page: 1, per_page: 10, ...params };
            params.page = parseInt(params.page);
            params.per_page = parseInt(params.per_page);
            return params;
        },

        async modelSearchInit() {
            if (!!+this.$route.query.edit) return;
            this.modelSearch.submit();
        },

        async modelEditInit() {
            if (!+this.$route.query.edit) return;
            const id = this.$route.query.edit;
            const { data } = await this.$axios.get(`/api/${this.namespace}/find/${id}`);
            this.modelEdit.data = data;
        },

        getTableActions(item) {
            let actDefault = {
                icon: false,
                onClick: false,
                to: false,
            };
            let actsDefault = {
                edit: {
                    icon: 'mdi-pencil',
                    to: `/admin/${this.namespace}?edit=${item.id}`,
                    click: (item) => {
                        this.modelEdit.data = {...item};
                    },
                },
                clone: {
                    icon: 'mdi-content-copy',
                    click: (item) => {},
                },
                delete: {
                    icon: 'mdi-delete',
                    click: (item) => {
                        this.$confirm(`Deletar ${item.name}?`).then(() => {
                            alert('aaa');
                        });
                    },
                },
            };
            let acts = {...actsDefault, ...this.tableActions};
            for(let i in acts) {
                if (!acts[i]) {
                    delete acts[i];
                    continue;
                }

                acts[i] = {...actDefault, ...acts[i]};
            }
            return Object.values(acts);
        },
    },

    mounted() {
        this.modelSearchInit();
        this.modelEditInit();
    },
}
</script>