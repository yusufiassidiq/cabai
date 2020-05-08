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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Manajemen Lahan</li>
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
                <h3 class="card-title">Daftar Lahan</h3>

                <div class="card-tools">
                  <button class="btn btn-success btn-sm" @click="newModal">Tambah Lahan</button>
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
                      <th>Luas Lahan (ha)</th>
                      <th>Tanggal Tanam</th>
                      <th>Total Pengeluaran</th>
                      <th>Aksi</th>
                      <th>Pengeluaran</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-if="!datalahan.length">
                      <td colspan="7" align="center">Tidak ada data lahan</td>
                    </tr>
                    <tr v-for="data in datalahan" :key="data.id">
                      <td>{{ data.kode_lahan }}</td>
                      <td>{{ data.jenis_cabai }}</td>
                      <td>{{ data.luas_lahan }}</td>
                      <td>{{ data.tanggal_tanam | dateFilter }}</td>
                      <td>{{ data.pengeluaran | convertToRupiah }}</td>
                      <td>
                        <a href="#" @click="editModal(data)">
                          <i class="fas fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteLahan(data.id)">
                          <i class="fas fa-trash red"></i>
                        </a>
                      </td>
                      <td>
                        <a
                          href="#"
                          class="btn btn-success btn-xs"
                          @click="pengeluaranModal(data.id)"
                        >
                          <i class="fas fa-plus-square white"></i>
                          Tambah
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
    <vue-progress-bar></vue-progress-bar>
    <!-- Modal Manajemen Lahan-->
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
              <!-- <div>
                <input
                  v-model="form.id"
                  type = "text"
                  name = "id_form"
                  hidden
                  class="form-control"
                   :class="{ 'is-invalid': form.errors.has('id_form') }"
                />
                <has-error :form="form" field="id_form"></has-error>
              </div>-->
              <div class="form-group col-md">
                <input
                  v-model="form.kode_lahan"
                  type="text"
                  name="kode_lahan"
                  class="form-control"
                  placeholder="Kode lahan"
                  required
                  :class="{ 'is-invalid': form.errors.has('kode_lahan') }"
                />
                <has-error :form="form" field="kode_lahan"></has-error>
              </div>
              <div class="form-group col-md">
                <select
                  v-model="form.jenis_cabai"
                  class="form-control"
                  required
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
                  required
                  :class="{ 'is-invalid': form.errors.has('luas_lahan') }"
                />
                <has-error :form="form" field="luas_lahan"></has-error>
              </div>
              <div class="form-group col-md">
                <datepicker
                  input-class="form-control"
                  required
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
              <button
                id="btnupdate"
                v-show="editmode"
                type="submit"
                class="btn btn-success"
              >Perbarui</button>
              <button id="btnadd" v-show="!editmode" type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- </modal> -->

    <!-- Modal Pengeluaran -->
    <div
      class="modal fade"
      id="modalPengeluaran"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalRiwayatLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPengeluaranLabel">Tambahkan Pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="addPengeluaran()">
            <div class="modal-body">
              <div class="form-group col-md">
                <select
                  v-model="formriwayat.nama_pengeluaran"
                  required
                  class="form-control"
                  :class="{ 'is-invalid': formriwayat.errors.has('nama_pengeluaran') }"
                >
                  <option value disabled selected>Jenis pengeluaran</option>
                  <option value="Pupuk">Pupuk</option>
                  <option value="Alat Tani">Alat Tani</option>
                  <option value="Pestisida">Pestisida</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                <has-error :form="formriwayat" field="nama_pengeluaran"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  required
                  v-model="formriwayat.jumlah_pengeluaran"
                  type="number"
                  name="jumlah_pengeluaran"
                  class="form-control"
                  placeholder="Jumlah Pengeluaran (dalam rupiah)"
                  :class="{ 'is-invalid': formriwayat.errors.has('jumlah_pengeluaran') }"
                />
                <has-error :form="formriwayat" field="jumlah_pengeluaran"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="formriwayat.rincian"
                  type="text"
                  name="rincian"
                  class="form-control"
                  placeholder="Rincian pengeluaran (Opsional)"
                  :class="{ 'is-invalid': formriwayat.errors.has('rincian') }"
                />
                <has-error :form="form" field="rincian"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnaddpengeluaran" type="submit" class="btn btn-primary">Tambah</button>
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
import datepicker from "vuejs-datepicker";

export default {
  components: {
    datepicker
  },
  data() {
    return {
      datalahan: {},
      editmode: false,
      form: new Form({
        id: "",
        kode_lahan: "",
        jenis_cabai: "",
        luas_lahan: "",
        tanggal_tanam: ""
      }),
      formriwayat: new Form({
        pra_produksi_id: "",
        nama_pengeluaran: "",
        jumlah_pengeluaran: "",
        rincian: ""
      })
    };
  },
  methods: {
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    // CRUD
    // Menambahkan data lahan Produsen
    addLahan() {
      document.getElementById("btnadd").disabled = true;
      this.$Progress.start();
      this.form
        .post("/praProduksi/tambah")
        .then(() => {
          UpdateData.$emit("ManajemenLahan");
          $("#modalLahan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Lahan berhasil ditambahkan"
          });
          this.$Progress.finish();
          document.getElementById("btnadd").disabled = false;
        })
        .catch(error => {
          this.$Progress.fail();
          document.getElementById("btnadd").disabled = false;
        });
    },
    // Mendapatkan data lahan produsen
    getLahan() {
      axios.get("/praProduksi/list").then(response => {
        this.datalahan = response.data.data;
      });
    },
    // Memperbarui data lahan produsen
    updateLahan() {
      document.getElementById("btnupdate").disabled = true;
      this.$Progress.start();
      this.form
        .put("/praProduksi/update/" + this.form.id)
        .then(() => {
          UpdateData.$emit("ManajemenLahan");
          $("#modalLahan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Lahan berhasil diperbarui"
          });
          this.$Progress.finish();
          document.getElementById("btnupdate").disabled = false;
        })
        .catch(() => {
          this.$Progress.fail();
          document.getElementById("btnupdate").disabled = false;
        });
    },
    // menghapus data lahan produsen
    deleteLahan(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text:
            "Menghapus lahan dapat menghapus seluruh riwayat pengeluaran lahan ini",
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
              .delete("/praProduksi/delete/" + id)
              .then(() => {
                UpdateData.$emit("ManajemenLahan");
                swal.fire("Tehapus!", "Lahan berhasil dihapus", "success");
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
                swal.fire(
                  "Gagal!",
                  "Terdapat masalah ketika menghapus",
                  "warning"
                );
              });
          }
        });
    },
    addPengeluaran() {
      document.getElementById("btnaddpengeluaran").disabled = true;
      this.$Progress.start();
      this.formriwayat
        .post("/pengeluaran/tambah")
        .then(() => {
          UpdateData.$emit("ManajemenLahan");
          $("#modalPengeluaran").trigger("click");
          toast.fire({
            icon: "success",
            title: "Pengeluaran berhasil ditambahkan"
          });
          this.$Progress.finish();
          document.getElementById("btnaddpengeluaran").disabled = false;
        })
        .catch(error => {
          this.$Progress.fail();
          document.getElementById("btnaddpengeluaran").disabled = false;
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
      this.editmode = true;
      this.form.reset();
      $("#modalLahan").modal("show");
      this.form.fill(data);
    },
    pengeluaranModal(id) {
      this.formriwayat.reset();
      $("#modalPengeluaran").modal("show");
      this.formriwayat.pra_produksi_id = id;
    }
  },
  created() {
    this.getLahan();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("ManajemenLahan", () => {
      this.getLahan();
    });
  }
};
</script>