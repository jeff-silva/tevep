<template>
    <div class="ui-app">
        <ui-browser-info v-model="browser"></ui-browser-info>

        <div class="d-flex" style="height:100vh;">
            <div class="d-none d-md-flex" :style="`min-width:${navWidth}; max-width:${navWidth}; background:${barsBackground};`">
                <div class="w-100 ui-app-vrow">
                    <div class="ui-app-vrow-action">
                        <slot name="nav-header" :browser="browser"></slot>
                    </div>
                    <div class="ui-app-vrow-body ui-app-scroll">
                        <slot name="nav-body" :browser="browser"></slot>
                    </div>
                    <div class="ui-app-vrow-action border-top">
                        <slot name="nav-footer" :browser="browser">
                            <ui-auth-logout class="btn border-0 shadow-none w-100 rounded-0">
                                <i class="fas fa-fw fa-power-off"></i> Sair
                            </ui-auth-logout>
                        </slot>
                    </div>
                </div>
            </div>

            <div class="flex-grow-1" :style="(browser.mobile? 'max-width:100vw;': `max-width:calc(100vw - ${navWidth});`)">
                <div class="ui-app-vrow">
                    <div class="ui-app-vrow-action" :style="`background:${barsBackground};`">
                        <div class="d-flex align-items-center p-2">
                            <div class="d-md-none pe-2">
                                <a href="javascript:;" @click="drawer=true">
                                    <i class="fas fa-fw fa-bars"></i>
                                </a>
                            </div>

                            <div class="flex-grow-1 fw-bold text-uppercase">{{ headTitle }}</div>

                            <slot name="header" :browser="browser">&nbsp;</slot>
                        </div>
                    </div>

                    <div class="ui-app-vrow-body ui-app-scroll p-1 pt-2 p-md-2" :style="`background:${contentBackground}; overflow-x:hidden;`">
                        <slot name="content" :browser="browser"></slot>
                    </div>

                    <div class="ui-app-vrow-action" v-if="$slots.footer">
                        <slot name="footer" :browser="browser"></slot>
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
                        <slot name="nav-header" :browser="browser"></slot>
                    </div>
                </div>

                <div class="ui-app-vrow-body ui-app-scroll">
                    <slot name="nav-body" :browser="browser"></slot>
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
        barsBackground: {default:"#fff"},
        contentBackground: {default:"#eee"},
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
            browser: {},
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