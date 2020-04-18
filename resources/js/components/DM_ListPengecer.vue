<template>
  <!-- DM : Ini merupakan komponen bagian pada Daftar Mitra -->
  <div
    class="tab-pane fade"
    id="custom-tabs-three-pengecer"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-pengecer-tab"
  >
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pengecer</h3>
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
              <tr v-for="data in dataMitra" :key="data.id">
                <td>{{data.name}}</td>
                <td>{{data.lokasiKelurahan}}, {{data.lokasiKecamatan}}, {{data.lokasiKabupaten}}</td>
                <td>
                  <a href="#" class="btn btn-success btn-xs" @click="addMitra()">
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
      dataMitra: null
    };
  },
  methods: {
    // Mendapatkan data Mitra
    getMitra() {
      console.log("data berhasil didapatkan");
      // var url = "https://5e844114a8fdea00164ac49e.mockapi.io/api/daftarmitra";
      axios.get("/getMitraPengecer").then(response => {
        this.dataMitra = response.data.data;
        console.log(this.dataMitra);
      });
    },
    addMitra() {
      console.log("requestt berhasil");
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