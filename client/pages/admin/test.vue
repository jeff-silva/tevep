<template>
    <div class="p-5">
        <ui-form v-model="test" :validation-rules="validationRules" #default="f">
            <ui-field label="Nome" :validate="f.validate.test('name')" info="Isso é uma informação">
                <input type="text" class="form-control" v-model="test.name">
            </ui-field>

            <ui-field label="E-mail" :validate="f.validate.test('email')">
                <input type="text" class="form-control" v-model="test.email">
            </ui-field>

            <hr>

            <ui-field label="Nome" :validate="f.validate.test('name')">
                <input type="text" class="form-control" v-model="test.name">
            </ui-field>

            <ui-field label="E-mail" :validate="f.validate.test('email')">
                <input type="text" class="form-control" v-model="test.email">
            </ui-field>

            <button type="submit" class="btn btn-primary" :disabled="f.validate.invalid">
                Enviar
            </button>

            <pre>f: {{ f }}</pre>
            <pre>$data: {{ $data }}</pre>
        </ui-form>
    </div>
</template>

<script>
export default {
    // layout: "default",

    head() {
        return {
            title: "Test",
        };
    },

    data() {
        return {
            test: {},
            validationRules: {
                name: {presence:{allowEmpty: false}},
                email: {presence:{allowEmpty: false}, email:true},
            },
        };
    },
}
</script>