<template>
  <!-- PM : Permintaanmitra dari Pengguna Lain-->
  <div
    class="tab-pane fade active show"
    id="custom-tabs-three-permintaan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-permintaan-tab"
  >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Permintaan Cabai</h3>

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
              <th>Nama</th>
              <th>Jenis cabai</th>
              <th>Jumlah cabai</th>
              <th>Harga cabai</th>
              <th>Tanggal pengiriman</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <td>Example Data</td>
            <td>Cabai keriting</td>
            <td>250</td>
            <td>30000</td>
            <td>22-12-2020</td>
            <td>belum dikirim</td>
            <td>
              <button
                type="button"
                class="btn btn-success btn-xs"
                @click="modalAccPermintaan()"
              >Terima</button>
              <button type="button" class="btn btn-danger btn-xs" @click="rejectPermintaan()">Tolak</button>
            </td>
            <!-- <tr v-if="!listPermintaanCabai.length">
              <td colspan="7" align="center">Tidak ada daftar permintaan cabai</td>
            </tr>-->
            <!-- <tr v-for="data in dataListPermintaanMitra" :key="data.id">
              <td>{{ data.nama }}</td>
              <td>
                <div v-if="data.role===2">Produsen</div>
                <div v-else-if="data.role===3">Pengepul</div>
                <div v-else-if="data.role===4">Grosir</div>
                <div v-else-if="data.role===5">Pengecer</div>
              </td>
              <td>{{ data.lokasi.kelurahan }} , {{ data.lokasi.kecamatan }} , {{ data.lokasi.kabupaten }}</td>
              <td>
                <button
                  type="button"
                  class="btn btn-success btn-xs"
                  @click="acceptMitra(data.id, data.nama)"
                >Terima</button>
                <button
                  type="button"
                  class="btn btn-danger btn-xs"
                  @click="rejectMitra(data.id, data.nama)"
                >Tolak</button>
              </td>
            </tr>-->
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- Modal Penerimaan Permintaan Cabai -->
    <div
      class="modal fade"
      id="modalaccPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalaccPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalaccPermintaanLabel">Permintaan Pasokan Cabai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="acceptPermintaan(1)">
            <div class="modal-body">
              <div class="form-group">
                <datepicker
                  class="col-sm-10"
                  placeholder="Tanggal Pengiriman"
                  v-model="form.tanggal_perngiriman"
                  :format="customFormatter"
                  id="tanggal_perngiriman"
                  :class="{ 'is-invalid': form.errors.has('tanggal_perngiriman') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_perngiriman"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Terima</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import datepicker from "vuejs-datepicker";
export default {
  components: {
    datepicker
  },
  data() {
    return {
      form: new Form({
        tanggal_pengiriman: ""
      }),
      listPermintaanCabai: {}
    };
  },
  methods: {
    getPermintaanCabai() {},
    acceptPermintaan(id_permintaan) {},
    rejectPermintaan(id_permintaan, mitra_yg_mengajukan) {
      swal
        .fire({
          title: "Menolak Permintaan",
          text:
            "Apakah anda yakin menolak permintaan pasokan cabai dari " +
            mitra_yg_mengajukan +
            " ?",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            console.log("berhasil")
          }
        });
    },
    modalAccPermintaan() {
      $("#modalaccPermintaan").modal("show");
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    }
  },
  created() {
    this.getPermintaanCabai();
  },
  mounted() {
    UpdateData.$on("update", () => {
      this.getPermintaanCabai();
    });
  }
};
</script>