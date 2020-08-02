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
                <div class="row">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Tanggal Panen</th>
                        <th>Kode Lahan</th>
                        <th>Jenis Cabai</th>
                        <th>Jumlah Cabai(Kg)</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-if="!dataPanen.length">
                        <td colspan="5" align="center">Tidak ada Hasil Panen</td>
                      </tr>
                      <tr v-for="data in dataPanen" :key="data.id">
                        <td>{{ data.tanggal_panen | dateFilter }}</td>
                        <td>{{ data.kode_lahan }}</td>
                        <td>{{ data.jenis_cabai }}</td>
                        <td>{{ data.jumlah_panen | filterAngkaRibuan }}</td>
                        <td>
                          <a href="#">
                            <i class="fas fa-edit blue" @click="editModal(data)"></i>
                          </a>
                          /
                          <a href="#" @click="deletePanen(data.id)">
                            <i class="fas fa-trash red"></i>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
                <div class="row">
                  <div class="col-md-6 d-flex justify-content-start align-self-center">
                    <div
                      style="padding-left: 20px"
                    >Menampilkan {{ pagination.current_page }} dari {{ pagination.last_page }} halaman</div>
                  </div>

                  <div
                    class="col-md-6 d-flex justify-content-end align-self-end"
                    style="padding-right: 30px"
                  >
                    <div class="dataTables_paginate paging_simple_numbers">
                      <ul class="pagination">
                        <li>
                          <button
                            href="#"
                            class="btn btn-default"
                            v-on:click="fetchPaginatePanen(pagination.prev_page_url)"
                            :disabled="!pagination.prev_page_url"
                          >Sebelumnya</button>
                        </li>

                        <li>
                          <button
                            class="btn btn-default"
                            v-on:click="fetchPaginatePanen(pagination.next_page_url)"
                            :disabled="!pagination.next_page_url"
                          >Selanjutnya</button>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
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
                  id="lahan__id" v-model="form.pra_produksi_id" class="form-control"
                  :class="{ 'is-invalid': form.errors.has('pra_produksi_id') }"
                >
                  <option value disabled selected>Pilih Lahan</option>
                  <option v-for="data in datalahan" :key="data.id"
                    v-bind:value="data.id"
                  >{{ data.kode_lahan }} - {{ data.jenis_cabai }}
                  </option>
                </select>
                <has-error :form="form" field="pra_produksi_id"></has-error>
              </div>

              <div class="form-group col-md">
                <input v-model="form.jumlah_cabai" type="number"
                  class="form-control" placeholder="Jumlah Cabai (Kg)"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>

              <div class="form-group col-md">
                <datepicker input-class="form-control" required
                  placeholder="Tanggal Panen" v-model="form.tanggal_panen"
                  :format="customFormatter" id="tanggal_panen"
                  :class="{ 'is-invalid': form.errors.has('tanggal_panen') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_panen"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Simpan</button>
              <button
                id="btnaddpanen"
                v-show="!editmode"
                type="submit"
                class="btn btn-primary"
              >Tambah</button>
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
      datalahan: {},
      dataPanen: {},
      editmode: false, // buat ngebedain modal yg di klik modal tambah lahan /edit lahan
      form: new Form({
        id: "",
        jumlah_cabai: "",
        pra_produksi_id: "",
        tanggal_panen: ""
      }),
      // pagination
      pagination: [],
      url_getPanen: "/panen/list"
    };
  },
  methods: {
    getPanen() {
      let $this = this;
      axios.get("/panen/list").then(response => {
        this.dataPanen = response.data.data.data;
        $this.makePagination(response.data.data);
      });
    },

    // prev & next paggination
    fetchPaginatePanen(url) {
      this.url_getPanen = url;
      this.getPanen();
    },
    // set up pagination
    makePagination(data) {
      let pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url
      };
      this.pagination = pagination;
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },

    addPanen() {
      document.getElementById("btnaddpanen").disabled = true;
      this.$Progress.start();
      this.form.post("/panen/tambah").then(() => {
          UpdateData.$emit("HasilPanen");
          $("#modalHasilPanen").trigger("click");
          toast.fire({ icon: "success", title: "Panen berhasil ditambahkan"
          });
          this.$Progress.finish();
          document.getElementById("btnaddpanen").disabled = false;
        })
        .catch(error => {
          this.$Progress.fail();
          document.getElementById("btnaddpanen").disabled = false;
        });
    },
    // Memperbarui Hasil Panen
    updatePanen() {
      console.log("berhasil diedit");
      this.$Progress.start();
      this.form
        .put("/panen/update/" + this.form.id)
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
      swal .fire({
          title: "Apakah kamu yakin?",
          text: "Panen yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          axios.delete("/panen/delete/" + id).then(() => {
              UpdateData.$emit("HasilPanen");
              swal.fire( "Tehapus!", 
              "Hasil Panen berhasil dihapus", "success");
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
      axios.get("praProduksi/list/all").then(response => {
        this.datalahan = response.data.data;
      });
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
      document.getElementById("lahan__id").disabled = true;
      this.form.fill(data);
      this.form.jumlah_cabai = data.jumlah_panen;
    }
  },
  mounted() {
    this.getLahan();
    this.getPanen();
    // Custom event on Vue js
    UpdateData.$on("HasilPanen", () => {
      this.getPanen();
    });
  }
};
</script>