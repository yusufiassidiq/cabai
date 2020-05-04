<template>
  <!-- DM : Ini merupakan komponen bagian pada Daftar Mitra -->
  <div class="col-md-12">
    <vue-progress-bar></vue-progress-bar>
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
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!dataMitra.length">
              <td colspan="3" align="center">Tidak ada mitra yang dapat ditambahkan</td>
            </tr>
            <tr v-for="data in dataMitra" :key="data.id">
              <td>{{data.name}}</td>
              <td>{{data.lokasiKelurahan | customFilter}}, {{data.lokasiKecamatan | customFilter}}, {{data.lokasiKabupaten | customFilter}}</td>
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
      axios
        .get("/kemitraan/pengepul/list")
        .then(response => {
          this.dataMitra = response.data.data;
        })
        .catch(() => {});
    },
    addMitra(id_pengepul, nama) {
      swal
        .fire({
          title: "Mengajukan Permintaan",
          text: "Apakah anda yakin menambahkan " + nama + " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .post("/kemitraan/request/" + id_pengepul)
              .then(() => {
                UpdateData.$emit("ListPengepul");
                swal.fire(
                  "Mengajukan Permintaan",
                  "Berhasil mengajukan kemitraan",
                  "success"
                );
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
                swal.fire(
                  "Gagal!",
                  "Terdapat permasalahan saat menyimpan",
                  "error"
                );
              });
          }
        });
      this.$Progress.finish();
    }
  },
  created() {
    this.getMitra();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("ListPengepul", () => {
      this.getMitra();
    });
  }
};
</script>