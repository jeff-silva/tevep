<template>
    <ui-form ref="search" method="get"
        :action="`/api/${modelName}/search`"
        v-model="searchParams"
        #default="{loading, response}"
        :mounted-submit="true"
        @response="searchParamsUrl()"
        class="ui-model-search"
    >
        <div class="row g-0">
            <div class="col-12 pb-3 px-2">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 d-md-none pe-2">
                        <button type="button" class="btn btn-light w-100" @click="$refs.searchForm.show()">
                            Filtro
                        </button>
                    </div>

                    <div class="flex-grow-1 d-none d-md-block">
                        &nbsp;
                    </div>

                    <ui-mobile-action>
                        <slot name="header-actions"></slot>
        
                        <transition name="el-fade-in-linear">
                            <a href="javascript:;" class="btn btn-danger" v-if="selecteds.length && !searchParams.deleted" @click="modelDelete(selecteds)">
                                <i class="fas fa-times me-1"></i> Deletar {{ selecteds.length }}
                            </a>
                        </transition>
        
                        <transition name="el-fade-in-linear">
                            <a href="javascript:;" class="btn btn-success" v-if="selecteds.length && searchParams.deleted" @click="modelRestore(selecteds)">
                                <i class="fas fa-times me-1"></i> Restaurar {{ selecteds.length }}
                            </a>
                        </transition>
        
                        <ui-dropdown type="bottom-right">
                            <a href="javascript:;" class="btn btn-outline-success">
                                <i class="fas fa-download me-1"></i> Exportar
                            </a>
        
                            <template #dropdown>
                                <div class="p-1">
                                    <button type="button" class="btn w-100 mb-1" @click="downloadExport('csv')">CSV</button>
                                    <button type="button" class="btn w-100 mb-1" @click="downloadExport('json')">JSON</button>
                                    <button type="button" class="btn w-100 mb-0" @click="downloadExport('html')">HTML</button>
                                </div>
                            </template>
                        </ui-dropdown>
        
                        <nuxt-link :to="`/admin/${modelName}/new`" class="btn btn-outline-primary" v-if="actionsDefault">
                            <i class="fas fa-fw fa-plus me-1"></i> Novo
                        </nuxt-link>
                    </ui-mobile-action>
                </div>

            </div>
    
            <div class="col-12 col-md-3">
                <div class="bg-white p-2 shadow-sm">
                    <ui-mobile-action :slot-button="false" ref="searchForm">
                        
                        <div class="ui-model-search-search-fields mb-4">
                            <div class="input-group form-control p-0">
                                <input type="text" class="form-control border-0 bg-transparent" :placeholder="`Buscar ${plural}`" v-model="searchParams.q">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn border-0 bg-transparent shadow-none" v-loading="loading">
                                        <i class="fas fa-fw fa-search"></i>
                                    </button>
                                </div>
                            </div>
        
                            <select class="form-control" v-model="searchParams.deleted" @change="submit()">
                                <option value="">Ativos</option>
                                <option value="1">Deletados</option>
                            </select>
        
                            <slot name="search-fields"></slot>
                        </div>
            
                        <button type="submit" class="btn btn-primary shadow-none w-100" v-loading="loading">
                            <i class="fas fa-fw fa-search"></i> Buscar
                        </button>
        
                        <button type="button" class="btn shadow-none w-100 mt-2" @click="searchParams=searchParamsDefault(); submit().then(resp => searchParamsUrl())">
                            <i class="fas fa-fw fa-times"></i> Limpar
                        </button>
        
                        <slot name="search-actions"></slot>
                    </ui-mobile-action>
                </div>
            </div>
    
            <div class="col-12 col-md-9 pt-3 pt-md-0 ps-md-3">
                <div class="bg-white shadow-sm">
                    <table class="table table-striped table-hover table-borderless m-0" style="box-shadow:none;">
                        <thead>
                            <tr>
                                <th width="30px">
                                    <input type="checkbox" class="form-control" @click="selecteds=$event.target.checked? response.data.map(item => item.id): [];">
                                </th>
                                <slot name="table-header">
                                    <th>-</th>
                                </slot>
                                <th width="10px"></th>
                            </tr>
                        </thead>
                        
                        <tbody>
        
                            <!-- Empty -->
                            <tr v-if="response && response.data && response.data.length==0">
                                <slot name="table-empty">
                                    <td class="text-center py-3" colspan="10">
                                        Nenhum item encontrado
                                    </td>
                                </slot>
                            </tr>
        
                            <tr v-for="i in response.data">
                                <td>
                                    <input type="checkbox" class="form-control" :value="i.id" v-model="selecteds">
                                </td>
                                
                                <slot name="table-row" :item="i">
                                    <td>{{ i }}</td>
                                </slot>
    
                                <td v-if="tableActions">
                                    <ui-dropdown type="left" trigger="hover">
                                        <button type="button" class="btn btn-light" style="border-radius:50%;">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>

                                        <template #dropdown>
                                            <div class="ui-model-search-table-actions p-2">
                                                <slot name="table-actions" :item="i"></slot>
                                                        
                                                <slot name="table-actions-default" :item="i">
                                                    <nuxt-link :to="`/admin/${modelName}/${i.id}`" class="btn btn-primary" v-if="actionsExcept.indexOf('edit')<0">
                                                        <i class="fas fa-fw fa-pen"></i> Editar
                                                    </nuxt-link>
                                                    
                                                    <button type="button" class="btn btn-light" @click="modelClone(i)" v-if="actionsExcept.indexOf('clone')<0">
                                                        <i class="fas fa-fw fa-copy"></i> Clonar
                                                    </button>
    
                                                    <button type="button" class="btn btn-success" @click="modelRestore(i.id)" v-if="i.deleted_at">
                                                        <i class="fas fa-fw fa-undo"></i> Restaurar
                                                    </button>
                    
                                                    <button type="button" class="btn btn-danger" @click="modelDelete(i.id)" v-if="!i.deleted_at && actionsExcept.indexOf('delete')<0">
                                                        <i class="fas fa-fw fa-times"></i> Deletar
                                                    </button>
                                                </slot>
                                            </div>
                                        </template>
                                    </ui-dropdown>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="p-2">
                        <el-pagination
                            background
                            layout="prev, pager, next, sizes"
                            :current-page.sync="searchParams.page"
                            :page-size.sync="searchParams.per_page"
                            :pager-count="11"
                            :total="(response? response.total: 0)"
                            :page-sizes="[5, 10, 25, 50, 100]"
                            @size-change="submit()"
                            @current-change="submit()"
                            @prev-click="submit()"
                            @next-click="submit()"
                        ></el-pagination>
                    </div>
                </div>
            </div>
        </div>
    </ui-form>
</template>

<script>
export default {
    props: {
        modelName: {default:""},
        singular: {default:"Item"},
        plural: {default:"Itens"},
        changeUrl: {default:true},
        actionsDefault: {default:true},
        tableActions: {default:true},
        actionsExcept: {default:()=>([]), type:Array},
    },

    data() {
        return {
            searchParams: this.searchParamsDefault(this.$route.query),
            selecteds: [],
            mobileSearchParamsModal: false,
        };
    },

    methods: {
        submit() {
            return new Promise((resolve, reject) => {
                this.mobileSearchParamsModal = false;
                setTimeout(() => {
                    this.selecteds = [];
                    this.$refs.search.submit().then(resp => {
                        resolve();
                    }).catch(reject);
                }, 10);
            });
        },

        searchParamsDefault(merge={}) {
            merge = {
                q: '',
                page: 1,
                per_page: 10,
                orderby: "updated_at",
                order: "desc",
                deleted: "",
                ...merge
            };
            ['page', 'per_page'].forEach(attr => { merge[attr] = parseInt(merge[attr]); });
            return merge;
        },

        searchParamsUrl() {
            if (!this.changeUrl) return;
            this.$router.push({
                query: this.searchParams,
            });
            setTimeout(() => {
                let u = new URL(location.href);
                localStorage.setItem(`ui-model-search-${this.modelName}-url`, `${u.pathname}${u.search}`);
            }, 200);
        },

        orderByArrow() {
            this.$el.querySelectorAll('[data-orderby]').forEach(elem => {
                let orderby = elem.getAttribute("data-orderby");
                if (this.searchParams.orderby==orderby) { elem.setAttribute("data-order", this.searchParams.order); }
                else { elem.removeAttribute("data-order"); }
            });
        },

        orderbyHandleClick() {
            this.$el.addEventListener('click', ev => {
                let target = ev.target;
                let orderby = target.getAttribute("data-orderby");
                if (!orderby) return;

                if (orderby==this.searchParams.orderby) {
                    this.searchParams.order = this.searchParams.order=="asc"? "desc": "asc";
                }

                this.searchParams.orderby = orderby;
                this.orderByArrow();
                this.searchParamsUrl();
                this.submit();
            });
            this.orderByArrow();
        },

        downloadExport(format) {
            let u = new URLSearchParams();
            for(let i in this.searchParams) { u.append(i, this.searchParams[i] || ''); }
            u.append('format', format);
            
            this.$axios({
                url: `/api/${this.modelName}/export?${u.toString()}`,
                method: "get",
                responseType: 'blob',
            }).then(resp => {
                Object.assign(document.createElement('a'), {
                    href: URL.createObjectURL(resp.data),
                    download: `data-export.${format}`,
                }).click();
            });
        },

        modelDelete(id) {
            let forced = !!this.searchParams.deleted;
            let confirmText = forced? `Deseja deletar estes itens permanentemente?\nEsta ação não pode ser desfeita.`: 'Deseja deletar estes itens?';
            let deleted = forced;
            this.$confirm(confirmText).then(resp => {
                this.$axios.post(`/api/${this.modelName}/delete`, {id, deleted, forced}).then(resp => {
                    this.selecteds = [];
                    this.submit();
                });
            });
        },

        modelClone(model) {
            this.$confirm(`Clonar ${model.name}?`).then(resp => {
                this.$axios.post(`/api/${this.modelName}/clone/${model.id}`, {name:`${model.name} #${model.id} clone`}).then(resp => {
                    this.submit();
                });
            });
        },

        modelRestore(id) {
            this.$confirm('Deseja restaurar este item?').then(resp => {
                this.$axios.post(`/api/${this.modelName}/restore`, {id, deleted:1}).then(resp => {
                    this.submit();
                });
            });
        },
    },

    mounted() {
        this.orderbyHandleClick();
    },
}
</script>

<style>
.ui-model-search-search-fields > * {
    margin-bottom: 15px;
}

.ui-model-search .table th {font-weight:bold;}

.ui-model-search [data-orderby] {cursor:pointer;}
.ui-model-search [data-order="asc"]:after {content: "↓"; float: right;}
.ui-model-search [data-order="desc"]:after {content: "↑"; float: right;}

.ui-model-search-table-actions > * {
    width: 100%;
    margin-bottom: 8px;
}

.ui-model-search-table-actions > *:last-child {
    margin-bottom: 0;
}

@media (min-width: 992px) {
    .ui-model-search-table-actions {
        width: 150px;
    }
}
</style>