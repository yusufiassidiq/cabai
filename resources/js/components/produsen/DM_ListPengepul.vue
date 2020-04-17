<template>
  <!-- DM : Ini merupakan komponen bagian pada Daftar Mitra -->
  <div class="tab-content" id="custom-tabs-three-tabContent">
    <div
      class="tab-pane fade active show"
      id="custom-tabs-three-home"
      role="tabpanel"
      aria-labelledby="custom-tabs-three-home-tab"
    >
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Pengepul</h3>
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
                  <th>Lokasi</th>
                  <th>Aksi</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <td>Example data pengepul</td>
                  <td>Bogor</td>
                  <td>
                    <a href="#" class="btn btn-success btn-xs" @click="addMitra()">
                      <i class="fas fa-plus-square white"></i>
                      Tambah sebagai mitra
                    </a>
                  </td>
                </tr>
                <!-- <tr v-for="data in dataMitra" :key="data.id"> -->
                <!-- <td>{{ data.id }}</td> -->
                <!-- <td>{{ data.name }}</td>
                  <td>{{ data.lokasi }}</td>
                  <td>
                    <a href="#" class="btn btn-success btn-xs" @click="addMitra()">
                      <i class="fas fa-plus-square white"></i>
                      Tambah sebagai mitra
                    </a>
                </td>-->
                <!-- end example data -->
                <!-- </tr> -->
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      dataMitra: null
    };
  },
  methods: {
    // Mendapatkan data Mitra
    getMitra() {
      console.log("get berhasil");
    },
    addMitra() {
      console.log("requestt berhasil");
    }
  },
  created() {
    this.getMitra();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.getMitra();
    });
  }
};
</script>