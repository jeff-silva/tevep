<template><div class="ui-table">

    <div v-if="props.value.data.length==0">
        <slot name="empty">
            Nenhum dado encontrado
        </slot>
    </div>

    <div v-else>
        <table class="table table-sm table-borderless bg-white shadow-sm">
            <!-- <thead>
                <tr>
                    <th class="text-right">Ações</th>
                </tr>
            </thead> -->
            <tbody>
                <template v-for="i in props.value.data">
                    <tr>
                        <slot name="item" :item="i"></slot>
                        <td class="ui-table-td-actions">
                            <div class="ui-table-td-actions-aaa">
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
.ui-table-td-actions {text-align:right; border:solid 1px red;}
.ui-table-td-actions-aaa {position:relative;}
</style>