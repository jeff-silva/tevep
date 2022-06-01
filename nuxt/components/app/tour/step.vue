<template>
    <div class="app-tour-step">
        <slot></slot>
    </div>
</template>

<script>
export default {
    props: {
        target: {default:false, type:[String]},
    },
};
</script>