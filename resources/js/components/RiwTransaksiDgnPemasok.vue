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
          <!-- <div class="input-group input-group-sm" style="width: 150px;">
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
          </div>-->
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <div class="row">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>Tanggal Terima</th>
                <th>Tanggal Dikirim Pemasok</th>
                <th>Pemasok</th>
                <th>Role</th>
                <th>Jenis Cabai</th>
                <th>Jumlah Cabai(Kg)</th>
                <th>Harga Cabai</th>
              </tr>
            </thead>

            <tbody>
              <tr v-if="!listPermintaanSaya.length">
                <td colspan="11" align="center">Tidak ada permintaan anda</td>
              </tr>
              <tr v-for="data in listPermintaanSaya" :key="data.id">
                <td>{{ data.tanggal_diterima | dateFilter }}</td>
                <td>{{ data.tanggal_pengiriman | dateFilter }}</td>
                <td>{{ data.nama }}</td>
                <td>{{ data.role | filterRoleUser }}</td>
                <td>{{ data.jenis_cabai }}</td>
                <td>{{ data.jumlah_cabai | filterAngkaRibuan }}</td>
                <td>{{data.harga | convertToRupiah }}</td>
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
    <vue-progress-bar></vue-progress-bar>
  </div>
</template>
<script>
export default {
  data() {
    return {
      listPermintaanSaya: {},
      // pagination
      pagination: [],
      url_permintaanSaya: "/transaksi/riwPermintaanSaya/list"
    };
  },
  methods: {
    // prev & next paggination
    fetchPaginate(url) {
      this.url_permintaanSaya = url;
      this.getPermintaanMasuk();
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
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    getPermintaanSaya() {
      let $this = this;
      axios.get(this.url_permintaanSaya).then(response => {
        this.listPermintaanSaya = response.data.data.data;
        $this.makePagination(response.data.data);
      });
    }
  },
  mounted() {
    this.getPermintaanSaya();
    UpdateData.$on("TransaksiDenganPemasok", () => {
      this.getPermintaanSaya();
    });
  }
};
</script>