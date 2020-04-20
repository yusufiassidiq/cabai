<template>
  <!-- MS : Ini merupakan komponen bagian pada Mitra Saya-->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Mitra Saya</h3>

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
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Lokasi</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-if="!dataMitra.length">
                    <td colspan="4" align="center">Tidak ada data lahan</td>
                  </tr>
                  <tr v-for="data in dataMitra" :key="data.id">
                    <td>{{ data.nama }}</td>
                    <td>
                      <div v-if="data.role===2">Produsen</div>
                      <div v-else-if="data.role===3">Pengepul</div>
                      <div v-else-if="data.role===4">Grosir</div>
                      <div v-else-if="data.role===5">Pengecer</div>
                    </td>
                    <td>{{ data.lokasi.kelurahan }}, {{ data.lokasi.kecamatan }}, {{ data.lokasi.kabupaten }}</td>
                    <td>
                      <a
                        href="#"
                        class="btn btn-danger btn-xs"
                        @click="deleteMitra(data.id, data.nama)"
                      >
                        <i class="fas fa-plus-square white"></i>
                        Hapus Mitra
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
      axios.get("/listMitraSaya").then(response => {
        this.dataMitra = response.data.data;
        console.log(this.dataMitra);
      });
    },
    deleteMitra(id_mitra, mitra) {
      swal
        .fire({
          title: "Menghapus Permintaan",
          text: "Apakah anda yakin menghapus " + mitra + " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .delete("/hapusmitra/" + id_mitra)
              .then(function(response) {
                swal.fire(
                  "Menghapus Kemitraan",
                  "Mitra berhasil dihapus",
                  "success"
                );
                UpdateData.$emit("update");
              })
              .catch(function(error) {
                swal.fire("gagal!", "Mitra gagal dihapus", "error");
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