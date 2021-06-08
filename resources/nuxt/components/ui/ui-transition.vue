<template>
    <transition :name="uuid"
        :enter-active-class="`ui-transition animate__animated ${enter}`"
        :leave-active-class="`ui-transition animate__animated ${leave}`"
    >
        <slot></slot>
    </transition>
</template>

<script>
export default {
    props: {
        enter: {default:'animate__fadeIn'},
        leave: {default:'animate__fadeOut'},
    },

    data() {
        return {
            uuid: ('transition-'+Math.round(Math.random()*99999)),
        };
    },
}
</script>

<style>
.ui-transition {animation-duration:200ms;}
</style>