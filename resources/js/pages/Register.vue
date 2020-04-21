<template>
  <div class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p class="font-putih">
          <b>SCM</b>Cabai
        </p>
      </div>
      <vue-progress-bar></vue-progress-bar>
      <!-- /.Register-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Pendaftaran anggota baru</p>

          <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.name }">
              <input type="text" id="name" class="form-control" placeholder="Nama" v-model="name" required/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.email }">
              <input type="email" id="email" class="form-control" placeholder="Email" v-model="email" required/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.role }">
              <select id="role" class="form-control" v-model="role" required>
                <option value selected disabled>Pilih Peran Keanggotaan</option>
                <option value="2">Produsen</option>
                <option value="3">Pengepul</option>
                <option value="4">Grosir</option>
                <option value="5">Pengecer</option>
                <option value="6">Konsumen</option>
              </select>
            </div>
            <span class="help-block" v-if="has_error && errors.role">{{ errors.role }}</span>

            <div class="input-group mb-3">
              <select class="form-control" v-model="kabupaten" id="kabupaten" required>
                <option selected value>Pilih Kabupaten</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <select class="form-control m-b" v-model="kecamatan" id="kecamatan" required>
                <option selected value>Pilih Kecamatan</option>
              </select>
            </div>

            <div class="input-group mb-3">
              <select class="form-control m-b" v-model="kelurahan" id="kelurahan" required>
                <option selected value>Pilih Kelurahan</option>
              </select>
            </div>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.password }">
              <input type="password" class="form-control" placeholder="Password" v-model="password" required/>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>

            <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.password }">
              <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation" placeholder="Masukan ulang Password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>
           
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="card-footer">
        <small class="text-muted">Sudah punya akun?</small>
        <router-link to="/login">
          <small>Masuk</small>
        </router-link>
      </div>
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
      kabupaten: "",
      kecamatan: "",
      kelurahan: "",
      password: "",
      password_confirmation: "",
      has_error: false,
      error: "",
      errors: {},
      success: false
    };
  },
  mounted: function(){
    function makeRequest (method, url, done) {
      var xhr = new XMLHttpRequest();
      xhr.open(method, url);
      xhr.onload = function () {
        done(null, xhr.response);
      };
      xhr.onerror = function () {
        done(xhr.response);
      };
      xhr.send();
    }

    var hasil = makeRequest('GET', 'https://x.rajaapi.com/poe', function (err, datums) {
      if (err) { throw err; }
      hasil = JSON.parse(datums)
      var return_first = hasil.token
    
      // var return_first = function() {
      // var tmp = null;
      // $.ajax({
      //     'async': false,
      //     'type': "get",
      //     'global': false,
      //     'dataType': 'json',
      //     'url': 'https://x.rajaapi.com/poe',
      //     'success': function(data) {
      //         tmp = data.token;
      //     },
      // });
      // // console.log(tmp)
      // return tmp;
      // }();

      $(document).ready(function() {
          var propinsi = 32; //id jawa barat
          $.ajax({
              url: 'https://x.rajaapi.com/MeP7c5ne' + return_first + '/m/wilayah/kabupaten',
              data: "idpropinsi=" + propinsi,
              type: 'GET',
              dataType: 'json',
              success: function(json) {
                  if (json.code == 200) {
                      for (var i = 0; i < Object.keys(json.data).length; i++) {
                          $('#kabupaten').append($('<option>').text(json.data[i].name).attr('value', json.data[i].name).attr('idnya', json.data[i].id)); 
                      }
                  } else {
                      $('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                  }
              }
          });
                      
          $("#kabupaten").change(function() {
              // var kabupaten = $("#kabupaten").val();
              var kabupaten = $("#kabupaten option:selected").attr('idnya');
              $.ajax({
                  url: 'https://x.rajaapi.com/MeP7c5ne' + return_first + '/m/wilayah/kecamatan',
                  data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi,
                  type: 'GET',
                  cache: false,
                  dataType: 'json',
                  success: function(json) {
                      $("#kecamatan").html('');
                      if (json.code == 200) {
                        $('#kecamatan').append($('<option>').text('Pilih Kecamatan').attr('value', ''));
                          for (var i = 0; i < Object.keys(json.data).length; i++) {
                              $('#kecamatan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].name).attr('idnya', json.data[i].id));
                          }
                          $('#kelurahan').html($('<option>').text('Pilih Kelurahan').attr('value', ''));

                      } else {
                          $('#kecamatan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                      }
                  }
              });
          });
          $("#kecamatan").change(function() {
              // var kecamatan = $("#kecamatan").val();
              var kecamatan = $("#kecamatan option:selected").attr('idnya');
              $.ajax({
                  url: 'https://x.rajaapi.com/MeP7c5ne' + return_first + '/m/wilayah/kelurahan',
                  data: "idkabupaten=" + kabupaten + "&idpropinsi=" + propinsi + "&idkecamatan=" + kecamatan,
                  type: 'GET',
                  dataType: 'json',
                  cache: false,
                  success: function(json) {
                      $("#kelurahan").html('');
                      if (json.code == 200) {
                        $('#kelurahan').html($('<option>').text('Pilih Kelurahan').attr('value', ''));
                          for (var i = 0; i < Object.keys(json.data).length; i++) {
                              $('#kelurahan').append($('<option>').text(json.data[i].name).attr('value', json.data[i].name));
                          }
                      } else {
                          $('#kelurahan').append($('<option>').text('Data tidak di temukan').attr('value', 'Data tidak di temukan'));
                      }
                  }
              });
          });
      });
      // if (localStorage.getItem('reloaded')) {
      //     // The page was just reloaded. Clear the value from local storage
      //     // so that it will reload the next time this page is visited.
      //     localStorage.removeItem('reloaded');
      // } else {
      //     // Set a flag so that we know not to reload the page twice.
      //     localStorage.setItem('reloaded', '1');
      //     location.reload();
      // }
    });
  },
  methods: {
    register() {
      this.$Progress.start();
      var app = this;
      this.$auth.register({
        data: {
          name: app.name,
          email: app.email,
          role: app.role,
          kabupaten: app.kabupaten,
          kecamatan: app.kecamatan,
          kelurahan: app.kelurahan,
          password: app.password,
          password_confirmation: app.password_confirmation
        },
        success: function() {
          app.success = true;
          this.$router.push({
            name: "login",
            params: { successRegistrationRedirect: true }
          });
          this.$Progress.finish();
        },
        error: function(res) {
          console.log(res.response.data.errors);
          app.has_error = true;
          app.error = res.response.data.error;
          app.errors = res.response.data.errors || {};
          this.$Progress.fail()
        }
      });
    }
  }
};
</script>