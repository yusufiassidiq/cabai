<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manajemen akun</h1>
          </div>
          <vue-progress-bar></vue-progress-bar>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Admin</a>
              </li>
              <li class="breadcrumb-item active">Manajemen akun</li>
            </ol>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="container" style="padding-top: 30px">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h5 class="card-title">VueJS Datatables</h5>
                        </div> -->
                        <div class="card-body">
                            <app-datatable 
                                :items="items" 
                                :fields="fields" 
                                :meta="meta"
                                :editUrl="'/a/b'"
                                :title="'Delete Posts'"
                                @per_page="handlePerPage" 
                                @pagination="handlePagination" 
                                @search="handleSearch" 
                                @sort="handleSort"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
    <!-- Modal Add new user Start-->
    <div class="modal fade" id="editUser" tabindex="-1" role="dialog" aria-labelledby="editUserLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailUserLabel">Edit User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="updateUser()">
            <div class="modal-body">
              <div class="form-group">
                <select class="form-control" placeholder="status">
                  <option value disabled selected>Select status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non-aktif</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.input-container input {
  /* border: none;
	background: transparent; */
  color: black;
  padding: 6px 6px;
  font-size: 16px;
}
img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
</style>

<script>
import Datatable from '../../components/datatable/ValidatedUserDatatable'
export default {
  components: {
        'app-datatable': Datatable //REGISTER COMPONENT DATATABLE
  },
  data() {
    return {
      //UNTUK VARIABLE FIELDS, DEFINISIKAN KEY UNTUK MASING-MASING DATA DAN SORTABLE BERNILAI TRUE JIKA INGIN MENAKTIFKAN FITUR SORTING DAN FALSE JIKA TIDAK INGIN MENGAKTIFKAN
      fields: [
          {key: 'name', sortable: true, label: "Nama"},
          {key: 'role', sortable: true, label: "Role"},
          {key: 'email', sortable: true, label: "Email"},
          {key: 'updated_at', sortable: true, label: "Tanggal validasi"},
          {key: 'siup', sortable: false, label: "SIUP"},
          {key: 'actions', sortable: false, label: "Aksi"},
      ],
      items: [], //DEFAULT VALUE DARI ITEMS ADALAH KOSONG
      meta: [], //JUGA BERLAKU UNTUK META
      current_page: 1, //DEFAULT PAGE YANG AKTIF ADA PAGE 1
      per_page: 10, //DEFAULT LOAD PERPAGE ADALAH 10
      search: '',
      sortBy: 'updated_at', //DEFAULT SORTNYA ADALAH CREATED_AT
      sortByDesc: false, //ASCEDING
      // old
      selectedImage: "logo",
      userDetail: "",
      has_error: false,
      selectedUser: undefined,
      users: {},
      // variabel untuk search
      stringNama: "",
      // untuk pagination
      pagination: [],
      url_getUser: "/user/validated"
    };
  },
  created() {
    this.loadPostsData()
  },
  methods: {
    //METHOD INI AKAN MENGHANDLE REQUEST DATA KE API
    loadPostsData() {
        let current_page = this.search == '' ? this.current_page:1
        //LAKUKAN REQUEST KE API UNTUK MENGAMBIL DATA POSTINGAN
        axios.get(`/user/validated`, {
            //KIRIMKAN PARAMETER BERUPA PAGE YANG SEDANG DILOAD, PENCARIAN, LOAD PERPAGE DAN SORTING.
            params: {
                page: current_page,
                per_page: this.per_page,
                q: this.search,
                sortby: this.sortBy,
                sortbydesc: this.sortByDesc ? 'DESC':'ASC'
            }
        })
        .then((response) => {
            //JIKA RESPONSENYA DITERIMA
            let getData = response.data.users
            this.items = getData.data //MAKA ASSIGN DATA POSTINGAN KE DALAM VARIABLE ITEMS
            //DAN ASSIGN INFORMASI LAINNYA KE DALAM VARIABLE META
            this.meta = {
                total: getData.total,
                current_page: getData.current_page,
                per_page: getData.per_page,
                from: getData.from,
                to: getData.to
            }
        })
    },
    //JIKA ADA EMIT TERKAIT LOAD PERPAGE, MAKA FUNGSI INI AKAN DIJALANKAN
    handlePerPage(val) {
        this.per_page = val //SET PER_PAGE DENGAN VALUE YANG DIKIRIM DARI EMIT
        this.loadPostsData() //DAN REQUEST DATA BARU KE SERVER
    },
    //JIKA ADA EMIT PAGINATION YANG DIKIRIM, MAKA FUNGSI INI AKAN DIEKSEKUSI
    handlePagination(val) {
        this.current_page = val //SET CURRENT PAGE YANG AKTIF
        this.loadPostsData()
    },
    //JIKA ADA DATA PENCARIAN
    handleSearch(val) {
        this.search = val //SET VALUE PENCARIAN KE VARIABLE SEARCH
        this.loadPostsData() //REQUEST DATA BARU
    },
    //JIKA ADA EMIT SORT
    handleSort(val) {
        //MAKA SET SORT-NYA
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc

        this.loadPostsData() //DAN LOAD DATA BARU BERDASARKAN SORT
    },
    // showing modal edit
    edituser(id) {
      $("#editUser").modal("show");
    },
    // fungsi untuk mengubah status user menjadi inaktif
    updateUser() {
      console.log("update user");
    },
    // format simpan tanggal
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
  }
};
</script>