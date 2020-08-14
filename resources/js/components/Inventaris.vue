 <template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Stok Cabai</h3>
              <vue-progress-bar></vue-progress-bar>
              <div class="card-tools">
                <!-- <button class="btn btn-success btn-sm" @click="newModal">Tambah Inventory</button> -->
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Jenis Cabai</th>
                    <th>Stok</th>
                    <th>Rataan Harga Jual</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="data in inventaris" :key="data.id">
                    <td>{{ data.jenis_cabai }}</td>
                    <td>{{ data.jumlah_cabai | filterAngkaRibuan}} Kg</td>
                    <td>{{ data.harga | convertToRupiah }}</td>
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
      form: new Form({
        jenis_cabai: "",
        jumlah_cabai: ""
      }),
      editmode: false,
      inventaris: {}
    };
  },
  methods: {
    getInventaris() {
      axios.get("/inventaris/list").then(response => {
        this.inventaris = response.data.data;
      });
    },
  },
  created() {
    this.getInventaris();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("Inventaris", () => {
      this.getInventaris();
    });
  }
};
</script>