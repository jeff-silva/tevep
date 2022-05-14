<template>
    <head>
        <title>Auth</title>
        <!-- <Style children="@import url('https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css');"></Style> -->
    </head>

    <div class="layout-auth v-row g-0">
        <div class="layout-auth-background v-col-7 v-col-md-5 v-col-lg-7 d-none d-md-block">
            <!--  -->
        </div>

        <div class="layout-auth-pattern v-col-12 v-col-md-7 v-col-lg-5 px-5 d-flex align-center justify-content-center" style="height:100vh;">
            <div class="bg-primary pa-4 w-100">
                <v-img :src="app.settings['app.logo']" width="200px" class="mx-auto mb-5"></v-img>
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style>
.layout-auth-background {
    height: 100vh;
    background: url(https://source.unsplash.com/collection/1534020/800x600) center center no-repeat;
    background-size: cover;
}

.layout-auth-pattern {
    background-color: hsla(0,0%,100%,.26667);
    background-image: radial-gradient(rgba(68,76,247,.26667) 1px,transparent 0),radial-gradient(rgba(68,76,247,.26667) 1px,hsla(0,0%,100%,.26667) 0);
    background-size: 40px 40px;
    background-position: 0 0,20px 20px;
}
</style>

<script>
export default {
    data() {
        return {
            app: useApp(),
        };
    },
};
</script>