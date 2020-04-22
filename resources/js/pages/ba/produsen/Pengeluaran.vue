<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pengeluaran Poduksi Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
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
        <div class="row">
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
                      <strong>Pengeluaran Tahun {{ year }}</strong>
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
        year : {},
      };
    },
    mounted () {
      this.fillData()
    },
    methods: {
      fillData () {
        axios.get('/getPengeluaran').then(response=>{
          this.year = response.data.tahun;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
            type : 'line',
            data:{
              labels:response.data.month,
              datasets:[{
                label               : 'Pupuk',
                backgroundColor     : 'rgba(60,141,188,0.9)',
                borderColor         : 'rgba(60,141,188,0.8)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(60,141,188,1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data                : response.data.pupuk,
                fill                : false,
              },
              {
                label               : 'Alat Tani',
                backgroundColor     : 'rgba(255, 0, 0, 0.6)',
                borderColor         : 'rgba(255, 0, 0, 0.8)',
                pointRadius         : true,
                pointColor          : 'rgba(255, 0, 0, 0.8)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255, 0, 0, 0.8)',
                data                : response.data.alatTani,
                fill                : false,
              },
              {
                label               : 'Pestisida',
                backgroundColor     : 'rgba(11, 156, 49, 0.8)',
                borderColor         : 'rgba(11, 156, 49, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(11, 156, 49, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(11, 156, 49, 1)',
                data                : response.data.pestisida,
                fill                : false,
              },
              {
                label               : 'Lainnya',
                backgroundColor     : 'rgba(255, 255, 0, 0.8)',
                borderColor         : 'rgba(255, 255, 0, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(255, 255, 0, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255, 255, 0, 1)',
                data                : response.data.lainnya,
                fill                : false,
              }]
            },
            options:{
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
    }
  }
</script>
