<template>

  <div style="display:flex; align-items:center; justify-content:center; height:100vh;">
    <div class="bg-light p-3 border shadow-lg" style="width:400px;">
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
</template>

<script>
export default {
  layout: 'default',
}
</script>
