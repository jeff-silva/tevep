<template><div class="ui-addresses">
    <button type="button" class="btn btn-outline-primary" @click="add()">
        <i class="fa fa-fw fa-plus"></i> Adicionar endereço
    </button>

    <div class="text-center text-muted p-3" v-if="props.value.length==0">
        Nenhum endereço cadastrado
    </div>

    <table class="table table-borderless table-striped">
        <tbody>
            <tr v-for="v in props.value" @click="edit=v">
                <td style="cursor:pointer;">
                    <strong class="d-block">{{ v.name||'Sem descrição' }}</strong>
                    <small class="d-block text-muted">{{ [v.route, v.district, v.city].join(' ') }}</small>
                </td>
            </tr>
        </tbody>
    </table>

    <ui-modal v-model="edit">
        <template #body>
            <ui-address v-model="edit"
                :reference="reference"
                :ref-id="refId"
                :show-btn-save="false"
                ref="edit"
                @saved="edit=false; list()"
            ></ui-address>
        </template>

        <template #footer>
            <button type="button" class="btn btn-primary" @click="$refs.edit.save()">
                <i class="fa fa-fw fa-save"></i> Salvar
            </button>
        </template>
    </ui-modal>
</div></template>

<script>export default {
    props: {
        reference: {default:''},
        refId: {default:''},
        value: {default: () => ([])},
        loadOnStart: {default:true},
    },

    methods: {
        list() {
            var params = {
                ref: this.reference,
                ref_id: this.refId,
            };
            this.$axios.get('/api/address/search', {params:params}).then((resp) => {
                this.props.value = resp.data;
            });
        },

        add() {
            this.props.value.push({
                name: `Endereço #${this.props.value.length+1}`,
            });
            this.edit = this.props.value[this.props.value.length-1];
        },
    },

    data() {
        return {
            props: Object.assign({}, this.$props),
            edit: false,
        };
    },

    mounted() {
        if (this.loadOnStart) {
            this.list();
        }
    },
};</script>
