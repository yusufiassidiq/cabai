<template>
  <!-- PM : Permintaanmitra-->
  <div
    class="tab-pane fade active show"
    id="custom-tabs-three-permintaan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-permintaan-tab"
  >
    <div class="card">
      <div class="card-header">
        <vue-progress-bar></vue-progress-bar>
        <h3 class="card-title">Daftar Permintaan</h3>

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
              <!-- <th>Id</th> -->
              <th>Nama</th>
              <th>Role</th>
              <th>Lokasi</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!filteredNama.length">
              <td colspan="4" align="center">Tidak ada yang mengajukan kemitraan</td>
            </tr>
            <tr v-for="data in filteredNama" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>{{ data.role | filterRoleUser }}</td>
              <td>{{ data.lokasi.kelurahan | filterAlamat }} , {{ data.lokasi.kecamatan | filterAlamat }} , {{ data.lokasi.kabupaten | filterAlamat }}</td>
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
      dataListPermintaanMitra: {},
      // variabel untuk search
      stringNama: "",
    };
  },
  computed: {
    filteredNama: function() {
      var namaUser = this.dataListPermintaanMitra;
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
    getPermintaanMitra() {
      axios.get("/kemitraan/permintaan/list").then(response => {
        this.dataListPermintaanMitra = response.data.data;
      });
    },
    acceptMitra(id_mitra, mitra_yg_mengajukan) {
      swal
        .fire({
          title: "Menerima Permintaan",
          text:
            "Apakah anda yakin menerima " +
            mitra_yg_mengajukan +
            " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, terima"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .put("/kemitraan/terima/" + id_mitra)
              .then(function(response) {
                swal.fire(
                  "Mengajukan Permintaan",
                  "Berhasil mengajukan kemitraan",
                  "success"
                );
                UpdateData.$emit("ListPermintaan");
              })
              .catch(function(error) {
                swal.fire(
                  "gagal!",
                  "Pengguna ini telah mendaftarkan anda sebagai mitra",
                  "error"
                );
              });
          }
        });
    },
    rejectMitra(id_mitra, mitra_yg_mengajukan) {
      swal
        .fire({
          title: "Menolak Permintaan",
          text:
            "Apakah anda yakin menolak " +
            mitra_yg_mengajukan +
            " sebagai mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .put("/kemitraan/tolak/" + id_mitra)
              .then(function(response) {
                swal.fire(
                  "Menolak Permintaan",
                  "Berhasil menolak kemitraan",
                  "success"
                );
                UpdateData.$emit("ListPermintaan");
              })
              .catch(function(error) {
                swal.fire("gagal!", "Gagal menolak mitra", "error");
              });
          }
        });
    }
  },
  created() {
    this.getPermintaanMitra();
  },
  mounted() {
    UpdateData.$on("ListPermintaan", () => {
      this.getPermintaanMitra();
    });
  }
};
</script>