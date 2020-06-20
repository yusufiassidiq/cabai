<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap Pengeluaran Poduksi Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">{{ roleUser | filterRoleName }}</a>
              </li>
              <li class="breadcrumb-item active">Rekap Pengeluaran</li>
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
        <div v-show= "lahan!==null" class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                 <!-- FORM FILTER BERDASARKAN BULAN DAN TAHUN -->
                <div class="row"> 
                  <div class="col-md-3 form-group">
                      <!-- <div class="form-group"> -->
                          <label for="">Pilih Bulan</label>
                          <select class="form-control select2" 
                                  @change="fillData"
                                  v-model="bulanFilter">
                              <!-- <option value disabled selected>Bulan</option> -->
                              <option value="01">Januari</option>
                              <option value="02">Februari</option>
                              <option value="03">Maret</option>
                              <option value="04">April</option>
                              <option value="05">Mei</option>
                              <option value="06">Juni</option>
                              <option value="07">Juli</option>
                              <option value="08">Agustus</option>
                              <option value="09">September</option>
                              <option value="10">Oktober</option>
                              <option value="11">November</option>
                              <option value="12">Desember</option>
                          </select>
                      <!-- </div> -->
                  </div>
                  <div class="col-md-3 form-group">
                      <!-- <div class="form-group"> -->
                          <label for="">Pilih Tahun</label>
                          <select class="form-control select2"
                                  @change="fillData"
                                  v-model="tahunFilter">>
                              <!-- <option value disabled selected>Tahun</option> -->
                              <option v-for="t in arrayTahun" :key="t" v-bind:value="t">{{ t }}</option>
                          </select>
                      <!-- </div> -->
                  </div>
                </div>
                <!-- FORM FILTER BERDASARKAN BULAN DAN TAHUN -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div v-show= "lahan!==null" class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Pengeluaran Produksi Cabai</h5>
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
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <p class="text-center">
                        <strong>Pengeluaran Bulan {{month}} {{ year }}</strong>
                    </p>
                    <div class="chart">
                      <!-- Pengeluaran Chart Canvas -->
                      <canvas ref="chart" height="100" style="height: 100px;"></canvas>
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
        <div v-show= "lahan!==null" class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pengeluaran Cabai Bulan {{month}} {{tahunFilter}}</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body table-responsive p-0">
                <div class="row">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Pupuk</th>
                        <th>Alat Tani</th>
                        <th>Pestisida</th>
                        <th>Lainnya</th>
                        <th>Total Pengeluaran</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="p in pengeluaran" :key="p.tanggal">
                        <td>{{p.tanggal}}</td>
                        <td>{{p.pupuk | convertToRupiah}}</td>
                        <td>{{p.alatTani | convertToRupiah}}</td>
                        <td>{{p.pestisida | convertToRupiah}}</td>
                        <td>{{p.lainnya | convertToRupiah}}</td>
                        <td>{{p.jumlahPengeluaran | convertToRupiah}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div v-if= "lahan===null" class="row">
          <div class="col">
            <!-- <div class="card alert alert-warning alert"> -->
            <div class="card callout callout-warning">
                  <h5>
                    <i class="icon fas fa-exclamation-triangle"></i>
                  Belum Ada Data Lahan
                  </h5>
                  <p>
                  Silahkan Mengisi Data Lahan
                      <router-link to="/produsen/manajemenlahan">
                        Disini
                      </router-link>
                  </p>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
</template>

<script>
  import { Bar } from 'vue-chartjs'

  export default {
    data(){
      return{
        //filter
        bulanFilter: moment().format('MM'), //DEFAULT BULAN YG AKTIF BERDASARKAN BULAN SAAT INI
        tahunFilter: moment().format('Y'), //DEFAULT TAHUN YG AKTIF BERDASARKAN TAHUN SAAT INI
        arrayTahun:"",
        //tabel
        month:"",
        pengeluaran:"",

        roleUser : "",
        year : "",
        lahan : "",
      };
    },
    mounted () {
      this.filterData(),
      this.fillData()
      window.setInterval(() => {
        this.fillData()
      }, 1800000)
    },
    methods: {
      filterData() {
        axios
          .get("/getFilterTarget")
          .then(response =>{
            // this.roleUser = response.data.roleUser;
            this.arrayTahun = response.data.tahun;
          })
          .catch(error => {});
      },
      fillData () {
        let bulanFilter = this.bulanFilter;
        let tahunFilter = this.tahunFilter;
        axios.get('/getPengeluaran/' + bulanFilter + '/' + tahunFilter).then(response=>{
          this.roleUser = response.data.roleUser;
          this.pengeluaran = response.data.pengeluaran;
          this.month = response.data.month;
          this.year = response.data.tahun;
          this.lahan = response.data.lahan;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
            type : 'bar',
            data:{
              labels:response.data.lahan,
              datasets:[{
                label               : 'Pupuk',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(54, 162, 235, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.pupuk,
                // fill                : false,
              },
              {
                label               : 'Alat Tani',
                backgroundColor     : 'rgba(254, 99, 131, 1)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(254, 99, 131, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.alatTani,
                // fill                : false,
              },
              {
                label               : 'Pestisida',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.pestisida,
                // fill                : false,
              },
              {
                label               : 'Lainnya',
                backgroundColor     : 'rgba(247, 249, 127, 1)',
                borderColor         : 'rgba(247, 249, 127, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(247, 249, 127, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(247, 249, 127, 1)',
                data                : response.data.lainnya,
                fill                : false,
              }]
            },
            options:{
              barValueSpacing:100,
              responsive: true,
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
                  scaleLabel: {
                    display:true,
                    labelString : 'Nama Lahan'
                  },
                  // stacked: true,
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes:[{
                  scaleLabel: {
                    display:true,
                    labelString : 'Rp'
                  },
                  // stacked: true,
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
    }
  }
</script>
