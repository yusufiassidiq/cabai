<template>
  <!-- PM : Permintaanmitra -->
  <div
    class="tab-pane fade"
    id="custom-tabs-three-pengajuan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-pengajuan-tab"
  >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Pengajuan</h3>

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
            <tr v-for="data in dataListPengajuanMitra" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>{{ data.role }}</td>
              <td>{{ data.lokasi.kelurahan }} , {{ data.lokasi.kecamatan }} , {{ data.lokasi.kabupaten }}</td>
              <td>Menunggu Persetujuan
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
      dataListPengajuanMitra: {}
    };
  },
  methods: {
    getPengajuanMitra() {
      axios.get("/listPengajuanMitra").then(response => {
        this.dataListPengajuanMitra = response.data.data;
        // console.log(this.dataListPengajuanMitra[0].lokasi);
      });
    },
    terimaMitra(id, nama) {
      swal
        .fire({
          title: "Menerima Permintaan",
          text: "Apakah anda yakin menerima " + nama + " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, terima"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .put("/terimaMitra/" + id)
              .then(function(response) {
                swal.fire(
                  "Menerima Permintaan",
                  "Berhasil membentuk kemitraan",
                  "success"
                );
              })
              .catch(function(error) {
                swal.fire("gagal!", "Gagal membentuk kemitraan", "error");
              });
          }
        });
    }
  },
  created() {
    this.getPengajuanMitra();
  },
  mounted() {
    UpdateData.$on("update", () => {
      this.getPengajuanMitra();
    });
  }
};
</script>