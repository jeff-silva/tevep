<template>
    <div>
        <ui-form v-model="test" :validate="testValidate" #default="f">
            <ui-field label="Nome" :error="f.errorFields.name">
                <input type="text" class="form-control" v-model="test.name">
            </ui-field>

            <ui-field label="E-mail" :error="f.errorFields.email">
                <input type="text" class="form-control" v-model="test.email">
            </ui-field>
            
            <ui-field label="Senha" :error="f.errorFields.password">
                <div class="d-flex">
                    <ui-password v-model="test.password" class="me-1"></ui-password>
                    <ui-password v-model="test.password_confirm"></ui-password>
                </div>
            </ui-field>

            <button type="submit" class="btn btn-primary" :disabled="!f.valid">
                Enviar
            </button>

            <pre>f: {{ f }}</pre>
            <pre>$data: {{ $data }}</pre>
        </ui-form>
    </div>
</template>

<script>
export default {
    head() {
        return {
            title: "Test",
        };
    },

    data() {
        return {
            test: {},
            testValidate: {
                name: {presence:{allowEmpty: false}},
                email: {presence:{allowEmpty: false}, email:true},
                password: {presence: {allowEmpty: false}, equality: "password_confirm"},
            },
        };
    },
}
</script>