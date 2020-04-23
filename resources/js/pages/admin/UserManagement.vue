<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen User</h1>
          </div>
          <vue-progress-bar></vue-progress-bar>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Admin</a>
              </li>
              <li class="breadcrumb-item active">Manajemen User</li>
            </ol>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Management User</h3>

                <div class="card-tools">
                  <!-- <div class="input-group input-group-sm" style="width: 150px;">
                    <input
                      type="text"
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                    />

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>-->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Tanggal divalidasi</th>
                      <th>Surat Izin(SIUP)</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-if="!users.length">
                      <td colspan="5" align="center">Tidak ada user yang belum divalidasi</td>
                    </tr>
                    <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>{{ customFormatter(user.updated_at) }}</td>
                      <td>
                        <button class="btn btn-info btn-xs" @click="previewImage()">
                            <i class="fas fa-eye"></i>&nbsp; Lihat
                          </button>
                          &nbsp;/&nbsp;
                          <button class="btn btn-secondary btn-xs" @click="downloadSIUP()">
                            <i class="fas fa-file-download">&nbsp; Download</i>
                          </button>
                      </td>
                      <td>{{ getRole(user.role) }}</td>
                      <td>
                        <a href="#">
                          <i class="fas fa-edit blue" v-on:click="edituser(user.id)"></i>
                        </a>
                        /
                        <a href="#" v-on:click="deleteUser(user.id)">
                          <i class="fas fa-trash red"></i>
                        </a>
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
    <!-- Modal Add new user Start-->
    <div
      class="modal fade"
      id="editUser"
      tabindex="-1"
      role="dialog"
      aria-labelledby="editUserLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailUserLabel">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="updateUser()">
            <div class="modal-body">
              <div class="form-group">
                <select class="form-control" placeholder="status">
                  <option value disabled selected>Select status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non-aktif</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success">Update</button>
            </div>
          </form>
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
    getUsers() {
      axios
        .get("validateduser")
        .then(response => {
          this.users = response.data.users;
        })
        .catch(error => {});
    },
    deleteUser(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "User dihapus tidak dapat dikembalikan!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, hapus!"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .delete("/user/" + id)
              .then(() => {
                swal.fire("Terhapus!", "User berhasil dihapus", "success");
                UpdateData.$emit("UserManagement");
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
    edituser(id) {
      $("#editUser").modal("show");
    },
    // fungsi untuk mengubah status user menjadi inaktif
    updateUser() {
      console.log("update user");
    },
    // fungsi untuk mendapat role dari role id
    getRole(id_role) {
      switch (id_role) {
        case 2:
          return "Produsen";
          break;
        case 3:
          return "Pengepul";
          break;
        case 4:
          return "Grosir";
          break;
        case 5:
          return "Pengecer";
          break;
        default:
          return "Konsumen";
      }
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    // fungsi untuk melihat gambar SIUP User
    previewImage() {},

    // fungsi mendownload SIUP User
    downloadSIUP() {},
  },
  created() {
    // custom event vue to update data changes
    UpdateData.$on("UserManagement", () => {
      this.getUsers();
    });
  },
  mounted() {
    this.getUsers();
  }
};
</script>