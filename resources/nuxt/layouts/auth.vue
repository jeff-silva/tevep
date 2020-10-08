<template><div class="layout-auth">
    <div class="layout-auth-content p-3">
        <nuxt />
        <div class="row mt-3">
            <div class="col-4"><nuxt-link to="/auth/" class="btn btn-link btn-block">Login</nuxt-link></div>
            <div class="col-4"><nuxt-link to="/auth/register/" class="btn btn-link btn-block">Registrar</nuxt-link></div>
            <div class="col-4"><nuxt-link to="/auth/password/" class="btn btn-link btn-block">Senha</nuxt-link></div>
        </div>
    </div>
</div></template>

<script>export default {
    components: {
        // "ui-navbar": () => import("@/components/ui/ui-navbar"),
    },

    data() {
        return {};
    },
};</script>


<style>
.layout-auth {
    position: relative;
    width: 100vw;
    height: 100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    background:url(https://source.unsplash.com/1600x900/?store,market,shop) center center no-repeat;
    background-size: cover;
}

.layout-auth:after {
    content: "";
    position: absolute;
    top: 0px;
    left: 0px;
    width: 100%;
    height: 100%;
    background-image: linear-gradient(to bottom, #000000cc 0%, #00000022 40%, #00000022 60%, #000000cc 100%);
}

.layout-auth-content {
    position: relative;
    width: 400px;
    max-width: 90%;
    background:#ffffffdd;
    z-index: 2;
}

.colorgraph {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
</style>