<template>
    <form @submit.prevent="search.submit()">
        <!-- Footer actions -->
        <app-actions>
            <v-btn icon="mdi-plus" :to="`/admin/${namespace}?edit=new`"></v-btn>
            <v-btn icon="mdi-magnify" @click="drawer=true" class="d-md-none"></v-btn>
        </app-actions>

        <!-- Drawer actions -->
        <v-navigation-drawer
            v-model="drawer"
            location="right"
            width="300"
        >
            <v-card :title="app.title" :elevation="0">
                <v-divider />
                <v-card-text>
                    <div class="d-flex flex-column" style="gap:25px;">
                        <v-text-field
                            :label="`Buscar ${plural}`"
                            v-model="search.params.q"
                            hide-details
                        ></v-text-field>

                        <v-select
                            v-if="can.delete"
                            label="Estado"
                            v-model="search.params.deleted"
                            :items="[{value:'', title:'Ativo'}, {value:'1', title:'Deletado'}]"
                            @update:model-value="search.submit()"
                            hide-details
                        ></v-select>

                        <slot name="search-drawer" v-bind="slotBind()"></slot>
                    </div>
                </v-card-text>
                <v-divider class="my-2" />
                <v-card-text>
                    <div class="d-flex flex-column" style="gap:20px;">    
                        <v-btn type="submit" color="primary" block :disabled="search.loading">
                            Buscar
                        </v-btn>
                        
                        <v-btn color="white" block @click="search.clear().then(search.submit)">
                            Limpar
                        </v-btn>
                        
                        <v-btn color="error" block v-if="selectedIds.length && can.delete && !search.params.deleted">
                            Deletar {{ selectedIds.length }} {{ plural }}
                        </v-btn>
                        
                        <v-btn color="error" block v-if="selectedIds.length && can.restore && search.params.deleted">
                            Restaurar {{ selectedIds.length }} {{ plural }}
                        </v-btn>
                    </div>
                </v-card-text>
            </v-card>
        </v-navigation-drawer>

        <!-- Main -->
        <v-container class="pa-0" :fluid="fluid">
            <div style="height:3px;">
                <v-progress-linear
                    v-if="search.loading"
                    indeterminate
                />
            </div>
            <v-sheet elevation="5">
                <slot name="search-header" v-bind="slotBind()"></slot>
                <v-table>
                    <thead>
                        <tr>
                            <th class="px-2" style="min-width:40px; width:40px;">
                                <v-checkbox
                                    hide-details
                                    @click="selectAll($event)"
                                ></v-checkbox>
                            </th>
                            <slot name="search-table-header" v-bind="slotBind()"></slot>
                            <th class="app-model-crud-table-actions" width="30px"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Empty -->
                        <tr v-if="!search.loading && search.resp.data && search.resp.data.length==0">
                            <td colspan="100%">
                                <div class="text-center">Nenhum {{ singular }} encontrado</div>
                            </td>
                        </tr>

                        <!-- Item -->
                        <tr v-for="i in searchRespData" :key="$key(i)">
                            <td class="px-2">
                                <v-checkbox
                                    hide-details
                                    v-model="selectedIds"
                                    :value="i.item.id"
                                ></v-checkbox>
                            </td>
                            <slot name="search-table-item" v-bind="slotBind({ ...i })"></slot>
                            <td style="position:sticky; right:0; padding:0;s">
                                <v-menu location="start">
                                    <template #activator="{ props }">
                                        <v-btn icon="mdi-dots-vertical" v-bind="props" flat></v-btn>
                                    </template>

                                    <div class="d-inline-flex flex-wrap me-2" style="gap:10px; max-width:300px;">
                                        <v-btn
                                            v-for="act in i.actions"
                                            :key="$key(act)"
                                            v-bind="act"
                                            @click="act.click? act.click(i.item): null"
                                        ></v-btn>
                                    </div>
                                </v-menu>
                            </td>
                        </tr>
                    </tbody>
                </v-table>
                <v-divider />
                <div class="d-flex align-center py-1 px-5">
                    <div class="d-none d-md-flex">
                        {{ search.resp.total||0 }} {{ $filters.singularPlural(search.resp.total, 'resultado', 'resultados') }}
                    </div>

                    <v-pagination
                        v-if="search.resp.last_page"
                        v-model="search.params.page"
                        :length="search.resp.last_page"
                        @update:model-value="search.submit()"
                        class="flex-grow-1"
                    ></v-pagination>
                    
                    <div class="d-none d-md-flex">
                        <v-select
                            v-model="search.params.per_page"
                            :items="[5, 10, 15, 25, 50, 100]"
                            label="Exibir"
                            hide-details
                            density="compact"
                            @update:model-value="search.params.page=1; search.submit();"
                        ></v-select>
                    </div>
                </div>
            </v-sheet>
        </v-container>
    </form>
</template>

<script>
import base from './base.vue';

export default {
    extends: base,
    computed: {
        searchRespData() {
            return this.search.resp.data.map(item => {
                const actions = this.getItemActions(item);
                return { item, actions };
            });
        },
        can() {
            let can = this.getItemActions({id:''});
            for(let i in can) { can[i] = !!can[i]; }
            return can;
        },
    },
    data() {
        let params = {
            q: '',
            deleted: '',
            page: 1,
            per_page: 10,
            ...this.$route.query
        };

        params.page = parseInt(params.page);
        params.per_page = parseInt(params.per_page);

        return {
            selectedIds: [],
            search: useAxios({
                method: "get",
                url: `/api/${this.namespace}/search`,
                submit: true,
                params,
                resp: {
                    data: [],
                },
                onResponse: (resp) => {
                    this.search.paramns = resp.data.params;
                    this.$emit('search-result', this.slotBind({ resp }));
                    this.$router.push({ query: resp.data.params });
                },
            }),
        };
    },
    methods: {
        slotBind(merge={}) {
            // console.log('slotBind', merge);
            return {
                ...merge,
                ...this.$props,
                search: this.search,
            };
        },

        selectAll(ev) {
            const checked = ev.target.checked;
            if (!checked) { return this.selectedIds = []; }
            this.selectedIds = this.search.resp.data.map(item => item.id);
        },
    },
};
</script>