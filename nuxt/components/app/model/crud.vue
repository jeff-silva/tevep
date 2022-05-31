<template>

    <!-- Edit -->
    <div v-if="isEditPage">
        <form @submit.prevent="modelEdit.submit().then(saveSuccess);">
            <app-actions>
                <v-btn icon="mdi-plus-circle" @click="modelEditDrawer=true" v-if="!responsive.desktop"></v-btn>

                <template v-for="(a, i) in getFormActions()">
                    <v-btn
                        v-bind="a"
                        @click="(typeof a.click=='function'? a.click(modelEdit.data, $event): null)"
                    ></v-btn>
                </template>
            </app-actions>

            <!-- Edit drawer -->
            <v-navigation-drawer
                v-model="modelEditDrawer"
                position="right"
                width="300"
            >
                <v-card :title="app.title" :elevation="0">
                    <v-card-content>
                        <template v-for="(a, i) in getFormActions()">
                            <v-btn
                                v-bind="a"
                                block
                                @click="(typeof a.click=='function'? a.click(modelEdit.data, $event): null)"
                                :class="{'mt-3':i}"
                                :icon="false"
                            >
                                {{ a.name }}
                            </v-btn>
                        </template>
                    </v-card-content>
                </v-card>
            </v-navigation-drawer>

            <!-- Edit form -->
            <v-container :fluid="editFluid">
                <v-card>
                    <v-progress-linear indeterminate v-if="modelEdit.loading"></v-progress-linear>
                    <v-alert type="success" :rounded="0" @click="modelEdit.status=false" v-if="modelEdit.status==200">Dados salvos</v-alert>

                    <slot name="edit-card" v-bind="slotBind()">
                        <v-card>
                            <v-card-text>
                                <slot name="edit-fields" v-bind="slotBind()"></slot>
                            </v-card-text>
                        </v-card>
                    </slot>
                </v-card>
            </v-container>
        </form>
    </div>

    <!-- Search -->
    <div v-else>
        <app-actions>
            <v-btn icon="mdi-magnify" v-if="!responsive.desktop" @click="modelSearchDrawer=true"></v-btn>
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

        <!-- Search drawer -->
        <v-navigation-drawer
            v-model="modelSearchDrawer"
            position="right"
            width="300"
        >
            <v-card :title="app.title" :elevation="0">
                <div style="height:3px;">
                    <v-progress-linear
                        indeterminate
                        color="primary"
                        height="3"
                        :active="modelSearch.loading"
                    ></v-progress-linear>
                </div>
                <v-card-content>
                    <form @submit.prevent="modelSearch.submit()">
                        <v-text-field :label="`Buscar ${plural}`" v-model="modelSearch.params.q"></v-text-field>
    
                        <slot name="search-fields" v-bind="slotBind()"></slot>
    
                        <v-btn type="submit" color="primary" block :disabled="modelSearch.loading">
                            Buscar
                        </v-btn>
                        
                        <v-btn color="white" class="mt-4" block @click="modelSearch.clear().then(searchSubmit)">
                            Limpar
                        </v-btn>
                        
                        <v-btn color="error" class="mt-4" block v-if="selectedIds.length">
                            Deletar {{ selectedIds.length }} {{ plural }}
                        </v-btn>
                    </form>
                </v-card-content>
            </v-card>
        </v-navigation-drawer>

        <v-container class="pa-0">

            <!-- Search header -->
            <div v-if="$slots['search-header']" class="mb-5">
                <slot name="search-header" v-bind="slotBind()"></slot>
            </div>

            <!-- Search table -->
            <v-table>
                <thead>
                    <tr>
                        <th class="px-2" style="min-width:40px; width:40px;">
                            <v-checkbox
                                hide-details
                                v-model="selectedAll"
                                @click="selectAll()"
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
                                :active="modelSearch.loading"
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
                                v-model="selectedIds"
                                :value="item.id"
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

            <!-- Pagination -->
            <v-card elevation="0">
                <div class="d-flex align-center">
                    <div class="ps-4" v-if="responsive.desktop">
                        {{ modelSearch.resp.total||0 }} {{ $filters.singularPlural(modelSearch.resp.total, 'resultado', 'resultados') }}
                    </div>
                    <div class="flex-grow-1">
                        <v-pagination
                            v-if="modelSearch.resp.last_page"
                            v-model="modelSearch.params.page"
                            :length="modelSearch.resp.last_page"
                            @update:model-value="modelSearch.submit()"
                        ></v-pagination>
                    </div>
                    <div class="px-4 py-2" v-if="responsive.desktop">
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
        </v-container>
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
import {
    useDebounceFn,
    useBreakpoints,
} from '@vueuse/core';

export default {
    props: {
        namespace: {default:''},
        actionsExcept: {default:()=>([]), type:Array},
        singular: {default:'Item'},
        plural: {default:'Itens'},
        searchFluid: {default:false},
        editFluid: {default:false},
        tableActions: {type:Object, default:()=>({})},
        formActions: {type:Object, default:()=>({})},
    },

    async mounted() {
        await this.init();
    },

    computed: {
        isEditPage() {
            return Object.keys(this.$route.query).includes('edit');
        },
    },

    data() {
        const responsive = useBreakpoints({ desktop: 1279 });
        return {
            modelSearchDrawer: responsive.desktop,
            modelEditDrawer: responsive.desktop,
            modelSearch: useAxios({
                method: "get",
                url: `/api/${this.namespace}/search`,
                params: this.searchParamsDefault(this.$route.query),
                resp: {data:[]},
                onSubmited: (resp) => {
                    if (this.isEditPage) return;
                    this.selectedAll = false;
                    this.selectedIds = [];
                    this.$router.push({ query: this.modelSearch.params }).then(resp => {
                        localStorage.setItem(`app-model-crud-${this.namespace}-search-url`, this.$route.fullPath);
                    });
                },
            }),
            modelEdit: useAxios({
                method: "post",
                url: `/api/${this.namespace}/save`,
                data: {},
                onSubmited: (resp) => {
                    this.modelEdit.data = resp.data;
                    this.app.setTitle(`Editar ${this.singular}: ${this.modelEdit.data.name}`);
                },
            }),
            app: useApp(),
            selectedAll: false,
            selectedIds: [],
            responsive,
        };
    },

    methods: {
        slotBind(merge={}) {
            return {
                modelSearch: this.modelSearch,
                modelEdit: this.modelEdit,
                edit: this.modelEdit.data,
                responsive: this.responsive,
                ...merge
            };
        },

        searchParamsDefault(params={}) {
            params = { q: '', page: 1, per_page: 10, ...params };
            params.page = parseInt(params.page);
            params.per_page = parseInt(params.per_page);
            if (params.edit) delete params.edit;
            return params;
        },

        init: useDebounceFn(async function() {
            await this.modelSearchInit();
            await this.modelEditInit();
        }, 100),

        async modelSearchInit() {
            if (this.isEditPage) return;
            if (this.modelSearch.loading) return;
            this.app.setTitle(`Buscar ${this.plural}`);
            await this.modelSearch.submit();
        },

        async modelEditInit() {
            if (!this.isEditPage) return;
            const id = +this.$route.query.edit;
            this.modelEdit.status = false;

            if (isNaN(id)) {
                this.modelEdit.data = {};
                return;
            }

            if (this.modelEdit.loading) return;
            this.modelEdit.loading = true;

            try {
                this.modelEdit.loading = false;
                const { data } = await this.$axios.get(`/api/${this.namespace}/find/${id}`);
                this.modelEdit.data = data;
            }
            catch(err) { this.modelEdit.loading = false; }
            finally { this.modelEdit.loading = false; }
            this.app.setTitle(`Editar ${this.singular}: ${this.modelEdit.data.name}`);
        },

        mergeActions(item, formActions={}, merge={}) {
            let acts = {...formActions, ...merge};
            for(let i in acts) {
                let act = acts[i];
                if (!act) { delete acts[i]; continue; }
                if (typeof act=='function') {
                    act = act(item);
                }
                acts[i] = { name: '', ...act };
            }
            return Object.values(acts);
        },

        getTableActions(item) {
            let actsDefault = {
                edit: {
                    icon: 'mdi-pencil',
                    to: `/admin/${this.namespace}?edit=${item.id}`,
                    click: (item) => {
                        this.modelEdit.data = {...item};
                        this.init();
                    },
                },
                clone: {
                    icon: 'mdi-content-copy',
                    click: (item) => {
                        this.modelEdit.data = {...item};
                        this.modelEdit.data.id = null;
                        this.$router.push({
                            query: {edit: 'new'},
                        });
                    },
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
            
            return this.mergeActions(item, actsDefault, this.tableActions);
        },
        
        getFormActions() {
            const item = this.modelEdit.data;
            return this.mergeActions(item, {
                save: {
                    name: 'Salvar',
                    icon: 'mdi-content-save',
                    type: 'submit',
                    color: 'primary',
                },
                cancel: {
                    name: 'Cancelar',
                    icon: 'mdi-close',
                    to: this.modelSearchUrl(),
                    click: () => {
                        this.init();
                    },
                },
            }, this.formActions);
        },

        modelSearchUrl() {
            let url = localStorage.getItem(`app-model-crud-${this.namespace}-search-url`);
            return url || `/admin/${this.namespace}`;
        },

        selectAll: useDebounceFn(function() {
            this.selectedIds = [];
            if (!this.selectedAll) return;

            this.modelSearch.resp.data.forEach(item => {
                this.selectedIds.push(item.id);
            });
        }, 100),
    },
}
</script>