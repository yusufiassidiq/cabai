<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Riwayat Pengeluaran</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Riwayat Pengeluaran</li>
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
                <h3 class="card-title">Daftar Pengeluaran Lahan</h3>
                <vue-progress-bar></vue-progress-bar>

                <div class="card-tools">
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
                      <th>Tanggal</th>
                      <th>Kode Lahan</th>
                      <th>Jenis Pengeluaran</th>
                      <th>Jumlah Pengeluaran</th>
                      <th>Rincian</th>
                      
                      <th>Aksi</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-if="!dataPengeluaran.length">
                      <td colspan="6" align="center">Tidak ada pengeluaran</td>
                    </tr>
                    <tr v-for="data in dataPengeluaran" :key="data.id">
                      <td>{{ data.created_at | dateFilter}}</td>
                      <td>{{ data.kodeLahan }}</td>
                      <td>{{ data.nama_pengeluaran }}</td>
                      <td>{{ data.jumlah_pengeluaran | convertToRupiah }}</td>
                      <td>{{ data.rincian }}</td>
                      <td>
                        <a href="#">
                          <i class="fas fa-edit blue" @click="editModal(data)"></i>
                        </a>
                        /
                        <a href="#" @click="deletePengeluaran(data.id)">
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
          <form @submit.prevent="editmode? updatePengeluaran() : addPengeluaran()">
            <div class="modal-body">
              <div class="form-group col-md">
                <input
                  disabled
                  v-model="form.kodeLahan"
                  type="text"
                  name="kodeLahan"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kodeLahan') }"
                />
                <has-error :form="form" field="kodeLahan"></has-error>
              </div>

              <div class="form-group col-md">
                <select
                  v-model="form.nama_pengeluaran"
                  class="form-control"
                  required
                  :class="{ 'is-invalid': form.errors.has('nama_pengeluaran') }"
                >
                  <option
                    :value="form.nama_pengeluaran"
                    disabled
                    hidden
                    selected
                  >{{form.nama_pengeluaran}}</option>
                  <option value="Pupuk">Pupuk</option>
                  <option value="Alat Tani">Alat Tani</option>
                  <option value="Pestisida">Pestisida</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                <has-error :form="form" field="nama_pengeluaran"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.jumlah_pengeluaran"
                  type="number"
                  name="jumlah_pengeluaran"
                  class="form-control"
                  required
                  placeholder="Jumlah Pengeluaran (dalam rupiah)"
                  :class="{ 'is-invalid': form.errors.has('jumlah_pengeluaran') }"
                />
                <has-error :form="form" field="jumlah_pengeluaran"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.rincian"
                  type="text"
                  name="rincian"
                  class="form-control"
                  placeholder
                  :class="{ 'is-invalid': form.errors.has('rincian') }"
                />
                <has-error :form="form" field="rincian"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
export default {
  data() {
    return {
      dataPengeluaran: {},
      editmode: false, // buat ngebedain modal yg di klik modal tambah lahan /edit lahan
      form: new Form({
        id: "",
        kodeLahan: "",
        jumlah_pengeluaran: "",
        nama_pengeluaran: "",
        tanggal_pengeluaran: new Date(),
        rincian: ""
      })
    };
  },
  methods: {
    // Menghapus Riwayat Pengeluaran
    getPengeluaran() {
      axios.get("/pengeluaran/list").then(response => {
        this.dataPengeluaran = response.data.data;
      });
    },
    // Memperbarui Riwayat Pengeluaran
    updatePengeluaran() {
      this.$Progress.start();
      this.form
        .put("/pengeluaran/update/" + this.form.id)
        .then(() => {
          UpdateData.$emit("RiwayatPengeluaran");
          $("#modalPengeluaran").trigger("click");
          toast.fire({
            icon: "success",
            title: "Pengeluaran berhasil diperbarui"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deletePengeluaran(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "Riwayat pengeluaran yang dihapus tidak dapat dikembalikan",
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
              .delete("/pengeluaran/delete/" + id)
              .then(() => {
                UpdateData.$emit("RiwayatPengeluaran");
                swal.fire("Tehapus!", "Pengeluaran berhasil dihapus", "success");
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
    // Modal
    // Menampilkan modal utk menambahkan pengeluaran baru
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalPengeluaran").modal("show");
    },
    // Menampilkan modal utk mengedit pengeluaran
    editModal(data) {
      this.editmode = true;
      this.form.reset();
      $("#modalPengeluaran").modal("show");
      this.form.fill(data);
    }
  },
  created() {
    this.getPengeluaran();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("RiwayatPengeluaran", () => {
      this.getPengeluaran();
    });
  }
};
</script>