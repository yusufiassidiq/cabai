<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
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
                      <td>{{ data.kode_lahan }}</td>
                      <td>{{ data.jenis_cabai }}</td>
                      <td>{{ data.luas_lahan }}</td>
                      <td>{{ data.lokasi }}</td>
                      <td>{{ data.tanggal_tanam }}</td>
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
            <h5 class="modal-title" id="modalLahanLabel">Informasi Lahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateLahan() : addLahan()">
            <div class="modal-body">
              <div>
                <input
                  v-model="form.id"
                  type = "text"
                  name = "id_form"
                  hidden
                  class="form-control"
                   :class="{ 'is-invalid': form.errors.has('id_form') }"
                />
                <has-error :form="form" field="id_form"></has-error>
              </div>
              <div class="form-group col-md">
                <input
                  v-model="form.kode_lahan"
                  type="text"
                  name="kode_lahan"
                  class="form-control"
                  placeholder="Kode lahan"
                  :class="{ 'is-invalid': form.errors.has('kode_lahan') }"
                />
                <has-error :form="form" field="kode_lahan"></has-error>
              </div>
              <div class="form-group col-md">
                <select
                  v-model="form.jenis_cabai"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('jenis_cabai') }"
                >
                  <option value disabled selected>Jenis cabai</option>
                  <option value="Cabai rawit">Cabai rawit</option>
                  <option value="Cabai keriting">Cabai keriting</option>
                  <option value="Cabai besar">Cabai besar</option>
                </select>
                <has-error :form="form" field="jenis_cabai"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.luas_lahan"
                  type="number"
                  name="luas_lahan"
                  class="form-control"
                  placeholder="Luas lahan (ha)"
                  :class="{ 'is-invalid': form.errors.has('luas_lahan') }"
                />
                <has-error :form="form" field="luas_lahan"></has-error>
              </div>
              <div class="form-group">
                <datepicker
                  class="col-sm-10"
                  placeholder="Tanggal tanam"
                  v-model="form.tanggal_tanam"
                  
                  :format="customFormatter"
                  id="tanggal_tanam"
                  :class="{ 'is-invalid': form.errors.has('tanggal_tanam') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_tanam"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnupdate" v-show="editmode" type="submit" class="btn btn-success">Perbarui</button>
              <button id="btnadd" v-show="!editmode" type="submit" class="btn btn-primary">Tambahkan</button>
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
import HeaderProdusen from '../../../components/produsen/HeaderManajemenLahan'

export default {
  components: {
    datepicker,
    'headerProdusen' : HeaderProdusen
  },
  data() {
    return {
      datalahan: null,
      editmode: false, // buat ngebedain modal yg di klik modal tambah lahan /edit lahan
      // form buat simpan data
      form: new Form({
        id: "",
        kode_lahan: "",
        jenis_cabai: "",
        luas_lahan: "",
        tanggal_tanam: ""
      }),
    };
  },
  methods: {
    customFormatter(date) {
      return moment(date).format('DD MMMM YYYY');
    },
    // CRUD
    // Menambahkan data lahan Produsen
    addLahan() {
      // Http Request axios dgn menggunakan vform
      // var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai";
      document.getElementById("btnadd").disabled = true;
      this.form
        .post('/addLahan')
        .then(() => {
          this.isLoading = false;
          // custom event
          UpdateData.$emit("update");
          // hide modal
          $("#modalLahan").trigger("click");
          // show Toast if success
          toast.fire({
            icon: "success",
            title: "Lahan berhasil ditambahkan"
          });
          document.getElementById("btnadd").disabled = false;
        })
        .catch(error => {
          console.error(error);
          document.getElementById("btnadd").disabled = false;
        });
    },
    // Mendapatkan data lahan produsen
    getLahan() {
      // var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai";
      axios.get('/readLahan').then(response => {
        this.datalahan = response.data.data;
        // console.log(response.data.data)
      });
    },
    // Memperbarui data lahan produsen
    updateLahan() {
      document.getElementById("btnupdate").disabled = true;
      console.log(this.form.id);
      // var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai";
      this.form
        .put("updateLahan/" + this.form.id)
        .then(() => {
          UpdateData.$emit("update");
          // hide modal
          $("#modalLahan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Lahan berhasil diperbarui"
          });
          document.getElementById("btnupdate").disabled = false;
        })
        .catch(() => {
          document.getElementById("btnupdate").disabled = false;
        });
    },
    // menghapus data lahan produsen
    deleteLahan(id) {
      // var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/cabai";
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "Data yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, hapus data!"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .delete("deleteLahan/" + id)
              .then(() => {
                UpdateData.$emit("update");
                swal.fire("Tehapus!", "Data lahan berhasil dihapus", "success");
              })
              .catch(() => {
                swal.fire(
                  "Gagal!",
                  "Terdapat masalah ketika menghapus",
                  "waning"
                );
              });
          }
        });
    },
    // MODAL
    // Menampilkan Modal utk menambahkan lahan baru
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalLahan").modal("show");
    },
    // Menampilkan Modal utk Mengedit lahan baru
    editModal(data) {
      console.log(data)
      this.editmode = true;
      this.form.reset();
      $("#modalLahan").modal("show");
      this.form.fill(data);
      console.log(this.form)
    }
  },
  created() {
    this.getLahan();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.getLahan();
    });
  }
};
</script>