<template>
    <div>
        <div style="border:solid 1px #eee; padding:10px; margin-bottom:10px;">
            <nuxt-link to="/">Home</nuxt-link> -
            <nuxt-link to="/test">Test</nuxt-link>
        </div>

        <slot></slot>
        <!-- <pre>foo: {{ foo }}</pre> -->
        <pre>mouse: {{ mouse }}</pre>
    </div>
</template>

<script setup>
// const foo = await useAxios({
//     url: "https://randomuser.me/api/?results=10",
// });

const mouse = useMouse();
</script>