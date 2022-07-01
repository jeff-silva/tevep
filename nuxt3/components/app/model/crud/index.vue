<template>
    <div>
        <!-- Edit -->
        <app-model-crud-edit
            v-if="$route.query.edit || $route.query.clone"
            v-bind="$props"
            @success="$emit('edit-success', $event)"
            @error="$emit('edit-error', $event)"
            @response="$emit('edit-response', $event)"
        >
            <template #edit-drawer="bind">
                <slot name="edit-drawer" v-bind="bind"></slot>
            </template>
            
            <template #edit-form="bind">
                <slot name="edit-form" v-bind="bind"></slot>
            </template>
        </app-model-crud-edit>

        <!-- Search -->
        <app-model-crud-search
            v-else
            v-bind="$props"
            @search-result="$emit('search-result', $event)"
        >   
            <template #search-drawer="bind">
                <slot name="search-drawer" v-bind="bind"></slot>
            </template>
            
            <template #search-header="bind">
                <slot name="search-header" v-bind="bind"></slot>
            </template>
            
            <template #search-table-header="bind">
                <slot name="search-table-header" v-bind="bind"></slot>
            </template>
            
            <template #search-table-item="bind">
                <slot name="search-table-item" v-bind="bind"></slot>
            </template>

            <template #search-table-loading="bind">
                <slot name="search-table-loading" v-bind="bind"></slot>
            </template>

            <template #search-table-empty="bind">
                <slot name="search-table-empty" v-bind="bind"></slot>
            </template>
        </app-model-crud-search>
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

import base from './base.vue';

export default {
    extends: base,
    props: {
        // 
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