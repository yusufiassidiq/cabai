<template>
  <!-- PM : Permintaanmitra -->
  <div
    class="tab-pane fade"
    id="custom-tabs-three-profile"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-profile-tab"
  >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Riwayat Permintaan</h3>

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
              <!-- <th>Id</th> -->
              <th>Nama</th>
              <th>Role</th>
              <th>Lokasi</th>
              <th>Status</th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <!-- <td>1</td> -->
              <td>Example data 2</td>
              <td>Produsen</td>
              <td>Bogor</td>
              <td>Ditolak</td>
            </tr>
            <!-- <tr v-for="data in dataMitra" :key="data.id">
                <td>{{ data.id }}</td>
                <td>{{ data.name }}</td>
                <td>{{ data.role }}</td>
                <td>{{ data.lokasi }}</td>
                <td>
                <button
                    type="button"
                    class="btn btn-success"
                    @click="terimaMitra(data.id)"
                >Terima</button>
                <button
                    type="button"
                    class="btn btn-danger"
                    @click="tolakMitra(data.id)"
                >Tolak</button>
            </td>-->
            <!-- end example data -->
            <!-- </tr> -->
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
  </div>
</template>
<script>
export default {};
</script>