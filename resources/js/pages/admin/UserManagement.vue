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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Admin</a>
              </li>
              <li class="breadcrumb-item active">Manajemen akun</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="card">
            <div class="card-body">
                <app-datatable :items="items" :fields="fields" :meta="meta" @per_page="handlePerPage" 
                    @pagination="handlePagination" @search="handleSearch" @sort="handleSort"/>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
</template>

<script>
import Datatable from '../../components/datatable/UserDatatable'
export default {
  components: {
        'app-datatable': Datatable
  },
  data() {
    return {
      fields: [
          {key: 'name', sortable: true, label: "Nama"},
          {key: 'email', sortable: true, label: "Email"},
          {key: 'role', sortable: true, label: "Role"},
          {key: 'siup', sortable: false, label: "SIUP"},
          {key: 'managementUserAction', sortable: false, label: "Aksi"},
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
  created() {
    this.getValidatedUser()
  },
  methods: {
    getValidatedUser() {
      let current_page = this.search == '' ? this.current_page:1
      axios.get(`/user/validated`, {
          params: {
            page: current_page,
            per_page: this.per_page,
            q: this.search,
            sortby: this.sortBy,
            sortbydesc: this.sortByDesc ? 'DESC':'ASC'
          }
      })
      .then((response) => {
          let getData = response.data.users
          this.items = getData.data
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
        this.getValidatedUser() 
    },
    handlePagination(val) {
        this.current_page = val 
        this.getValidatedUser()
    },
    handleSearch(val) {
        this.search = val 
        this.getValidatedUser()
    },
    handleSort(val) {
        this.sortBy = val.sortBy
        this.sortByDesc = val.sortDesc
        this.getValidatedUser()
    },
  }
};
</script>