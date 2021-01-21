<template><div class="ui-table">

    <div style="overflow:auto;" :style="{maxHeight:props.maxHeight}">
        <table class="table table-borderless table-striped bg-white shadow-sm m-0" :class="{'table-hover':props.data.length>0, 'ui-table-fixed-header':props.fixedHeader}">
            <thead>
                <tr>
                    <th width="10px" v-if="select"><input type="checkbox" @change="toggleSelectAll($event.target);"></th>
                    <slot name="header">
                        <th>&nbsp;</th>
                    </slot>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td :colspan="headers.length" class="p-0">
                        <slot name="loading">
                            <div style="height:5px; position:relative;">
                                <div class="progress rounded-0" style="height:100%;" v-if="props.loading">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
                                </div>
                            </div>
                        </slot>
                    </td>
                </tr>
                
                <template v-if="props.data.length==0 && !props.loading">
                    <tr><td :colspan="headers.length"><slot name="empty">Nenhum item carregado</slot></td></tr>
                </template>

                <tr v-for="(i, iindex) in props.data" :key="i[props.loopKey]">
                    <td v-if="select"><input type="checkbox" @change="toggleSelect(i)" :checked="isSelected(i)"></td>
                    <slot name="item" :item="i">
                        <td><pre>{{ i }}</pre></td>
                    </slot>
                    <td width="50px">
                        <div class="ui-table-actions">
                            <div class="btn-group btn-group-sm">
                                <div class="btn-group btn-group-sm ui-table-actions-hidden">
                                    <slot name="actions" :item="i">&nbsp;</slot>
                                </div>
                                <a href="javascript:;" class="btn d-md-none"><i class="fa fa-fw fa-plus"></i></a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="bg-white">
        <div class="row no-gutters align-items-center">
            <div class="col-12 col-md-8 p-2">
                <ui-pagination v-bind="props" @change="onPaginationChange($event)"></ui-pagination>
            </div>

            <div class="col-12 col-md-4 p-2 text-md-right">
                Página {{ props.current_page }}/{{ props.last_page }}
                &nbsp; &bullet; &nbsp;
                {{ props.total }} Itens
            </div>
        </div>
    </div>
</div></template>


<style>
.ui-table * {transition: all 300ms ease;}
.ui-table table tbody td {vertical-align:middle;}

.ui-table-actions {position:relative; z-index:2;}
.ui-table-actions > .btn-group {position:absolute; top:-15px; right:0px;}
.ui-table-actions-hidden {white-space:nowrap; opacity:0; visibility:hidden;}
.ui-table-actions .btn {margin-left:5px!important; border-radius:5px!important;}
.ui-table table tbody tr:hover .ui-table-actions-hidden {opacity:1; visibility:visible;}

.ui-table-fixed-header {overflow-y: scroll;}
.ui-table-fixed-header thead th {position: sticky; top: 0; background:#f5f5f5; z-index:3;}
</style>


<script>export default {
    props: {
        value: {default: ()=>([])},
        data: {default: ()=>([])},
        fixedHeader: {default:true},
        select: {default:true},
        loading: {default:false},
        maxHeight: {default:'500px'},
        current_page: {default:1},
        from: {default:0},
        to: {default:0},
        last_page: {default:0},
        per_page: {default:0},
        total: {default:0},
        loopKey: {default:'id'},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    methods: {
        toggleSelect(item) {
            let index = this.value.indexOf(item);
            if (index==-1) { this.value.push(item); }
            else { this.value.splice(index, 1); }
            this.$emit('input', this.value);
        },

        toggleSelectAll(check) {
            this.$el.querySelectorAll('input[type=checkbox]').forEach(checkk => {
                if (check==checkk) return;
                checkk.checked = check.checked;
                checkk.dispatchEvent(new Event('change'));
            });
        },

        isSelected(item) {
            return this.value.indexOf(item)>-0;
        },

        getHeaders() {
            this.headers = [];
            this.$el.querySelectorAll('table thead th').forEach(item => {
                this.headers.push({
                    text: item.innerText,
                    width: item.getAttribute('width'),
                });
            });
        },

        onPaginationChange(pagination) {
            this.$emit('page-change', pagination);
        },
    },

    data() {
        let data = {};
        data.headers = [];
        data.props = Object.assign({}, this.$props);
        return data;
    },

    mounted() {
        this.getHeaders();
    },
};</script>
