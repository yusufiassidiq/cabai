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
        <h3 class="card-title">Daftar Permintaan Pembentukan Kemitraan</h3>

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
              <td>{{ data.role | filterRoleUser }}</td>
              <td>{{ data.lokasi.kelurahan | filterAlamat }} , {{ data.lokasi.kecamatan | filterAlamat }} , {{ data.lokasi.kabupaten | filterAlamat }}</td>
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
      axios.get("/kemitraan/pengajuan/list").then(response => {
        this.dataListPengajuanMitra = response.data.data;
      });
    }
  },
  created() {
    this.getPengajuanMitra();
  }
};
</script>