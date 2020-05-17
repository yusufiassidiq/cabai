<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap Harga Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Rekap Harga</li>
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
                <h5 class="card-title">Grafik Harga Cabai Rawit</h5>

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
                      <strong>Harga Cabai Rawit 15 Hari Terakhir</strong>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Harga Cabai Keriting</h5>

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
                      <strong>Harga Cabai Keriting 15 Hari Terakhir</strong>
                    </p>

                    <div class="chart">
                      <!-- Pengeluaran Chart Canvas -->
                      <canvas ref="chart2" height="100" style="height: 100px;"></canvas>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Harga Cabai Besar</h5>

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
                      <strong>Harga Cabai Besar 15 Hari Terakhir</strong>
                    </p>

                    <div class="chart">
                      <!-- Pengeluaran Chart Canvas -->
                      <canvas ref="chart3" height="100" style="height: 100px;"></canvas>
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
      </div>
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
</template>
<script>
  import { Line } from 'vue-chartjs'

  export default {
    data(){
      return{
        dateNow : {},
        start: {},
        end : {},
        data:{},
        date: {}
      };
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        axios.get('/getHarga').then(response=>{
          this.dateNow = response.data.dateNow;
          this.date = response.data.date;
          this.data = response.data.data;
          this.start = response.data.start;
          this.end = response.data.end;                              
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
              type                : 'line',
            data:{
              labels:response.data.date,
              datasets:[
              {
                // type                : 'bar',
                label               : 'Produsen',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(54, 162, 235, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.rawitProdusen,
                pointStyle          : 'rect',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Pengepul',
                backgroundColor     : 'rgba(254, 99, 131, 1)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(254, 99, 131, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.rawitPengepul,
                pointStyle          : 'triangle',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Grosir',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.rawitGrosir,
                pointStyle          : 'circle',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                label               : 'Pengecer',
                backgroundColor     : 'rgba(255,129,0, 1)',
                borderColor         : 'rgba(255,129,0, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(255,129,0, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255,129,0, 1)',
                data                : response.data.rawitPengecer,
                pointStyle          : 'rectRot',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              ]
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
                    // stacked: true,
                    gridLines : {
                        display : false,
                    }
                    
                }],
                yAxes:[{
                    // stacked: true,
                        gridLines : {
                        display : false,
                        },
                  ticks:{
                    beginAtZero:true,
                  }
                }]
              }
            }
          });
          var chart2 = this.$refs.chart2;
          var ctx2 = chart2.getContext("2d");
          var myChart2 = new Chart(ctx2, {
              type                : 'line',
            data:{
              labels:response.data.date,
              datasets:[
              {
                // type                : 'bar',
                label               : 'Produsen',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(54, 162, 235, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.keritingProdusen,
                pointStyle          : 'rect',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Pengepul',
                backgroundColor     : 'rgba(254, 99, 131, 1)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(254, 99, 131, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.keritingPengepul,
                pointStyle          : 'triangle',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Grosir',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.keritingGrosir,
                pointStyle          : 'circle',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                label               : 'Pengecer',
                backgroundColor     : 'rgba(255,129,0, 1)',
                borderColor         : 'rgba(255,129,0, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(255,129,0, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255,129,0, 1)',
                data                : response.data.keritingPengecer,
                pointStyle          : 'rectRot',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              ]
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
                    // stacked: true,
                    gridLines : {
                        display : false,
                    }
                    
                }],
                yAxes:[{
                    // stacked: true,
                        gridLines : {
                        display : false,
                        },
                  ticks:{
                    beginAtZero:true,
                  }
                }]
              }
            }
          });
          var chart3 = this.$refs.chart3;
          var ctx3 = chart3.getContext("2d");
          var myChart3 = new Chart(ctx3, {
              type                : 'line',
            data:{
              labels:response.data.date,
              datasets:[
              {
                // type                : 'bar',
                label               : 'Produsen',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(54, 162, 235, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.besarProdusen,
                pointStyle          : 'rect',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Pengepul',
                backgroundColor     : 'rgba(254, 99, 131, 1)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(254, 99, 131, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.besarPengepul,
                pointStyle          : 'triangle',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                // type                : 'bar',
                label               : 'Grosir',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.besarGrosir,
                pointStyle          : 'circle',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              {
                label               : 'Pengecer',
                backgroundColor     : 'rgba(255,129,0, 1)',
                borderColor         : 'rgba(255,129,0, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(255,129,0, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255,129,0, 1)',
                data                : response.data.besarPengecer,
                pointStyle          : 'rectRot',
                pointRadius         : 5,
                pointHoverRadius    : 10,
                fill                : false,
              },
              ]
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
                    // stacked: true,
                    gridLines : {
                        display : false,
                    }
                    
                }],
                yAxes:[{
                    // stacked: true,
                        gridLines : {
                        display : false,
                        },
                  ticks:{
                    beginAtZero:true,
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
