<template>
  <!-- PM : Permintaanmitra-->
  <div
    class="tab-pane fade active show"
    id="custom-tabs-three-permintaan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-permintaan-tab"
  >
    <div class="card">
      <div class="card-body">
        <app-datatable
          :items="items" :fields="fields"
          :meta="meta" @per_page= "handlePerPage"
          @pagination="handlePagination" @search="handleSearch"
          @sort="handleSort" @acceptMitraKu="acceptMitra" 
          @rejectMitraKu="rejectMitra">
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
        { key: 'nama', sortable: true, label:"Nama"},
        { key: 'role', sortable: true, label: "Role"},
        { key: 'lokasi.kabupaten', sortable: true, label: "Kabupaten"},
        { key: 'lokasi.kecamatan', sortable: true, label: "Kecamatan"},
        { key: 'lokasi.kelurahan', sortable: true, label: "Kelurahan"},
        { key: 'aksiPembentukanMitra', sortable: false, label: "Aksi"}
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
    this.getPengajuanSaya()
  },
  methods: {
    getPengajuanSaya(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/kemitraan/permintaan/list", {
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
        this.getPengajuanSaya() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getPengajuanSaya()
    },
    handleSearch(val) {
        this.search = val 
        this.getPengajuanSaya()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getPengajuanSaya()
    },
    acceptMitra(id) {
      swal
        .fire({
          title: "Menerima Permintaan",
          text: "Apakah anda yakin menerima mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, terima"
        })
        .then(result => {
          if (result.value) {
            axios.put("/kemitraan/terima/" + id)
              .then(()=> {
                this.getPengajuanSaya()
                swal.fire( "Mengajukan Permintaan", "Berhasil menerima kemitraan", "success");
              })
              .catch(()=>{
                swal.fire( "gagal!", "Pengguna ini telah mendaftarkan anda sebagai mitra","error");
              });
          }
        });
    },
    rejectMitra(id) {
      swal
        .fire({
          title: "Menolak Permintaan",
          text: "Apakah anda yakin menolak mitra?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            axios.put("/kemitraan/tolak/" + id)
              .then(()=> {
                swal.fire("Menolak Permintaan", "Berhasil menolak kemitraan", "success");
                this.getPengajuanSaya()
              })
              .catch(() => {
                swal.fire("gagal!", "Gagal menolak mitra", "error");
              });
          }
        });
    }

  } 
};
</script>