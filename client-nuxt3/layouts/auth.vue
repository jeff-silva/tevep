<template>
    <head>
        <title>Testes</title>
        <Style children="@import url('https://unpkg.com/bootstrap@5.1.3/dist/css/bootstrap.min.css');"></Style>
    </head>

    <div class="page-index row g-0">
        <div class="col-7 col-md-5 col-lg-7 d-none d-md-block" style="height:100vh; background:url(https://source.unsplash.com/collection/1534020/800x600) center center no-repeat; background-size:cover;">
        <!--  -->
        </div>

        <div class="col-12 col-md-7 col-lg-5 px-5 l-auth-pattern d-flex align-items-center justify-content-center" style="height:100vh;">
            <div class="bg-white p-4 shadow-sm w-100">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  layout: 'default',
}
</script>

<style>
.l-auth-pattern {
    background-color: hsla(0,0%,100%,.26667);
    background-image: radial-gradient(rgba(68,76,247,.26667) 1px,transparent 0),radial-gradient(rgba(68,76,247,.26667) 1px,hsla(0,0%,100%,.26667) 0);
    background-size: 40px 40px;
    background-position: 0 0,20px 20px;
}
</style>