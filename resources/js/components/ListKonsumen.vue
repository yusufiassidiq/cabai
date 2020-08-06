<template>
  <div class="col-md-12">
    <div class="card">
          <div class="card-body">
            <app-datatable
              :items="items" :fields="fields"
              :meta="meta" @per_page= "handlePerPage"
              @pagination="handlePagination" @search="handleSearch"
              @sort="handleSort" @tambahMitraKu="tambahMitra">
            </app-datatable>
          </div>
        </div>
  </div>
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
        { key: 'name', sortable: true, label:"Nama"},
        { key: 'lokasiKabupaten', sortable: true, label: "Kabupaten"},
        { key: 'lokasiKecamatan', sortable: true, label: "kecamatan"},
        { key: 'lokasiKelurahan', sortable: true, label: "Kelurahan"},
        { key: 'aksiTambahMitra', sortable: false, label: "Aksi"},
      ],
      items: [],
      meta: [],
      current_page: 1,
      per_page: 10,
      search: '',
      sortBy: 'updated_at',
      sortByDesc: false,
    };
  },
  created(){
    this.getListKonsumen()
  },
  methods: {
    getListKonsumen(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/kemitraan/konsumen/list", {
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
        this.getListKonsumen() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getListKonsumen()
    },
    handleSearch(val) {
        this.search = val 
        this.getListKonsumen()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getListKonsumen()
    },
    tambahMitra(id) {
      swal
        .fire({
          title: "Mengajukan Permintaan",
          text: "Apakah anda yakin menambahkan mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            this.$Progress.start();
            axios
              .post("/kemitraan/request/" + id)
              .then(() => {
                this.getListKonsumen()
                swal.fire( "Mengajukan Permintaan", "Berhasil mengajukan kemitraan", "success" );
                this.$Progress.finish();
              })
              .catch(() => {
                this.$Progress.fail();
                swal.fire( "Gagal!", "Terdapat permasalahan saat menyimpan", "error" );
              });
          }
        });
      this.$Progress.finish();
    }
  }
};
</script>