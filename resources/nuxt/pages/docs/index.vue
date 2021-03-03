<template><div>
    <div class="row no-gutters">
        <div class="col-2 bg-white shadow-sm" style="height:calc(100vh - 130px); overflow:auto;">
            <div class="nav nav-pills flex-column">
                <div v-for="(i, index) in menuItems">
                    <nuxt-link :to="i.to" class="nav-link font-weight-bold" :key="index">{{ i.title }}</nuxt-link>
                    <div v-for="(ii, iindex) in i.children">
                        <nuxt-link :to="ii.to" class="nav-link" :key="iindex">&nbsp; {{ ii.title }}</nuxt-link>
                    </div>
                </div>
            </div>
        </div>
        <div class="col pl-3" style="height:calc(100vh - 130px); overflow:auto;">
            <nuxt-child></nuxt-child>
        </div>
    </div>
</div></template>


<script>
export default {
    layout: 'admin',

    data() {
        return {
            menuItems: [
                {
                    title: "Cores",
                    to: "/docs/colors",
                    children: [],
                },
                {
                    title: "Autenticação",
                    to: "/docs/auth",
                    children: [],
                },
                {
                    title: "Carrosel",
                    to: "/docs/carousel",
                    children: [],
                },
                {
                    title: "Drawer",
                    to: "/docs/drawer",
                    children: [],
                },
                {
                    title: "Endpoints",
                    to: "/docs/endpoints",
                    children: [],
                },
                {
                    title: "Inputs",
                    to: "/docs/input",
                    children: [
                        {
                            title: "Select",
                            to: "/docs/input/select",
                            children: [],
                        },
                        {
                            title: "Loading",
                            to: "/docs/input/loading",
                            children: [],
                        },
                    ],
                },
                {
                    title: "Table",
                    to: "/docs/table",
                    children: [],
                },
                {
                    title: "Tabs",
                    to: "/docs/tabs",
                    children: [],
                },
            ],
        };
    },

    mounted() {
        if (1 == this.$route.path.split('/').filter(item => !!item).length) {
            this.$router.push({path:this.menuItems[0].to});
        }
    },
}
</script>