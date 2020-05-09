<template>
  <div class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <p class="font-putih">
          <b>SCM</b>Cabai
        </p>
      </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk dengan akun SCM Cabai</p>
        <vue-progress-bar></vue-progress-bar>
        <form autocomplete="on" @submit.prevent="login" method="post">
          <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.email }">
            <input
              type="email"
              id="email"
              class="form-control"
              placeholder="Email"
              v-model="email"
              required
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>

          <div
            class="input-group mb-3"
            v-bind:class="{ 'has-error': has_error && errors.password }"
          >
            <input
              type="password"
              class="form-control"
              placeholder="Password"
              v-model="password"
              autocomplete="on"
              required
            />
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <center class="red" v-for="error in errors" :key="error.message">{{ error }}</center>
          <div class="row">
            <div class="col-12">
              <button id="btnmasuk" type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer">
        <small class="text-muted">belum punya akun?</small>
        <router-link to="/register">
          <small>Daftar</small>
        </router-link>
      </div>
    </div>
  </div>
</template>
<style>
.login-page {
  background-image: url("/dist/img/cabai.jpg");
  background-size: cover;
}
.font-putih {
  color: white;
}
</style>
<script>
export default {
  data() {
    return {
      errors: [],
      email: null,
      password: null,
      has_error: false
    };
  },

  mounted() {},

  methods: {
    login() {
      this.$Progress.start();
      document.getElementById("btnmasuk").disabled = true;
      this.errors = [];
      // get the redirect object
      var redirect = this.$auth.redirect();
      var app = this;
      this.$auth.login({
        params: {
          email: app.email,
          password: app.password
        },
        success: function() {
          // handle redirection
          // const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'dashboard'

          let redirectTo;
          if (this.$auth.user().status === 1) {
            switch (this.$auth.user().role) {
              case 1:
                redirectTo = "DashboardAdmin";
                break;
              case 2:
                redirectTo = "DashboardProd";
                break;
              case 3:
                redirectTo = "DashboardPengepul";
                break;
              case 4:
                redirectTo = "DashboardGrosir";
                break;
              case 5:
                redirectTo = "DashboardPengecer";
                break;
              case 6:
                redirectTo = "DashboardKonsumen";
                break;
              default:
                // do nothing
                break;
            }
          } 
          else if (this.$auth.user().status === 0)
            redirectTo = "unverifiedDashboard"
          else
            redirectTo = "gagalvalidasi"
            
          this.$Progress.finish();
          // var sts = this.$auth.user()
          window.localStorage.setItem("isLoggedUser", true);
          // window.localStorage.setItem("role", this.$auth.user().role);
          this.$router
            .push({ name: redirectTo, params: { usrId: this.$auth.user().id } })
            .catch(err => {});
        },
        error: function() {
          this.errors.push("Maaf, Email atau kata sandi Anda salah.");
          document.getElementById("btnmasuk").disabled = false;
          this.$Progress.fail();
        },
        rememberMe: true,
        fetchUser: true
      });
    }
  }
};
</script>