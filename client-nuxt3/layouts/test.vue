<template>
    <div>
        <head>
            <title>Testes</title>
            <Style children="@import url('https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css');"></Style>
        </head>

        <div class="row g-0">
            <div class="col-2 p-3 bg-dark">
                <template v-for="i in navItems">
                    <nuxt-link class="d-block mb-3 text-white" :to="i.to">
                        {{ i.label }}
                    </nuxt-link>
                </template>
            </div>

            <div class="col-10 p-3">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script setup>
    const navItems = [
        {to:"/test", label:"Home"},
        {to:"/test/app", label:"App"},
        {to:"/test/axios", label:"Axios"},
        {to:"/test/auth", label:"Auth"},
    ];
</script>