<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Riwayat Pengeluaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Riwayat Pengeluaran</li>
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
              <div class="card-body">
                <app-datatable
                  :items="items" :fields="fields"
                  :meta="meta" @per_page= "handlePerPage"
                  @pagination="handlePagination" @search="handleSearch"
                  @sort="handleSort" @editPengeluaran="editModal" 
                  @hapusPengeluaran="deletePengeluaran">
                </app-datatable>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="modalPengeluaran" tabindex="-1" role="dialog" aria-labelledby="modalRiwayatLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="editmode" id="modalPengeluaranLabel">Perbarui Pengeluaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updatePengeluaran() : addPengeluaran()">
            <div class="modal-body">
              <div class="form-group col-md">
                <label>Nama lahan</label>
                <input disabled v-model="form.kodeLahan" type="text" name="kodeLahan" class="form-control" :class="{ 'is-invalid': form.errors.has('kodeLahan') }" />
                <has-error :form="form" field="kodeLahan"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Jenis pengeluaran</label>
                <select v-model="form.nama_pengeluaran" class="form-control" required :class="{ 'is-invalid': form.errors.has('nama_pengeluaran') }" >
                  <option :value="form.nama_pengeluaran" disabled hidden selected
                  >{{form.nama_pengeluaran}}</option>
                  <option value="Pupuk">Pupuk</option>
                  <option value="Alat Tani">Alat Tani</option>
                  <option value="Pestisida">Pestisida</option>
                  <option value="Lainnya">Lainnya</option>
                </select>
                <has-error :form="form" field="nama_pengeluaran"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Biaya pengeluaran (Rp)</label>
                <input v-model="form.jumlah_pengeluaran" type="number" name="jumlah_pengeluaran" class="form-control" required placeholder="Jumlah Pengeluaran (dalam rupiah)" :class="{ 'is-invalid': form.errors.has('jumlah_pengeluaran') }"/>
                <has-error :form="form" field="jumlah_pengeluaran"></has-error>
              </div>

              <div class="form-group col-md">
                <label>Rincian pengeluaran (opsional)</label>
                <input v-model="form.rincian" type="text" name="rincian" class="form-control" placeholder :class="{ 'is-invalid': form.errors.has('rincian') }" />
                <has-error :form="form" field="rincian"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button v-show="editmode" type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import PengeluaranDatatable from '../../../components/datatable/RiwayatPengeluaranDatatable'
export default {
  components: {
    'app-datatable' : PengeluaranDatatable
  },
  data() {
    return {
      fields:[
        { key: 'created_at', sortable: true, label:"Tanggal"},
        { key: 'kodeLahan', sortable: true, label:"Nama Lahan"},
        { key: 'nama_pengeluaran', sortable: true, label:"Jenis pengeluaran"},
        { key: 'jumlah_pengeluaran', sortable: true, label:"Jumlah pengeluaran"},
        { key: 'rincian', sortable: true, label:"Rincian"},
        { key: 'action', sortable: false, label:"Aksi"},
      ],
      items: [],
      meta: [],
      current_page: 1,
      per_page: 10,
      search: '',
      sortBy: 'updated_at',
      sortByDesc: false,

      editmode: false,
      form: new Form({
        id: "",
        kodeLahan: "",
        jumlah_pengeluaran: "",
        nama_pengeluaran: "",
        tanggal_pengeluaran: new Date(),
        rincian: ""
      }),
    };
  },
  created(){
    this.getRiwayatPengeluaran()
  },
  methods: {
    getRiwayatPengeluaran(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/pengeluaran/list", {
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
        this.getRiwayatPengeluaran() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getRiwayatPengeluaran()
    },
    handleSearch(val) {
        this.search = val 
        this.getRiwayatPengeluaran()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getRiwayatPengeluaran()
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },

    // Memperbarui Riwayat Pengeluaran
    updatePengeluaran() {
      this.$Progress.start();
      this.form.put("/pengeluaran/update/" + this.form.id)
        .then(() => {
          this.getRiwayatPengeluaran()
          $("#modalPengeluaran").trigger("click");
          toast.fire({icon: "success", title: "Pengeluaran berhasil diperbarui"});
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deletePengeluaran(id) {
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "Riwayat pengeluaran yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios.delete("/pengeluaran/delete/" + id)
              .then(() => {
                this.getRiwayatPengeluaran()
                swal.fire( "Tehapus!", "Pengeluaran berhasil dihapus", "success");
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
                swal.fire( "Gagal!", "Terdapat masalah ketika menghapus", "waning");
              });
          }
        });
    },
    // Modal
    // Menampilkan modal utk menambahkan pengeluaran baru
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#modalPengeluaran").modal("show");
    },
    // Menampilkan modal utk mengedit pengeluaran
    editModal(data) {
      this.editmode = true;
      this.form.reset();
      $("#modalPengeluaran").modal("show");
      this.form.fill(data);
    }
  },
};
</script>