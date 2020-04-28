<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Target Produksi Cabai</h1>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Target Penjualan Cabai</h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col">
                    <p class="text-center">
                      <strong>Target Januari - Desember Tahun {{ year }}</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas ref="chart" height="100" style="height: 100px;"></canvas>
                      <!-- <canvas id="salesChart" height="180" style="height: 180px;"></canvas> -->
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Rekap Target Tahun {{ year }}</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">Tambah Target 
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
                      <!-- <th>ID </th> -->
                      <th>Tahun</th>
                      <th>Bulan</th>
                      <th>Jenis Cabai</th>
                      <th>Total Target</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="data in datatarget" :key="data.id">
                      <!-- <td></td> -->
                      <!-- <td>{{ data.id }}</td> -->
                      <td>{{ data.tahun }}</td>
                      <td>{{ data.bulan }}</td>
                      <td>{{ data.jenis_cabai }}</td>
                      <td>Rp{{ data.jumlah_cabai }}</td>
                      <td>
                        <a href="#" @click="editModal(data)">
                          <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteTarget(data.id)">
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
    <div class="modal fade" id="modalTarget" tabindex="-1" role="dialog"
    aria-labelledby="modalTargetLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" v-show="!editmode" id="modalTargetLabel">Tambahkan Target</h5>
            <h5 class="modal-title" v-show="editmode" id="modalTargetLabel">Edit Target</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateTarget() : addTarget()">
            <div class="modal-body">
              <!-- <div >
                <input
                  v-model="form.id"
                  type="text"
                  name="id_form"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('id_form') }"
                />
                <has-error :form="form" field="id"></has-error>
              </div>  -->
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
                  placeholder="Total Penjualan (dalam Rupiah)"
                  :class="{ 'is-invalid': form.errors.has('jumlah_cabai') }"
                />
                <has-error :form="form" field="jumlah_cabai"></has-error>
              </div>
            </div> 
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">Tambahkan</button>
              <button v-show="editmode" type="submit" class="btn btn-success">Perbarui</button>
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
  import { Line } from 'vue-chartjs'

  export default{
    data(){
      return {
        editmode : false,
        datatarget :{},
        form : new Form({
          id: "",
          tahun : "",
          bulan : "",
          jenis_cabai: "",
          jumlah_cabai:"",
        })
      };
    },
    methods:{
      newModal(){
        this.editmode = false,
        this.form.reset();
        $("#modalTarget").modal("show");
      },
      addTarget(){
        this.$Progress.start();
        this.form.post('/addTargetAdmin')
        .then(()=>{
          // this.isLoading = false;
          UpdateData.$emit("update");
          // hide modal
          $("#modalTarget").trigger("click");
          // show Toast if success
          toast.fire({
            icon: "success",
            title: "Target berhasil ditambahkan"
          });
          this.$Progress.finish();
        })
      },
      loadTarget(){
        axios.get('/readTargetAdmin').then(response =>{
          this.datatarget = response.data.data;
          this.year = response.data.tahun;
        });
        console.log(response.data.data)
      },
      editModal(t){
        this.editmode = true,
        this.form.reset();
        $("#modalTarget").modal("show");
        this.form.fill(t);
        console.log(t)
      },
      updateTarget(){
        console.log("satu")
        this.$Progress.start();
        this.form
          .put("updateTargetAdmin/" + this.form.id,{
            tahun : this.form.tahun,
            bulan : this.form.bulan,
            jenis_cabai : this.form.jenis_cabai,
            jumlah_cabai : this.form.jumlah_cabai
          })
          .then(() => {
          UpdateData.$emit("update");
          // hide modal
          $("#modalTarget").trigger("click");
          toast.fire({
            icon: "success",
            title: "Target berhasil diperbarui"
          });
        })
        .catch(() => {
          this.$Progress.fail();
        });
      },
      deleteTarget(id){
        swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "Data yang dihapus tidak dapat dikembalikan",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, hapus data!"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .delete("deleteTargetAdmin/" + id)
              .then(() => {
                UpdateData.$emit("update");
                swal.fire("Tehapus!", "Data Target berhasil dihapus", "success");
              })
              .catch(() => {
                swal.fire(
                  "Gagal!",
                  "Terdapat masalah ketika menghapus",
                  "waning"
                );
              });
          }
        });
      },
      fillData () {
        axios.get('/getTargetAdmin').then(response=>{
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
            type : 'line',
            data:{
              labels:response.data.month,
              datasets:[{
                label : 'Cabai Rawit',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: response.data.rawit,
                fill                : false,
              },
              {
                label : 'Cabai Keriting',
                backgroundColor     : 'rgba(255, 0, 0, 0.6)',
                borderColor         : 'rgba(255, 0, 0, 0.8)',
                pointRadius         : true,
                pointColor          : 'rgba(255, 0, 0, 0.8)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255, 0, 0, 0.8)',
                data                : response.data.keriting,
                fill                : false,
              },
              {
                label : 'Cabai Besar',
                backgroundColor     : 'rgba(11, 156, 49, 0.8)',
                borderColor         : 'rgba(11, 156, 49, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(11, 156, 49, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(11, 156, 49, 1)',
                data                : response.data.besar,
                fill                : false,
              }]
            },
            options:{
              tooltips:{
                mode:'index',
                intersect: false,
              },
              hover:{
                mode: 'nearest',
                intersect: true,
              },
              scales:{
                xAxes: [{
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes:[{
                  gridLines : {
                    display : false,
                  },
                  ticks:{
                    beginAtZero:true
                  }
                }]
              }
            }
          }); 
        }).catch(error => {
          console.log(error)
          this.errored= true
        });
      }
    },
    created(){
      this.loadTarget();
      // setInterval(()=> this.loadTarget(), 3000);
    },
    mounted() {
    this.fillData();
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.fillData();
      this.loadTarget();
    });
  }
};
</script>