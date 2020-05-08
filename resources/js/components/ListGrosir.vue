<template>
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <vue-progress-bar></vue-progress-bar>
        <h3 class="card-title">Daftar Grosir</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input
              type="text"
              class="form-control input-sm float-right"
              placeholder="Cari User"
              v-model="stringNama"
            />
            <div class="input-group-append">
              <button class="btn btn-default">
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
              <th>Alamat</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!filteredNama.length">
              <td colspan="3" align="center">Tidak ada mitra yang dapat ditambahkan</td>
            </tr>
            <tr v-for="data in filteredNama" :key="data.id">
              <td>{{data.name}}</td>
              <td>{{data.lokasiKelurahan | filterAlamat}}, {{data.lokasiKecamatan | filterAlamat}}, {{data.lokasiKabupaten | filterAlamat}}</td>
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
      dataMitra: {},
      // variabel untuk search
      filteredusers: {},
      stringNama: "",
    };
  },
  methods: {
    // Mendapatkan data Mitra
    getMitra() {
      axios.get("/kemitraan/grosir/list").then(response => {
        this.dataMitra = response.data.data;
      });
    },
    addMitra(id_grosir, nama) {
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
              .post("/kemitraan/request/" + id_grosir)
              .then(() => {
                UpdateData.$emit("ListGrosir");
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
    }
  },
  computed: {
    filteredNama: function() {
      var namaUser = this.dataMitra;
      var stringNama = this.stringNama;

      if (!stringNama) {
        return namaUser;
      }

      var searchString = stringNama.trim().toLowerCase();

      namaUser = namaUser.filter(function(item) {
        if (item.name.toLowerCase().indexOf(stringNama) !== -1) {
          return item;
        }
      });

      return namaUser;
    }
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("ListGrosir", () => {
      this.getMitra();
    });
    this.getMitra();
  }
};
</script>