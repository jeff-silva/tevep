<template><div>
    <nuxt-child></nuxt-child>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',
}
</script>