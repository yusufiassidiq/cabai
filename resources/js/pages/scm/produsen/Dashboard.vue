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
                <a href="#">{{ roleUser | filterRoleName}}</a>
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon elevation-1" v-bind:style="{backgroundColor: '#a0622d',color:'#ffffff'}"><i class="fas fa-seedling"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Produktivitas Tertinggi</span>
                <span class="info-box-number">{{ maxProduktivitas }} Kg/ha</span>
                <span class="info-box-number">{{ maxKodeLahan }}</span>
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
                <h5 class="card-title">Rekap Penjualan Bulan {{ bulan }} {{ year }}</h5>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <p class="text-center">
                        <strong>Penjualan: {{ start }} - {{end}}</strong>
                    </p>
                    <div class="chart">
                      <!-- Pengeluaran Chart Canvas -->
                      <canvas ref="chart" style="height: 300px;"></canvas>
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
              <!-- <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
              </div> -->
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-md-8">
                    <p class="text-center">
                      <strong>Penjualan: {{ start }} - {{end}}</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas ref="chart2" height="250" style="height: 250px;"></canvas>
                      <!-- <canvas id="salesChart" height="180" style="height: 180px;"></canvas> -->
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-4">
                    <p class="text-center">
                      <strong>Pencapaian Target</strong>
                    </p>

                    <div class="progress-group"  v-for="data in penjualanTarget" :key="data.jenis">
                      {{ data.jenis }}
                      <span class="float-right"><b>{{ data.terjual | filterRealisasiTarget }}</b>{{ data.gap | filterGapTarget }}</span>
                      <div class="progress progress-sm">
                        <div class="progress-bar progress-bar-striped" v-bind:style="{backgroundColor: getColorProgress(data.ach), width: data.ach + '%'}"></div>
                      </div>
                      <!-- <span class="progress-description float-right">
                        {{ data.gap | filterGapTarget }}
                      </span><br> -->
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
                      <span class="description-text">TOTAL PENDAPATAN</span>
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
        roleUser :"",
        penjualanTarget : "",
        start : "",
        end : "",
        maxHargaQty :"",
        maxHargaJenis : "",
        maxJumlahQty :"",
        maxJumlahJenis : "",
        minJumlahQty :"",
        minJumlahJenis : "",
        maxProduktivitas : "",
        maxKodeLahan: "",
        year : "",
        bulan : "",
        pemasukanTotal: "",
        mtdPemasukan : "",
        pengeluaranTotal: "",
        mtdPengeluaran : "",
        labaTotal : "",
        mtdLaba : "",
        terjualTotal : "",
        mtdTerjual : "",
        jml_cabai_rawit:"",
        jml_cabai_besar:"",
        jml_cabai_keriting:"",
        jml_mitra_dimiliki:"",
        jml_pengajuan_mitra:"",
        jml_permintaan_mitra:"",
      };
    },
    mounted () {
      this.getData()
      this.getInventaris()
      this.getInfoKemitraan()
      window.setInterval(() => {
        this.getData()
        this.getInventaris()
        this.getInfoKemitraan()
      }, 1800000)
    },
    methods: {
      getColorProgress:function(value){
        if(value=='-')
          return "#909090";
        else if(value>=85)
          return "#00a65a";
        else if(value>=50)
          return "#e98b2d";
        else if(value>=0)
          return "#dd4b39";
      },
      getColor: function(item){
        if(parseInt(item)<0){
          return '#e3342f';
        }
        else if(parseInt(item)==0){
          return '#fcd12a';
        }
        else if(parseInt(item)>0){
          return '#38c172';
        }
      },
      getClass:function(item){
        if(parseInt(item) < 0){
          return "fas fa-caret-down";
        }
        else if(parseInt(item) == 0){
          return "fas fa-caret-left";
        }
        else if(parseInt(item) > 0){
          return "fas fa-caret-up";
        }
      },
      getData () {
        axios.get('/getSummaryProdusen').then(response=>{
          this.roleUser = response.data.roleUser;
          this.year = response.data.year;
          this.bulan = response.data.bulan;
          this.start = response.data.start;
          this.end = response.data.end;
          this.mtdPemasukan = response.data.mtdPemasukan;
          this.pemasukanTotal = response.data.pemasukanTotal;
          this.mtdPengeluaran = response.data.mtdPengeluaran;
          this.pengeluaranTotal = response.data.pengeluaranTotal;
          this.mtdLaba = response.data.mtdLaba;
          this.labaTotal = response.data.labaTotal;
          this.mtdTerjual = response.data.mtdTerjual;
          this.terjualTotal = response.data.terjualTotal;
          this.penjualanTarget = response.data.penjualanTarget;
          this.maxHargaQty = response.data.maxHargaQty;
          this.maxHargaJenis = response.data.maxHargaJenis;
          this.maxJumlahQty = response.data.maxJumlahQty;
          this.maxJumlahJenis = response.data.maxJumlahJenis;
          this.minJumlahQty = response.data.minJumlahQty;
          this.minJumlahJenis = response.data.minJumlahJenis;
          this.maxProduktivitas = response.data.maxProduktivitas;
          this.maxKodeLahan = response.data.maxKodeLahan;
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
                    labelString : 'Rp (ribu)'
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
          var chart2 = this.$refs.chart2;
          var ctx2 = chart2.getContext("2d");
          var myChart2 = new Chart(ctx2, {
            type : 'bar',
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