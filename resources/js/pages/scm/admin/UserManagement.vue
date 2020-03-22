<template>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Manajemen User</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">Admin</a>
                </li>
                <li class="breadcrumb-item active">User Management</li>
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
                  <h3 class="card-title">Manajemen User</h3>

                  <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <button
                        class="btn btn-success"
                        data-toggle="modal"
                        data-target="#exampleModal"
                      >Add new</button>
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
                      <!-- <tr v-for="user in users" :key="user.id">
                        <td>{{ user.id }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>status</td>
                        <td>role</td>
                        <td>
                          <a href="#">
                            <i class="fas fa-edit blue"></i>
                          </a>
                          /
                          <a href="#">
                            <i class="fas fa-trash red"></i>
                          </a>
                        </td>
                      </tr>-->
                      <tr>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Status</td>
                        <td>Role</td>
                        <td>Aksi</td>
                      </tr>
                      <tr>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Status</td>
                        <td>Role</td>
                        <td>Aksi</td>
                      </tr>
                      <tr>
                        <td>ID</td>
                        <td>Nama</td>
                        <td>Email</td>
                        <td>Status</td>
                        <td>Role</td>
                        <td>Aksi</td>
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
    <!-- /.content-wrapper -->
  </div>
</template>