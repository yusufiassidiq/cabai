<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hasil Panen</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Hasil Panen</li>
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
                <h3 class="card-title">Hasil Panen</h3>
                <vue-progress-bar></vue-progress-bar>

                <div class="card-tools">
                  <button class="btn btn-success btn-sm" @click="newModal">Tambah Panen</button>
                  <!-- <button class="btn btn-success" @click="newModal">Tambahkan Pengeluaran</button> -->
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
                      <th>Kode Lahan</th>
                      <th>Jenis Cabai</th>
                      <th>Jumlah Panen</th>
                      <th>Tanggal Panen</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    <!-- <tr v-if="!dataPanen.length">
                      <td colspan="5" align="center">Tidak ada Hasil Panen</td>
                    </tr> -->
                    <!-- START EXAMPLE DATA -->
                    <td>kode 12</td>
                    <td>Cabai keriting</td>
                    <td>1200 kg</td>
                    <td>12 12 2002</td>
                    <td>
                      <a href="#">
                          <i class="fas fa-edit blue" @click="editModal(data)"></i>
                        </a>
                        /
                        <a href="#" @click="deletePanen(1)">
                          <i class="fas fa-trash red"></i>
                        </a>
                    </td>
                    <!-- END EXAMPLE DATA -->
                    <!-- Silahkan ubah sesuai atribut yg dimiliki -->
                    <!-- <tr v-for="data in dataPanen" :key="data.id">
                      <td>{{ data.kodeLahan }}</td>
                      <td>{{ data.jenis_cabai }}</td>
                      <td>{{ data.jumlah_panen }}</td>
                      <td>{{ data.tanggal_panen }}</td>
                      <td>
                        <a href="#">
                          <i class="fas fa-edit blue" @click="editModal(data)"></i>
                        </a>
                        /
                        <a href="#" @click="deletePanen(data.id)">
                          <i class="fas fa-trash red"></i>
                        </a>
                      </td>
                    </tr> -->
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
      id="modalHasilPanen"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalHasilPanenLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalHasilPanenLabel">Tambahkan Hasil Panen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updatePanen() : addPanen()">
            <div class="modal-body">

              <div class="form-group col-md">
                <select
                  id="pemasok__id"
                  v-model="form.lahan_id"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('lahan_id') }"
                >
                  <option value disabled selected>Pilih Lahan</option>
                  <option
                    v-for="data in datalahan"
                    :key="data.id"
                    v-bind:value="data.id"
                  >{{ data.kode_lahan }} - {{ data.jenis_cabai }}</option>
                </select>
                <has-error :form="form" field="lahan_id"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.jumlah_cabai"
                  type="number"
                  class="form-control"
                  placeholder="Jumlah Panen"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>

              <div class="form-group col-md">
                <datepicker
                  input-class="form-control"
                  required
                  placeholder="Tanggal Panen"
                  v-model="form.tanggal_panen"
                  :format="customFormatter"
                  id="tanggal_panen"
                  :class="{ 'is-invalid': form.errors.has('tanggal_panen') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_panen"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// datetimepicker doc : https://github.com/charliekassel/vuejs-datepicker#demo
import datepicker from "vuejs-datepicker";
export default {
  components: {
    datepicker
  },
  data() {
    return {
      datalahan:{},
      dataPanen: {},
      editmode: false, // buat ngebedain modal yg di klik modal tambah lahan /edit lahan
      form: new Form({
        id: "",
        lahan_id: "",
        jumlah_cabai:"",
        tanggal_panen: "",
      })
    };
  },
  methods: {
    // menampilkan daftar panen cabai
    getPanen(){},
    addPanen(){
      console.log("berhasil ditambahkan")
    },
    // Memperbarui Hasil Panen
    updatePanen() {
      console.log("berhasil diedit")
      this.$Progress.start();
      this.form
        .put("/updatePanen/" + this.form.id)
        .then(() => {
          UpdateData.$emit("HasilPanen");
          $("#modalHasilPanen").trigger("click");
          toast.fire({
            icon: "success",
            title: "Data panen berhasil diperbarui"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deletePanen(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "Panen yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .delete("/deleteHasilPanen/" + id)
              .then(() => {
                UpdateData.$emit("HasilPanen");
                swal.fire("Tehapus!", "Hasil Panen berhasil dihapus", "success");
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
                swal.fire(
                  "Gagal!",
                  "Terdapat masalah ketika menghapus",
                  "waning"
                );
              });
          }
        });
    },
    getLahan() {
      axios.get("/readLahan").then(response => {
        this.datalahan = response.data.data;
      });
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    // Modal
    // Menampilkan modal utk menambahkan pengeluaran baru
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalHasilPanen").modal("show");
    },
    // Menampilkan modal utk mengedit pengeluaran
    editModal(data) {
      this.editmode = true;
      this.form.reset();
      $("#modalHasilPanen").modal("show");
    //   this.form.fill(data);
    }
  },
  created() {
    this.getLahan()
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("HasilPanen", () => {
      this.getPengeluaran();
    });
  }
};
</script>