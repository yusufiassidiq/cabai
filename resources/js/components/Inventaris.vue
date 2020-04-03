 <template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Inventaris</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <button
                    class="btn btn-success"
                    data-toggle="modal"
                    data-target="#exampleModal"
                  >Add Target</button>
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
                    <th>Id</th>
                    <th>Jenis</th>
                    <th>Jumlah/kg</th>
                    <th>Ketersediaan</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>1</td>
                    <td>cabai rawit</td>
                    <td>!00</td>
                    <td>69</td>
                    <td>aksi</td>
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