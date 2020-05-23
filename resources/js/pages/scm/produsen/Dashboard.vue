<template>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Produsen</a>
              </li>
              <li class="breadcrumb-item active">Dashboard</li>
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
        <div class="row" v-show="role != 6">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info red">
              <div class="inner">
                <h3>{{jml_cabai_besar}} kg</h3>
                <p>ketersediaan cabai besar</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  {{jml_cabai_keriting}} kg
                </h3>
                <p>ketersediaan cabai keriting</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{jml_cabai_rawit}} kg</h3>
                <p>ketersediaan cabai rawit</p>
              </div>
            </div>
          </div>
          <!-- ./col -->
          
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{jml_mitra_dimiliki}}</h3>

                <p>Mitra dimiliki</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-friends"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  {{jml_permintaan_mitra}}
                </h3>
                <p>Permintaan mitra dari pengguna lain</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-clock"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{jml_pengajuan_mitra}}</h3>

                <p>Permintaan Mitra dari saya</p>
              </div>
              <div class="icon">
                <i class="fas fa-user-clock"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Harga Tertinggi</span>
                <span class="info-box-number">{{ maxHargaQty | convertToRupiah }}/Kg</span>
                <span class="info-box-number">{{ maxHargaJenis }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Penjualan Terendah</span>
                <span class="info-box-number">{{ minJumlahQty }} Kg</span>
                <span class="info-box-number">{{ minJumlahJenis }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Penjualan terbanyak</span>
                <span class="info-box-number">{{ maxJumlahQty }} Kg</span>
                <span class="info-box-number">{{ maxJumlahJenis }}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12"  v-for="data in penjualanTarget" :key="data.jenis">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{ data.jenis }}</span>
                <span class="info-box-number">{{ data.terjual | convertToRupiah }}</span>

                <div class="progress">
                  <div class="progress-bar" v-bind:style="{width: data.ach}"></div>
                </div>
                <span class="progress-description">
                  {{ data.ach }}<br>
                  Kurang {{ data.gap |convertToRupiah }} 
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box bg-info">
              <span class="info-box-icon"><i class="far fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Target</span>
                <span class="info-box-number">{{ terjualTotal | convertToRupiah }}</span>

                <div class="progress">
                  <div class="progress-bar" v-bind:style="{width: achTotal}"></div>
                </div>
                <span class="progress-description">
                  {{ achTotal }}<br>
                  Kurang {{ gapTotal | convertToRupiah }}
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Rekap Penjualan Bulan Mei</h5>
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
                        <strong>Pendapatan dan Pengeluaran</strong>
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
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Rekap Penjualan Bulan Mei</h5>
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
                        <strong>Pendapatan dan Target</strong>
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
        penjualanTarget : {},
        maxHargaQty :{},
        maxHargaJenis : {},
        year : {},
        terjualTotal : {},
        achTotal : {},
        gapTotal : {},

        jml_cabai_rawit:"",
        jml_cabai_besar:"",
        jml_cabai_keriting:"",
        jml_mitra_dimiliki:"",
        jml_pengajuan_mitra:"",
        jml_permintaan_mitra:""
      };
    },
    mounted () {
      this.fillData()
      
      this.getInventaris()
      this.getInfoKemitraan()
      
      window.setInterval(() => {
        this.getInventaris()
        this.getInfoKemitraan()
      }, 1800000)
    },
    methods: {
      fillData () {
        axios.get('/getGapAch').then(response=>{
          this.year = response.data.tahun;
          this.terjualTotal = response.data.terjualTotal;
          this.achTotal = response.data.achTotal;
          this.gapTotal = response.data.gapTotal;
          this.penjualanTarget = response.data.penjualanTarget;
          this.maxHargaQty = response.data.maxHargaQty;
          this.maxHargaJenis = response.data.maxHargaJenis;
          this.maxJumlahQty = response.data.maxJumlahQty;
          this.maxJumlahJenis = response.data.maxJumlahJenis;
          this.minJumlahQty = response.data.minJumlahQty;
          this.minJumlahJenis = response.data.minJumlahJenis;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
            type : 'bar',
            data:{
              labels:response.data.last6Month,
              datasets:[{
                label               : 'Pemasukan',
                backgroundColor     : 'rgba(74, 192, 192, 1)',
                borderColor         : 'rgba(74, 192, 192, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(74, 192, 192, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(74, 192, 192, 1)',
                data                : response.data.pemasukan,
                fill                : true,
              },
              {
                label : 'Pengeluaran',
                backgroundColor     : 'rgba(255, 0, 0, 0.8)',
                borderColor         : 'rgba(255, 0, 0, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(255, 0, 0, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255, 0, 0, 1)',
                data                : response.data.pengeluaran,
                fill                : true,
              },
            //   
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
                  scaleLabel: {
                    display:true,
                    labelString : 'Bulan'
                  },
                  // stacked: true,
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes:[{
                  // stacked: true,
                  scaleLabel: {
                    display:true,
                    labelString : 'Rp (ribu)'
                  },
                  // gridLines : {
                  //   display : false,
                  // },
                  // ticks:{
                  //   beginAtZero:true
                  // }
                }]
              }
            }
          }); 
          var chart2 = this.$refs.chart2;
          var ctx2 = chart2.getContext("2d");
          var myChart2 = new Chart(ctx2, {
            type : 'bar',
            data:{
              labels:response.data.last6Month,
              datasets:[
              {
                label               : 'Target',
                backgroundColor     : 'rgba(254, 99, 131, 0.8)',
                borderColor         : 'rgba(254, 99, 131, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(254, 99, 131, 1)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(254, 99, 131, 1)',
                data                : response.data.target,
                fill                : true,
              },
              {
                label               : 'Realisasi',
                backgroundColor     : 'rgba(54, 162, 235, 1)',
                borderColor         : 'rgba(54, 162, 235, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(54, 162, 235, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(54, 162, 235, 1)',
                data                : response.data.pemasukan,
                fill                : true,
              },
              
            //   
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
                  scaleLabel: {
                    display:true,
                    labelString : 'Bulan'
                  },
                  // stacked: true,
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes:[{
                  // stacked: true,
                  scaleLabel: {
                    display:true,
                    labelString : 'Rp (ribu)'
                  },
                  // gridLines : {
                  //   display : false,
                  // },
                  // ticks:{
                  //   beginAtZero:true
                  // }
                }]
              }
            }
          }); 
        }).catch(error => {
          console.log(error)
          this.errored= true
        });
      },
      getInventaris() {
      axios.get("/inventaris/list").then(response => {
        // cabai besar
        if(response.data.data[0].jenis_cabai = "Cabai besar")
        this.jml_cabai_besar = response.data.data[0].jumlah_cabai
        // cabai rawit
        if(response.data.data[1].jenis_cabai = "Cabai rawit")
        this.jml_cabai_rawit = response.data.data[1].jumlah_cabai
        // cabai keriting
        if(response.data.data[2].jenis_cabai = "Cabai keriting")
        this.jml_cabai_keriting = response.data.data[2].jumlah_cabai
      });
    },
    getInfoKemitraan(){
      axios.get("/kemitraan/mitra/info").then(response => {
      this.jml_mitra_dimiliki = response.data.data.jml_mitra_saya
      this.jml_pengajuan_mitra = response.data.data.jml_pengajuan_mitra
      this.jml_permintaan_mitra = response.data.data.jml_permintaan_mitra
      
    })
    }
    },
  }
</script>
