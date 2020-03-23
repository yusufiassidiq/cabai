<template>
  <div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Manajemen Lahan</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">Produsen</a>
                </li>
                <li class="breadcrumb-item active">Manajemen Lahan</li>
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
                  <h3 class="card-title">Manajemen Lahan</h3>

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
                        <th>Kode Lahan</th>
                        <th>Jenis Cabai</th>
                        <th>Luas Lahan</th>
                        <th>Lokasi</th>
                        <th>Tanggal tanam</th>
                        <th>Total Pengeluaran</th>
                        <th>Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                    <td>P12</td>
                    <td>Cabai Keriting</td>
                    <td>2 ha</td>
                    <td>Bogor</td>
                    <td>01-02-2020</td>
                    <td>2.000.000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                  <tr>
                    <td>P11</td>
                    <td>Cabai Besar</td>
                    <td>10 ha</td>
                    <td>Garut</td>
                    <td>02-02-2020</td>
                    <td>2.030.000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                  <tr>
                    <td>P90</td>
                    <td>Cabai Rawit</td>
                    <td>3 ha</td>
                    <td>Bekasi</td>
                    <td>09-02-2020</td>
                    <td>2.110.000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                  <tr>
                    <td>P70</td>
                    <td>Cabai Rawit</td>
                    <td>3 ha</td>
                    <td>Cianjur</td>
                    <td>10-02-2020</td>
                    <td>6.000.000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                        </a>

                    </td>
                  </tr>
                  <tr>
                    <td>P29</td>
                    <td>Cabai Rawit</td>
                    <td>3 ha</td>
                    <td>Sukabumi</td>
                    <td>11-02-2020</td>
                    <td>2.230.000</td>
                    <td>
                        <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                        </a>

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
    <!-- /.content-wrapper -->
  </div>
</template>