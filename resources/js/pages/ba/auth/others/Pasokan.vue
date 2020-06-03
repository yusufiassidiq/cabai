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
        <div v-show= "pemasok!==null" class="row">
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
                        <strong>Pasokan Cabai {{ rangePasokan }}</strong>
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
        <div v-if= "pemasok===null" class="row">
          <div class="col">
            <!-- <div class="card alert alert-warning alert"> -->
            <div class="card callout callout-warning">
                  <h5>
                    <i class="icon fas fa-exclamation-triangle"></i>
                  Belum Ada Data Distribusi Cabai dengan Pemasok
                  </h5>
                  <p>
                  Silahkan Tambah Permintaan Pasokan
                      <router-link v-bind:to="getLink(roleUser)">
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
  import { horizontalBar } from 'vue-chartjs'

  export default {
    data(){
      return{
        rangePasokan : "",
        roleUser : "",
        pemasok : "",
        totalRawit : "",
        totalKeriting : "",
        totalBesar : "",
      };
    },
    mounted () {
      this.fillData()
      window.setInterval(() => {
        this.fillData()
      }, 1800000)
    },
    methods: {
      getLink:function(value){
        if(value === 3)
            return "/pengepul/distribusicabai";
        else if(value === 4)
            return "/grosir/distribusicabai";
        else if(value === 5)
            return "/pengecer/distribusicabai";
      },
      fillData () {
        axios.get('/getPasokan').then(response=>{
          this.roleUser = response.data.roleUser;
          this.pemasok = response.data.pemasok;
          this.rangePasokan = response.data.rangePasokan;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
            type : 'horizontalBar',
            data:{
              labels:response.data.pemasok,
              datasets:[{
                label               : 'CabaiRawit',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(54, 162, 235, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.totalRawit,
              },
              {
                label               : 'Cabai Keriting',
                backgroundColor     : 'rgba(254, 99, 131, 1)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(254, 99, 131, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.totalKeriting,
                // fill                : false,
              },
              {
                label               : 'Cabai besar',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.totalBesar,
                // fill                : false,
              },
            ]
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
