<template>
    <div>
        <head>
            <title>Auth</title>
            <!-- <Style children="@import url('https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css');"></Style> -->
        </head>

        <v-app>
            <v-row no-gutters>
                <v-col cols="12" md="5" lg="7" class="layout-auth-background d-none d-md-block">
                    <!--  -->
                </v-col>
                <v-col cols="12" md="7" lg="5" class="layout-auth-pattern d-flex align-center justify-center">
                    <div style="width:100%; max-width:500px; margin:0 40px;">
                        <v-img :src="app.settings['app.logo']" width="200px" class="mx-auto mb-5"></v-img>
                        <br><br>
                        <slot />
                    </div>
                </v-col>
            </v-row>
        </v-app>
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