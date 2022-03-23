<template>
  <div class="page-index row g-0">
    <div class="col-7 col-md-5 col-lg-7 d-none d-md-block" style="height:100vh; background:url(https://source.unsplash.com/collection/1534020/800x600) center center no-repeat; background-size:cover;">
      <!--  -->
    </div>

    <div class="col-12 col-md-7 col-lg-5 l-auth-pattern d-flex align-items-center justify-content-center" style="height:100vh;">
      <div class="bg-white shadow-lg p-3">
        <el-tabs value="login" tab-position="top" :stretch="true">
          <el-tab-pane label="Login" name="login">
            <h3 class="mt-2 mb-3">Acessar o sistema</h3>
            <ui-auth-login redirect="/admin"></ui-auth-login>
          </el-tab-pane>
      
          <el-tab-pane label="Cadastro" name="register">
            <h3 class="mt-2 mb-3">Cadastre-se</h3>
            <ui-auth-register></ui-auth-register>
          </el-tab-pane>
      
          <el-tab-pane label="Esqueci minha senha" name="password">
            <h3 class="mt-2 mb-3">Recuperar senha</h3>
            <ui-auth-password></ui-auth-password>
          </el-tab-pane>
        </el-tabs>
      </div>
    </div>
  </div>

  <!-- <div style="display:flex; align-items:center; justify-content:center; height:100vh;">
    <div class="bg-light p-3 border shadow-lg" style="width:400px;">
    </div>
  </div> -->
</template>

<script>
export default {
  layout: 'default',
}
</script>

<style>
.page-index * {transition: all 300ms ease;}

.l-auth-pattern {
    background-color: hsla(0,0%,100%,.26667);
    background-image: radial-gradient(rgba(68,76,247,.26667) 1px,transparent 0),radial-gradient(rgba(68,76,247,.26667) 1px,hsla(0,0%,100%,.26667) 0);
    background-size: 40px 40px;
    background-position: 0 0,20px 20px;
}
</style>