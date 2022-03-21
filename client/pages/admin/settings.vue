<template>
    <div class="admin-settings bg-white">
        <ui-form method="post" action="/api/settings/save" v-model="settings" #default="{loading, response}" success-text="Configurações salvas">
            <el-tabs :value="$route.path" @tab-click="$router.push($event.name)">
                <el-tab-pane :label="n.label" :name="n.to" :key="n.to" v-for="n in navItems">
                    &nbsp;
                </el-tab-pane>
            </el-tabs>
    
            <div class="p-2">
                <nuxt-child v-model="settings"></nuxt-child>
            </div>

            <div class="bg-light text-end p-2">
                <button type="submit" class="btn btn-primary" v-loading="loading">
                    Salvar
                </button>
            </div>
        </ui-form>
    </div>
</template>

<script>
export default {
    layout: "admin",
    middleware: ["auth", "permission"],

    head() {
        return {
            title: "Configurações",
        };
    },

    data() {
        return {
            navItems: [
                {label:"Principal", to:"/admin/settings"},
                {label:"E-mail", to:"/admin/settings/email"},
                {label:"Arquivos", to:"/admin/settings/files"},
            ],
            settings: {},
        };
    },

    methods: {
        settingsGetAll() {
            this.$axios.get('/api/settings/all').then(resp => {
                this.settings = resp.data;
            });
        },
    },

    mounted() {
        this.settingsGetAll();
    },
}
</script>


<style>
.admin-settings .el-tabs__content {display: none !important;}
</style>