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
                <h3 class="card-title">Riwayat Pengeluaran</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">Tambahkan Pengeluaran</button>
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
                      <th>id</th>
                      <th>Kode Lahan</th>
                      <th>Jumlah Pengeluaran</th>
                      <th>Tanggal</th>
                      <th>Rincian</th>
                      <th>Catatan</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr></tr>
                    <tr v-for="data in dataPengeluaran" :key="data.id">
                      <td>{{ data.id }}</td>
                      <td>{{ data.kodeLahan }}</td>
                      <td>{{ data.jmlPengeluaran }}</td>
                      <td>{{ data.tglPengeluaran }}</td>
                      <td>{{ data.rincian }}</td>
                      <td>{{ data.note }}</td>
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
                <!-- OPTION SEMENTARA, NANTINYA PERLU AMBIL DATA DARI API
                LAHAN APA AJA YG PRODUSEN INI PUNYA
                -->
                <select
                  v-model="form.kodeLahan"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('kodeLahan') }"
                >
                  <option value disabled selected>Pilih Lahan</option>
                  <option value="p11">P11</option>
                  <option value="p12">P12</option>
                  <option value="p13">P13</option>
                </select>
                <has-error :form="form" field="kodeLahan"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.jmlPengeluaran"
                  type="number"
                  name="jmlPengeluaran"
                  class="form-control"
                  placeholder="Jumlah Pengeluaran (dalam rupiah)"
                  :class="{ 'is-invalid': form.errors.has('jmlPengeluaran') }"
                />
                <has-error :form="form" field="jmlPengeluaran"></has-error>
              </div>

              <div class="form-group col-md">
                <select
                  v-model="form.rincian"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('rincian') }"
                >
                  <option value disabled selected>Pilih rincian</option>
                  <option value="Pupuk">Pupuk</option>
                  <option value="Alat Tani">Alat Tani</option>
                  <option value="Pestisida">Pestisida</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                <has-error :form="form" field="rincian"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.note"
                  type="text"
                  name="note"
                  class="form-control"
                  placeholder="Catatan rincian (Opsional)"
                  :class="{ 'is-invalid': form.errors.has('note') }"
                />
                <has-error :form="form" field="note"></has-error>
              </div>
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
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
import HeaderProdusen from '../../../components/produsen/HeaderRiwayatPengeluaran'
export default {
  data() {
    return {
      dataPengeluaran: {},
      editmode: false, // buat ngebedain modal yg di klik modal tambah lahan /edit lahan
      // vform buat simpan data
      form: new Form({
        id: "",
        kodeLahan: "",
        jmlPengeluaran: "",
        tglPengeluaran: new Date(),
        rincian: "",
        note: ""
      })
    };
  },
  components:{
    'headerProdusen' : HeaderProdusen
  },
  methods: {
    // CRUD
    // Menambahkan Riwayat Pengeluaran
    addPengeluaran() {
      console.log("tambah data berhasil");
      // this.isLoading = true;
      // Menampilkan progress bar di mozila
      this.$Progress.start();
      // Http Request axios dgn menggunakan vform
      // var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/pengeluaran";
      this.form
        .post('/addPengeluaran')
        .then(() => {
          this.isLoading = false;
          // this.status = true; // or success
          // setTimeout(() => {
          //   this.status = "";
          // }, 2000);
          // custom event
          UpdateData.$emit("update");
          // hide modal
          $("#modalPengeluaran").trigger("click");
          // show Toast if success
          toast.fire({
            icon: "success",
            title: "Pengeluaran berhasil ditambahkan"
          });
          this.$Progress.finish();
        })
        .catch(error => {
          this.$Progress.fail();
          console.error(error);
          // this.isLoading = false;
          // this.status = false; //or error
        });
    },
    // Menghapus Riwayat Pengeluaran
    getPengeluaran() {
      console.log("Ambil data berhasil");
      var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/pengeluaran";
      axios.get(url).then(response => {
        this.dataPengeluaran = response.data;
      });
    },
    // Memperbarui Riwayat Pengeluaran
    updatePengeluaran() {
      console.log("Update berhasil");
      this.$Progress.start();
      var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/pengeluaran";
      this.form
        .put(url + "/" + this.form.id)
        .then(() => {
          UpdateData.$emit("update");
          // hide modal
          $("#modalPengeluaran").trigger("click");
          toast.fire({
            icon: "success",
            title: "Pengeluaran berhasil diperbarui"
          });
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deletePengeluaran(id) {
      console.log("Hapus Berhasil");
      var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/pengeluaran";
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
              .delete(url + "/" + id)
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
    // Modal
    // Menampilkan modal utk menambahkan pengeluaran baru
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalPengeluaran").modal("show");
    },
    // Menampilkan modal utk mengedit pengeluaran
    editModal(data) {
      console.log("Modal Edit berhasil");
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
    UpdateData.$on("update", () => {
      this.getPengeluaran();
    });
  }
};
</script>