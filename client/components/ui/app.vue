<template>
    <div class="ui-app">
        <div class="d-flex" style="height:100vh;">
            <div class="d-none d-md-flex ui-app-bg-navs" :style="`min-width:${navWidth}; max-width:${navWidth};`">
                <div class="w-100 ui-app-vrow">
                    <div class="ui-app-vrow-action">
                        <slot name="nav-header"></slot>
                    </div>
                    <div class="ui-app-vrow-body ui-app-scroll">
                        <slot name="nav-body"></slot>
                    </div>
                    <div class="ui-app-vrow-action border-top">
                        <slot name="nav-footer">
                            <ui-auth-logout class="btn border-0 shadow-none w-100 rounded-0">
                                <i class="fas fa-fw fa-power-off"></i> Sair
                            </ui-auth-logout>
                        </slot>
                    </div>
                </div>
            </div>

            <div class="flex-grow-1">
                <div class="ui-app-vrow">
                    <div class="ui-app-vrow-action ui-app-bg-navs">
                        <div class="d-flex align-items-center p-2">
                            <div class="d-md-none pe-2">
                                <a href="javascript:;" @click="drawer=true">
                                    <i class="fas fa-fw fa-bars"></i>
                                </a>
                            </div>

                            <slot name="header">&nbsp;</slot>
                        </div>
                    </div>

                    <div class="ui-app-vrow-body ui-app-scroll ui-app-bg-content p-0 p-md-4">
                        <div class="bg-white p-3 mb-3 fw-bold text-uppercase">{{ headTitle }}</div>
                        <slot name="content"></slot>
                    </div>

                    <div class="ui-app-vrow-action" v-if="$slots.footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>

        <el-drawer :visible.sync="drawer" direction="ltr" :with-header="false" size="300px">
            <div class="ui-app-vrow">
                <div class="ui-app-vrow-action">
                    <div>
                        <a href="javascript:;" class="btn btn-light btn-sm border-0 shadow-none m-1" style="float:right;" @click="drawer=false">
                            <i class="fas fa-fw fa-times"></i>
                        </a>
                        <slot name="nav-header"></slot>
                    </div>
                </div>

                <div class="ui-app-vrow-body ui-app-scroll">
                    <slot name="nav-body"></slot>
                </div>

                <div class="ui-app-vrow-action">
                    <ui-auth-logout class="btn btn-light shadow-none w-100 rounded-0">
                        <i class="fas fa-fw fa-power-off"></i> Sair
                    </ui-auth-logout>
                </div>
            </div>
        </el-drawer>
    </div>
</template>

<script>
export default {
    props: {
        navWidth: {default:"250px"},
    },

    watch: {
        $route() {
            setTimeout(() => {
                this.headTitle = document.title;
            }, 100);
        },
    },

    data() {
        return {
            drawer: false,
            headTitle: document.title,
        };
    },

    methods: {
        drawerToggle() {
            this.drawer = !this.drawer;
        },

        drawerOpen() {
            this.drawer = true;
        },

        drawerClose() {
            this.drawer = false;
        },
    },
}
</script>

<style>
.ui-app-bg-navs {background: #fff;}
.ui-app-bg-content {background: #eee;}

.ui-app-vrow {display:flex; flex-direction:column; width:100%; height:100vh;}
.ui-app-vrow-action {display: flex; flex-direction: column;}
.ui-app-vrow-body {
    flex: 1 !important;
    max-height: 100vh;
    overflow: auto !important;
}

.ui-app-scroll::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}
.ui-app-scroll::-webkit-scrollbar:hover {
  height: 18px;
}
.ui-app-scroll::-webkit-scrollbar-thumb:vertical {
  height: 50px;
  background: #aaaaaaaa;
  border: 1px solid transparent;
}
.ui-app-scroll::-webkit-scrollbar-thumb:horizontal {
  width: 50px;
  background: #aaaaaaaa;
  border: 1px solid transparent;
}
</style>