<template><div>
    <nuxt-link to="/admin/tevep/1">Editar</nuxt-link>
    <hr>
</div></template>

<script>
export default {
    layout: 'admin',
    middleware: 'auth',
}
</script>