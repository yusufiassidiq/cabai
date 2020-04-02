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
                  <button class="btn btn-success" @click="newModal">Tambah Lahan</button>
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
                      <th>id</th>
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
                    <!-- example data -->
                    <tr v-for="data in datalahan" :key="data.id">
                      <td>{{ data.id }}</td>
                      <td>{{ data.kodelahan }}</td>
                      <td>{{ data.jeniscabai }}</td>
                      <td>{{ data.luaslahan }}</td>
                      <td>{{ data.lokasi }}</td>
                      <td>{{ data.tgltanam }}</td>
                      <td>ini total</td>
                      <td>
                        <a href="#">
                          <i class="fas fa-edit blue" @click="editModal(data)"></i>
                        </a>
                        /
                        <a href="#" @click="deleteLahan(data.id)">
                          <i class="fas fa-trash red"></i>
                        </a>
                      </td>
                      <!-- end example data -->
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

    <!-- Modal -->
    <div
      class="modal fade"
      id="modalLahan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalLahanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLahanLabel">Tambahkan Lahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateLahan() : addLahan()">
            <div class="modal-body"></div>
            <div class="form-group col-md">
              <input
                v-model="form.kodelahan"
                type="text"
                name="kodelahan"
                class="form-control"
                placeholder="Kode lahan"
                :class="{ 'is-invalid': form.errors.has('kodelahan') }"
              />
              <has-error :form="form" field="kodelahan"></has-error>
            </div>
            <div class="form-group col-md">
              <select
                v-model="form.jeniscabai"
                class="form-control"
                :class="{ 'is-invalid': form.errors.has('jeniscabai') }"
              >
                <option value disabled selected>Jenis cabai</option>
                <option value="Cabai rawit">Cabai rawit</option>
                <option value="Cabai keriting">Cabai keriting</option>
                <option value="Cabai besar">Cabai besar</option>
              </select>
              <has-error :form="form" field="jeniscabai"></has-error>
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
            <div class="form-group">
              <datepicker
                class="col-sm-10"
                placeholder="Tanggal tanam"
                v-model="form.tgltanam"
                id="tanggaltanam"
                :class="{ 'is-invalid': form.errors.has('tgltanam') }"
              ></datepicker>
              <has-error :form="form" field="tgltanam"></has-error>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <!-- <vue-button-spinner :is-loading="isLoading" :disabled="isLoading" :status="status"> -->
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
              <!-- <span>Simpan</span> -->
              <!-- </vue-button-spinner> -->
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- </modal> -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
// datetimepicker doc : https://github.com/charliekassel/vuejs-datepicker#demo
// laravel vue spinner doc : https://www.npmjs.com/package/vue-button-spinner
import datepicker from "vuejs-datepicker";
// import VueButtonSpinner from "vue-button-spinner";

export default {
  components: {
    datepicker,
    // VueButtonSpinner
  },
  data() {
    return {
      datalahan: {},
      isLoading: false, // vuebutton spinner
      status: "", // vuebutton spinner
      editmode: false, // buat ngebedain modal yg di klik modal tambah lahan /edit lahan
      // form buat simpan data
      form: new Form({
        id: "100",
        name: "testing",
        kodelahan: "",
        jeniscabai: "",
        luaslahan: "",
        lokasi: "test",
        tgltanam: ""
      })
    };
  },
  methods: {
    // CRUD
    addLahan() {
      this.isLoading = true;
      this.$Progress.start();
      this.form
        .post("https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai")
        .then(() => {
          this.isLoading = false;
          this.status = true; // or success
          setTimeout(() => {
            this.status = "";
          }, 2000); // to clear the status :)
          // custom event
          UpdateData.$emit("update");
          // hide modal add new user (dengan cara bruteforce karena kalo cara hide fadenya ga hilang)
          $("#modalLahan").trigger("click");
          // show Toast if success
          toast.fire({
            icon: "success",
            title: "data berhasil disimpan"
          });
          this.$Progress.finish();
        })
        .catch(error => {
          this.$Progress.fail();
          console.error(error);
          this.isLoading = false;
          this.status = false; //or error
        });
    },
    getLahan() {
      axios
        .get("https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai")
        .then(response => {
          this.datalahan = response.data;
        });
    },
    updateLahan(){
      // console.log("Lagi diedi?t nih GANS");
      this.$Progress.start();
      this.form
        .put("https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai/" + this.form.id)
        .then(() => {
          // success
          $("#modalLahan").trigger("click");
          swal.fire(
            "Updated!",
            "Data lahan berhasil di simpan.",
            "success"
          );
          this.$Progress.finish();
          UpdateData.$emit("update");
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deleteLahan(id) {
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
              .delete("https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai/" + id)
              .then(() => {
                swal.fire("Deleted!", "Your file has been deleted.", "success");
                UpdateData.$emit("update");
              })
              .catch(() => {
                swal.fire("Failed!", "There was something wrong.", "waning");
              });
          }
        });
    },
    // MODAL
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalLahan").modal("show");
    },
    editModal(data) {
      this.editmode = true;
      this.form.reset();
      $("#modalLahan").modal("show");
      this.form.fill(data);
    }
  },
  created() {
    this.getLahan();
  },
  mounted() {
    console.log("User Management Mounted");
    UpdateData.$on("update", () => {
      this.getLahan();
    });
  }
};
</script>