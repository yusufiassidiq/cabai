<template>
  <!-- PM : Permintaanmitra dari Pengguna Lain-->
  <div
    class="tab-pane fade"
    id="custom-tabs-three-pengajuan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-pengajuan-tab"
  >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Permintaan Cabai</h3>

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
              <th>Jenis cabai</th>
              <th>Jumlah cabai</th>
              <th>Harga cabai</th>
              <th>Tanggal diterima</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!listPermintaanCabai.length">
              <td colspan="7" align="center">Tidak ada daftar permintaan cabai</td>
            </tr>
            <!-- <tr v-for="data in dataListPermintaanMitra" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>
                <div v-if="data.role===2">Produsen</div>
                <div v-else-if="data.role===3">Pengepul</div>
                <div v-else-if="data.role===4">Grosir</div>
                <div v-else-if="data.role===5">Pengecer</div>
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
            </tr> -->
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
      listPermintaanCabai: {}
    };
  },
  methods: {
    getPermintaanCabai(){

    }
  },
  created() {
    this.getPermintaanCabai();
  },
  mounted() {
    UpdateData.$on("update", () => {
      this.getPermintaanCabai();
    });
  }
};
</script>