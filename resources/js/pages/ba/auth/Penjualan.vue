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
                <a href="#">{{ roleUser | filterRoleName }}</a>
              </li>
              <li class="breadcrumb-item active">Rekap Penjualan</li>
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
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                 <!-- FORM FILTER BERDASARKAN BULAN DAN TAHUN -->
                <div class="row"> 
                  <div class="col-md-3 form-group">
                    <label for="">Pilih Bulan</label>
                    <select class="form-control select2" 
                            @change="getData"
                            v-model="bulan">
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
                  <div class="col-md-3 form-group">
                    <label for="">Pilih Tahun</label>
                    <select class="form-control select2"
                            @change="getData"
                            v-model="tahun">>
                        <option v-for="t in arrayTahun" :key="t" v-bind:value="t">{{ t }}</option>
                    </select>
                  </div>
                </div>
                <!-- FORM FILTER BERDASARKAN BULAN DAN TAHUN -->
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Penjualan Cabai</h5>

                <div class="card-tools">
                  <a id="download">
                        <button class="btn btn-primary float-right bg-flat-color-1" @click="downloadChart">
                        <!-- Download Icon -->
                        <i class="fa fa-download"></i>
                        </button>
                      </a>
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <!-- <p class="text-center">
                      <strong>Penjualan (Kg): {{start}} - {{end}}</strong>
                    </p> -->

                    <div class="chart">
                      <!-- Pengeluaran Chart Canvas -->
                      <canvas id=chart ref="chart" height="100" style="height: 100px;"></canvas>
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
                  <!-- TOMBOL UNTUK EXPORT DATA KE EXCEL -->
                  <vue-excel-xlsx
                    class = "btn btn-primary float-right bg-flat-color-1"
                    :data="data"
                    :columns="columns"
                    :filename="'Penjualan Cabai ' + this.monthYearNow"
                    :sheetname="this.monthYearNow"
                    >
                    <i class="fas fa-download fa-fw"></i>
                  </vue-excel-xlsx>
                  <!-- TOMBOL UNTUK EXPORT DATA KE EXCEL --> 
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button> -->
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
                <div class="row">
                  <table id="mytable" class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Tanggal Transaksi</th>
                        <th>Cabai Rawit (Kg)</th>
                        <th>Cabai Keriting (Kg)</th>
                        <th>Cabai Besar (Kg)</th>
                        <th>Jumlah Cabai (Kg)</th>
                        <th>Total Penjualan (Rp)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="transaksi in data" :key="transaksi.tanggal_transaksi">
                        <td>{{transaksi.tanggal_transaksi}}</td>
                        <td>{{transaksi.jumlah_rawit | filterAngkaRibuan}}</td>
                        <td>{{transaksi.jumlah_keriting | filterAngkaRibuan}}</td>
                        <td>{{transaksi.jumlah_besar | filterAngkaRibuan}}</td>
                        <td>{{transaksi.jumlah_cabai | filterAngkaRibuan}}</td>
                        <td>{{transaksi.total_transaksi | convertToRupiah}}</td>
                      </tr>
                      <!-- end example data -->
                    </tbody>
                  </table>
                </div>
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
  import XLSX from 'xlsx'

  export default {
    data(){
      return{
        roleUser : "",
        //filter
        bulan: moment().format('MM'), //DEFAULT BULAN YG AKTIF BERDASARKAN BULAN SAAT INI
        tahun: moment().format('Y'), //DEFAULT TAHUN YG AKTIF BERDASARKAN TAHUN SAAT INI
        
        //Table&Graph
        monthYearNow : "",
        start: "",
        end : "",
        data:"",
        arrayTahun:"",
        
        //download table
        columns : [
          {
              label: "Tanggal Transaksi",
              field: "tanggal_transaksi",
          },
          {
              label: "Cabai Rawit (Kg)",
              field: "jumlah_rawit",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Cabai Keriting (Kg)",
              field: "jumlah_keriting",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Cabai Besar (Kg)",
              field: "jumlah_besar",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Jumlah Cabai (Kg)",
              field: "jumlah_cabai",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Total Penjualan (Rp)",
              field: "total_transaksi",
              dataFormat: this.$options.filters.convertToRupiah
          },
        ],
        
      };
    },
    mounted () {
      this.filterData(),
      this.getData()
      // window.setInterval(() => {
      //   this.getData()
      // }, 1800000)
    },
    methods: {
      downloadChart(){
        /*get download button (tag: <a></a>) */
        var download = document.getElementById("download");
        /*Get image of canvas element*/
        var image = document.getElementById("chart").toDataURL("image/png");
        /*insert chart image url to download button (tag: <a></a>) */
        download.setAttribute("href", image);
        download.setAttribute('download', 'Grafik Penjualan '+this.monthYearNow + '.png');
      },
      filterData() {
        axios
          .get("/getFilterPenjualan")
          .then(response =>{
            this.roleUser = response.data.roleUser;
            this.arrayTahun = response.data.tahun;
          })
          .catch(error => {});
      },
      getData () {
        let bulan = this.bulan;
        let tahun = this.tahun;
        axios.get('/getPenjualan/'+ bulan + '/' + tahun)
          .then(response=>{
          this.roleUser = response.data.roleUser;
          this.monthYearNow = response.data.monthYearNow;
          this.data = response.data.data;
          this.start = response.data.start;
          this.end = response.data.end;                              
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
              type                : 'line',
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
              title:{
                display : true,
                fontSize : 16,
                fontColor : '#333',
                text : 'Penjualan (Kg): ' + this.start + ' - ' + this.end,
              },
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
                    scaleLabel: {
                      display:true,
                      labelString : 'Tanggal'
                    },
                    gridLines : {
                        display : false,
                    }
                }],
                yAxes:[{
                  scaleLabel: {
                    display:true,
                    labelString : 'Kg'
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
