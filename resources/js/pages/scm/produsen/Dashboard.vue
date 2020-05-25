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
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill-wave"></i></span>

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
                <h5 class="card-title">Monthly Recap Report</h5>

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
                  <div class="col-md-9">
                    <p class="text-center">
                      <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas ref="chart2" height="250" style="height: 250px;"></canvas>
                      <!-- <canvas id="salesChart" height="180" style="height: 180px;"></canvas> -->
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                    <p class="text-center">
                      <strong>Pencapaian Target</strong>
                    </p>

                    <div class="progress-group"  v-for="data in penjualanTarget" :key="data.jenis">
                      {{ data.jenis }}
                      <span class="float-right"><b>{{ data.terjual | filterRealisasiTarget }}</b></span>
                      <div class="progress progress-sm">
                        <div class="progress-bar progress-bar-striped" v-bind:style="{backgroundColor: data.warna, width: data.ach + '%'}"></div>
                      </div>
                      <span class="progress-description float-right">
                        {{ data.gap | filterGapTarget }}
                      </span><br>
                    </div>
                    <!-- /.progress-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage" v-bind:style="{color:getColor(mtdPemasukan)}">
                        <i v-bind:class="getClass(mtdPemasukan)"></i> {{ mtdPemasukan | angkaPersentase }}</span>
                      <h5 class="description-header">{{ pemasukanTotal | convertToRupiah }}</h5>
                      <span class="description-text">TOTAL PEMASUKAN</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage" v-bind:style="{color:getColor(mtdPengeluaran)}">
                        <i v-bind:class="getClass(mtdPengeluaran)"></i> {{ mtdPengeluaran | angkaPersentase }}</span>
                      <h5 class="description-header">{{ pengeluaranTotal | convertToRupiah }}</h5>
                      <span class="description-text">TOTAL PENGELUARAN</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block border-right">
                      <span class="description-percentage" v-bind:style="{color:getColor(mtdLaba)}">
                        <i v-bind:class="getClass(mtdLaba)"></i> {{ mtdLaba | angkaPersentase }}</span>
                      <h5 class="description-header">{{ labaTotal | convertToRupiah }}</h5>
                      <span class="description-text">TOTAL LABA</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <span class="description-percentage" v-bind:style="{color:getColor(mtdTerjual)}">
                        <i v-bind:class="getClass(mtdTerjual)"></i> {{ mtdTerjual | angkaPersentase }}</span>
                      <h5 class="description-header">{{ terjualTotal | filterAngkaRibuan }} Kg</h5>
                      <span class="description-text">TOTAL PENJUALAN</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
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
  import { Line } from 'vue-chartjs'

  export default {
    data(){
      return{
        penjualanTarget : {},
        maxHargaQty :{},
        maxHargaJenis : {},
        year : {},
      //summary month now
        //pemasukan
        pemasukanTotal: {},
        mtdPemasukan : {},
        // warnaPemasukan : {},
        // flagPemasukan : {},
        //pengeluaran
        pengeluaranTotal: {},
        mtdPengeluaran : {},
        //laba
        labaTotal : {},
        mtdLaba : {},
        //penjualan
        terjualTotal : {},
        mtdTerjual : {},
        // achTotal : {},
        // gapTotal : {},
        myStyle:{
          color:"#16a085",
        }
      };
    },
    mounted () {
      this.fillData()
    },
    computed:{
      // classPemasukan:function(){
      //   if(this.flagPemasukan === -1){
      //     return "fas fa-caret-down";
      //   }
      //   else if(this.flagPemasukan === 0){
      //     return "fas fa-caret-left";
      //   }
      //   else if(this.flagPemasukan === 1){
      //     return "fas fa-caret-up";
      //   }
      //   else{
      //     return " ";
      //   }
      },
    methods: {
      getColor: function(item){
        if(item<0){
          return '#e3342f';
        }
        else if(item===0){
          return '#ffed4a';
        }
        else if(item>0){
          return '#38c172';
        }
      },
      getClass:function(item){
        if(item < 0){
          return "fas fa-caret-down";
        }
        else if(item === 0){
          return "fas fa-caret-left";
        }
        else if(item > 0){
          return "fas fa-caret-up";
        }
        else{
          return " ";
        }
      },
      fillData () {
        axios.get('/getGapAch').then(response=>{
          this.year = response.data.tahun;
          this.mtdPemasukan = response.data.mtdPemasukan;
          // this.warnaPemasukan = response.data.warnaPemasukan;
          // this.flagPemasukan = response.data.flagPemasukan;
          this.pemasukanTotal = response.data.pemasukanTotal;
          this.mtdPengeluaran = response.data.mtdPengeluaran;
          this.pengeluaranTotal = response.data.pengeluaranTotal;
          this.mtdLaba = response.data.mtdLaba;
          this.labaTotal = response.data.labaTotal;
          this.mtdTerjual = response.data.mtdTerjual;
          this.terjualTotal = response.data.terjualTotal;
          // this.achTotal = response.data.achTotal;
          // this.gapTotal = response.data.gapTotal;
          this.penjualanTarget = response.data.penjualanTarget;
          if(this.achTotal>=85){
            this.myStyle.color="#00a65a";
          }
          else if(this.achTotal>=50){
            this.myStyle.color="#e98b2d";
          }
          else if(this.achTotal>=0){
            this.myStyle.color="#dd4b39";
          }
          // else{
          //   this.myStyle.color="#909090";
          // } 
          // console.log(this.penjualanTarget[]);
          // if(this.pen>=85){
          //   this.myStyle.backgroundColor="#00a65a";
          // }
          // else if(this.achTotal>=50){
          //   this.myStyle.backgroundColor="#f39c12";
          // }
          // else if(this.achTotal>=0){
          //   this.myStyle.backgroundColor="#dd4b39";
          // } 
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
                label               : 'Pengeluaran',
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
                  ticks:{
                    beginAtZero:true
                  }
                }]
              }
            }
          }); 
          var chart2 = this.$refs.chart2;
          var ctx2 = chart2.getContext("2d");
          var myChart2 = new Chart(ctx2, {
            type : 'line',
            data:{
              labels:response.data.last6Month,
              datasets:[
              {
                label               : 'Target',
                backgroundColor     : 'rgba(259, 99, 131, 0.9)',
                borderColor         : 'rgba(259, 99, 131, 0.8)',
                pointRadius         : true,
                pointColor          : '#35a0e9',
                pointStrokeColor    : 'rgba(259, 99, 131, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(259, 99, 131, 1)',
                data                : response.data.target,
                // fill                : true,
              },
              {
                label               : 'Realisasi',
                backgroundColor     : 'rgba(201, 222, 235, 1)',
                borderColor         : 'rgba(201, 222, 235, 1)',
                pointRadius         : true,
                pointColor          : 'rgba(201, 222, 235, 1)',
                pointStrokeColor    : '#d0e3f8',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(201, 222, 235, 1)',
                data                : response.data.penjualan,
                // fill                : true,
              },
              
              
            //   
            ]
            },
            options:{
              maintainAspectRatio : false,
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
                    labelString : 'Kg'
                  },
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