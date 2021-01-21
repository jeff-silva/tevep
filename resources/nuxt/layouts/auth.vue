<template><div class="l-auth">
  <div class="row no-gutters">
    <div class="col-12 col-sm-4 col-md-7 d-none d-sm-flex l-auth-background" style="height:100vh;">
      &nbsp;
    </div>

    <div class="col-12 col-sm-8 col-md-5 d-flex align-items-center l-auth-pattern" style="height:100vh;">
      <div class="mx-auto shadow">

        
        <div class="bg-light" style="height:50px;"></div>
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

          <div class="px-3 pb-3"><nuxt /></div>

          <!-- Links -->
          <div class="row no-gutters bg-light py-3">
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
  background-color: #fff;
  /* background-image:
    radial-gradient(#fff 1px, transparent 1px),
    radial-gradient(#fff 1px, transparent 1px);
  background-size: 50px 50px;
  background-position: 0px 0px, 50px 50px;
  animation: l_auth_background 2s linear infinite; */
}

@keyframes l_auth_background {
  to {
    background-position: 50px 50px, 0px 0px;
  }
}
</style>

<script>
export default {
  data() {
    return {}
  },

  computed: {
    isLogin() { return this.$route.name=='auth'; },
    isRegister() { return this.$route.name=='auth-password'; },
    isPassword() { return this.$route.name=='auth-register'; },
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
