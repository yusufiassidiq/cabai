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
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="data in inventaris" :key="data.id">
                    <td>{{ data.id }}</td>
                    <td>{{ data.jenis }}</td>
                    <td>{{ data.jumlah }}</td>
                    <td>{{ data.ketersediaan }}</td>
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
      inventaris: {},
    };
  },
  methods: {
    // Mendapatkan data Pengajuan Mitra
    getInventaris() {
      var url = "https://5e8730b2781e48001676b86c.mockapi.io/inventaris";
      axios.get(url).then(response => {
        this.inventaris = response.data;
      });
    },
  },
  created() {
    this.getInventaris();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.getInventaris();
    });
  }
};
</script>