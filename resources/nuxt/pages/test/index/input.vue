<template><div class="page-test-input">
    <div class="row">
        <div class="col-12 col-md-6 form-group">
            <label>Texto simples</label>
            <input type="text" class="form-control" v-model="values.text">
            <pre>{{ values.text }}</pre>
        </div>

        <div class="col-12 col-md-6 form-group">
            <label>Texto HTML</label>
            <ui-content v-model="values.content"></ui-content>
            <pre v-html="values.content"></pre>
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
            <ui-datepicker v-model="values.datepicker"></ui-datepicker>
            <ui-datetime v-model="values.datetime"></ui-datetime>
            <ui-money v-model="values.money"></ui-money>
            <ui-password v-model="values.password"></ui-password>

            <br>
            <ui-select v-model="values.select">
                <template #selected="{option}">OPT: {{ option.text }}</template>
                <template #options="{select, toggle}">
                    <div v-for="i in selectItems" @click="toggle(i);">
                        <strong>Opção:</strong> {{ i.text }}
                    </div>
                </template>
            </ui-select>
            <pre>values.select: {{ values.select }}</pre>
            <br>

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
                address: {zipcode:"30710-580"},
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