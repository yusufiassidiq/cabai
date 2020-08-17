<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6"> 
            <h1 class="m-0 text-dark">Manajemen Lahan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Manajemen Lahan</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <button class="btn btn-primary btn-sm" @click="newModal">Tambah Lahan</button>
                </div>
              </div>
              <div class="card-body">
                <app-datatable
                  :items="items" :fields="fields"
                  :meta="meta" @per_page= "handlePerPage"
                  @pagination="handlePagination" @search="handleSearch"
                  @sort="handleSort" @editLahan="editModal" 
                  @hapusLahan="deleteLahan" @addPengeluaran="pengeluaranModal">
                </app-datatable>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <vue-progress-bar></vue-progress-bar>
    <!-- Modal Manajemen Lahan-->
    <div class="modal fade" id="modalLahan" tabindex="-1" role="dialog" aria-labelledby="modalLahanLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLahanLabel">Tambah lahan baru</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateLahan() : addLahan()">
            <div class="modal-body">
              <div class="form-group col-md">
                <label> Nama lahan</label>
                <input v-model="form.kode_lahan" type="text" name="kode_lahan" class="form-control" placeholder="masukan nama lahan" required :class="{ 'is-invalid': form.errors.has('kode_lahan') }" />
                <has-error :form="form" field="kode_lahan"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Jenis cabai</label>
                <select v-model="form.jenis_cabai" class="form-control" required :class="{ 'is-invalid': form.errors.has('jenis_cabai') }" >
                  <option value disabled selected>Pilih jenis cabai</option>
                  <option value="Cabai rawit">Cabai rawit</option>
                  <option value="Cabai keriting">Cabai keriting</option>
                  <option value="Cabai besar">Cabai besar</option>
                </select>
                <has-error :form="form" field="jenis_cabai"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Luas lahan (hektar)</label>
                <input v-model="form.luas_lahan" type="number" name="luas_lahan" class="form-control" placeholder="Masukan luas lahan" required :class="{ 'is-invalid': form.errors.has('luas_lahan') }" />
                <has-error :form="form" field="luas_lahan"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Tanggal tanam</label>
                <datepicker input-class="form-control" required placeholder="Masukan tanggal tanam" v-model="form.tanggal_tanam" :format="customFormatter" id="tanggal_tanam" :class="{ 'is-invalid': form.errors.has('tanggal_tanam') }"></datepicker>
                <has-error :form="form" field="tanggal_tanam"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button id="btnupdate" v-show="editmode" type="submit" class="btn btn-primary" >Simpan</button>
              <button id="btnadd" v-show="!editmode" type="submit" class="btn btn-primary" >Tambahkan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- </modal> -->

    <!-- Modal Pengeluaran -->
    <div class="modal fade" id="modalPengeluaran" tabindex="-1" role="dialog" aria-labelledby="modalRiwayatLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalPengeluaranLabel">Tambahkan biaya pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="addPengeluaran()">
            <div class="modal-body">
              <div class="row" style="padding-left:10px">
                <div class="col-md-4">
                  <p class="normal text-md-left">Kode Lahan</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_kodelahan}}</p>
                </div>
              </div>
              <div class="row" style="padding-left:10px">
                <div class="col-md-4">
                  <p class="normal text-md-left">Jenis Cabai</p>
                </div>
                <div class="col-md-8"> 
                  <p>:&ensp; {{temp_jeniscabai}}</p>
                </div>
              </div>
              <br>
              <div class="form-group col-md">
                <label >Jenis pengeluaran</label>
                <select v-model="formriwayat.nama_pengeluaran" required class="form-control" :class="{ 'is-invalid': formriwayat.errors.has('nama_pengeluaran') }" >
                  <option value disabled selected>Pilih jenis pengeluaran</option>
                  <option value="Pupuk">Pupuk</option>
                  <option value="Alat Tani">Alat Tani</option>
                  <option value="Pestisida">Pestisida</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                <has-error :form="formriwayat" field="nama_pengeluaran"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Biaya pengeluaran (Rp)</label>
                <input required v-model="formriwayat.jumlah_pengeluaran" type="number" name="jumlah_pengeluaran" class="form-control" placeholder="Masukan biaya Pengeluaran" :class="{ 'is-invalid': formriwayat.errors.has('jumlah_pengeluaran') }" />
                <has-error :form="formriwayat" field="jumlah_pengeluaran"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Rincian pengeluaran (opsional)</label>
                <input v-model="formriwayat.rincian" type="text" name="rincian" class="form-control" placeholder="Masukan rincian pengeluaran" :class="{ 'is-invalid': formriwayat.errors.has('rincian') }" />
                <has-error :form="form" field="rincian"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnaddpengeluaran" type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- </modal> -->
  </div>
  <!-- /.content-wrapper -->
</template>

<script>
// datetimepicker doc : https://github.com/charliekassel/vuejs-datepicker#demo
import datepicker from "vuejs-datepicker";
import LahanDatatable from '../../../components/datatable/LahanDatatable'

export default {
  components: {
    datepicker,
    'app-datatable' : LahanDatatable
  },
  data() {
    return {
      fields:[
        { key: 'kode_lahan', sortable: true, label:"Nama Lahan"},
        { key: 'jenis_cabai', sortable: true, label:"Jenis cabai"},
        { key: 'luas_lahan', sortable: true, label:"Luas lahan"},
        { key: 'tanggal_tanam', sortable: true, label:"Tanggal tanam"},
        { key: 'pengeluaran', sortable: true, label:"Total pengeluaran"},
        { key: 'action', sortable: false, label:"Aksi"},
        { key: 'Addpengeluaran', sortable: false, label:"Pengeluaran"}
      ],
      items: [],
      meta: [],
      current_page: 1,
      per_page: 10,
      search: '',
      sortBy: 'updated_at',
      sortByDesc: false,

      datalahan: {},
      editmode: false,
      form: new Form({
        id: "",
        kode_lahan: "",
        jenis_cabai: "",
        luas_lahan: "",
        tanggal_tanam: ""
      }),
      formriwayat: new Form({
        pra_produksi_id: "",
        nama_pengeluaran: "",
        jumlah_pengeluaran: "",
        rincian: ""
      }),
      url_getLahan: "/praProduksi/list",
      // untuk modal pengeluaran
      temp_kodelahan:"",
      temp_jeniscabai:"",
    };
  },
  created(){
    this.getLahan()
  },
  methods: {
    getLahan(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/praProduksi/list", {
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
        this.getLahan() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getLahan()
    },
    handleSearch(val) {
        this.search = val 
        this.getLahan()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getLahan()
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    // Menambahkan data lahan Produsen
    addLahan() {
      document.getElementById("btnadd").disabled = true;
      this.$Progress.start();
      this.form
        .post("/praProduksi/tambah")
        .then(() => {
          this.getLahan()
          $("#modalLahan").trigger("click")
          toast.fire({ icon: "success", title: "Lahan berhasil ditambahkan" });
          this.$Progress.finish();
          document.getElementById("btnadd").disabled = false;
        })
        .catch(error => {
          this.$Progress.fail();
          document.getElementById("btnadd").disabled = false;
        });
    },
    // Memperbarui data lahan produsen
    updateLahan() {
      document.getElementById("btnupdate").disabled = true;
      this.$Progress.start();
      this.form
        .put("/praProduksi/update/" + this.form.id)
        .then(() => {
          this.getLahan()
          $("#modalLahan").trigger("click");
          toast.fire({ icon: "success", title: "Lahan berhasil diperbarui"});
          this.$Progress.finish();
          document.getElementById("btnupdate").disabled = false;
        })
        .catch(() => {
          this.$Progress.fail();
          document.getElementById("btnupdate").disabled = false;
        });
    },
    // menghapus data lahan produsen
    deleteLahan(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "Menghapus lahan dapat menghapus seluruh riwayat pengeluaran lahan ini",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .delete("/praProduksi/delete/" + id)
              .then(() => {
                this.getLahan()
                swal.fire("Tehapus!", "Lahan berhasil dihapus", "success");
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
                swal.fire( "Gagal!", "Terdapat masalah ketika menghapus", "warning");
              });
          }
        });
    },
    addPengeluaran() {
      document.getElementById("btnaddpengeluaran").disabled = true;
      this.$Progress.start();
      this.formriwayat
        .post("/pengeluaran/tambah")
        .then(() => {
          this.getLahan()
          $("#modalPengeluaran").trigger("click");
          toast.fire({ icon: "success", title: "Pengeluaran berhasil ditambahkan"});
          this.$Progress.finish();
          document.getElementById("btnaddpengeluaran").disabled = false;
        })
        .catch(error => {
          this.$Progress.fail();
          document.getElementById("btnaddpengeluaran").disabled = false;
        });
    },
    // MODAL
    // Menampilkan Modal utk menambahkan lahan baru
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalLahan").modal("show");
    },
    // Menampilkan Modal utk Mengedit lahan baru
    editModal(data) {
      this.editmode = true;
      this.form.reset();
      $("#modalLahan").modal("show");
      this.form.fill(data);
    },
    pengeluaranModal(data) {
      this.temp_kodelahan = data.kode_lahan
      this.temp_jeniscabai = data.jenis_cabai
      this.formriwayat.reset();
      $("#modalPengeluaran").modal("show");
      this.formriwayat.pra_produksi_id = data.id;
    }
  }
};
</script>