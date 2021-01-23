<template><div class="page-test-input">
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
            <label>Datepicker</label>
            <ui-datepicker v-model="values.datepicker"></ui-datepicker>
            <pre v-html="values.datepicker"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Texto HTML</label>
            <ui-content v-model="values.content"></ui-content>
            <pre v-html="values.content"></pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Telefone</label>
            <ui-phone v-model="values.phone"></ui-phone>
            <pre>{{ values.phone }}</pre>
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
            <label>Cor</label>
            <ui-color v-model="values.color"></ui-color>
            <pre>{{ values.color }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Código</label>
            <ui-code v-model="values.code"></ui-code>
            <pre>{{ values.code }}</pre>
        </div>
        
        <div class="col-12 col-md-12 form-group">
            <label>Upload</label>
            <ui-upload v-model="values.upload"></ui-upload>
            <pre>{{ values.upload }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Select simples</label>
            <ui-select v-model="values.select" :multiple="false">
                <template #selected="{option}">{{ option.text }}</template>
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
                <template #selected="{option}">{{ option.text }}</template>
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

    <pre>$data: {{ $data }}</pre>
</div></template>


<style>
.page-test-input pre {background:var(--dark); color:#fff; padding:5px; min-height:25.47px; margin-top:5px;}
</style>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            values: {
                address: {zipcode:"30710-380"},
                phone: "+55 (31) 98765-4321",
                code: `let data = [];\ndata.push(Math.round(Math.random() * 999));\nconsole.log(data);`,
                select: false,
                selects: [],
            },
            selectItems: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20].map(n => {
                return {
                    id: n,
                    text: `Ítem ${n}`,
                };
            }),
        };
    },
}
</script>