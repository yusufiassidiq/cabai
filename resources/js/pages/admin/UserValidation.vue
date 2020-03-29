<template>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Validasi User</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">Admin</a>
                </li>
                <li class="breadcrumb-item active">User Validation</li>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Validasi User</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input
                        type="text"
                        name="table_search"
                        class="form-control float-right"
                        placeholder="Search"
                      />

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
                        <th scope="row">{{ user.id }}</th>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>
                          <div v-if="user.status===1">Verified</div>
                          <div v-else>Unverified</div>
                        </td>
                        <td>
                          <div v-if="user.role===1">Admin</div>
                          <div v-else-if="user.role===2">Produsen</div>
                          <div v-else-if="user.role===3">Pedagang Pengepul</div>
                          <div v-else-if="user.role===4">Pedagang Grosir</div>
                          <div v-else-if="user.role===5">Pedagang Eceran</div>
                        </td>
                        <td>
                        <button class="btn btn-success" @click="selectUser(user)" >Detail</button>
                        <!-- <router-link :to="{ name: 'userDetails', params: { userId: user.id, userObj: user }}" class="btn btn-primary"> Detail </router-link>        -->
                          </td>        
                      </tr>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- Modal -->
    <div
      class="modal fade"
      id="detailUser"
      tabindex="-1"
      role="dialog"
      aria-labelledby="detailUserLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="detailUserLabel">Detail User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <!-- <form @submit.prevent="createuser"> -->
            <div class="modal-body">
              <!-- <form class="form-horizontal" method="post" name="" action=""> -->
                <div class="form-group">
                  
                    <tr>Nama : {{ userDetail.name }}</tr>
                    <tr> <div v-if="userDetail.role===1">Role : Admin</div>
                         <div v-else-if="userDetail.role===2">Role : Produsen</div>
                         <div v-else-if="userDetail.role===3">Role : Pedagang Pengepul</div>
                         <div v-else-if="userDetail.role===4">Role : Pedagang Grosir</div>
                         <div v-else-if="userDetail.role===5">Role : Pedagang Eceran</div>
                    </tr>
                    <tr>Tanggal Registrasi : {{ userDetail.created_at }}</tr>
                  
                  
                </div>
              <!-- </form> -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-danger" v-on:click="deleteUser(userDetail.id)">Tolak</button>
              <button class="btn btn-success" v-on:click="terima(userDetail.id)">Terima</button>
            </div>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
</template>
<script>
export default {
  data() {
    return {
        userDetail: "",
        has_error: false,
        users: null,
        selectedUser: undefined,
    };
  },
  methods:{
      selectUser(user) {
        this.userDetail = user
        $("#detailUser").modal('show');
      },
      getUsers() {
        this.$http({
          url: `users`,
          method: 'GET'
        })
            .then((res) => {this.users = res.data.users}, () => {this.has_error = true})
      },
      deleteUser(id) {
        // delete data
        if(confirm('Are you sure?')){
        this.loading = !this.loading
        axios.delete("/user/" + id)
        .then(response => {this.getUsers();})
        .catch((error) => {
          console.log(error);
          })
        }
      },
      terima(id){
            axios.post("/terima/"+id).then(response => {
            this.getData()
            }).catch((error) => {
            console.log(error);
          })
        },
  },
  mounted() {
    this.getUsers()
  }
};
</script>