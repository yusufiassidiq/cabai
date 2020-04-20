<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Transaksi Pelanggan</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Produsen</a>
            </li>
            <li class="breadcrumb-item active">Transaksi Pelanggan</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Transaksi Pembeli</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <button class="btn btn-success" @click="newModal()">Add new</button>
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
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>Jenis</th>
                      <th>Pelanggan</th>
                      <th>Tanggal</th>
                      <th>Jumlah/kg</th>
                      <th>Harga/kg</th>
                      <th>Action</th>
                    </tr>
                  </thead>

                  <tbody></tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal Manajemen Lahan-->
    <div
      class="modal fade"
      id="modalTransaksi"
      tabindex="-1"
      role="dialog"
      aria-labelledby="modalTransaksiLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTransaksiLabel">Transaksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode? updateTransaksi() : addTransaksi()">
            <div class="modal-body">
              <div class="form-group col-md">
                <select
                  v-model="form.pembeli_id"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('pembeli_id') }"
                >
                  <option value disabled selected>Pilih pembeli</option>
                  <option
                    v-for="data in dataMitra"
                    :key="data.id"
                    v-bind:value="data.id"
                  >{{ data.nama }}</option>
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
              <div class="form-group col-md">
                <input
                  v-model="form.harga"
                  type="number"
                  name="harga"
                  class="form-control"
                  placeholder="Harga"
                  :class="{ 'is-invalid': form.errors.has('harga') }"
                />
                <has-error :form="form" field="harga"></has-error>
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
    <!-- </modal> -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
export default {
  data() {
    return {
      dataMitra: {},
      editmode: false,
      form: new Form({
        id: "",
        jenis_cabai: "",
        jumlah_cabai: "",
        harga: "",
        pembeli_id: ""
      })
    };
  },
  methods: {
    getMitra() {
      axios.get("/listMitraSaya").then(response => {
        this.dataMitra = response.data.data;
        console.log(this.dataMitra);
      });
    },
    updateTransaksi() {
      console.log("update berhasil");
    },
    addTransaksi() {
      console.log("berhasil menambahkan");
    },
    newModal() {
      this.editmode = false;
      // this.form.reset();
      $("#modalTransaksi").modal("show");
    },
    // Menampilkan Modal utk Mengedit lahan baru
    editModal(data) {
      // console.log(data)
      this.editmode = true;
      this.form.reset();
      $("#modalTransaksi").modal("show");
      // this.form.fill(data);
      // console.log(this.form)
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