<template>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Manajemen User</h1>
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
                  <h3 class="card-title">Manajemen User</h3>

                  <!-- BUTTON ADD NEW CUMA SEMENTARA, BUAT TEST CRUD -->
                  <div class="card-tools">
                    <!-- Button to show add new user modal -->
                    <button class="btn btn-success" @click="newModal">Add new</button>
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
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                          <!-- warna background belum aktif -->
                          <div v-if="user.status===1">
                            <span class="label label-success">Aktif</span>
                          </div>
                          <div v-else>
                            <span class="label label-danger">Non-Aktif</span>
                          </div>
                        </td>
                        <td>
                          <div v-if="user.role===2">Produsen</div>
                          <div v-else-if="user.role===3">Pengepul</div>
                          <div v-else-if="user.role===4">Grosir</div>
                          <div v-else>Pengecer</div>
                        </td>
                        <td>
                          <a href="#">
                            <i class="fas fa-edit blue" @click="editModal(user)"></i>
                          </a>
                          /
                          <a href="#" @click="deleteUser(user.id)">
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
    </div>
    <!-- /.content-wrapper -->
    <!-- Modal Add new user Start-->
    <div
      class="modal fade"
      id="addNewUser"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewUserLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="!editmode" class="modal-title" id="addNewUserLabel">Add New User</h5>
            <h5 v-show="editmode" class="modal-title" id="addNewUserLabel">Update User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateUser() : createUser()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  class="form-control"
                  placeholder="name"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  class="form-control"
                  placeholder="email"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>
              <div class="form-group">
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  class="form-control"
                  placeholder="password"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
              <div class="form-group">
                <select v-model="form.role" class="form-control" placeholder="role">
                  <option value disabled selected>Select role</option>
                  <option value="2">Produsen</option>
                  <option value="3">Pengepul</option>
                  <option value="4">Grosir</option>
                  <option value="5">Pengecer</option>
                </select>
              </div>
              <div class="form-group">
                <select v-model="form.status" class="form-control" placeholder="status">
                  <option value disabled selected>Select status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non-aktif</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal Add new user End-->
  </div>
</template>
<script>
export default {
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        role: "",
        status: ""
      })
    };
  },
  methods: {
    // Show Moodal for create user
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNewUser").modal("show");
    },

    // show modal for edit user and fill that form
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNewUser").modal("show");
      this.form.fill(user);
    },

    updateUser() {
      // console.log("Lagi diedi?t nih GANS");?
      this.$Progress.start();
      this.form
        .put("/user/" + this.form.id)
        .then(() => {
          // success
          $("#addNewUser").trigger("click");
          swal.fire(
            "Updated!",
            "User information has been updated.",
            "success"
          );
          this.$Progress.finish();
          Fire.$emit("AfterCreate");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },

    // function for create user (Method POST)
    createUser() {
      // show progress bar on top browser
      this.$Progress.start();
      this.form
        .post("/user")
        .then(() => {
          // custom event
          Fire.$emit("AfterCreate");
          // hide modal add new user (dengan cara bruteforce karena kalo cara hide fadenya ga hilang)
          $("#addNewUser").trigger("click");
          // show Toast if success
          toast.fire({
            icon: "success",
            title: "user created successfully"
          });
          this.$Progress.finish();
        })
        .catch(() => {});
    },

    // function for get user from DB (Method GET)
    loaduser() {
      axios.get("/user").then(({ data }) => (this.users = data.data));
    },

    // function for delete user (Method)
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
                Fire.$emit("AfterCreate");
              })
              .catch(() => {
                swal.fire("Failed!", "There was something wrong.", "waning");
              });
          }
        });
    }
  },
  created() {
    this.loaduser();
    Fire.$on("AfterCreate", () => {
      this.loaduser();
    });
  },
  mounted() {
    console.log("User Management Mounted");
  }
};
</script>
