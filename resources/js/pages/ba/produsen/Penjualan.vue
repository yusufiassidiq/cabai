<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap Penjualan Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Laporan Penjualan</li>
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
                <h5 class="card-title">Grafik Penjualan Cabai</h5>

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
                      <strong>Penjualan (Kg): {{start}} - {{end}}</strong>
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
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Penjualan Cabai Bulan {{monthYearNow}}</h3>

                <div class="card-tools">
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
              <!-- FORM FILTER BERDASARKAN BULAN DAN TAHUN -->
              <!-- <form role="form">
                <div class="card-body">  
                  <div class="col-md-5">
                      <div class="form-group">
                          <label for="">Bulan</label>
                          <select v-model="month" class="form-control">
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
                      </div>
                  </div>
                  <div class="col-md-5">
                      <div class="form-group">
                          <label for="">Tahun</label>
                          <select v-model="year" class="form-control">
                              <option v-for="(y, i) in years" :key="i" :value="y">{{ y }}</option>
                          </select>
                      </div>
                  </div>
              </div>
              </form> -->
              <!-- FORM FILTER BERDASARKAN BULAN DAN TAHUN -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <!-- <th>No</th> -->
                      <!-- <th>ID </th> -->
                      <th>Tanggal Transaksi</th>
                      <!-- <th>Jenis Cabai</th> -->
                      <th>Jumlah Cabai (Kg)</th>
                      <th>Total Penjualan (Rp)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="transaksi in data" :key="transaksi.tanggal_diterima">
                      <!-- <td></td> -->
                      <!-- <td>{{ data.id }}</td> -->
                      <td>{{transaksi.tanggal_diterima}}</td>
                      <!-- <td>coba</td> -->
                      <td>{{transaksi.jumlah_cabai}}</td>
                      <td>{{transaksi.total_transaksi}}</td>
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
  </div>
<!-- /.content-wrapper -->
</template>

<script>
  import { Bar } from 'vue-chartjs'

  export default {
    data(){
      return{
        monthYearNow : {},
        start: {},
        end : {},
        data:{},
      };
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        axios.get('/getPenjualan').then(response=>{
          this.monthYearNow = response.data.monthYearNow;
          this.data = response.data.data;
          this.start = response.data.start;
          this.end = response.data.end;                              
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
              type                : 'bar',
            data:{
              labels:response.data.tanggal,
              datasets:[
              {
                // type                : 'bar',
                label               : 'Rawit',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(54, 162, 235, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.rawit,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Keriting',
                backgroundColor     : 'rgba(254, 99, 131, 1)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(254, 99, 131, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.keriting,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Besar',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.besar,
                fill                : false,
              }]
            },
            options:{
              responsive: true,
              tooltips:{
                mode:'index',
                intersect: false,
              },
            //   hover:{
            //     mode: 'nearest',
            //     intersect: true,
            //   },
            //   snapGaps: false,
              // elements:{
              //   line:{
              //     tension: 0.000001
              //   }
              // },
              scales:{
                xAxes: [{
                    stacked: true,
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes:[{
                    stacked: true,
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
