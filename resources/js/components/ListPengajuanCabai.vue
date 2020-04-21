<template>
  <!-- PM : Permintaanmitra dari Pengguna Lain-->
  <div
    class="tab-pane fade"
    id="custom-tabs-three-pengajuan"
    role="tabpanel"
    aria-labelledby="custom-tabs-three-pengajuan-tab"
  >
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Daftar Permintaan Cabai</h3>

        <div class="card-tools">
          <button class="btn btn-success btn-sm" @click="newModal">Tambah Permintaan pasokan</button>
          <!-- <div class="input-group input-group-sm" style="width: 150px;">
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
          </div>-->
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
              <th>Tanggal diterima</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>

          <tbody>
            <tr v-if="!listPermintaanCabai.length">
              <td colspan="7" align="center">Tidak ada daftar permintaan cabai</td>
            </tr>
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
    <!-- Modal Permintaan Cabai -->
    <div
      class="modal fade"
      id="modalPermintaan"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalPermintaanLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              v-show="!editmode"
              id="modalPermintaanLabel"
            >Permintaan Pasokan Cabai</h5>
            <h5
              class="modal-title"
              v-show="editmode"
              id="modalPermintaanLabel"
            >Edit Permintaan Pasokan Cabai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateLahan() : addLahan()">
            <div class="modal-body">
              <div class="form-group col-md">
                <select
                  v-model="form.pembeli_id"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('pembeli_id') }"
                >
                  <option value disabled selected>Pilih pemasok</option>
                  <option
                    v-for="data in dataMitra"
                    :key="data.id"
                    v-bind:value="data.id"
                  >{{ data.nama }} - {{ getRole(data.role) }}</option>
                </select>
                <has-error :form="form" field="pembeli_id"></has-error>
              </div>
              <div class="form-group col-md">
                <select
                  v-model="form.jenis_cabai"
                  class="form-control"
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
                  placeholder="Jumlah Cabai /kg"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>
              <div class="form-group">
                <datepicker
                  class="col-sm-10"
                  placeholder="Tanggal cabai diterima"
                  v-model="form.tanggal_diterima"
                  :format="customFormatter"
                  id="tanggal_diterima"
                  :class="{ 'is-invalid': form.errors.has('tanggal_diterima') }"
                ></datepicker>
                <has-error :form="form" field="tanggal_diterima"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button
                id="btnupdate"
                v-show="editmode"
                type="submit"
                class="btn btn-success"
              >Perbarui</button>
              <button id="btnadd" v-show="!editmode" type="submit" class="btn btn-primary">Tambahkan</button>
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
        jenis_cabai: "",
        jumlah_cabai: "",
        pembeli_id: "",
        tanggal_diterima: ""
      }),
      editmode: false,
      listPermintaanCabai: {},
      dataMitra: {}
    };
  },
  methods: {
    // fungsi untuk mendapatkan role dari mitra
    getRole(id_role) {
      switch (id_role) {
        case 2:
          return "Produsen";
          break;
        case 3:
          return "Pengepul";
          break;
        case 4:
          return "Grosir";
          break;
        case 4:
          return "Pengecer";
          break;
        default:
          return "Konsumen";
      }
    },
    customFormatter(date) {
      return moment(date).format("DD MMMM YYYY");
    },
    getMitra() {
      axios.get("/listMitraSaya").then(response => {
        this.dataMitra = response.data.data;
        console.log(this.dataMitra);
      });
    },
    getPermintaanCabai() {},
    newModal() {
      console.log("modal created");
      // this.editmode = false;
      // this.form.reset();
      $("#modalPermintaan").modal("show");
    }
  },
  created() {
    this.getPermintaanCabai();
    this.getMitra();
  },
  mounted() {
    UpdateData.$on("update", () => {
      this.getPermintaanCabai();
    });
  }
};
</script>