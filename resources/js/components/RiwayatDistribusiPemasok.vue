<template>
  <!-- PM : Permintaanmitra dari Pengguna Lain-->
  <div class="tab-pane fade active show" id="custom-tabs-three-permintaan" role="tabpanel" aria-labelledby="custom-tabs-three-permintaan-tab">
    <div class="card">
      <div class="card-body">
        <app-datatable
          :items="items" :fields="fields"
          :meta="meta" @per_page= "handlePerPage"
          @pagination="handlePagination" @search="handleSearch"
          @sort="handleSort">
        </app-datatable>
      </div>
    </div>
    <vue-progress-bar></vue-progress-bar>
  </div>
</template>

<script>
import KemitraanDatatable from '../components/datatable/DistribusiDatatable'
export default {
  components:{
    'app-datatable': KemitraanDatatable
  },
  data() {
    return {
      fields:[
        { key: 'tanggal_pengiriman', sortable: true, label:"Tgl kirim"},
        { key: 'tanggal_diterima', sortable: true, label: "Tgl terima"},
        { key: 'nama', sortable: true, label: "Pelanggan"},
        { key: 'jenis_cabai', sortable: true, label: "Jenis cabai"},
        { key: 'jumlah_cabai', sortable: true, label: "Jumlah cabai"},
        { key: 'harga', sortable: false, label: "Harga"},
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
    this.getRiwayatPemasok()
  },
  methods: {
    getRiwayatPemasok(){
      let current_page = this.search == '' ? this.current_page : 1
      axios.get("/transaksi/riwPermintaanMasuk/list", {
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
        this.getRiwayatPemasok() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getRiwayatPemasok()
    },
    handleSearch(val) {
        this.search = val 
        this.getRiwayatPemasok()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getRiwayatPemasok()
    },
  } 
};
</script>