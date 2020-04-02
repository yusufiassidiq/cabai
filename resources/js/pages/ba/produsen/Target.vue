<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Target Penjualan Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Rekap Target</li>
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
                <h3 class="card-title">Rekap Target Tahun 2020</h3>

                <div class="card-tools">
                  <button
                    class="btn btn-success"
                    data-toggle="modal"
                    data-target="#addfield"
                  >Tambah Target</button>
                  <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
                  <!-- <input
                      type="text"
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                  />-->

                  <!-- <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                  </div>-->
                  <!-- </div> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Jenis Cabai</th>
                      <th>Bulan</th>
                      <th>Total Target</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <!-- example data -->
                    <tr>
                      <td>1</td>
                      <td>Cabai Keriting</td>
                      <td>Januari</td>
                      <td>Rp20.000</td>
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
                    <!-- end example data -->
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
    <!-- Modal -->
    <div
      class="modal fade"
      id="addfield"
      tabindex="-1"
      role="dialog"
      aria-labelledby="detailUserLabel"
      aria-hidden="true"
    >
      <!-- <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailUserLabel">Tambahkan Target</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="addchilifields">
            <div class="modal-body"></div>
            <div class="form-group col-md">
              <input
                v-model="form.target"
                type="text"
                name="kodelahan"
                class="form-control"
                placeholder="Kode lahan"
                :class="{ 'is-invalid': form.errors.has('kodelahan') }"
              />
              <has-error :form="form" field="kodelahan"></has-error>
            </div>
            <div class="form-group col-md">
              <select v-model="form.jeniscabai" class="form-control">
                <option value disabled selected>Jenis cabai</option>
                <option value="Cabai rawit">Cabai rawit</option>
                <option value="Cabai keriting">Cabai keriting</option>
                <option value="Cabai besar">Cabai besar</option>
              </select>
            </div>

            <div class="form-group col-md">
              <input
                v-model="form.luaslahan"
                type="number"
                name="luaslahan"
                class="form-control"
                placeholder="Luas lahan (ha)"
                :class="{ 'is-invalid': form.errors.has('luaslahan') }"
              />
              <has-error :form="form" field="luaslahan"></has-error>
            </div>
            <div class="form-group col-md">
              
            </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
      </div> -->
    </div>
    <!-- <div
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
    </div>-->
    <!-- End Modal -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
// export default {
//   data() {
//     return {
//       form: new Form({
//         kodelahan: "",
//         jeniscabai: "",
//         luaslahan: "",
//         lokasi: "",
//         tgltanam: "",
//         vmodelexample:""
//       })
//     };
//   },
//   methods: {
//     addchilifields() {
//       console.log("Berhasil ditambahkan");
      // this.form.post("/user");
//     }
//   },
//   mounted() {
//     console.log("User Management Mounted");
//   }
// };
</script>