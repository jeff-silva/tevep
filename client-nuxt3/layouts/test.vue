<template>
    <div>
        <head>
            <title>Testes</title>
            <Style children="@import url('https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css');"></Style>
        </head>

        <div class="row g-0">
            <div class="col-2 p-3 bg-dark">
                <nuxt-link class="d-block mb-3 text-white" to="/test">Home</nuxt-link>
                <nuxt-link class="d-block mb-3 text-white" to="/test/app">App</nuxt-link>
                <nuxt-link class="d-block mb-3 text-white" to="/test/axios">Axios</nuxt-link>
            </div>

            <div class="col-10 p-3">
                <slot></slot>
            </div>
        </div>
    </div>
</template>