<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Target Penjualan Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Rekap Target</li>
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
                <h3 class="card-title">Rekap Target Tahun 2020</h3>

                <div class="card-tools">
                  <button class="btn btn-success" data-toggle="modal" data-target="#addfield">Tambah Target 
                    <i class="fas fa-plus fa-fw"></i>
                  </button>
                  <!-- <div class="input-group input-group-sm" style="width: 150px;"> -->
                  <!-- <input
                      type="text"
                      name="table_search"
                      class="form-control float-right"
                      placeholder="Search"
                  />-->

                  <!-- <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                  </div>-->
                  <!-- </div> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <!-- <th>No</th> -->
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Jenis Cabai</th>
                      <th>Total Target</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- example data -->
                    <tr v-for="t in target" :key="t.id">
                      <!-- <td></td> -->
                      <td>{{ t.tahun }}</td>
                      <td>{{ t.bulan }}</td>
                      <td>{{ t.jenis_cabai }}</td>
                      <td>{{ t.jumlah_cabai }}</td>
                      <td>
                        <a href="#">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#">
                          <i class="fa fa-trash red"></i>
                        </a>
                      </td>
                    </tr>
                    <!-- end example data -->
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->

    <!-- Start Modal -->
    <!-- Modal -->
    <div class="modal fade" id="addfield" tabindex="-1" role="dialog"
    aria-labelledby="addfieldLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addfieldLabel">Tambahkan Target</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="addTarget">
            <div class="modal-body">
              <div class="form-group col-md">
                <input
                  v-model="form.tahun"
                  type="text"
                  name="tahun"
                  class="form-control"
                  placeholder="Tahun"
                  :class="{ 'is-invalid': form.errors.has('tahun') }"
                />
                <has-error :form="form" field="tahun"></has-error>
              </div> 
              <div class="form-group col-md">
                <select
                    v-model="form.bulan"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('bulan') }"
                  >
                  <option value disabled selected>Bulan</option>
                  <option value="Januari">Januari</option>
                  <option value="Februari">Februari</option>
                  <option value="Maret">Maret</option>
                  <option value="April">April</option>
                  <option value="Mei">Mei</option>
                  <option value="Juni">Juni</option>
                  <option value="Juli">Juli</option>
                  <option value="Agustus">Agustus</option>
                  <option value="September">September</option>
                  <option value="Oktober">Oktober</option>
                  <option value="November">November</option>
                  <option value="Desember">Desember</option>
                </select>
                <has-error :form="form" field="bulan"></has-error>
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
                  type="text"
                  name="jumlah_cabai"
                  class="form-control"
                  placeholder="Jumlah Cabai"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>
            </div> 
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </div>
        <!-- Modal Content -->
      </div>
      <!-- Modal dialog -->
    </div>
    <!-- End Modal -->
  </div>
<!-- /.content-wrapper -->
</template>

<script>
  export default{
    data(){
      return {
        target :{},
        form : new Form({
          tahun : "",
          bulan : "",
          jenis_cabai: "",
          jumlah_cabai:"",
        })
      }
    },
    methods:{
      loadTarget(){
        axios.get('/readTarget').then(({data}) =>
        (this.target = data.data));
      },
      addTarget(){
        this.form.post('/addTarget');
      }
    },
    created(){
      this.loadTarget();
    }
  }
</script>