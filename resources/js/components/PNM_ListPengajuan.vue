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
            <tr v-if="!dataListPengajuanMitra.length">
              <td colspan="4" align="center">Tidak ada mitra yang diajukan</td>
            </tr>
            <tr v-for="data in dataListPengajuanMitra" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>
                <div v-if="data.role===2">Produsen</div>
                <div v-else-if="data.role===3">Pengepul</div>
                <div v-else-if="data.role===4">Grosir</div>
                <div v-else-if="data.role===5">Pengecer</div>
              </td>
              <td>{{ data.lokasi.kelurahan }} , {{ data.lokasi.kecamatan }} , {{ data.lokasi.kabupaten }}</td>
              <td>Menunggu Persetujuan</td>
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