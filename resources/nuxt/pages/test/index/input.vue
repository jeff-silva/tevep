<template><div class="page-test-input">
    <div v-for="e in examples" class="bg-white mb-3 shadow-sm">
        <div class="bg-secondary p-2 text-uppercase font-weight-bold" v-html="e.title"></div>
        <div class="row no-gutters align-items-center">
            <div class="col-12 col-md-7 p-3">
                <div v-html="e.description" class="text-muted mb-2"></div>
                <v-runtime-template :template="e.code"></v-runtime-template>
            </div>
            <div class="col-12 col-md-5 p-md-3">
                <ui-code v-model="e.code"></ui-code>
                <pre v-if="e.attr" class="m-0 mt-1">v-model: {{ values[e.attr] }}</pre>
            </div>
        </div>
    </div>
    <br>

    <!-- Hide to autoload -->
    <div style="display:none;">
        <ui-address></ui-address>
        <ui-auth-login></ui-auth-login>
        <ui-auth-password></ui-auth-password>
        <ui-auth-register></ui-auth-register>
        <ui-color></ui-color>
        <ui-content></ui-content>
        <ui-datepicker></ui-datepicker>
        <ui-money></ui-money>
        <ui-password></ui-password>
        <ui-phone></ui-phone>
        <ui-select></ui-select>
        <ui-timeago></ui-timeago>
        <ui-upload></ui-upload>
    </div>

    <!--
    <div class="row">
        <div class="col-12 col-md-5 form-group">
            <label>Texto simples</label>
            <ui-slider v-model="values.slider">
                <template #sliders>
                    <input type="range">
                    <input type="range">
                    <input type="range">
                </template>
            </ui-slider>
            
            <ui-datetime v-model="values.datetime"></ui-datetime>
            <ui-photo v-model="values.photo"></ui-photo>
        </div>
    </div>
    -->
</div></template>


<style>
.page-test-input pre {background:var(--dark); color:#fff; padding:5px; min-height:25.47px; margin-top:5px;}
</style>


<script>
import VRuntimeTemplate from "v-runtime-template";

export default {
    layout: 'coreui/admin',

    components: {
        VRuntimeTemplate,
    },

    data() {
        let data = {};

        data.examples = [];

        data.examples.push({
            title: 'text',
            description: 'Campo de texto simples',
            code: `<div>\n\t<input type="text" class="form-control" v-model="values.text" />\n</div>`,
            attr: 'text',
            value: 'Hello world!',
        });

        data.examples.push({
            title: 'ui-address',
            description: 'Retorna dados referentes ao endereço',
            code: '<ui-address v-model="values.address"></ui-address>',
            attr: 'address',
            value: {zipcode:'30710-380'},
        });

        data.examples.push({
            title: 'ui-auth-login',
            description: 'Componente para autenticação',
            code: '<ui-auth-login></ui-auth-login>',
            attr: false,
            value: false,
        });

        data.examples.push({
            title: 'ui-auth-password',
            description: 'Recuperação de senha',
            code: '<ui-auth-password></ui-auth-password>',
            attr: false,
            value: false,
        });

        data.examples.push({
            title: 'ui-auth-register',
            description: 'Componente para cadastro de usuário',
            code: '<ui-auth-register></ui-auth-register>',
            attr: false,
            value: false,
        });

        data.examples.push({
            title: 'ui-code',
            description: 'Editor de código',
            code: '<ui-code v-model="values.code"></ui-code>',
            attr: 'code',
            value: `let data = [];\ndata.push(Math.round(Math.random() * 999));\nconsole.log(data);`,
        });

        data.examples.push({
            title: 'ui-color',
            description: 'Código de cor no formato RGB8',
            code: '<ui-color v-model="values.color"></ui-color>',
            attr: 'color',
            value: '#00000055',
        });

        data.examples.push({
            title: 'ui-color (sem input)',
            description: 'Também retorna o código de cor, no entanto sem utilização da input',
            code: '<ui-color v-model="values.color" :show-input="false"></ui-color>',
            attr: 'color',
            value: '#00000055',
        });

        data.examples.push({
            title: 'ui-content',
            description: 'Conteúdo simples (aceita ctrl+b para negrito, ctrl+i para itálico, ctrl+u para underline). Também é possivel postar print.',
            code: '<ui-content v-model="values.content"></ui-content>',
            attr: 'content',
            value: '',
        });

        data.examples.push({
            title: 'ui-datepicker',
            description: 'Retorna data',
            code: '<ui-datepicker v-model="values.datepicker"></ui-datepicker>',
            attr: 'datepicker',
            value: '1986-02-11 15:30:00',
        });

        data.examples.push({
            title: 'ui-money',
            description: 'Campo de valor monetário',
            code: '<ui-money v-model="values.money"></ui-money>',
            attr: 'money',
            value: '12345.67',
        });

        data.examples.push({
            title: 'ui-password',
            description: 'Campo de senha',
            code: '<ui-password v-model="values.password"></ui-password>',
            attr: 'password',
            value: 'john123!@#',
        });

        data.examples.push({
            title: 'ui-phone',
            description: 'Campo de telefone',
            code: '<ui-phone v-model="values.phone"></ui-phone>',
            attr: 'phone',
            value: '+55 (31) 98765-4321',
        });

        data.examples.push({
            title: 'ui-select',
            description: 'Select avançado',
            code: `<ui-select v-model="values.select">
                <template #selected="{option}"><div class="badge badge-secondary mr-1">{{ option.text }}</div></template>
                <template #options="{select, selected}">
                    <div class="row no-gutters">
                        <div class="col-4 p-2" v-for="i in selectItems" @click="select(i, $event);" :class="{'bg-secondary':selected(i)}">
                            <strong>Opção:</strong> {{ i.text }}
                        </div>
                    </div>
                </template>
            </ui-select>`,
            attr: 'select',
            value: false,
        });

        data.examples.push({
            title: 'ui-select multiple',
            description: 'Select de múltiplos itens',
            code: `<ui-select v-model="values.selects" :multiple="true">
                <template #selected="{option}"><div class="badge badge-secondary mr-1">{{ option.text }}</div></template>
                <template #options="{select, selected}">
                    <div class="row no-gutters">
                        <div class="col-4 p-2" v-for="i in selectItems" @click="select(i, $event);" :class="{'bg-secondary':selected(i)}">
                            <strong>Opção:</strong> {{ i.text }}
                        </div>
                    </div>
                </template>
            </ui-select>`,
            attr: 'selects',
            value: [],
        });

        data.examples.push({
            title: 'ui-upload',
            description: 'Upload de arquivos',
            code: '<ui-upload v-model="values.upload"></ui-upload>',
            attr: 'upload',
            value: '',
        });

        data.values = {};

        data.examples.forEach(item => {
            if (item.attr && typeof data.values[item.attr]=='undefined') {
                data.values[item.attr] = item.value;
            }
        });

        data.selectItems = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20].map(n => {
            return {
                id: n,
                text: `Ítem ${n}`,
            };
        });

        return data;
    },
}
</script>