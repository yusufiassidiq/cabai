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
              <th>Pembeli</th>
              <th>Jenis cabai</th>
              <th>Jumlah cabai(Kg)</th>
              <th>Permintaan Cabai diterima</th>
              <th>Harga cabai</th>
              <th>Tanggal pengiriman</th>
              <th>Status</th>
              <th>Keterangan</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!listPermintaanCabai.length">
              <td colspan="8" align="center">Tidak ada permintaan cabai</td>
            </tr>
            <tr v-for="data in listPermintaanCabai" :key="data.id">
              <td>{{data.nama}}</td>
              <td>{{data.jenis_cabai}}</td>
              <td>{{data.jumlah_cabai}}</td>
              <td>{{data.tanggal_diterima}}</td>
              <td>
                <div v-if="data.harga!==null">{{ convertToRupiah(data.harga) }}/Kg</div>
                <div v-else>Belum ditetapkan</div>
              </td>
              <td>
                <div v-if="data.tanggal_pengiriman!==null">{{data.tanggal_pengiriman}}</div>
                <div v-else>Belum ditetapkan</div>
              </td>
              <td>
                <div class="orange" v-if="data.status_permintaan === 0">Belum ditanggapi</div>
                <div v-else-if="data.status_permintaan === 1">Menunggu persetujuan pembeli</div>
                <div class="red" v-else-if="data.status_permintaan === 4">Penawaran anda ditolak</div>
                <div class="green" v-else-if="data.status_permintaan === 3">Penawaran anda diterima</div>
                <div class="red" v-else-if="data.status_permintaan === 2">Permintaan ditolak</div>
              </td>
              <td>
                <div v-if="data.status_permintaan === 2">{{data.keterangan}}</div>
                <div v-else>-</div>
              </td>
              <td>
                <div v-if="data.status_permintaan === 0">
                  <button
                    type="button"
                    class="btn btn-success btn-xs"
                    @click="modalAccPermintaan(data)"
                  >Terima</button>
                  <button
                    type="button"
                    class="btn btn-danger btn-xs"
                    @click="modalTolakPermintaan(data)"
                  >Tolak</button>
                </div>
                <div v-if="data.status_permintaan === 3">
                  <button
                    type="button"
                    class="btn btn-success btn-xs"
                    @click="modalKirimPesanan(data)"
                  >Kirim Pesanan</button>
                </div>
                <div v-else>-</div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- Modal Penerimaan Permintaan Cabai -->
    <div
      class="modal fade"
      id="modalAccPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalAccPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalAccPermintaanLabel">Penerimaan Permintaan Pasokan Cabai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="acceptPermintaan()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Pembeli</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_nama}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Jenis Cabai</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_jeniscabai}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Jumlah cabai</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_jumlahcabai}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <p class="normal text-md-left">Tanggal diterima</p>
                </div>
                <div class="col-md-8">
                  <p>:&ensp; {{temp_tanggalditerima}}</p>
                </div>
              </div>

              <div class>
                <datepicker
                  input-class="form-control"
                  placeholder="Tanggal Pengiriman"
                  v-model="form.tanggal_pengiriman"
                  :format="customFormatter"
                  id="tanggal_pengiriman"
                  :class="{ 'is-invalid': form.errors.has('tanggal_pengiriman') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_pengiriman"></has-error>
              </div>
              <br />
              <div class>
                <input
                  v-model="form.harga"
                  type="number"
                  name="harga"
                  class="form-control"
                  placeholder="Harga"
                  required
                  :class="{ 'is-invalid': form.errors.has('harga') }"
                />
                <has-error :form="form" field="Penawaran harga"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnAccPermintaan" type="submit" class="btn btn-primary">Terima</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <vue-progress-bar></vue-progress-bar>
    <!-- Modal Penerimaan Penolakan Cabai -->
    <div
      class="modal fade"
      id="modalTolakPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalTolakPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTolakPermintaanLabel">Penolakan Permintaan Pasokan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="rejectPermintaan()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                  <p class="normal text-md-left">Pembeli</p>
                </div>
                <div class="col-md-9">
                  <p>:&ensp; {{temp_nama}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p class="normal text-md-left">Jenis Cabai</p>
                </div>
                <div class="col-md-9">
                  <p>:&ensp; {{temp_jeniscabai}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p class="normal text-md-left">Jumlah cabai</p>
                </div>
                <div class="col-md-9">
                  <p>:&ensp; {{temp_jumlahcabai}}</p>
                </div>
              </div>

              <div class>
                <textarea
                  v-model="formReject.keterangan"
                  type="textarea"
                  name="keterangan"
                  class="form-control"
                  placeholder="Alasan Menolak"
                  :class="{ 'is-invalid': formReject.errors.has('keterangan') }"
                  required
                />
                <has-error :form="formReject" field="Penawaran harga"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnTolakPermintaan" type="submit" class="btn btn-primary">Tolak</button>
            </div>
          </form>
          <!-- </form> -->
        </div>
      </div>
    </div>
    <div
      class="modal fade"
      id="modalKirimPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalKirimPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalKirimPermintaanLabel">Penolakan Permintaan Pasokan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="kirimPesanan()">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-3">
                  <p class="normal text-md-left">Pembeli</p>
                </div>
                <div class="col-md-9">
                  <p>:&ensp; {{temp_nama}}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <p class="normal text-md-left">Jenis Cabai</p>
                </div>
                <div class="col-md-9">
                  <p>:&ensp; {{temp_jeniscabai}}</p>
                </div>
              </div>
              <table class="table">
                <thead>
                  <tr>
                    <th>Jumlah Permintaan</th>
                    <th>Jumlah dimiliki</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{temp_jumlahcabai}} Kg</td>
                    <td>{{temp_inv_jumlahcabai}} Kg</td>
                  </tr>
                </tbody>
              </table>
              <table class="table">
                <thead>
                  <tr>
                    <th>Harga permintaan</th>
                    <th>Rata-rata harga jual</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>{{temp_hargacabai}} /Kg</td>
                    <td>{{temp_inv_hargacabai}} /Kg</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button id="btnKirimPesanan" type="submit" class="btn btn-primary">Kirim</button>
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
        id: "",
        tanggal_pengiriman: "",
        harga: ""
      }),
      formReject: new Form({
        id: "",
        keterangan: ""
      }),
      // Temporary variable
      temp_nama: "",
      temp_jeniscabai: "",
      temp_jumlahcabai: "",
      temp_hargacabai: "",
      temp_tanggalditerima: "",
      temp_inv_jeniscabai: "",
      temp_inv_jumlahcabai: "100",
      temp_inv_hargacabai: "10000",
      // for update keterangan
      keterangan: "",

      listPermintaanCabai: {}
    };
  },
  methods: {
    getPermintaanMasuk() {
      axios.get("getPermintaanMasuk").then(response => {
        this.listPermintaanCabai = response.data.data;
      });
    },
    acceptPermintaan() {
      document.getElementById("btnAccPermintaan").disabled = true;
      this.$Progress.start();
      this.form
        .put("terimaPermintaanMasuk/" + this.form.id)
        .then(() => {
          UpdateData.$emit("ListPermintaanCabai");
          $("#modalAccPermintaan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Permintaan berhasil diterima"
          });
          this.$Progress.finish();
          document.getElementById("btnAccPermintaan").disabled = false;
        })
        .catch(() => {
          document.getElementById("btnAccPermintaan").disabled = false;
          this.$Progress.finish();
        });
    },
    rejectPermintaan() {
      document.getElementById("btnTolakPermintaan").disabled = true;
      this.$Progress.start();
      this.formReject
        .put("tolakPermintaanPembeli/" + this.formReject.id)
        .then(() => {
          UpdateData.$emit("ListPermintaanCabai");
          // hide modal
          $("#modalTolakPermintaan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Permintaan berhasil ditolak"
          });
          this.$Progress.finish();
          document.getElementById("btnTolakPermintaan").disabled = false;
        })
        .catch(() => {
          document.getElementById("btnTolakPermintaan").disabled = false;
          this.$Progress.fail();
        });
    },
    modalAccPermintaan(data) {
      $("#modalAccPermintaan").modal("show");
      this.form.id = data.id;
      this.temp_nama = data.nama;
      this.temp_jeniscabai = data.jenis_cabai;
      this.temp_jumlahcabai = data.jumlah_cabai;
      this.temp_tanggalditerima = data.tanggal_diterima;
    },
    modalTolakPermintaan(data) {
      $("#modalTolakPermintaan").modal("show");
      this.formReject.id = data.id;
      this.temp_nama = data.nama;
      this.temp_jeniscabai = data.jenis_cabai;
      this.temp_jumlahcabai = data.jumlah_cabai;
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
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
    modalKirimPesanan(data) {
      $("#modalKirimPermintaan").modal("show");
      this.formReject.id = data.id;
      this.temp_nama = data.nama;
      this.temp_jeniscabai = data.jenis_cabai;
      this.temp_jumlahcabai = data.jumlah_cabai;
      this.temp_hargacabai = data.harga;
      this.temp_tanggalditerima = data.tanggal_diterima;
    },
    kirimPesanan() {
      document.getElementById("btnKirimPesanan").disabled = true;
      this.$Progress.start();
      this.form
        .put("/" + this.form.id)
        .then(() => {
          UpdateData.$emit("ListPermintaanCabai");
          $("#modalKirimPermintaan").trigger("click");
          toast.fire({
            icon: "success",
            title: "Pesanan berhasil dikirim"
          });
          this.$Progress.finish();
          document.getElementById("btnKirimPesanan").disabled = false;
        })
        .catch(() => {
          document.getElementById("btnKirimPesanan").disabled = false;
          this.$Progress.finish();
        });
    }
  },
  created() {
    this.getPermintaanMasuk();
  },
  mounted() {
    UpdateData.$on("ListPermintaanCabai", () => {
      this.getPermintaanMasuk();
    });
  }
};
</script>