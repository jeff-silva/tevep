<template><div class="l-auth">
  <div class="row no-gutters">
    <div class="col-12 col-sm-4 col-md-7 d-none d-sm-flex l-auth-background" style="height:100vh;">
      &nbsp;
    </div>

    <div class="col-12 col-sm-8 col-md-5 d-flex align-items-center l-auth-pattern" style="height:100vh;">
      <div class="mx-auto">

        <div class="px-3 pb-3"><nuxt /></div>

        <div class="bg-white">
        
          <!-- Forms -->
          <div class="p-3">
            <div v-if="isLogin">
              <ui-auth-login @success="onLogin()"></ui-auth-login>
            </div>

            <div v-if="isRegister">
              <ui-auth-register @success="onRegister()"></ui-auth-register>
            </div>

            <div v-if="isPassword">
              <ui-auth-password @success="onPassword()"></ui-auth-password>
            </div>
          </div>

          <!-- Links -->
          <div class="row no-gutters py-3">
            <div class="col-6 text-center" v-if="!isLogin"><nuxt-link to="/auth">Login</nuxt-link></div>
            <div class="col-6 text-center" v-if="!isRegister"><nuxt-link to="/auth/register">Cadastro</nuxt-link></div>
            <div class="col-6 text-center" v-if="!isPassword"><nuxt-link to="/auth/password">Senha</nuxt-link></div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div></template>

<style>
.l-auth-background {
  background: url(https://source.unsplash.com/random/800x600/?office,organization) center center no-repeat;
  background-size: cover;
}

.l-auth-pattern {
  background-color: #F5F5F544;
  background-image:  radial-gradient(#444CF744 1px, transparent 1px), radial-gradient(#444CF744 1px, #E5E5F744 1px);
  background-size: 40px 40px;
  background-position: 0 0,20px 20px;
}
</style>

<script>
export default {
  data() {
    return {}
  },

  computed: {
    isLogin() { return this.$route.name=='auth'; },
    isRegister() { return this.$route.name=='auth-register'; },
    isPassword() { return this.$route.name=='auth-password'; },
  },

  methods: {
    onLogin() {
      let redirect = this.$route.query.redirect||'/dashboard';
      this.$router.push({path:redirect});
    },

    onRegister() {
      this.$swalSuccess('Sucesso', 'Cadastro efetuado. Por favor, faça login.');
      this.$router.push({path:'/auth'});
    },

    onPassword() {
      this.$swalSuccess('Sucesso', 'Senha alterada. Por favor, faça login.');
      this.$router.push({path:'/auth'});
    },
  },
}
</script>
