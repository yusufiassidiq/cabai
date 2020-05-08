<template>
  <!-- MS : Ini merupakan komponen bagian pada Mitra Saya-->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <vue-progress-bar></vue-progress-bar>
              <h3 class="card-title">Mitra Saya</h3>
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
                    <th>Role</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-if="!filteredNama.length">
                    <td colspan="4" align="center">Tidak ada mitra</td>
                  </tr>
                  <tr v-for="data in filteredNama" :key="data.id">
                    <td>{{ data.nama }}</td>
                    <td>{{ data.role | filterRoleUser }}</td>
                    <td>{{ data.lokasi.kelurahan | filterAlamat }}, {{ data.lokasi.kecamatan | filterAlamat }}, {{ data.lokasi.kabupaten | filterAlamat}}</td>
                    <td>
                      <a
                        href="#"
                        class="btn btn-danger btn-xs"
                        @click="deleteMitra(data.id, data.nama)"
                      >
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
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      dataMitra: {},
      // variabel untuk search
      stringNama: "",
    };
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
        if (item.nama.toLowerCase().indexOf(stringNama) !== -1) {
          return item;
        }
      });

      return namaUser;
    }
  },
  methods: {
    // Mendapatkan data Mitra
    getMitra() {
      axios.get("/kemitraan/mitra/list").then(response => {
        this.dataMitra = response.data.data;
      });
    },
    deleteMitra(id_mitra, mitra) {
      swal
        .fire({
          title: "Menghapus Permintaan",
          text: "Apakah anda yakin menghapus " + mitra + " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .delete("/kemitraan/delete/" + id_mitra)
              .then(response => {
                swal.fire(
                  "Menghapus Kemitraan",
                  "Mitra berhasil dihapus",
                  "success"
                );
                UpdateData.$emit("MitraSaya");
                this.$Progress.finish();
              })
              .catch(error => {
                this.$Progress.fail();
                swal.fire("gagal!", "Mitra gagal dihapus", "error");
              });
          }
        });
    }
  },
  created() {
    this.getMitra();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("MitraSaya", () => {
      this.getMitra();
    });
  }
};
</script>