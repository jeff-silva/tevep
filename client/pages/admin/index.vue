<template>
    <ui-form method="get" action="/api/app/dashboard" #default="form" :mounted-submit="true">
        <div v-if="form.response">
            <div class="d-flex">
                <div class="d-flex align-items-center bg-white me-2 shadow-sm">
                    <div class="bg-light p-2 fw-bold">Usuários <br>Cadastrados</div>
                    <div class="p-2 px-3">{{ form.response.users }}</div>
                </div>
                
                <div class="d-flex align-items-center bg-white me-2 shadow-sm">
                    <div class="py-2 px-3 bg-light fw-bold">Arquivos <br>Enviados</div>
                    <div class="py-2 px-3">{{ form.response.filesSize|fileSize }}</div>
                </div>
            </div>
        </div>
    </ui-form>
</template>

<script>
export default {
    layout: "admin",
    middleware: ["auth"],

    head() {
        return {
            title: "Dashboard",
        };
    },
}
</script>