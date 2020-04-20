<template>
  <!-- DM : Ini merupakan komponen bagian pada Daftar Mitra -->
  <div
    class="tab-pane fade"
    id="custom-tabs-three-produsen"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-produsen-tab"
  >
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Produsen</h3>
          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
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
                <!-- <th>Id</th> -->
                <th>Nama</th>
                <th>Lokasi</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-if="!dataMitra.length">
                <td colspan="3" align="center">Tidak ada pelaku rantai pasok Produsen</td>
              </tr>
              <tr v-for="data in dataMitra" :key="data.id">
                <td>{{data.name}}</td>
                <td>{{data.lokasiKelurahan}}, {{data.lokasiKecamatan}}, {{data.lokasiKabupaten}}</td>
                <td>
                  <a href="#" class="btn btn-success btn-xs" @click="addMitra(data.id, data.name)">
                    <i class="fas fa-plus-square white"></i>
                    Tambah sebagai mitra
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
</template>
<script>
export default {
  data() {
    return {
      dataMitra: {}
    };
  },
  methods: {
    // Mendapatkan data Mitra
    getMitra() {
      axios.get("/getMitraProdusen").then(response => {
        this.dataMitra = response.data.data;
      });
    },
    addMitra(id_produsen, nama) {
      swal
        .fire({
          title: "Mengajukan Permintaan",
          text: "Apakah anda yakin menambahkan " + nama + " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, tambahkan"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .post("/requestMitra/" + id_produsen)
              .then(function(response) {
                swal.fire(
                  "Mengajukan Permintaan",
                  "Berhasil mengajukan kemitraan",
                  "success"
                );
              })
              .catch(function(error) {
                swal.fire(
                  "gagal!",
                  "Pengguna ini telah mendaftarkan anda sebagai mitra",
                  "error"
                );
              });
          }
        });
    }
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