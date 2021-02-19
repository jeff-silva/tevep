<template><div class="ui-actions" :class="{'ui-actions-hover':buttons>1}">
    <a href="javascript:;" class="btn bg-success" v-if="buttons>1">
        <i class="fa fa-fw fa-plus"></i>
    </a>

    <div class="ui-actions-btns">
        <slot></slot>
    </div>
</div></template>

<style>
.ui-actions {position:fixed; bottom:25px; right:15px;}
.ui-actions .btn {border-radius:50% !important; width:50px; height:50px; padding:10px 0px; margin-top:5px;}
.ui-actions-btns {position:absolute; right:0px; bottom:100%; width:50px; transition: all 300ms ease;}
.ui-actions-hover .ui-actions-btns {right:-200%; opacity:0;}
.ui-actions:hover .ui-actions-btns,
.ui-actions:focus .ui-actions-btns {right:0px; opacity:1;}
</style>

<script>
export default {
    data() {
        return {
            buttons: 0,
        };
    },

    methods: {
        countButtons() {
            return this.$el.querySelectorAll('.ui-actions-btns .btn').length;
        },
    },

    mounted() {
        this.buttons = this.countButtons();
    },
}
</script>