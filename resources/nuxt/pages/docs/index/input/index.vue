<template><div class="page-test-input">
    <div v-for="c in codes" class="pb-3">
        <div class="bg-white shadow-sm">
            <div class="font-weight-bold text-uppercase p-2" style="background:#eee;">{{ c.title }}</div>
            <div class="p-2">
                <v-runtime-template :template="c.code"></v-runtime-template>
            </div>
        </div>
        <pre class="m-0 text-white" v-if="typeof value[c.id] != 'undefined'">Valor: {{ value[c.id] }}</pre>
        <ui-code v-model="c.code"></ui-code>
    </div>

    <!-- Hide to autoload -->
    <div style="display:none;">
        <ui-address></ui-address>
        <ui-auth-login></ui-auth-login>
        <ui-auth-password></ui-auth-password>
        <ui-auth-register></ui-auth-register>
        <ui-check></ui-check>
        <ui-color></ui-color>
        <ui-content></ui-content>
        <ui-datetime></ui-datetime>
        <ui-html></ui-html>
        <ui-money></ui-money>
        <ui-password></ui-password>
        <ui-phone></ui-phone>
        <ui-timeago></ui-timeago>
        <ui-upload></ui-upload>
        <ui-photo></ui-photo>
        <ui-file></ui-file>
    </div>
</div></template>


<style>
.page-test-input pre {background:var(--dark); color:#fff; padding:5px; min-height:25.47px; margin-top:5px;}
</style>


<script>
import VRuntimeTemplate from "v-runtime-template";

let codes = [];

codes.push({
    id: "text",
    title: "Texto simples",
    code: `<input type="text" class="form-control" v-model="value.text" />`,
    value: 'Lorem ipsum dolor sit amet',
});

codes.push({
    id: "textMask",
    title: "Texto simples com máscara",
    code: `<input type="text" class="form-control" v-model="value.textMask" v-mask="['#####-###', '###.###.###-##', '##.###.###/####-##']" />`,
    value: '',
});

codes.push({
    id: "checkCheckbox",
    title: "Checkbox",
    code: `<ui-check v-model="value.checkCheckbox" :dark="false">Checkbox</ui-check>`,
    value: '',
});

codes.push({
    id: "checkCheckboxDark",
    title: "Checkbox escuro",
    code: `<ui-check v-model="value.checkCheckboxDark">Checkbox escuro</ui-check>`,
    value: '',
});

codes.push({
    id: "checkRadio",
    title: "Radio",
    code: [
        '<div>',
        `\t<ui-check v-model="value.checkRadio" type="radio" true-value="A" :dark="false">Opção A</ui-check>`,
        `\t<ui-check v-model="value.checkRadio" type="radio" true-value="B" :dark="false">Opção B</ui-check>`,
        '</div>',
    ].join("\n"),
    value: '',
});

codes.push({
    id: "checkRadioDark",
    title: "Radio escuro",
    code: [
        '<div>',
        `\t<ui-check v-model="value.checkRadioDark" type="radio" true-value="A">Opção A</ui-check>`,
        `\t<ui-check v-model="value.checkRadioDark" type="radio" true-value="B">Opção B</ui-check>`,
        '</div>',
    ].join("\n"),
    value: '',
});

codes.push({
    id: "checkToggle",
    title: "Toggle",
    code: `<ui-check v-model="value.checkToggle" type="toggle">Toggle</ui-check>`,
    value: '',
});

codes.push({
    id: "money",
    title: "Dinheiro",
    code: `<ui-money v-model="value.money"></ui-money>`,
    value: '1234.56',
});

codes.push({
    id: "datetime",
    title: "Data e hora",
    code: `<ui-datetime v-model="value.datetime"></ui-datetime>`,
    value: '',
});

codes.push({
    id: "date",
    title: "Data",
    code: `<ui-datetime type="date" v-model="value.date"></ui-datetime>`,
    value: '',
});

codes.push({
    id: "time",
    title: "Hora",
    code: `<ui-datetime type="time" v-model="value.time"></ui-datetime>`,
    value: '',
});

codes.push({
    id: "content",
    title: "Conteúdo HTML simples",
    code: `<ui-content v-model="value.content"></ui-content>`,
    value: 'Lorem ipsum <b>dolor</b><br><i>sit</i> <s>amet</s>',
});

codes.push({
    id: "phone",
    title: "Telefone",
    code: `<ui-phone v-model="value.phone"></ui-phone>`,
    value: '+55 (31) 98765-4321',
});

codes.push({
    id: "password",
    title: "Senha com medidor",
    code: `<ui-password v-model="value.password"></ui-password>`,
    value: 'qweQWE123!@#',
});

codes.push({
    id: "passwordNoMetter",
    title: "Senha sem medidor",
    code: `<ui-password v-model="value.passwordNoMetter" :meter="false"></ui-password>`,
    value: 'qweQWE123!@#',
});

codes.push({
    id: "color",
    title: "Color picker",
    code: `<ui-color v-model="value.color"></ui-color>`,
    value: '#FF000088',
});

codes.push({
    id: "code",
    title: "Editor de código",
    code: `<ui-code v-model="value.code"></ui-code>`,
    value: `let cores = [];\ncores.push('Vermelho');\ncores.push('Rosa');\nconsole.log(cores);`,
});

codes.push({
    id: "html",
    title: "Editor WYSIWYG",
    code: `<ui-html v-model="value.html"></ui-html>`,
    value: `Conteúdo com <strong>tags</strong> <i>HTML</i>`,
});

codes.push({
    id: "upload",
    title: "Upload",
    code: `<ui-upload v-model="value.upload"></ui-upload>`,
    value: '',
});

codes.push({
    id: "photo",
    title: "Upload de imagem",
    code: `<ui-photo v-model="value.photo"></ui-photo>`,
    value: '',
});

codes.push({
    id: "address",
    title: "Endereço",
    code: `<ui-address v-model="value.address"></ui-address>`,
    value: {zipcode:"30130-000"},
});

codes.push({
    id: "file",
    title: "Biblioteca",
    code: `<ui-file v-model="value.file"></ui-file>`,
    value: '',
});

export default {
    layout: 'coreui/admin',

    components: {
        VRuntimeTemplate,
    },

    data() {
        let data = {};

        data.value = {};
        codes.forEach(item => {
            if (!item.id) return;
            data.value[item.id] = item.value||'';
        });

        data.codes = codes;

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