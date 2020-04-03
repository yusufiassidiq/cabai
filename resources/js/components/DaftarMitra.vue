<template>
  <div>
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Mitra</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <button
                      class="btn btn-success"
                      data-toggle="modal"
                      data-target="#modalDaftarMitra"
                    >Tambahkan Mitra</button>
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
                      <th>Id</th>
                      <th>Nama</th>
                      <th>Role</th>
                      <th>Lokasi</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr v-for="data in dataMitra" :key="data.id">
                      <td>{{ data.id }}</td>
                      <td>{{ data.name }}</td>
                      <td>{{ data.role }}</td>
                      <td>{{ data.lokasi }}</td>
                      <td>
                        <a href="#" @click="deleteMitra(data.id)">
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
    <!-- Modal -->
    <div
      class="modal fade"
      id="modalDaftarMitra"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalDaftarMitraLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLahanLabel">Cari Mitra</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="addMitra()">
            <div class="modal-body">
              <!-- form grup ini masih belum fix -->
              <!-- Nanti ambil dari ajax jquery kemungkinan-->
              <div class="form-group">
                <label>Pilih role</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Produsen</option>
                  <option>Pengepul</option>
                  <option>Grosir</option>
                  <option>Pengecer</option>
                </select>
              </div>
              <div class="form-group">
                <label>Pilih user</label>
                <select class="form-control select2" style="width: 100%;">
                  <option selected="selected">Johnson</option>
                  <option>Kenedy</option>
                  <option>Alex</option>
                  <option>Kurnia</option>
                  <option>Sasa</option>
                  <option>Susi</option>
                  <option>Wayne</option>
                </select>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <!-- <vue-button-spinner :is-loading="isLoading" :disabled="isLoading" :status="status"> -->
              <button type="submit" class="btn btn-primary">Tambahkan</button>
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
</template>
<script>
export default {
  components: {},
  data() {
    return {
      dataMitra: {},
      // isLoading: false, // vuebutton spinner
      // status: "", // vuebutton spinner
      form: new Form({
        id: "",
        name: "",
        role: "",
        lokasi: ""
      })
    };
  },
  methods: {
    // CRUD
    // Menambahkan data Mitra
    addMitra() {
      console.log("data berhasil ditambahkan");
    },
    // Mendapatkan data Mitra
    getMitra() {
      console.log("data berhasil didapatkan");
      var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/daftarmitra";
      axios.get(url).then(response => {
        this.dataMitra = response.data;
      });
    },
    // menghapus data Mitra
    deleteMitra(id) {
      console.log("data berhasil dihapus");
      var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/daftarmitra";
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
    }
    // MODAL
    // Menampilkan Modal utk menambahkan Mitra baru
  },
  created() {
    this.getMitra();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.getMitra();
    });
  }
};
</script>