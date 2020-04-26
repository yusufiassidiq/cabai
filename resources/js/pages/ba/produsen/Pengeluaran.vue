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
  import { Bar } from 'vue-chartjs'

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
            type : 'bar',
            data:{
              labels:response.data.month,
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
