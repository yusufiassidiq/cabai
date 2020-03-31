<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen Lahan</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Manajemen Lahan</li>
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
                <h3 class="card-title">Manajemen Lahan</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <button
                      class="btn btn-success"
                      data-toggle="modal"
                      data-target="#exampleModal"
                    >Add new</button>
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
                      <th>Kode Lahan</th>
                      <th>Jenis Cabai</th>
                      <th>Luas Lahan</th>
                      <th>Lokasi</th>
                      <th>Tanggal tanam</th>
                      <th>Total Pengeluaran</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>P12</td>
                      <td>Cabai Keriting</td>
                      <td>2 ha</td>
                      <td>Bogor</td>
                      <td>01-02-2020</td>
                      <td>2.000.000</td>
                      <td>
                        <a href="#">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                          <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>P11</td>
                      <td>Cabai Besar</td>
                      <td>10 ha</td>
                      <td>Garut</td>
                      <td>02-02-2020</td>
                      <td>2.030.000</td>
                      <td>
                        <a href="#">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                          <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>P90</td>
                      <td>Cabai Rawit</td>
                      <td>3 ha</td>
                      <td>Bekasi</td>
                      <td>09-02-2020</td>
                      <td>2.110.000</td>
                      <td>
                        <a href="#">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                          <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>P70</td>
                      <td>Cabai Rawit</td>
                      <td>3 ha</td>
                      <td>Cianjur</td>
                      <td>10-02-2020</td>
                      <td>6.000.000</td>
                      <td>
                        <a href="#">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                          <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                    <tr>
                      <td>P29</td>
                      <td>Cabai Rawit</td>
                      <td>3 ha</td>
                      <td>Sukabumi</td>
                      <td>11-02-2020</td>
                      <td>2.230.000</td>
                      <td>
                        <a href="#">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                          <i class="fa fa-trash red"></i>
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
    
    <!-- Start Modal -->
    <div
      class="modal fade"
      id="AddNewUser"
      tabindex="-1"
      role="dialog"
      aria-labelledby="AddNewUserLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="AddNewUserLabel">Add New User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="createuser">
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
                  <option value="1">Admin</option>
                  <option value="2">Produsen</option>
                  <option value="3">Eceran</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
export default {
  data() {
    return {
      form: new Form({
        // name: "",
        // email: "",
        // password: "",
        // role: "",
        // status: "hhh"
      })
    };
  },
  methods: {
    addchilifields() {
      console.log("Berhasil ditambahkan");
      // this.form.post("/user");
    }
  },
  mounted() {
    console.log("User Management Mounted");
  }
};
</script>