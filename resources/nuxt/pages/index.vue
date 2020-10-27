<template><div class="container">
    <h1>Home</h1>
    <nuxt-link to="/auth">Fazer login</nuxt-link>
    <pre>{{ $auth.user }}</pre>
</div></template>

<script>
export default {
    data() {
        return {
            // 
        }
    }
}
</script>
