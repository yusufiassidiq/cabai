<template>
  <div class="login-page">
    <div class="login-box">
      <div class="login-logo">
        <p>
          <b>SCM</b>Cabai
        </p>
      </div>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

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

          <div class="row">
            <div class="col-4">
              <!-- <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember">Remember Me</label>
              </div>-->
            </div>
            <!-- /.col -->
            <div class="col-8">
              <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: null,
      password: null,
      has_error: false
    };
  },

  mounted() {
    //
  },

  methods: {
    login() {
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
          if (redirect) {
            redirectTo = redirect.from.name;
          } else if (this.$auth.user().role === 1) {
            redirectTo = "DashboardAdmin";
          } else if (this.$auth.user().role === 2) {
            if (this.$auth.user().status === 0)
              redirectTo = "unverifiedDashboard";
            else redirectTo = "DashboardProd";
          } else if (this.$auth.user().role === 3) {
            if (this.$auth.user().status === 0)
              redirectTo = "unverifiedDashboard";
            else redirectTo = "DashboardPengepul";
          } else if (this.$auth.user().role === 4) {
            if (this.$auth.user().status === 0)
              redirectTo = "unverifiedDashboard";
            else redirectTo = "DashboardGrosir";
          } else {
            if (this.$auth.user().status === 0)
              redirectTo = "unverifiedDashboard";
            else redirectTo = "DashboardPengecer";
          }

          // var sts = this.$auth.user()
          window.localStorage.setItem('isLoggedUser',true)
          this.$router
            .push({ name: redirectTo, params: { usrId: this.$auth.user().id } })
            .catch(err => {});
        },
        error: function() {
          alert("Data yang anda masukan salah");
          // app.has_error = true;
        },
        rememberMe: true,
        fetchUser: true
      });
    }
  }
};
</script>