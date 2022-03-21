<template>
    <div class="ui-mobile-action">
        <div class="d-md-none" @click="drawer=true" v-if="slotButton">
            <slot name="button">
                <button type="button" class="btn bg-white shadow-sm" style="padding:5px 7px; border-radius:50%;">
                    <i class="fas fa-fw fa-ellipsis-v"></i>
                </button>
            </slot>
        </div>

        <el-drawer :visible.sync="drawer" :with-header="false" direction="ltr">
            <div>
                <div class="bg-primary p-2 mb-2 text-white text-left">Ações</div>
                <div class="p-2"><slot></slot></div>
            </div>
        </el-drawer>

        <div class="d-none d-md-block">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        slotButton: {default:true},
    },

    data() {
        return {
            drawer: false,
        };
    },

    methods: {
        show() {
            this.drawer = true;
        },

        hide() {
            this.drawer = false;
        },

        toggle() {
            this.drawer = !this.drawer;
        },
    },
}
</script>

<style>
.ui-mobile-action .el-drawer {
    width: 300px !important;
    max-width: 80vw;
}
</style>