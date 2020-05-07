<template>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Validasi User</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">Admin</a>
                </li>
                <li class="breadcrumb-item active">Validasi User</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Validasi User</h3>
                </div>
                <vue-progress-bar></vue-progress-bar>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Tgl Pengajuan</th>
                        <th>Surat Izin Usaha Perdagangan (SIUP)</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-if="!users.length">
                        <td colspan="5" align="center">Tidak ada user yang belum divalidasi</td>
                      </tr>
                      <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
                        <td>{{ user.name }}</td>
                        <td>{{ user.role | filterRoleUser }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ customFormatter(user.created_at) }}</td>
                        <td>
                          <button class="btn btn-info btn-xs" @click="previewImage()">
                            <i class="fas fa-eye"></i>&nbsp; Lihat
                          </button>
                          &nbsp;/&nbsp;
                          <button
                            class="btn btn-secondary btn-xs"
                            @click="downloadSIUP()"
                          >
                            <i class="fas fa-file-download">&nbsp; Download</i>
                          </button>
                        </td>
                        <td>
                          <button class="btn btn-success btn-xs" @click="selectUser(user)">Validasi</button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="detailUser"
      tabindex="-1"
      role="dialog"
      aria-labelledby="detailUserLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailUserLabel">Detail User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <tr>Nama : {{ userDetail.name }}</tr>
              <tr>Role : {{ userDetail.role | filterRoleUser }}</tr>
              <tr>Tanggal Registrasi : {{ customFormatter(userDetail.created_at) }}</tr>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
            <button class="btn btn-danger" v-on:click="tolak(userDetail.id)">Tolak</button>
            <button class="btn btn-success" v-on:click="terima(userDetail.id)">Terima</button>
          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>
<script>
export default {
  data() {
    return {
      userDetail: "",
      has_error: false,
      users: {},
      selectedUser: undefined
    };
  },
  methods: {
    // fungsi untuk mendapatkan objek user dari API
    getUsers() {
      axios
        .get("/user/requested")
        .then(response => {
          this.users = response.data.users;
        })
        .catch(() => {});
    },

    // fungsi untuk melihat gambar SIUP User
    previewImage() {},

    // fungsi mendownload SIUP User
    downloadSIUP() {},

    // fungsi untuk melihat detail User yang belum divalidasi
    selectUser(user) {
      this.userDetail = user;
      $("#detailUser").modal("show");
    },

    // funsi untuk menolak validasi user
    tolak(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "User akan ditolak",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .put("/user/tolak/" + id)
              .then(() => {
                swal.fire("Terhapus!", "User berhasil dihapus", "success");
                UpdateData.$emit("UserValidation");
                $("#detailUser").modal("hide");
                this.$Progress.finish();
              })
              .catch(() => {
                swal.fire(
                  "Gagal!",
                  "Terdapat masalah ketika menghapus",
                  "waning"
                );
                this.$Progress.fail();
              });
          }
        });
    },

    // fungsi untuk menerima validasi User
    terima(id) {
      this.$Progress.start();
      axios
        .put("/user/terima/" + id)
        .then(response => {
          UpdateData.$emit("UserValidation");
          $("#detailUser").modal("hide");
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
          this.$Progress.fail();
        });
    },
    // fungsi untuk mengubah format tanggal dengan moment js
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    }
  },
  mounted() {
    this.getUsers();
  },
  created() {
    // custom event vue to update data changes
    UpdateData.$on("UserValidation", () => {
      this.getUsers();
    });
  }
};
</script>