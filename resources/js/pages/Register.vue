<template>
  <div class="page-wrapper bg-cabai p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <!-- <h5 class="card-title d-flex justify-content-center" >Registrasi</h5> -->
                <div class="regist-page d-flex justify-content-center">
                  <h2>Registrasi akun</h2>
                </div>
                <div class="card-body">
                  <div class="container">
                    <form autocomplete="off" @submit.prevent="register" v-if="!success" method="post">
                      <div class="row">
                        <div class="col-md-6">
                          <label>Nama</label>
                          <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.name }">
                            <input type="text" id="name" class="form-control" placeholder="Masukan nama anda" v-model="name" required />
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-user"></span>
                              </div>
                            </div>
                          </div>
                          <span class="help-block" v-if="has_error && errors.name">{{ errors.name }}</span>
                          
                          <label>Password</label>
                          <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.password }">
                            <input id="password" type="password" class="form-control" placeholder="Masukan password" v-model="password" required />
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-eye" v-on:click="lihatpassword('password')"></span>
                              </div>
                            </div>
                          </div>
                          <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>

                          <label>Masukan ulang password</label>
                          <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.password }" >
                            <input type="password" id="password_confirmation" class="form-control" v-model="password_confirmation" placeholder="Masukan ulang Password" required />
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-eye" v-on:click="lihatpassword('password_confirmation')"></span>
                              </div>
                            </div>
                          </div>
                          <span class="help-block" v-if="has_error && errors.password">{{ errors.password }}</span>

                          <label>Role</label>
                          <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.role }">
                            <select id="role" class="form-control" v-model="role" required>
                              <option value selected disabled>Pilih role</option>
                              <option value="2">Produsen</option>
                              <option value="3">Pengepul</option>
                              <option value="4">Grosir</option>
                              <option value="5">Pengecer</option>
                              <option value="6">Konsumen</option>
                            </select>
                          </div>
                          <span class="help-block" v-if="has_error && errors.role">{{ errors.role }}</span>
                          <label>SIUP</label>
                          <div
                            class="input-group mb-3"
                            v-bind:class="{ 'has-error': has_error && errors.fotosk }"
                          >
                            <div class="input-group ">
                              <div class="custom-file">
                                <!-- <input type="file" v-on:change="onFileChange" class="form-control "> -->
                                <input type="file" v-on:change="onFileChange" class="custom-file-input form-control" id="exampleInputFile" />
                                <label class="custom-file-label" for="exampleInputFile" id="exampleInputFile">Pilih file</label>
                              </div>
                            </div>
                          </div>
                          <span class="help-block" v-if="has_error && errors.fotosk">{{ errors.fotosk }}</span>
                          <div class="row">
                            <div class="col-12 fotosk">
                              <img :src="fotosk" class="img-responsive">
                            </div>
                          </div>
                          <div class="row btncstm">
                        <div class="col-12 ">
                          <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                        </div>
                      </div>
                        </div>
                        <div class="col-md-6">
                          <label>Email</label>
                          <div class="input-group mb-3" v-bind:class="{ 'has-error': has_error && errors.email }">
                            <input type="email" id="email" class="form-control" placeholder="Masukan email" v-model="email" required/>
                            <div class="input-group-append">
                              <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                              </div>
                            </div>
                          </div>
                          <span class="help-block" v-if="has_error && errors.email">{{ errors.email }}</span>
                          <label>Kabupaten</label>
                          <div class="input-group mb-3">
                            <select class="form-control" v-model="kabupaten" id="kabupaten" required>
                              <option selected value>Pilih Kabupaten</option>
                            </select>
                          </div>

                          <label>Kota</label>
                          <div class="input-group mb-3">
                            <select class="form-control m-b" v-model="kecamatan" id="kecamatan" required>
                              <option selected value>Pilih Kecamatan</option>
                            </select>
                          </div>

                          <label>Kabupaten</label>
                          <div class="input-group mb-3">
                            <select class="form-control m-b" v-model="kelurahan" id="kelurahan" required>
                              <option selected value>Pilih Kelurahan</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      
                      <!-- <br> -->
                      
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
    </div>
</template>
<style scoped>
    .btncstm{
      padding-top: 10px;
    }
    .fotosk{
      text-align: center;
      /* display: inline-block; */
    }
    img{
        max-height: 200px;
        max-width: 320px;
    }
</style>
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
      fotosk: "",
      password: "",
      password_confirmation: "",
      has_error: false,
      error: "",
      errors: {},
      success: false
    };
  },
  mounted: function() {
    function makeRequest(method, url, done) {
      var xhr = new XMLHttpRequest();
      xhr.open(method, url);
      xhr.onload = function() {
        done(null, xhr.response);
      };
      xhr.onerror = function() {
        done(xhr.response);
      };
      xhr.send();
    }
  
    $(document).ready(function() {
          var propinsi = 32; //id jawa barat
          $.ajax({
            url:
              "https://dev.farizdotid.com/api/daerahindonesia/kota",
            data: "id_provinsi=" + propinsi,
            type: "GET",
            dataType: "json",
            success: function(json) {
              if(json){
                for (var i = 0; i < Object.keys(json.kota_kabupaten).length; i++) {
                  $("#kabupaten").append(
                    $("<option>")
                      .text(json.kota_kabupaten[i].nama)
                      .attr("value", json.kota_kabupaten[i].nama)
                      .attr("idnya", json.kota_kabupaten[i].id)
                  );
                }
              }
              else {
                $("#kecamatan").append(
                  $("<option>")
                    .text("Data tidak di temukan")
                    .attr("value", "Data tidak di temukan")
                );
              }
            }
          });
          $("#kabupaten").change(function() {
            var kabupaten = $("#kabupaten option:selected").attr("idnya");
            $.ajax({
              url:
                "https://dev.farizdotid.com/api/daerahindonesia/kecamatan",
              data: "id_kota=" + kabupaten,
              type: "GET",
              dataType: "json",
              success: function(json) {
                $("#kecamatan").html("");
                if (json) {
                  $("#kecamatan").append(
                    $("<option>")
                      .text("Pilih Kecamatan")
                      .attr("value", "")
                  );
                  for (var i = 0; i < Object.keys(json.kecamatan).length; i++) {
                    $("#kecamatan").append(
                      $("<option>")
                        .text(json.kecamatan[i].nama)
                        .attr("value", json.kecamatan[i].nama)
                        .attr("idnya", json.kecamatan[i].id)
                    );
                  }
                  $("#kelurahan").html(
                    $("<option>")
                      .text("Pilih Kelurahan")
                      .attr("value", "")
                  );
                } else {
                  $("#kecamatan").append(
                    $("<option>")
                      .text("Data tidak di temukan")
                      .attr("value", "Data tidak di temukan")
                  );
                }
              }
            });
          });
          $("#kecamatan").change(function() {
            var kecamatan = $("#kecamatan option:selected").attr("idnya");
            $.ajax({
              url:
                "https://dev.farizdotid.com/api/daerahindonesia/kelurahan",
              data:
                "id_kecamatan=" + kecamatan,
              type: "GET",
              dataType: "json",
              success: function(json) {
                $("#kelurahan").html("");
                if (json) {
                  $("#kelurahan").html(
                    $("<option>")
                      .text("Pilih Kelurahan")
                      .attr("value", "")
                  );
                  for (var i = 0; i < Object.keys(json.kelurahan).length; i++) {
                    $("#kelurahan").append(
                      $("<option>")
                        .text(json.kelurahan[i].nama)
                        .attr("value", json.kelurahan[i].nama)
                    );
                  }
                } else {
                  $("#kelurahan").append(
                    $("<option>")
                      .text("Data tidak di temukan")
                      .attr("value", "Data tidak di temukan")
                  );
                }
              }
            });
          });
    });
  },
  methods: {
    lihatpassword(id){
      var x = document.getElementById(id);
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    },
    onFileChange(e) {
        let files = e.target.files || e.dataTransfer.files;
        if (!files.length)
            return;
        this.createImage(files[0]);
    },
    createImage(file) {
        let reader = new FileReader();
        let vm = this;
        reader.onload = (e) => {
            vm.fotosk = e.target.result;
        };
        reader.readAsDataURL(file);
    },
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
          fotosk: app.fotosk,
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
          this.$Progress.fail();
        }
      });
    }
  }
};
</script>