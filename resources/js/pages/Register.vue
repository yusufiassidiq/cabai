<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p>
          <b>SCM</b>Cabai
        </p>
      </div>
      <!-- /.Register-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Pendaftaran anggota baru</p>

          <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.name }">
              <input type="text" id="name" class="form-control" placeholder="Nama" v-model="name" />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.email }">
              <input type="email" id="email" class="form-control" placeholder="Email" v-model="email"/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.role }">
              <select id="role" class="form-control" v-model="role">
                <option value selected disabled>Pilih Peran Keanggotaan</option>
                <option value="2">Produsen</option>
                <option value="3">Pengepul</option>
                <option value="4">Grosir</option>
                <option value="5">Pengecer</option>
              </select>
            </div>
            <span class="help-block" v-if="has_error && errors.role">{{ errors.role }}</span>

            <div class="input-group mb-3">
              <select class="form-control" name="kabupaten" id="kabupaten">
                <option selected value>Pilih Kabupaten</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <select class="form-control m-b" name="kecamatan" id="kecamatan">
                <option selected value>Pilih Kecamatan</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <select class="form-control m-b" name="kelurahan" id="kelurahan">
                <option selected value>Pilih Kelurahan</option>
              </select>
            </div>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.password }">
              <input type="password" class="form-control" placeholder="Password" v-model="password"/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.password }">
              <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation" placeholder="Masukan ulang Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>

            <div class="row">
              <div class="col-8">
                <!-- <div class="icheck-primary">
                  <input type="checkbox" id="remember" />
                  <label for="remember">Remember Me</label>
                </div> -->
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      role: "",
      password: "",
      password_confirmation: "",
      has_error: false,
      error: "",
      errors: {},
      success: false
    };
  },

  methods: {
    register() {
      var app = this;
      this.$auth.register({
        data: {
          name: app.name,
          email: app.email,
          role: app.role,
          password: app.password,
          password_confirmation: app.password_confirmation
        },
        success: function() {
          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });
        },
        error: function(res) {
          console.log(res.response.data.errors);
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
        }
      });
    }
  }
};
</script>