<template>
    <ui-model-edit model-name="users" :model-id="_userId" singular="Usuário" plural="Usuários" :validation-rules="validationRules" #default="{value, errorFields}">
        <ui-field label="Nome" :error="errorFields.name">
            <input type="text" class="form-control" v-model="value.name">
        </ui-field>

        <ui-field label="E-mail" :error="errorFields.email">
            <input type="text" class="form-control" v-model="value.email">
        </ui-field>

        <ui-field label="Senha" :error="errorFields.password">
            <ui-password v-model="value.password"></ui-password>
        </ui-field>

        <ui-field label="Grupo" :error="errorFields.group_id">
            <ui-model-select model-name="users-groups" v-model="value.group_id"></ui-model-select>
        </ui-field>

        <ui-field label="Foto" :error="errorFields.photo_id">
            <ui-file-id v-model="value.photo_id"></ui-file-id>
        </ui-field>
        
        <ui-field label="Endereço" :error="errorFields.group_id">
            <ui-place-id v-model="value.address_id"></ui-place-id>
        </ui-field>
    </ui-model-edit>
</template>

<script>
export default {
    head() {
        return {
            title: "Editar usuário",
        };
    },

    computed: {
        _userId() {
            let userId = this.$route.params.id || false;
            return userId=="me"? this.$auth.user.id: userId;
        },
    },

    data() {
        return {
            baseUrl: ((new URL(location.href)).protocol+ '//'+ (new URL(location.href)).host +'/'),
            validationRules: {
                name: {presence:{allowEmpty: false}},
                email: {email:true, presence:{allowEmpty: false}},
            },
        };
    },
}
</script>