<template><div v-if="value['mail.mailers.smtp.host']">
    <ui-field label="Host / Porta">
        <div class="row no-gutters">
            <div class="col-9"><input type="text" class="form-control" v-model="value['mail.mailers.smtp.host'].value"></div>
            <div class="col-3 pl-1"><input type="text" class="form-control" v-model="value['mail.mailers.smtp.port'].value"></div>
        </div>
    </ui-field>

    <ui-field label="Login">
        <input type="text" class="form-control" v-model="value['mail.mailers.smtp.username'].value">
    </ui-field>

    <ui-field label="Senha">
        <ui-password v-model="value['mail.mailers.smtp.password'].value" :meter="false"></ui-password>
    </ui-field>
</div></template>

<script>
export default {
    props: {
        value: Object,
        error: [Object, Boolean],
    },
};
</script>