<template><div class="ui-laravel-table">

    <div class="progress rounded-0" style="height:5px;" :style="{opacity:(props.loading? 1: 0)}">
        <div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%;"></div>
    </div>

    <div v-if="props.loading==false && props.value.data && props.value.data.length==0">
        <slot name="empty">
            Nenhum dado encontrado
        </slot>
    </div>

    <div v-else>
        <div class="bg-white shadow-sm">
            <table class="table table-sm table-hover table-borderless m-0">
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
                                        <slot name="actions" :item="i"></slot>
                                        <!-- <a href="javascript:;" class="btn btn-dark">
                                            <i class="fa fa-fw fa-plus"></i>
                                        </a> -->
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

    <pre>$data: {{ $data }}</pre>
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
.ui-laravel-table-td-actions {text-align:right; border:solid 1px red;}
.ui-laravel-table-td-actions-aaa {position:relative;}
</style>