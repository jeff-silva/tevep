<template><div class="page-test-input">
    <!-- <ui-playground>
        Aaa
    </ui-playground> -->

    <div v-for="e in examples" class="bg-white mb-3 shadow-sm">
        <div class="bg-secondary p-2 text-uppercase font-weight-bold" v-html="e.title"></div>
        <div class="row no-gutters align-items-center">
            <div class="col-12 col-md-7 p-3">
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
        <div class="col-12 col-md-6 form-group">
            <label>Texto simples</label>
            <input type="text" class="form-control" v-model="values.text">
            <pre>{{ values.text }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Texto simples com máscara</label>
            <input type="text" class="form-control" v-model="values.text_mask" v-mask="['###.###.###', '#### #### #### ####']">
            <pre>{{ values.text_mask }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Dinheiro</label>
            <ui-money v-model="values.money"></ui-money>
            <pre v-html="values.money"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Texto HTML</label>
            <ui-content v-model="values.content"></ui-content>
            <pre v-html="values.content"></pre>
        </div>
        
        <div class="col-12 col-md-6 form-group">
            <label>Datepicker</label>
            <ui-datepicker v-model="values.datepicker"></ui-datepicker>
            <pre v-html="values.datepicker"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Timeago</label>
            <ui-timeago v-model="values.datepicker" class="form-control"></ui-timeago>
            <pre v-html="values.datepicker"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Telefone</label>
            <ui-phone v-model="values.phone"></ui-phone>
            <pre>{{ values.phone }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Cor</label>
            <ui-color v-model="values.color"></ui-color>
            <pre>{{ values.color }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Senha com medidor</label>
            <ui-password v-model="values.password"></ui-password>
            <pre v-html="values.password"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Senha sem medidor</label>
            <ui-password v-model="values.password" :meter="false"></ui-password>
            <pre v-html="values.password"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Código</label>
            <ui-code v-model="values.code"></ui-code>
            <pre>{{ values.code }}</pre>
        </div>
        
        <div class="col-12 col-md-6 form-group">
            <label>Upload</label>
            <ui-upload v-model="values.upload"></ui-upload>
            <pre>{{ values.upload }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Select simples</label>
            <ui-select v-model="values.select" :multiple="false">
                <template #selected="{option}"><div class="badge badge-secondary mr-1">{{ option.text }}</div></template>
                <template #options="{select, selected}">
                    <div class="row no-gutters">
                        <div class="col-4 p-2" v-for="i in selectItems" @click="select(i, $event);" :class="{'bg-secondary':selected(i)}">
                            <strong>Opção:</strong> {{ i.text }}
                        </div>
                    </div>
                </template>
            </ui-select>
            <pre>values.select: {{ values.select }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Select multiplo</label>
            <ui-select v-model="values.selects" :multiple="true">
                <template #selected="{option}"><div class="badge badge-secondary mr-1">{{ option.text }}</div></template>
                <template #options="{select, selected}">
                    <div class="row no-gutters">
                        <div class="col-4 p-2" v-for="i in selectItems" @click="select(i, $event);" :class="{'bg-secondary':selected(i)}">
                            <strong>Opção:</strong> {{ i.text }}
                        </div>
                    </div>
                </template>
            </ui-select>
            <pre>values.selects: {{ values.selects }}</pre>
        </div>

        <div class="col-12 col-md-12 form-group">
            <label>Endereço</label>
            <ui-address v-model="values.address"></ui-address>
            <pre>{{ values.address }}</pre>
        </div>

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

    <!-- <ui-datepicker></ui-datepicker> -->
    <pre>$data: {{ $data }}</pre>
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
            code: `<input type="text" class="form-control" v-model="values.text" />`,
            attr: 'text',
            value: 'Hello world!',
        });

        data.examples.push({
            title: 'ui-address',
            code: '<ui-address v-model="values.address"></ui-address>',
            attr: 'address',
            value: {zipcode:'30710-380'},
        });

        data.examples.push({
            title: 'ui-auth-login',
            code: '<ui-auth-login></ui-auth-login>',
            attr: false,
            value: false,
        });

        data.examples.push({
            title: 'ui-auth-password',
            code: '<ui-auth-password></ui-auth-password>',
            attr: false,
            value: false,
        });

        data.examples.push({
            title: 'ui-auth-register',
            code: '<ui-auth-register></ui-auth-register>',
            attr: false,
            value: false,
        });

        data.examples.push({
            title: 'ui-color',
            code: '<ui-color v-model="values.color"></ui-color>',
            attr: 'color',
            value: '#00000055',
        });

        data.examples.push({
            title: 'ui-content',
            code: '<ui-content v-model="values.content"></ui-content>',
            attr: 'content',
            value: '',
        });

        data.examples.push({
            title: 'ui-datepicker',
            code: '<ui-datepicker v-model="values.datepicker"></ui-datepicker>',
            attr: 'datepicker',
            value: '1986-02-11 15:30:00',
        });

        data.examples.push({
            title: 'ui-money',
            code: '<ui-money v-model="values.money"></ui-money>',
            attr: 'money',
            value: '12345.67',
        });

        data.examples.push({
            title: 'ui-password',
            code: '<ui-password v-model="values.password"></ui-password>',
            attr: 'password',
            value: 'john123!@#',
        });

        data.examples.push({
            title: 'ui-phone',
            code: '<ui-phone v-model="values.phone"></ui-phone>',
            attr: 'phone',
            value: '+55 (31) 98765-4321',
        });

        data.examples.push({
            title: 'ui-select',
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
            code: '<ui-upload v-model="values.upload"></ui-upload>',
            attr: 'upload',
            value: '',
        });

        data.values = {
            // address: {zipcode:"30710-380"},
            // phone: "+55 (31) 98765-4321",
            // code: `let data = [];\ndata.push(Math.round(Math.random() * 999));\nconsole.log(data);`,
            // select: false,
            // selects: [],
        };

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