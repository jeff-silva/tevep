<template><div>

    <div class="row no-gutters">
        <div class="col-12 col-md-2 bg-white shadow-sm d-none d-md-block">
            <div class="admin">
                <div class="admin-content">
                    <div class="nav nav-pills flex-column">
                        <!-- <nuxt-link :to="i.to" class="nav-link rounded-0 text-dark font-weight-bold"
                            :class="{'bg-light':$route.path==i.to}" v-for="(i, iindex) in menuItems"
                            :key="iindex"
                        >{{ i.title }}</nuxt-link> -->

                        <ui-drawer type="drawer-left" ref="drawer" :render-here="true">
                            <template #content>
                                <nuxt-link :to="i.to" class="nav-link rounded-0 text-dark font-weight-bold"
                                    :class="{'bg-light':$route.path==i.to}" v-for="(i, iindex) in menuItems"
                                    :key="iindex"
                                >{{ i.title }}</nuxt-link>
                            </template>
                        </ui-drawer>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-10">
            <div class="admin">
                <div class="admin-header p-2 bg-white shadow-sm">
                    <div class="d-flex align-items-center">
                        <div><a href="javascript:;" class="btn" @click="$refs.drawer.show()"><i class="fa fa-fw fa-bars"></i></a></div>
                    </div>
                </div>
                <div class="admin-content p-2">
                    <nuxt-child></nuxt-child>
                </div>
                <div class="admin-header bg-secondary p-1">footer</div>
            </div>
        </div>
    </div>
</div></template>


<style>
.admin {height:100vh; display: -webkit-box; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; flex-direction: column;}
.admin-header {display: -webkit-box; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; flex-direction: column; -webkit-box-pack: center;}
.admin-content {display: -webkit-box; display: flex; -webkit-box-orient: vertical; -webkit-box-direction: normal; flex-direction: column; -webkit-box-pack: center; -webkit-box-flex: 1; flex:1; overflow:auto;}
</style>


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
                    title: "Drawer",
                    to: "/test/drawer",
                },
                {
                    title: "Endpoints",
                    to: "/test/endpoints",
                },
                {
                    title: "Grape",
                    to: "/test/grape",
                },
                {
                    title: "Inputs",
                    to: "/test/input",
                },
                {
                    title: "Layout",
                    to: "/test/layout",
                },
                {
                    title: "Navigation",
                    to: "/test/nav",
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
                    title: "Exemplo completo",
                    to: "/test/example",
                },
            ],
        };
    },
}
</script>