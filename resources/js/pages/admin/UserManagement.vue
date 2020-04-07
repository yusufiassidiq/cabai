<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">User Managemennt</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Admin</a>
              </li>
              <li class="breadcrumb-item active">User Management</li>
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
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                    />

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
                      <th scope="row">{{ user.id }}</th>
                      <td>{{ user.name }}</td>
                      <td>{{ user.email }}</td>
                      <td>
                        <div v-if="user.role===1">Admin</div>
                        <div v-else-if="user.role===2">Produsen</div>
                        <div v-else-if="user.role===3">Pengepul</div>
                        <div v-else-if="user.role===4">Grosir</div>
                        <div v-else-if="user.role===5">Pengecer</div>
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
                <input type="email" name="email" class="form-control" placeholder="email" />
              </div>
              <div class="form-group">
                <select class="form-control">
                  <option value disabled selected>Select role</option>
                  <option value="2">Produsen</option>
                  <option value="3">Pengepul</option>
                  <option value="4">Grosir</option>
                  <option value="5">Pengecer</option>
                </select>
              </div>
              <div class="form-group">
                <select class="form-control" placeholder="status">
                  <option value disabled selected>Select status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non-aktif</option>
                </select>
              </div>
              <div class="form-group">
                <input
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="kata sandi baru (kosongkan jika tidak diperbarui)"
                />
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
      users: null,
      selectedUser: undefined
    };
  },
  methods: {
    getUsers() {
      axios.get("validateduser").then(response => {
        // console.log(response);
        this.users = response.data.users;
      });
    },
    deleteUser(id) {
      swal
        .fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .delete("/user/" + id)
              .then(() => {
                swal.fire("Deleted!", "Your file has been deleted.", "success");
                UpdateData.$emit("RefreshData");
              })
              .catch(() => {
                swal.fire("Failed!", "There was something wrong.", "waning");
              });
          }
        });
    },
    edituser(id) {
      $("#editUser").modal("show");
    },
    updateUser() {
      console.log("update user");
    }
  },
  created() {
    // custom event vue to update data changes
    UpdateData.$on("RefreshData", () => {
      this.getUsers();
    });
  },
  mounted() {
    this.getUsers();
  }
};
</script>