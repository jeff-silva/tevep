<template><div>
    <div class="row no-gutters">
        <div class="col-2 bg-white shadow-sm">
            <div class="nav nav-pills flex-column">
                <nuxt-link :to="i.to" class="nav-link" v-for="(i, iindex) in menuItems" :key="iindex">{{ i.title }}</nuxt-link>
            </div>
        </div>
        <div class="col p-1">
            <nuxt-child></nuxt-child>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'coreui/admin',

    data() {
        return {
            menuItems: [
                {
                    title: "Home",
                    to: "/test",
                },
                {
                    title: "Autenticação",
                    to: "/test/auth",
                },
                {
                    title: "Carrosel",
                    to: "/test/carousel",
                },
                {
                    title: "Endpoints",
                    to: "/test/endpoints",
                },
                {
                    title: "Table",
                    to: "/test/table",
                },
                {
                    title: "Tabs",
                    to: "/test/tabs",
                },
                {
                    title: "Teste",
                    to: "/test/test",
                },
            ],
        };
    },
}
</script>