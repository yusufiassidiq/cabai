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
          <button class="btn btn-success btn-sm" @click="newModal">Tambah Permintaan pasokan</button>
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
                <th>Pemasok</th>
                <th>Role</th>
                <th>Alamat</th>
                <th>Jenis Cabai</th>
                <th>Jumlah Cabai(Kg)</th>
                <th>Harga Cabai</th>
                <th>Tanggal Diterima</th>
                <th>Tanggal Pengiriman</th>
                <th>Status</th>
                <th>Keterangan</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <tr v-if="!listPermintaanSaya.length">
                <td colspan="11" align="center">Tidak ada permintaan anda</td>
              </tr>
              <tr v-for="data in listPermintaanSaya" :key="data.id">
                <td>{{ data.nama }}</td>
                <td>{{ data.role | filterRoleUser }}</td>
                <td>{{ data.lokasi.kabupaten | filterAlamat }}</td>
                <td>{{ data.jenis_cabai }}</td>
                <td>{{ data.jumlah_cabai | filterAngkaRibuan }}</td>
                <td>
                  <div v-if="data.harga!==null">{{data.harga | convertToRupiah }}</div>
                  <div v-else>Belum ditetapkan</div>
                </td>
                <td>{{ data.tanggal_diterima | dateFilter }}</td>
                <td>
                  <div
                    v-if="data.tanggal_pengiriman!==null"
                  >{{ data.tanggal_pengiriman | dateFilter }}</div>
                  <div v-else>Belum ditetapkan</div>
                </td>
                <td>
                  <div v-if="data.status_permintaan === 0">Menunggu penawaran pemasok</div>
                  <div class="red" v-else-if="data.status_permintaan === 2">Permintaan Anda ditolak</div>
                  <div v-else-if="data.status_permintaan === 4">Anda menolak penawaran</div>
                  <div v-else-if="data.status_permintaan === 3">Menunggu Pengiriman</div>
                  <div v-else-if="data.status_permintaan === 1">Menunggu persetujuan Anda</div>
                </td>
                <td>
                  <div v-if="data.status_permintaan === 2">{{ data.keterangan }}</div>
                  <div v-else>-</div>
                </td>
                <td>
                  <div v-if="data.status_permintaan === 2">
                    <button
                      type="button"
                      class="btn btn-success btn-xs"
                      @click="modalRequestUlang(data)"
                    >Permintaan ulang</button>
                    <button
                      type="button"
                      class="btn btn-danger btn-xs"
                      @click="deletePermintaanCabai(data.id)"
                    >Hapus</button>
                  </div>
                  <div v-else-if="data.status_permintaan === 1">
                    <button
                      type="button"
                      class="btn btn-success btn-xs"
                      @click="modalTerimaPenawaran(data)"
                    >Terima</button>
                    <button
                      type="button"
                      class="btn btn-danger btn-xs"
                      @click="modalTolakPenawaran(data)"
                    >Tolak</button>
                  </div>
                  <div v-else-if="data.status_permintaan === 3 && data.status_pengiriman === 1">
                    <button
                      type="button"
                      class="btn btn-success btn-xs"
                      @click="sudahDiterima(data)"
                    >Sudah diterima?</button>
                  </div>
                  <div v-else>-</div>
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
    <!-- Modal Permintaan Cabai -->
    <div
      class="modal fade"
      id="modalPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              v-show="!requestUlang"
              id="modalPermintaanLabel"
            >Permintaan Pasokan Cabai</h5>
            <h5
              class="modal-title"
              v-show="requestUlang"
              id="modalPermintaanLabel"
            >Permintaan Ulang Pasokan Cabai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <vue-progress-bar></vue-progress-bar>
          <form @submit.prevent="requestUlang? requestUlangPermintaan() : addPermintaan()">
            <div class="modal-body">
              <div class="form-group col-md">
                <select
                  id="pemasok__id"
                  v-model="form.pemasok_id"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('pemasok_id') }"
                >
                  <option value disabled selected>Pilih pemasok</option>
                  <option
                    v-for="data in dataMitra"
                    :key="data.id"
                    v-bind:value="data.id"
                  >{{ data.name }} - {{ data.role | filterRoleUser }}</option>
                </select>
                <has-error :form="form" field="pemasok_id"></has-error>
              </div>
              <div class="form-group col-md">
                <select
                  id="jenis__cabai"
                  v-model="form.jenis_cabai"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('jenis_cabai') }"
                >
                  <option value disabled selected>Jenis cabai</option>
                  <option value="Cabai rawit">Cabai rawit</option>
                  <option value="Cabai keriting">Cabai keriting</option>
                  <option value="Cabai besar">Cabai besar</option>
                </select>
                <has-error :form="form" field="jenis_cabai"></has-error>
              </div>
              <div class="form-group col-md">
                <input
                  v-model="form.jumlah_cabai"
                  type="number"
                  name="jumlah_cabai"
                  class="form-control"
                  placeholder="Jumlah Cabai /kg"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>
              <div class="form-group col-md">
                <datepicker
                  input-class="form-control"
                  placeholder="Tanggal cabai diterima"
                  v-model="form.tanggal_diterima"
                  :format="customFormatter"
                  id="tanggal_diterima"
                  :class="{ 'is-invalid': form.errors.has('tanggal_diterima') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_diterima"></has-error>
              </div>
              <div class="form-group col-md" v-if="requestUlang">
                <textarea
                  class="form-control"
                  v-model="form.keterangan"
                  :class="{ 'is-invalid': form.errors.has('keterangan') }"
                />
                <has-error :form="form" field="keterangan"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button
                id="btnReqUlang"
                v-show="requestUlang"
                type="submit"
                class="btn btn-success"
              >Simpan</button>
              <button
                id="btnaddpermintaan"
                v-show="!requestUlang"
                type="submit"
                class="btn btn-primary"
              >Tambahkan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- Modal Terima Penawaran -->
    <div
      class="modal fade"
      id="modalTerimaPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalTerimaPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              v-show="modalTerima"
              class="modal-title"
              id="modalTerimaPermintaanLabel"
            >Terima Penawaran Pemasok</h5>
            <h5
              v-show="!modalTerima"
              class="modal-title"
              id="modalTerimaPermintaanLabel"
            >Tolak Penawaran Pemasok</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="modalTerima? terimaPenawaran() : tolakPenawaran()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Pemasok</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_nama}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Jenis Cabai</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_jeniscabai}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Jumlah cabai</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_jumlahcabai | filterAngkaRibuan }} Kg</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Tanggal diterima</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_tanggalditerima | dateFilter }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Tanggal Pengiriman</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_tanggalpengiriman | dateFilter }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Harga</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{ temp_harga | convertToRupiah }} /Kg</p>
                </div>
              </div>
              <div class v-show="!modalTerima">
                <textarea
                  class="form-control"
                  v-model="form.keterangan"
                  placeholder="Alasan menolak"
                  :class="{ 'is-invalid': form.errors.has('keterangan') }"
                />
                <has-error :form="form" field="keterangan"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button
                v-show="modalTerima"
                id="btnAcceptPenawaran"
                type="submit"
                class="btn btn-primary"
              >Terima</button>
              <button
                v-show="!modalTerima"
                id="btnRejectPenawaran"
                type="submit"
                class="btn btn-danger"
              >Tolak</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <vue-progress-bar></vue-progress-bar>
  </div>
</template>
<script>
import datepicker from "vuejs-datepicker";
export default {
  components: {
    datepicker
  },
  data() {
    return {
      form: new Form({
        id: "",
        jenis_cabai: "",
        jumlah_cabai: "",
        pemasok_id: "",
        tanggal_diterima: "",
        keterangan: ""
      }),
      
      temp_nama: "",
      temp_jeniscabai: "",
      temp_jumlahcabai: "",
      temp_tanggalditerima: "",
      temp_tanggalpengiriman: "",
      temp_harga: "",
      
      formReceived: new Form({
        id: "",
        jenis_cabai: "",
        jumlah_cabai: ""
      }),
      requestUlang: false,
      modalTerima: true,
      listPermintaanSaya: {},
      dataMitra: {},
      // pagination
      pagination: [],
      url_permintaanSaya: "/transaksi/permintaanSaya/list"
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
    addPermintaan() {
      document.getElementById("btnaddpermintaan").disabled = true;
      this.$Progress.start();
      this.form
        .post("/transaksi/permintaanSaya/tambah")
        .then(response => {
          UpdateData.$emit("TransaksiDenganPemasok");
          // hide modal
          $("#modalPermintaan").trigger("click");
          // show Toast if success
          toast.fire({
            icon: "success",
            title: "Permintaan berhasil ditambahkan"
          });
          document.getElementById("btnaddpermintaan").disabled = false;
          this.form.reset();
          this.$Progress.finish();
        })
        .catch(error => {
          console.error(error);
          this.$Progress.fail();
          document.getElementById("btnaddpermintaan").disabled = false;
        });
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    getMitra() {
      axios.get("/kemitraan/mitraPemasok/list").then(response => {
        this.dataMitra = response.data.data;
      });
    },
    getPermintaanSaya() {
      let $this = this
      axios.get(this.url_permintaanSaya).then(response => {
        this.listPermintaanSaya = response.data.data.data
        $this.makePagination(response.data.data)
      });
    },
    requestUlangPermintaan() {
      document.getElementById("btnReqUlang").disabled = true;
      this.$Progress.start();
      this.form
        .put("/transaksi/permintaanSaya/update/" + this.form.id)
        .then(() => {
          UpdateData.$emit("TransaksiDenganPemasok");
          // hide modal
          $("#modalPermintaan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Permintaan ulang berhasil"
          });
          this.$Progress.finish();
          document.getElementById("btnReqUlang").disabled = false;
        })
        .catch(() => {
          this.$Progress.fail();
          document.getElementById("btnReqUlang").disabled = false;
          $("#modalPermintaan").trigger("click");
        });
    },
    deletePermintaanCabai(id_permintaanSaya) {
      swal
        .fire({
          title: "Menghapus Permintaan Pasokan",
          text: "Apakah anda yakin menghapus pemintaan pasokan?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .delete(
                "/transaksi/permintaanPesanan/delete/" + id_permintaanSaya
              )
              .then(response => {
                swal.fire(
                  "Menghapus Permintaan Pasokan",
                  "Pemintaan pasokan berhasil dihapus",
                  "success"
                );
                UpdateData.$emit("TransaksiDenganPemasok");
                this.$Progress.finish();
              })
              .catch(error => {
                this.$Progress.fail();
                swal.fire("gagal!", "Mitra gagal dihapus", "error");
              });
          }
        });
    },
    newModal() {
      this.requestUlang = false;
      document.getElementById("pemasok__id").disabled = false;
      document.getElementById("jenis__cabai").disabled = false;
      this.form.reset();
      $("#modalPermintaan").modal("show");
      // this.form.pemasok_id = id;
    },
    modalRequestUlang(data) {
      this.requestUlang = true;
      document.getElementById("pemasok__id").disabled = true;
      document.getElementById("jenis__cabai").disabled = true;
      $("#modalPermintaan").modal("show");
      this.form.fill(data);
      this.form.keterangan = "";
    },
    modalTerimaPenawaran(data) {
      this.modalTerima = true;
      $("#modalTerimaPermintaan").modal("show");
      this.form.id = data.id;
      this.temp_nama = data.nama;
      this.temp_jeniscabai = data.jenis_cabai;
      this.temp_jumlahcabai = data.jumlah_cabai;
      this.temp_tanggalditerima = data.tanggal_diterima;
      this.temp_tanggalpengiriman = data.tanggal_pengiriman;
      this.temp_harga = data.harga;
    },
    modalTolakPenawaran(data) {
      this.modalTerima = false;
      $("#modalTerimaPermintaan").modal("show");
      this.form.id = data.id;
      this.temp_nama = data.nama;
      this.temp_jeniscabai = data.jenis_cabai;
      this.temp_jumlahcabai = data.jumlah_cabai;
      this.temp_tanggalditerima = data.tanggal_diterima;
      this.temp_tanggalpengiriman = data.tanggal_pengiriman;
      this.temp_harga = data.harga;
    },
    terimaPenawaran() {
      document.getElementById("btnAcceptPenawaran").disabled = true;
      this.$Progress.start();
      this.form
        .put("/transaksi/penawaranPemasok/terima/" + this.form.id)
        .then(() => {
          UpdateData.$emit("TransaksiDenganPemasok");
          $("#modalTerimaPermintaan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Penawaran berhasil diterima"
          });
          this.$Progress.finish();
          document.getElementById("btnAcceptPenawaran").disabled = false;
        })
        .catch(() => {
          document.getElementById("btnAcceptPenawaran").disabled = false;
          this.$Progress.finish();
        });
    },
    tolakPenawaran() {
      document.getElementById("btnRejectPenawaran").disabled = true;
      this.$Progress.start();
      this.form
        .put("/transaksi/penawaranPemasok/tolak/" + this.form.id)
        .then(() => {
          UpdateData.$emit("TransaksiDenganPemasok");
          $("#modalTerimaPermintaan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Penawaran berhasil diterima"
          });
          this.$Progress.finish();
          document.getElementById("btnRejectPenawaran").disabled = false;
        })
        .catch(() => {
          document.getElementById("btnRejectPenawaran").disabled = false;
          this.$Progress.finish();
        });
    },
    sudahDiterima(data) {
      this.formReceived.jumlah_cabai = data.jumlah_cabai;
      this.formReceived.jenis_cabai = data.jenis_cabai;
      this.formReceived.id = data.id;
      // console.log(this.formReceived.jumlah_cabai)
      swal
        .fire({
          title: "Konfirmasi Pesanan",
          text: "Apakah cabai telah Anda terima sesuai pesanan?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            this.formReceived
              .put("/inventaris/stokMasuk/" + data.id)
              .then(response => {
                swal.fire(
                  "Konfirmasi Pesanan",
                  data.jumlah_cabai +
                    " Kg " +
                    data.jenis_cabai +
                    " telah diterima",
                  "success"
                );
                UpdateData.$emit("TransaksiDenganPemasok");
                this.$Progress.finish();
              })
              .catch(error => {
                this.$Progress.fail();
                swal.fire("gagal!", "Terjadi kesalahan", "error");
              });
          }
        });
    }
  },
  created() {
    this.getPermintaanSaya();
    this.getMitra();
  },
  mounted() {
    UpdateData.$on("TransaksiDenganPemasok", () => {
      this.getPermintaanSaya();
    });
  }
};
</script>