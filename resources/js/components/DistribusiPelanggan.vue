<template>
  <div class="tab-pane fade" id="custom-tabs-three-pengajuan" role="tabpanel" aria-labelledby="custom-tabs-three-pengajuan-tab">
    <div class="card">
      <div class="card-header">
        <div class="card-tools">
          <button class="btn btn-primary btn-sm" @click="newModal">Tambah distribusi</button>
        </div>
      </div>
      <div class="card-body">
        <app-datatable
          :items="items" :fields="fields"
          :meta="meta" @per_page= "handlePerPage"
          @pagination="handlePagination" @search="handleSearch"
          @sort="handleSort" @terimaPenawaranPemasok="modalTerimaPenawaran"
          @tolakPenawaranPemasok="modalTolakPenawaran"
          @cabaidiTerima="sudahDiterima"
          @deleteDistribusi="deletePermintaanCabai"
          @requestUlang="modalRequestUlang">
        </app-datatable>
      </div>
    </div>
    <!-- Modal Permintaan Cabai -->
    <div class="modal fade" id="modalPermintaan" tabindex="-1" role="dialog" aria-labelledby="modalPermintaanLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!requestUlang" id="modalPermintaanLabel" >Permintaan Pasokan Cabai</h5>
            <h5 class="modal-title" v-show="requestUlang" id="modalPermintaanLabel" >Permintaan Ulang Pasokan Cabai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <vue-progress-bar></vue-progress-bar>
          <form @submit.prevent="requestUlang? requestUlangPermintaan() : addPermintaan()">
            <div class="modal-body">
              <div class="form-group col-md">
                <label >Pemasok</label>
                <select id="pemasok__id" v-model="form.pemasok_id" class="form-control" :class="{ 'is-invalid': form.errors.has('pemasok_id') }">
                  <option value disabled selected>Pilih pemasok</option>
                  <option v-for="data in dataMitra" :key="data.id" v-bind:value="data.id">
                    {{ data.name }} - {{ data.role | filterRoleUser }}
                  </option>
                </select>
                <has-error :form="form" field="pemasok_id"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Jenis cabai</label>
                <select id="jenis__cabai" v-model="form.jenis_cabai" class="form-control" :class="{ 'is-invalid': form.errors.has('jenis_cabai') }">
                  <option value disabled selected>Pilih jenis cabai</option>
                  <option value="Cabai rawit">Cabai rawit</option>
                  <option value="Cabai keriting">Cabai keriting</option>
                  <option value="Cabai besar">Cabai besar</option>
                </select>
                <has-error :form="form" field="jenis_cabai"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Jumlah cabai (kg)</label>
                <input v-model="form.jumlah_cabai" type="number" name="jumlah_cabai" class="form-control" placeholder="Jumlah Cabai /kg" :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"/>
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Tanggal terima</label>
                <datepicker input-class="form-control" placeholder="Tanggal cabai diterima" v-model="form.tanggal_diterima" :format="customFormatter" id="tanggal_diterima" :class="{ 'is-invalid': form.errors.has('tanggal_diterima') }"></datepicker>
                <has-error :form="form" field="tanggal_diterima"></has-error>
              </div>
              <div class="form-group col-md" v-if="requestUlang">
                <label>Keterangan</label>
                <textarea class="form-control" v-model="form.keterangan" :class="{ 'is-invalid': form.errors.has('keterangan') }"/>
                <has-error :form="form" field="keterangan"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"> Tutup</button>
              <button id="btnReqUlang" v-show="requestUlang" type="submit" class="btn btn-success"> Simpan</button>
              <button id="btnaddpermintaan" v-show="!requestUlang" type="submit" class="btn btn-primary"> Tambahkan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- Modal Terima Penawaran -->
    <div class="modal fade" id="modalTerimaPermintaan" tabindex="-1" role="dialog" aria-labelledby="modalTerimaPermintaanLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 v-show="modalTerima" class="modal-title" id="modalTerimaPermintaanLabel">Terima Penawaran Pemasok</h5>
            <h5 v-show="!modalTerima" class="modal-title" id="modalTerimaPermintaanLabel">Tolak Penawaran Pemasok</h5>
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
                  <p class="normal text-md-left">Tanggal terima</p>
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
                <textarea class="form-control" v-model="form.keterangan" placeholder="Alasan menolak" :class="{ 'is-invalid': form.errors.has('keterangan') }"/>
                <has-error :form="form" field="keterangan"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button> -->
              <button v-show="modalTerima" id="btnAcceptPenawaran" type="submit" class="btn btn-primary">Terima</button>
              <button v-show="!modalTerima" id="btnRejectPenawaran" type="submit" class="btn btn-danger">Tolak</button>
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
import KemitraanDatatable from '../components/datatable/DistribusiDatatable'
export default {
  components: {
    datepicker,
    'app-datatable': KemitraanDatatable
  },
  data() {
    return {
      fields:[
        { key: 'nama', sortable: true, label:"Pemasok"},
        { key: 'role', sortable: true, label:"Role"},
        { key: 'lokasi.kabupaten', sortable: true, label:"Role"},
        { key: 'jenis_cabai', sortable: true, label:"Jenis"},
        { key: 'jumlah_cabai', sortable: true, label:"Jumlah"},
        { key: 'harga', sortable: true, label:"Harga"},
        { key: 'tanggal_diterima', sortable: true, label:"Tgl terima"},
        { key: 'tanggal_pengiriman', sortable: true, label:"Tgl kirim"},
        { key: 'status', sortable: true, label:"Status"},
        { key: 'keterangan', sortable: true, label:"Keterangan"},
        { key: 'AksiPelanggan', sortable: true, label:"Aksi"},
      ],
      items: [],
      meta: [],
      current_page: 1,
      per_page: 10,
      search: '',
      sortBy: 'updated_at',
      sortByDesc: false,

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
  created(){
    this.getDistribusi()
    this.getMitra()
  },
  methods: {
    getDistribusi(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/transaksi/permintaanSaya/list", {
        params: {
          page: current_page,
          per_page: this.per_page,
          q: this.search,
          sortby: this.sortBy,
          sortbydesc: this.sortByDesc ? 'DESC' : 'ASC'
        }
      })
      .then((response) => {
        let getData = response.data.data
        this.items = getData.data,
        this.meta = {
          total: getData.total,
          current_page: getData.current_page,
          per_page: getData.per_page,
          from: getData.from,
          to: getData.to
        }
      })
    },
    handlePerPage(val) {
        this.per_page = val 
        this.getDistribusi() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getDistribusi()
    },
    handleSearch(val) {
        this.search = val 
        this.getDistribusi()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getDistribusi()
    },
    addPermintaan() {
      document.getElementById("btnaddpermintaan").disabled = true;
      this.$Progress.start();
      this.form
        .post("/transaksi/permintaanSaya/tambah")
        .then(response => {
          this.getDistribusi()
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
    requestUlangPermintaan() {
      document.getElementById("btnReqUlang").disabled = true;
      this.$Progress.start();
      this.form
        .put("/transaksi/permintaanSaya/update/" + this.form.id)
        .then(() => {
          this.getDistribusi()
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
                this.getDistribusi()
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
      console.log(data)
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
          this.getDistribusi()
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
          this.getDistribusi()
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
                this.getDistribusi()
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
};
</script>