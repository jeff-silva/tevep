<template>
    <div class="row g-0">
        <div class="col-12">
            <ui-nav :items="nav||[]" mode="horizontal"></ui-nav>
            <pre>nav: {{ nav }}</pre>
        </div>
        <div class="col-3 border">
            alskfj 
        </div>

        <div class="col-9 border">
            <slot></slot>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        nav: {default:()=>([]), type:Array},
    },
}
</script>