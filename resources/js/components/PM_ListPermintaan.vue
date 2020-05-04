<template>
  <!-- PM : Permintaanmitra-->
  <div
    class="tab-pane fade active show"
    id="custom-tabs-three-permintaan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-permintaan-tab"
  >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Permintaan</h3>

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
              <th>Role</th>
              <th>Lokasi</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!dataListPermintaanMitra.length">
              <td colspan="4" align="center">Tidak ada yang mengajukan kemitraan</td>
            </tr>
            <tr v-for="data in dataListPermintaanMitra" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>
                <div v-if="data.role===2">Produsen</div>
                <div v-else-if="data.role===3">Pengepul</div>
                <div v-else-if="data.role===4">Grosir</div>
                <div v-else-if="data.role===5">Pengecer</div>
                <div v-else>Konsumen</div>
              </td>
              <td>{{ data.lokasi.kelurahan }} , {{ data.lokasi.kecamatan }} , {{ data.lokasi.kabupaten }}</td>
              <td>
                <button
                  type="button"
                  class="btn btn-success btn-xs"
                  @click="acceptMitra(data.id, data.nama)"
                >Terima</button>
                <button
                  type="button"
                  class="btn btn-danger btn-xs"
                  @click="rejectMitra(data.id, data.nama)"
                >Tolak</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dataListPermintaanMitra: {}
    };
  },
  methods: {
    getPermintaanMitra() {
      axios.get("/kemitraan/permintaan/list").then(response => {
        this.dataListPermintaanMitra = response.data.data;
      });
    },
    acceptMitra(id_mitra, mitra_yg_mengajukan) {
      swal
        .fire({
          title: "Menerima Permintaan",
          text:
            "Apakah anda yakin menerima " +
            mitra_yg_mengajukan +
            " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, terima"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .put("/kemitraan/terima/" + id_mitra)
              .then(function(response) {
                swal.fire(
                  "Mengajukan Permintaan",
                  "Berhasil mengajukan kemitraan",
                  "success"
                );
                UpdateData.$emit("ListPermintaan");
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
    },
    rejectMitra(id_mitra, mitra_yg_mengajukan) {
      swal
        .fire({
          title: "Menolak Permintaan",
          text:
            "Apakah anda yakin menolak " +
            mitra_yg_mengajukan +
            " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .put("/kemitraan/tolak/" + id_mitra)
              .then(function(response) {
                swal.fire(
                  "Menolak Permintaan",
                  "Berhasil menolak kemitraan",
                  "success"
                );
                UpdateData.$emit("ListPermintaan");
              })
              .catch(function(error) {
                swal.fire("gagal!", "Gagal menolak mitra", "error");
              });
          }
        });
    }
  },
  created() {
    this.getPermintaanMitra();
  },
  mounted() {
    UpdateData.$on("ListPermintaan", () => {
      this.getPermintaanMitra();
    });
  }
};
</script>