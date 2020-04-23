 <template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Inventaris</h3>
              <vue-progress-bar></vue-progress-bar>
              <div class="card-tools">
                <button class="btn btn-success btn-sm" @click="newModal">Tambah Inventory</button>
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
                    <td>{{ data.jumlah_cabai }} Kg</td>
                    <td>{{ convertToRupiah(data.harga) }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="modalInventaris"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalInventarisLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalInventarisLabel">Informasi Lahan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateLahan() : addInventaris()">
            <div class="modal-body">
              <div class="form-group col-md">
                <select
                  v-model="form.jenis_cabai"
                  class="form-control"
                  required
                  :class="{ 'is-invalid': form.errors.has('jenis_cabai') }"
                >
                  <option value disabled selected>Jenis cabai</option>
                  <option value="Cabai rawit">Cabai rawit</option>
                  <option value="Cabai keriting">Cabai keriting</option>
                  <option value="Cabai besar">Cabai besar</option>
                </select>
                <has-error :form="form" field="jenis_cabai"></has-error>
              </div>

              <div class="form-group col-md">
                <input
                  v-model="form.jumlah_cabai"
                  type="number"
                  name="jumlah_cabai"
                  class="form-control"
                  placeholder="Jumlah cabai"
                  required
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="luas_lahan"></has-error>
              </div>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnadd" type="submit" class="btn btn-primary">Tambahkan</button>
            </div>
          </form>
          <!-- </form> -->
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
      axios.get("/getInventaris").then(response => {
        this.inventaris = response.data.data;
      });
    },
    convertToRupiah(angka) {
      var rupiah = "";
      var angkarev = angka
        .toString()
        .split("")
        .reverse()
        .join("");
      for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
      return (
        "Rp. " +
        rupiah
          .split("", rupiah.length - 1)
          .reverse()
          .join("")
      );
    },
    newModal() {
      this.form.reset()
      $("#modalInventaris").modal("show");
    },
    addInventaris() {
      this.$Progress.start();
      this.form
        .put("/addInventaris")
        .then(() => {
          UpdateData.$emit("Inventaris");
          $("#modalInventaris").trigger("click");
          toast.fire({
            icon: "success",
            title: "Inventaris berhasil ditambahkan"
          });
          this.$Progress.finish();
          document.getElementById("btnadd").disabled = false;
        })
        .catch(() => {
          this.$Progress.fail();
        });
    }
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