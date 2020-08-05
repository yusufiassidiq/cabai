<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen akun</h1>
          </div>
          <vue-progress-bar></vue-progress-bar>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Admin</a>
              </li>
              <li class="breadcrumb-item active">Manajemen akun</li>
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
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input
                      type="text"
                      class="form-control input-sm float-right"
                      placeholder="Cari User"
                      v-model="stringNama"
                    />
                    <div class="input-group-append">
                      <button class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <div class="row">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Tanggal divalidasi</th>
                        <th>Surat Izin(SIUP)</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-if="!filteredNama.length">
                        <td colspan="5" align="center">Tidak ada user yang belum divalidasi</td>
                      </tr>
                      <tr
                        v-for="user in filteredNama"
                        v-bind:key="user.id"
                        style="margin-bottom: 5px;"
                      >
                        <td>{{ user.name }}</td>
                        <td>{{ user.role | filterRoleUser }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ customFormatter(user.updated_at) }}</td>
                        <td>
                          <button class="btn btn-info btn-xs" @click="previewImage(user)">
                            <i class="fas fa-eye"></i>&nbsp; Lihat
                          </button>
                        </td>

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
                <div class="row">
                  <div class="col-md-6 d-flex justify-content-start align-self-center">
                    <div
                      style="padding-left: 20px"
                    >Menampilkan {{ pagination.current_page }} dari {{ pagination.last_page }} halaman</div>
                  </div>

                  <div
                    class="col-md-6 d-flex justify-content-end align-self-end"
                    style="padding-right: 30px"
                  >
                    <div class="dataTables_paginate paging_simple_numbers">
                      <ul class="pagination">
                        <li>
                          <button
                            href="#"
                            class="btn btn-default"
                            v-on:click="fetchPaginateUsers(pagination.prev_page_url)"
                            :disabled="!pagination.prev_page_url"
                          >Sebelumnya</button>
                        </li>

                        <li>
                          <button
                            class="btn btn-default"
                            v-on:click="fetchPaginateUsers(pagination.next_page_url)"
                            :disabled="!pagination.next_page_url"
                          >Selanjutnya</button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
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
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    
    <!-- Modal Preview Image -->
    <div
      class="modal fade"
      id="fotosk"
      tabindex="-1"
      role="dialog"
      aria-labelledby="detailUserLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailUserLabel">Foto SIUP</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <img :src="getphoto()" class="img-responsive" />
            </div>
          </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.input-container input {
  /* border: none;
	background: transparent; */
  color: black;
  padding: 6px 6px;
  font-size: 16px;
}
img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
</style>

<script>
export default {
  data() {
    return {
      selectedImage: "logo",
      userDetail: "",
      has_error: false,
      selectedUser: undefined,
      users: {},
      // variabel untuk search
      stringNama: "",
      // untuk pagination
      pagination: [],
      url_getUser: "/user/validated"
    };
  },
  methods: {
    // prev & next paggination
    fetchPaginateUsers(url) {
      this.url_getUser = url
      this.getUsers()
    },
    // set up pagination
    makePagination(data) {
      let pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url
      };
      this.pagination = pagination;
    },
    // get validated user
    getUsers() {
      let $this = this;
      axios
        .get(this.url_getUser)
        .then(response => {
          this.users = response.data.users.data
          $this.makePagination(response.data.users)
        })
        .catch(error => {});
    },
    // delete user
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
              .delete("/user/delete/" + id)
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
    // showing modal edit
    edituser(id) {
      $("#editUser").modal("show");
    },
    // fungsi untuk mengubah status user menjadi inaktif
    updateUser() {
      console.log("update user");
    },
    // format simpan tanggal
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    // fungsi untuk melihat gambar SIUP User
    previewImage(user) {
      this.selectedImage = user.fotosk;
      $("#fotosk").modal("show");
    },
    getphoto() {
      return "/images/" + this.selectedImage;
    },
  },
  computed: {
    // fungsi search
    filteredNama: function() {
      var namaUser = this.users;
      var stringNama = this.stringNama;

      if (!stringNama) {
        return namaUser;
      }

      var searchString = stringNama.trim().toLowerCase();

      namaUser = namaUser.filter(function(item) {
        if (item.name.toLowerCase().indexOf(stringNama) !== -1) {
          return item;
        }
      });

      return namaUser;
    }
  },
  mounted() {
    this.getUsers();
    // custom event vue to update data changes
    UpdateData.$on("UserManagement", () => {
      this.getUsers();
    });
  }
};
</script>