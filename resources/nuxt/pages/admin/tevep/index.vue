<template><div>
    <nuxt-link to="/admin/tevep/123">Editar</nuxt-link>
    <hr>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',
}
</script>