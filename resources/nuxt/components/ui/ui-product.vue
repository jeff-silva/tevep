<template><div>
    <ui-form method="post" action="/api/products/save/" #default="form" v-model="props.value" @saved="saved($event)">
        <div v-if="form.loading"><span v-html="form.loading"></span> Carregando...</div>

        <ui-field type="text" v-model="props.value.name" label="Nome"></ui-field>
        <ui-field type="textarea" v-model="props.value.description" label="Descrição"></ui-field>
        
        <ui-field v-model="props.value.category" label="Qual a categoria do seu produto?">
            <template #field>
                <ui-select v-model="props.value.category"
                    :items="productCategories"
                    item-value="slug"
                    item-label="name"
                >
                    <template #item="{item}">
                        <div class="d-flex">
                            <div :style="`width:50px; height:50px; background:url(${item.photo}) center center no-repeat; background-size:cover;`"></div>
                            <div class="pl-3">
                                <div class="font-weight-bold">{{ item.name }}</div>
                                <div><small class="text-muted">{{ item.description }}</small></div>
                            </div>
                        </div>
                    </template>
                </ui-select>
            </template>
        </ui-field>

        <ui-field v-model="props.value.type" label="Qual seu segmento?">
            <template #field>
                <ui-select v-model="props.value.type"
                    :items="productTypes"
                    item-value="slug"
                    item-label="name"
                    :show-search="false"
                >
                    <template #item="{item}">
                        <div class="d-flex">
                            <div :style="`width:50px; height:50px; background:url(${item.photo}) center center no-repeat; background-size:cover;`"></div>
                            <div class="pl-3">
                                <div class="font-weight-bold">{{ item.name }}</div>
                                <div><small class="text-muted">{{ item.description }}</small></div>
                            </div>
                        </div>
                    </template>
                </ui-select>
            </template>
        </ui-field>

        <ui-field v-model="props.value" label="Informe o endereço">
            <template #field>
                <ui-address v-model="props.value"></ui-address>
            </template>
        </ui-field>

        <div class="text-right">
            <button type="button" class="btn" @click="props.value=modelDefault('products'); emit();">
                <i class="fa fa-fw fa-save"></i> Limpar
            </button>

            <button type="submit" class="btn btn-primary">
                <i class="fa fa-fw fa-save"></i> Salvar
            </button>
        </div>
    </ui-form>
    <pre>{{ props.value }}</pre>
</div></template>

<script>export default {
    layout: 'admin',
    middleware: 'auth',

    props: {
        value: {default: ()=>({})},
    },

    watch: {
        $props: {
            deep: true,
            handler(value) {
                this.props = Object.assign({}, value);
            },
        },
    },

    methods: {
        emit() {
            this.$emit('input', this.props.value);
            this.$emit('value', this.props.value);
            this.$emit('change', this.props.value);
        },

        saved(resp) {
            this.$set(this.props, 'value', resp);
            this.emit();
            this.$emit('saved', resp);
        },
    },

    data() {
        let data = {};
        data.props = Object.assign({}, this.$props);
        data.props.value = Object.assign(this.modelDefault('products'), data.props.value);
        data.props.value.user_id = data.props.value.user_id||this.$user('id');
        data.productTypes = this.modelDefault('productTypes');
        data.productCategories = this.modelDefault('productCategories');
        return data;
    },
};</script>