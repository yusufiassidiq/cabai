<template>
  <!-- MS : Ini merupakan komponen bagian pada Kelola mitra-->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <vue-progress-bar></vue-progress-bar>
              <h3 class="card-title">Kelola mitra</h3>
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
                          <i class="fas fa-trash white"></i>
                          Hapus
                        </a>
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
      // pagination
      pagination: [],
      url_getMitra: "/kemitraan/mitra/list"
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
    // Mendapatkan data Mitra
    getMitra() {
      let $this = this;
      axios.get(this.url_getMitra).then(response => {
        this.dataMitra = response.data.data.data;
        $this.makePagination(response.data.data);
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
  mounted() {
    this.getMitra();
    // Custom event on Vue js
    UpdateData.$on("MitraSaya", () => {
      this.getMitra();
    });
  }
};
</script>