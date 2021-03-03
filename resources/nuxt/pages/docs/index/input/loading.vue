<template><div>
    <ui-field label="Carregando">
        <ui-check v-model="bind.loading" :true-value="true" :false-value="false"></ui-check>
    </ui-field>

    <ui-field label="Tipo">
        <ui-check type="radio" v-model="bind.type" true-value="icon">Ícone</ui-check>
        <ui-check type="radio" v-model="bind.type" true-value="spinner">Spinner</ui-check>
        <ui-check type="radio" v-model="bind.type" true-value="progress">Progresso</ui-check>
    </ui-field>
    
    <ui-field label="Classe de cor">
        <input type="text" class="form-control" v-model="bind.colorClass">
        <a href="javascript:;" v-for="c in ['primary', 'danger', 'success', 'facebook', 'whatsapp']" class="mr-2" @click="bind.colorClass=c">{{ c }}</a>
    </ui-field>

    <ui-field label="Ícone">
        <input type="text" class="form-control" v-model="bind.icon">
        <a href="javascript:;" v-for="c in ['fas fa-sync', 'fas fa-spinner', 'fas fa-circle-notch', 'fas fa-cog']" class="mr-2" @click="bind.type='icon'; bind.icon=c">{{ c }}</a>
    </ui-field>

    <ui-field label="Porcentagem de progresso">
        <input type="number" class="form-control" min="0" max="100" v-model.number="bind.percent">
    </ui-field>

    <div class="bg-white shadow-sm p-3">
        <ui-loading v-bind="bind" :label="bind.percent+'%'"></ui-loading>
    </div>

    <ui-code :value="geCode()"></ui-code>
</div></template>

<script>
export default {
    data() {
        return {
            bind: {
                type: 'icon',
                icon: 'fas fa-sync',
                loading: true,
                percent: 50,
                colorClass: 'primary',
            },
        };
    },

    methods: {
        geCode() {
            return `<ui-loading v-bind='${JSON.stringify(this.bind, 2, '\t')}'></ui-loading>`;
        },
    },
}
</script>