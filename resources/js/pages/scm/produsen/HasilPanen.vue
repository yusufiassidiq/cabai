<template>
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hasil Panen</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Hasil Panen</li>
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
                      <button class="btn btn-primary btn-sm" @click="newModal">Tambah Panen</button>
                    </div>
                </div>
              <div class="card-body">
                <app-datatable
                  :items="items" :fields="fields"
                  :meta="meta" @per_page= "handlePerPage"
                  @pagination="handlePagination" @search="handleSearch"
                  @sort="handleSort" @editPanen="editModal" @hapusPanen="deletePanen">
                </app-datatable>
              </div>
            </div>
            <vue-progress-bar></vue-progress-bar>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Modal -->
    <div class="modal fade" id="modalHasilPanen" tabindex="-1" role="dialog" aria-labelledby="modalHasilPanenLabel" aria-hidden="true" >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalHasilPanenLabel">Tambahkan Hasil Panen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updatePanen() : addPanen()">
            <div class="modal-body">
              <div class="form-group col-md">
                <label>Nama lahan</label>
                <select id="lahan__id" v-model="form.pra_produksi_id" class="form-control" :class="{ 'is-invalid': form.errors.has('pra_produksi_id') }">
                  <option value disabled selected>Pilih Lahan</option>
                  <option v-for="data in datalahan" :key="data.id"
                    v-bind:value="data.id"
                  >{{ data.kode_lahan }} - {{ data.jenis_cabai }}
                  </option>
                </select>
                <has-error :form="form" field="pra_produksi_id"></has-error>
              </div>
              <div class="form-group col-md">
                <label>Jumlah panen (Kg)</label>
                <input v-model="form.jumlah_cabai" type="number"
                  class="form-control" placeholder="Masukan jumlah panen"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>

              <div class="form-group col-md">
                <label >Tanggal panen</label>
                <datepicker input-class="form-control" required
                  placeholder="Masukan tanggal panen" v-model="form.tanggal_panen"
                  :format="customFormatter" id="tanggal_panen"
                  :class="{ 'is-invalid': form.errors.has('tanggal_panen') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_panen"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button v-show="editmode" type="submit" class="btn btn-primary">Simpan</button>
              <button id="btnaddpanen" v-show="!editmode" type="submit" class="btn btn-primary">Tambah</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// datetimepicker doc : https://github.com/charliekassel/vuejs-datepicker#demo
import datepicker from "vuejs-datepicker";
import PanenDatatable from '../../../components/datatable/PanenDatatable'
export default {
  components: {
    datepicker,
    'app-datatable' : PanenDatatable
  },
  data() {
    return {
      fields:[
        { key: 'tanggal_panen', sortable: true, label:"Tanggal panen"},
        { key: 'kode_lahan', sortable: true, label:"Nama Lahan"},
        { key: 'jenis_cabai', sortable: true, label:"Jenis cabai"},
        { key: 'jumlah_panen', sortable: true, label:"Tanggal panen"},
        { key: 'action', sortable: true, label:"Aksi"},
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
        jumlah_cabai: "",
        pra_produksi_id: "",
        tanggal_panen: ""
      }),
    };
  },
  created(){
    this.getPanen()
    this.getLahan();
  },
  methods: {
    getPanen(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/panen/list", {
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
        this.getPanen() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getPanen()
    },
    handleSearch(val) {
        this.search = val 
        this.getPanen()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getPanen()
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },

    addPanen() {
      document.getElementById("btnaddpanen").disabled = true;
      this.$Progress.start();
      this.form.post("/panen/tambah").then(() => {
          this.getPanen()
          $("#modalHasilPanen").trigger("click");
          toast.fire({ icon: "success", title: "Panen berhasil ditambahkan"});
          this.$Progress.finish();
          document.getElementById("btnaddpanen").disabled = false;
        })
        .catch(error => {
          this.$Progress.fail();
          document.getElementById("btnaddpanen").disabled = false;
        });
    },
    // Memperbarui Hasil Panen
    updatePanen() {
      this.$Progress.start();
      this.form
        .put("/panen/update/" + this.form.id)
        .then(() => {
          this.getPanen()
          $("#modalHasilPanen").trigger("click");
          toast.fire({
            icon: "success",
            title: "Data panen berhasil diperbarui"
          });
          this.$Progress.finish();
        })
        .catch(() => {
          this.$Progress.fail();
        });
    },
    deletePanen(id) {
      swal .fire({
          title: "Apakah kamu yakin?",
          text: "Panen yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
      }).then(result => {
        if (result.value) {
          this.$Progress.start();
          axios.delete("/panen/delete/" + id).then(() => {
              this.getPanen()
              swal.fire( "Tehapus!", "Hasil Panen berhasil dihapus", "success");
              this.$Progress.finish();
            })
            .catch(() => {
              this.$Progress.fail();
              swal.fire( "Gagal!", "Terdapat masalah ketika menghapus", "waning");
            });
        }
      });
    },
    getLahan() {
      axios.get("praProduksi/list/all").then(response => {
        this.datalahan = response.data.data;
      });
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      document.getElementById("lahan__id").disabled = false;
      $("#modalHasilPanen").modal("show");
    },
    editModal(data) {
      this.editmode = true;
      this.form.reset();
      $("#modalHasilPanen").modal("show");
      document.getElementById("lahan__id").disabled = true;
      this.form.fill(data);
      this.form.jumlah_cabai = data.jumlah_panen;
    }
  }
};
</script>