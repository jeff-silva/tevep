<template>
    <div>
        <v-container class="pa-0">
            <v-fade-transition group>
                <v-alert v-bind="a" :rounded="0" v-for="a in alerts" :key="$key(a)">
                    <template #append>
                        <v-btn icon flat size="x-small" color="transparent" @click="alertRemove(a.id)">
                            <v-icon>mdi-close</v-icon>
                        </v-btn>
                    </template>
                </v-alert>
            </v-fade-transition>
        </v-container>

        <!-- Edit -->
        <div v-if="isEditPage">
            <form @submit.prevent="modelEdit.submit().then(saveSuccess);">
                <app-actions>
                    <v-btn icon="mdi-plus-circle" @click="modelEditDrawer=true" v-if="!responsive.desktop"></v-btn>
    
                    <v-btn
                        v-bind="a"
                        @click="(typeof a.click=='function'? a.click(modelEdit.data, $event): null)"
                        v-for="a in getFormActions"
                        :key="$key(a)"
                    ></v-btn>
                </app-actions>
    
                <!-- Edit drawer -->
                <v-navigation-drawer
                    v-model="modelEditDrawer"
                    location="right"
                    width="300"
                >
                    <v-card :title="app.title" :elevation="0">
                        <v-divider />
                        <v-card-content>
                            <div class="d-flex flex-column" style="gap:15px;">
                                <v-btn
                                    v-bind="a"
                                    block
                                    @click="(typeof a.click=='function'? a.click(modelEdit.data, $event): null)"
                                    :icon="false"
                                    v-for="a in getFormActions"
                                    :key="$key(a)"
                                >
                                    {{ a.name }}
                                </v-btn>
                            </div>
                        </v-card-content>
                    </v-card>
                </v-navigation-drawer>
    
                <!-- Edit form -->
                <v-container class="pa-0" :fluid="editFluid">
                    <v-progress-linear indeterminate v-if="modelEdit.loading"></v-progress-linear>
                    <slot name="edit-card" v-bind="slotBind()">
                        <v-card elevation="0">
                            <v-card-text>
                                <slot name="edit-fields" v-bind="slotBind()"></slot>
                            </v-card-text>
                        </v-card>
                    </slot>
                </v-container>
            </form>
        </div>
    
        <!-- Search -->
        <div v-else>
            <app-actions>
                <v-btn icon="mdi-magnify" v-if="!responsive.desktop" @click="modelSearchDrawer=true"></v-btn>
                <v-btn icon="mdi-plus-circle" :to="`/admin/${namespace}?edit=new`"></v-btn>
    
                <v-menu location="top">
                    <template #activator="{ props }">
                        <v-btn icon="mdi-cloud-download" v-bind="props"></v-btn>
                    </template>
    
                    <v-list style="width:180px; margin-left:-100px;">
                        <v-list-item
                            :title="e.name"
                            @click="exportDownload(e)"
                            v-for="e in modelSearch.resp.exportUrls"
                            :key="$key(e)"
                        ></v-list-item>
                    </v-list>
                </v-menu>
    
                <!-- <v-btn icon="mdi-delete" @click="searchDelete()"></v-btn> -->
            </app-actions>
    
            <!-- Search drawer -->
            <v-navigation-drawer
                v-model="modelSearchDrawer"
                location="right"
                width="300"
            >
                <form @submit.prevent="modelSearch.submit()">
                    <v-card :title="app.title" :elevation="0">
                        <v-divider />
                        <div style="height:3px;">
                            <v-progress-linear
                                indeterminate
                                color="primary"
                                height="3"
                                :active="modelSearch.loading"
                            ></v-progress-linear>
                        </div>

                        <v-card-content>
                            <div class="d-flex flex-column" style="gap:20px;">
                                <v-text-field
                                    :label="`Buscar ${plural}`"
                                    v-model="modelSearch.params.q"
                                    hide-details
                                ></v-text-field>

                                <v-select
                                    label="Estado"
                                    v-if="tableActions.delete !== false"
                                    v-model="modelSearch.params.deleted"
                                    :items="[{value:'', title:'Ativo'}, {value:'1', title:'Deletado'}]"
                                    @update:model-value="modelSearch.submit()"
                                    hide-details
                                ></v-select>

                                <slot name="search-fields" v-bind="slotBind()"></slot>
                            </div>
                        </v-card-content>

                        <v-divider class="my-2" />

                        <v-card-content>
                            <div class="d-flex flex-column" style="gap:20px;">    
                                <v-btn type="submit" color="primary" block :disabled="modelSearch.loading">
                                    Buscar
                                </v-btn>
                                
                                <v-btn color="white" block @click="modelSearch.clear().then(searchSubmit)">
                                    Limpar
                                </v-btn>
                                
                                <v-btn color="error" block v-if="selectedIds.length && !modelSearch.params.deleted && tableActions.delete !== false" @click="modelDelete(selectedIds)">
                                    Deletar {{ selectedIds.length }} {{ plural }}
                                </v-btn>
                                
                                <v-btn color="error" block v-if="selectedIds.length && modelSearch.params.deleted" @click="modelRestore(selectedIds)">
                                    Restaurar {{ selectedIds.length }} {{ plural }}
                                </v-btn>
                            </div>
                        </v-card-content>
                    </v-card>
                </form>
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
                                <div class="text-center">Nenhum {{ singular }} encontrado</div>
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
                                <v-menu location="start">
                                    <template #activator="{ props }">
                                        <v-btn icon="mdi-dots-vertical" v-bind="props" flat></v-btn>
                                    </template>
    
                                    <div class="search-table-item-actions">
                                        <v-btn
                                            v-bind="act"
                                            class="me-2"
                                            @click="(typeof act.click=='function'? act.click(item, $event): null)"
                                            v-for="act in getTableActions(item)"
                                            :key="$key(act)"
                                        ></v-btn>
                                    </div>
                                </v-menu>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
                <v-divider></v-divider>
    
                <!-- Pagination -->
                <v-card elevation="0">
                    <div class="d-flex align-center py-2 px-5">
                        <div v-if="responsive.desktop">
                            {{ modelSearch.resp.total||0 }} {{ $filters.singularPlural(modelSearch.resp.total, 'resultado', 'resultados') }}
                        </div>
                        <v-spacer />

                        <v-pagination
                            v-if="modelSearch.resp.last_page"
                            v-model="modelSearch.params.page"
                            :length="modelSearch.resp.last_page"
                            @update:model-value="modelSearch.submit()"
                        ></v-pagination>
                        
                        <v-spacer />
                        <div v-if="responsive.desktop">
                            <v-select
                                v-model="modelSearch.params.per_page"
                                :items="[5, 10, 15, 25, 50, 100]"
                                label="Exibir"
                                hide-details
                                density="compact"
                                @update:model-value="modelSearch.params.page=1; modelSearch.submit();"
                            ></v-select>
                        </div>
                    </div>
                </v-card>
            </v-container>
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
        searchParams: {type:Object, default:()=>({})},
        editFluid: {default:false},
        tableActions: {type:Object, default:()=>({})},
        formActions: {type:Object, default:()=>({})},
    },

    watch: {
        '$route.query.edit': {deep:false, handler(value) {
            this.init();
        }},
    },

    computed: {
        isEditPage() {
            return Object.keys(this.$route.query).includes('edit');
        },

        getFormActions() {
            const item = this.modelEdit.data;
            return this.mergeActions(item, {
                save: {
                    name: 'Salvar',
                    icon: 'mdi-content-save',
                    type: 'submit',
                    color: 'primary',
                    disabled: this.valid.invalid,
                },
                cancel: {
                    name: 'Cancelar',
                    icon: 'mdi-close',
                    to: this.modelSearchUrl(),
                    click: () => {
                        // this.init();
                    },
                },
            }, this.formActions);
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
                    this.alert({type:'success', text:`${this.singular} salvo`});
                },
            }),
            app: useApp(),
            valid: useValidation(),
            selectedAll: false,
            selectedIds: [],
            responsive,
            alerts: [],
        };
    },

    methods: {
        slotBind(merge={}) {
            return {
                modelSearch: this.modelSearch,
                modelEdit: this.modelEdit,
                edit: this.modelEdit.data,
                responsive: this.responsive,
                alert: this.alert,
                valid: this.valid,
                ...merge
            };
        },

        searchParamsDefault(params={}) {
            params = { q: '', page: 1, per_page: 10, deleted:'', ...this.searchParams, ...params };
            params.page = parseInt(params.page);
            params.per_page = parseInt(params.per_page);
            if (params.edit) delete params.edit;
            return params;
        },

        init: useDebounceFn(function() {
            this.modelSearchInit();
            this.modelEditInit();
        }, 100),

        async modelSearchInit() {
            if (this.isEditPage) return;
            if (this.modelSearch.loading) return;
            this.app.setTitle(`Buscar ${this.plural}`);
            await this.modelSearch.submit();
        },

        async modelEditInit() {
            if (!this.isEditPage) return;
            const id = this.$route.query.edit || 'new';
            this.modelEdit.status = false;
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

        async modelDelete(id) {
            let message = this.modelSearch.params.deleted?
                `Deletar estes ${this.plural} para sempre? (Esta ação não poderá ser desfeita)`:
                `Deletar estes ${this.plural}?`;
            this.$confirm(message).then(async resp => {
                await this.$axios.post(`/api/${this.namespace}/delete`, { id });
                this.alert({type:'success', text:`${this.singular} deletado`});
                this.init();
            });
        },
        
        async modelRestore(id) {
            this.$confirm('Restaurar?').then(async resp => {
                await this.$axios.post(`/api/${this.namespace}/restore`, { id });
                this.alert({type:'success', text:`${this.singular} restaurado`});
                this.init();
            });
        },

        mergeActions(item, formActions={}, merge={}) {
            let acts = {...formActions, ...merge};
            for(let i in acts) {
                let act = acts[i];
                if (typeof act=='function') {
                    act = act(item);
                }
                if (!act) { delete acts[i]; continue; }
                acts[i] = { id: i, name: '', ...act };
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
                        this.alert({type:'warning', text:`Este ${this.singular} está sendo clonado`});
                    },
                },
                delete: () => {
                    if (this.modelSearch.params.deleted) {
                        return null;
                    }
                    return {
                        icon: 'mdi-delete',
                        click: (item) => {
                            this.modelDelete(item.id);
                        },
                    };
                },
                restore: () => {
                    if (!this.modelSearch.params.deleted) {
                        return null;
                    }
                    return {
                        icon: 'mdi-delete-restore',
                        click: (item) => {
                            this.modelRestore(item.id);
                        },
                    };
                },
            };
            
            return this.mergeActions(item, actsDefault, this.tableActions);
        },

        modelSearchUrl() {
            return localStorage.getItem(`app-model-crud-${this.namespace}-search-url`) || `/admin/${this.namespace}`;
        },

        selectAll: useDebounceFn(function() {
            this.selectedIds = [];
            if (!this.selectedAll) return;

            this.modelSearch.resp.data.forEach(item => {
                this.selectedIds.push(item.id);
            });
        }, 100),

        alert(message) {
            if (typeof message=='string') {
                message = {text:message};
            }

            message = {
                id: ('alert-'+ Math.round(Math.random()*9999)),
                type: 'success',
                text: '',
                timeout: 10000,
                ...message
            };

            if (message.timeout) {
                message.timeout = setTimeout(() => {
                    this.alertRemove(message.id);
                }, message.timeout);
            }

            this.alerts.push(message);
        },

        alertRemove(id) {
            for(const i in this.alerts) {
                const message = this.alerts[i];

                if (message.id==id) {
                    if (message.timeout) {
                        clearTimeout(message.timeout);
                    }
                    this.alerts.splice(i, 1);
                }
            }
        },
    },

    async mounted() {
        await this.init();
    },
}
</script>