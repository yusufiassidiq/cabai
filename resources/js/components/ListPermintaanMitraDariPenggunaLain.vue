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
        <div class="row">
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
        <div class="row">
                <div class="col-md-6 d-flex justify-content-start align-self-center">
                  <div
                    style="padding-left: 20px"
                  >Menampilkan {{ pagination.current_page }} dari {{ pagination.last_page }} halaman</div>
                </div>

                <div
                  class="col-md-6 d-flex justify-content-end align-self-end"
                  style="padding-right: 30px"
                >
                  <div class="dataTables_paginate paging_simple_numbers">
                    <ul class="pagination">
                      <li>
                        <button
                          href="#"
                          class="btn btn-default"
                          v-on:click="fetchPaginate(pagination.prev_page_url)"
                          :disabled="!pagination.prev_page_url"
                        >Sebelumnya</button>
                      </li>

                      <li>
                        <button
                          class="btn btn-default"
                          v-on:click="fetchPaginate(pagination.next_page_url)"
                          :disabled="!pagination.next_page_url"
                        >Selanjutnya</button>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
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
      // pagination
      pagination: [],
      url_getMitra: "/kemitraan/permintaan/list"
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
    // prev & next paggination
    fetchPaginate(url) {
      this.url_getMitra = url;
      this.getMitra();
    },
    // set up pagination
    makePagination(data) {
      let pagination = {
        current_page: data.current_page,
        last_page: data.last_page,
        next_page_url: data.next_page_url,
        prev_page_url: data.prev_page_url
      };
      this.pagination = pagination;
    },
    getPermintaanMitra() {
      let $this = this
      axios.get(this.url_getMitra).then(response => {
        this.dataListPermintaanMitra = response.data.data.data
        $this.makePagination(response.data.data)
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