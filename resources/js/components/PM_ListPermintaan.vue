<template>
  <!-- PM : Permintaanmitra -->
  <div
    class="tab-pane fade active show"
    id="custom-tabs-three-home"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-home-tab"
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
            <tr v-for="data in dataListPermintaanMitra" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>role</td>
              <td>lokasi</td>
              <td>menunggu persetujuan</td>
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
      axios.get("/listPermintaanMitra").then(response => {
        this.dataListPermintaanMitra = response.data.data;
        console.log(this.dataListPermintaanMitra);
      });
    },
    acceptMitra() {
      console.log("Berhasil diterima");
    },
    rejectMitra() {
      console.log("Berhasil ditolak");
    }
  },
  created() {
    this.getPermintaanMitra();
  },
  mounted() {
    UpdateData.$on("update", () => {
      this.getPermintaanMitra();
    });
  }
};
</script>