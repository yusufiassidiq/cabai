<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Pengajuan Mitra</h3>

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
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Lokasi</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>Yahya</td>
                    <td>Pengepul</td>
                    <td>Depok</td>
                    <td>
                      <!-- <a href="#">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                            <i class="fa fa-trash red"></i>
                      </a>-->
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
</template>