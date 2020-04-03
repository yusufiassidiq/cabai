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
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="data in dataMitra" :key="data.id">
                    <td>{{ data.id }}</td>
                    <td>{{ data.name }}</td>
                    <td>{{ data.role }}</td>
                    <td>{{ data.lokasi }}</td>
                    <td>{{ data.status }}</td>
                    
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
<script>
export default {
  data() {
    return {
      dataMitra: {},
      // isLoading: false, // vuebutton spinner
      // status: "", // vuebutton spinner
      form: new Form({
        id: "",
        name: "",
        role: "",
        lokasi: ""
      })
    };
  },
  methods: {
    // Mendapatkan data Pengajuan Mitra
    getMitra() {
      var url = "https://5e8730b2781e48001676b86c.mockapi.io/pengajuanmitra";
      axios.get(url).then(response => {
        this.dataMitra = response.data;
      });
    },
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