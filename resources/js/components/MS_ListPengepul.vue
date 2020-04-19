<template>
  <!-- MS : Ini merupakan komponen bagian pada Mitra Saya-->
  <div
    class="tab-pane fade active show"
    id="custom-tabs-three-pengepul"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-pengepul-tab"
  >
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Daftar Pengepul</h3>
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
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-for="data in dataMitra" :key="data.id">
                  <td>{{ data.id }}</td>
                  <td>Role</td>
                  <td>Lokasi</td>
                  <td>
                    <a href="#" class="btn btn-danger btn-xs" @click="pengeluaranModal(data.id)">
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
      axios.get("/listMitraSaya").then(response => {
        this.dataMitra = response.data.data;
        console.log(this.dataMitra);
      });
    },
    deleteMitra() {
      console.log("berhasil dihapus");
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