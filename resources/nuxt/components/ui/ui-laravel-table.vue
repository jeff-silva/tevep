<template><div class="ui-laravel-table">

    <div class="progress rounded-0" style="height:5px;" :style="{opacity:(props.loading? 1: 0)}">
        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%;"></div>
    </div>

    <div class="bg-white p-3 text-muted shadow-sm" v-if="props.loading==false && props.value.data && props.value.data.length==0">
        <slot name="empty">
            Nenhum dado encontrado
        </slot>
    </div>

    <div v-else>
        <div class="bg-white shadow-sm">
            <table class="table table-sm table-hover table-striped table-borderless m-0">
                <!-- <thead>
                    <tr>
                        <th class="text-right">Ações</th>
                    </tr>
                </thead> -->
                <tbody>
                    <template v-for="i in props.value.data">
                        <tr>
                            <slot name="item" :item="i">
                                &lt;template #item="{item}"&gt;<br>
                                    &emsp;&lt;td&gt;<span v-pre>{{ item.name }}</span>&lt;/td&gt;<br>
                                &lt;/template&gt;
                            </slot>
                            <td class="ui-laravel-table-td-actions">
                                <div class="ui-laravel-table-td-actions-aaa">
                                    <div class="btn-group">
                                        <div class="btn-group m-0 d-md-flex" :class="{'d-none':show!=i}">
                                            <slot name="actions" :item="i"></slot>
                                        </div>
                                        <a href="javascript:;" class="btn d-md-none" @click="show = (show==i? false: i)">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <div class="text-right py-2" style="background:#f5f5f5;" v-if="props.loading==false">
                <div class="input-group m-0">
                    <div class="input-group-prepend input-group-btn">
                        <button type="button" class="btn btn-white">
                            <i class="fa fa-fw fa-caret-left"></i>
                        </button>
                    </div>

                    <div class="input-group-append input-group-btn">
                        <button type="button" class="btn btn-white">
                            <i class="fa fa-fw fa-caret-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div></template>


<script>export default {
    props: {
        value: {default: ()=>({})},
        loading: {default: false},
    },

    watch: {
        $props: {deep:true, handler(value) {
            this.props = Object.assign({}, value);
        }},
    },

    data() {
        let data = {};

        data.show = false;

        data.props = Object.assign({}, this.$props);
        data.props.value = Object.assign({
            current_page: 1,
            data: [],
            first_page_url: '',
            from: '',
            last_page: '',
            last_page_url: '',
            next_page_url: '',
            path: '',
            prev_page_url: '',
            to: '',
            total: '',
        }, data.props.value);

        return data;
    },
};</script>

<style>
.ui-laravel-table td {padding:15px;}
.ui-laravel-table-td-actions {text-align:right; padding:5px !important;}
.ui-laravel-table-td-actions .btn {margin:0px;}
.ui-laravel-table-td-actions-aaa {position:relative;}
@media (max-width: 768px) {
    .ui-laravel-table-td-actions-aaa .btn-group .btn-group {position:absolute; right:45px;}
}
</style>