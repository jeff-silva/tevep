<template>
    <ui-form ref="search" method="get"
        :action="`/api/${modelName}/search`"
        v-model="searchParams"
        #default="{loading, response}"
        :mounted-submit="true"
        @response="searchParamsUrl()"
        class="ui-model-search"
    >

        <!-- <ui-teleport-to :to="$refs.bbb||false">
            <div>
                <input type="text" class="form-control" v-model="$auth.user.name">
                <div>{{ $auth.user.name }}</div>
            </div>
        </ui-teleport-to>

        <div ref="bbb" style="border:solid 1px green; height:100px;"></div>

        <div ref="hello" style="border: solid 1px brown;">
            <div>
                <input type="text" class="form-control" v-model="$auth.user.name" @keyup="$log($event.target.value)">
                <div>{{ $auth.user.name }}</div>
            </div>
        </div>

        <div style="border:solid 1px blue; padding:5px;">
            <ui-teleport-from :target="$refs.hello||false"></ui-teleport-from>
        </div>
        <div style="border:solid 1px blue; padding:5px;">
            <ui-teleport-from :target="$refs.hello||false"></ui-teleport-from>
        </div> -->

        <div class="row g-0">
            <div class="col-12 pb-3 d-md-none">
                <button type="button" class="btn btn-primary w-100" @click="$refs.searchForm.show()">
                    Filtros e ações
                </button>
            </div>
    
            <div class="col-12 col-md-3">
                <div class="bg-white p-3 shadow-sm">
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
        
                        <button type="button" class="btn btn-light w-100 mt-2" @click="searchParams=searchParamsDefault(); submit().then(resp => searchParamsUrl())">
                            <i class="fas fa-fw fa-times"></i> Limpar
                        </button>

                        <nuxt-link :to="`/admin/${modelName}/new`" class="btn btn-light w-100 mt-2" v-if="actionsDefault">
                            <i class="fas fa-fw fa-plus me-1"></i> Novo
                        </nuxt-link>

                        <ui-dropdown type="right" class="w-100">
                            <a href="javascript:;" class="btn btn-light w-100 mt-2">
                                <i class="fas fa-download me-1"></i> Exportar
                            </a>
        
                            <template #dropdown>
                                <div class="p-1" style="width:200px;">
                                    <button type="button" class="btn w-100 mb-1"
                                        @click="downloadExport(f.ext)"
                                        v-for="f in $store.state.env.exportFormats"
                                    > {{ f.name }} </button>
                                </div>
                            </template>
                        </ui-dropdown>

                        <transition name="el-zoom-in-top">
                            <a href="javascript:;" class="btn btn-danger text-white w-100 mt-2" v-if="selecteds.length && !searchParams.deleted" @click="modelDelete(selecteds)">
                                <i class="fas fa-times me-1"></i> Deletar {{ selecteds.length }}
                            </a>
                        </transition>
        
                        <transition name="el-zoom-in-top">
                            <a href="javascript:;" class="btn btn-success text-white w-100 mt-2" v-if="selecteds.length && searchParams.deleted" @click="modelRestore(selecteds)">
                                <i class="fas fa-times me-1"></i> Restaurar {{ selecteds.length }}
                            </a>
                        </transition>
        
                        <slot name="search-actions"></slot>
                    </ui-mobile-action>
                </div>
            </div>
    
            <div class="col-12 col-md-9 pt-3 pt-md-0 ps-md-3">
                <div class="bg-white shadow-sm">
                    <div style="position:relative; overflow:auto;">
                        <table class="table table-striped table-hover table-borderless m-0" style="box-shadow:none;">
                            <thead>
                                <tr>
                                    <th width="30px">
                                        <input type="checkbox" class="form-control" @click="selecteds=$event.target.checked? response.data.map(item => item.id): [];">
                                    </th>
                                    <slot name="table-header">
                                        <th>-</th>
                                    </slot>
                                    <th width="10px" style="position:sticky; right:0;"></th>
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
        
                                    <td class="ui-model-search-table-actions" style="position:sticky; right:0;">
                                        <!-- <a href="javascript:;" class="btn btn-light">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </a> -->
                                        <div style="white-space:nowrap;">
                                            <slot name="table-actions" :item="i"></slot>
                                            <template v-if="tableActions">
                                                <slot name="table-actions-default" :item="i">
                                                    <nuxt-link :to="`/admin/${modelName}/${i.id}`" class="btn btn-primary" v-if="actionsExcept.indexOf('edit')<0">
                                                        <i class="fas fa-fw fa-pen text-white"></i>
                                                    </nuxt-link>
                                                    
                                                    <button type="button" class="btn btn-light" @click="modelClone(i)" v-if="actionsExcept.indexOf('clone')<0">
                                                        <i class="fas fa-fw fa-copy text-dark"></i>
                                                    </button>
            
                                                    <button type="button" class="btn btn-success" @click="modelRestore(i.id)" v-if="i.deleted_at">
                                                        <i class="fas fa-fw fa-undo text-white"></i>
                                                    </button>
                    
                                                    <button type="button" class="btn btn-danger" @click="modelDelete(i.id)" v-if="!i.deleted_at && actionsExcept.indexOf('delete')<0">
                                                        <i class="fas fa-fw fa-times text-white"></i>
                                                    </button>
                                                </slot>
                                            </template>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

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

.ui-model-search-table-actions {
    background: transparent !important;
}

.ui-model-search-table-actions .btn {
    width: 40px;
    height: 40px;
    padding: 7px;
    border-radius: 50%;
}
</style>