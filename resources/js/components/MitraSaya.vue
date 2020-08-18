<template>
  <!-- MS : Ini merupakan komponen bagian pada Kelola mitra-->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="card">
          <div class="card-body">
            <app-datatable
              :items="items" :fields="fields"
              :meta="meta" @per_page= "handlePerPage"
              @pagination="handlePagination" @search="handleSearch"
              @sort="handleSort" @deleteMitraKu="deleteMitra">
            </app-datatable>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import KemitraanDatatable from '../components/datatable/KemitraanDatatable'
export default {
  components:{
    'app-datatable': KemitraanDatatable
  },
  data() {
    return {
      fields:[
        { key: 'nama', sortable: true, label:"Nama"},
        { key: 'role', sortable: true, label: "Role"},
        { key: 'lokasi.kabupaten', sortable: true, label: "Kabupaten"},
        { key: 'lokasi.kecamatan', sortable: true, label: "kecamatan"},
        { key: 'lokasi.kelurahan', sortable: true, label: "Kelurahan"},
        { key: 'aksiKelolaMitra', sortable: false, label: "Aksi"},
      ],
      items: [],
      meta: [],
      current_page: 1,
      per_page: 10,
      search: '',
      sortBy: 'updated_at',
      sortByDesc: false
    };
  },
  created(){
    this.getKelolaMitra()
  },
  methods: {
    getKelolaMitra(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get('/kemitraan/mitra/list', {
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
        this.getKelolaMitra() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getKelolaMitra()
    },
    handleSearch(val) {
        this.search = val 
        this.getKelolaMitra()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getKelolaMitra()
    },
    
    deleteMitra(id) {
      swal
        .fire({
          title: "Menghapus Permintaan",
          text: "Apakah anda yakin menghapus mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .delete("/kemitraan/delete/" + id)
              .then(response => {
                swal.fire(
                  "Menghapus Kemitraan",
                  "Mitra berhasil dihapus",
                  "success"
                );
                this.getKelolaMitra()
                this.$Progress.finish();
              })
              .catch(error => {
                this.$Progress.fail();
                swal.fire("gagal!", "Mitra gagal dihapus", "error");
              });
          }
        });
    }
  } 
};
</script>