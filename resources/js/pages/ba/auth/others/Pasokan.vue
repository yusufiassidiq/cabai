<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Rekap Pasokan Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">{{ roleUser | filterRoleName }}</a>
              </li>
              <li class="breadcrumb-item active">Rekap Pasokan</li>
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
        <div v-show= "checkPemasok!==null" class="row justify-content-center">
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
        <div v-show= "pemasok!==null" class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Grafik Pasokan Cabai</h5>
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
                  <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row justify-content-center">
                  <div class="col-md-12">
                    <!-- <p class="text-center">
                      <strong>Pasokan Cabai {{ rangePasokan }}</strong>
                      
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
        <div v-show= "checkPemasok!==null" class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pasokan Cabai Bulan {{rangePasokan}}</h3>

                <div class="card-tools">
                  <!-- TOMBOL UNTUK EXPORT DATA KE EXCEL -->
                  <vue-excel-xlsx
                    class = "btn btn-primary float-right bg-flat-color-1"
                    :data="pasokan"
                    :columns="columns"
                    :filename="'Pasokan ' + this.rangePasokan"
                    :sheetname="this.rangePasokan"
                    >
                    <i class="fas fa-download fa-fw"></i>
                  </vue-excel-xlsx>
                  <!-- TOMBOL UNTUK EXPORT DATA KE EXCEL --> 
                </div>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body table-responsive p-0">
                <div class="row">
                  <table class="table table-hover text-nowrap">
                    <thead>
                      <tr>
                        <th>Tanggal</th>
                        <th>Cabai Rawit (Kg)</th>
                        <th>Cabai Keriting (Kg)</th>
                        <th>Cabai Besar (Kg)</th>
                        <th>Total Pasokan (Kg)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="p in pasokan" :key="p.tanggal">
                        <td>{{p.tanggal}}</td>
                        <td>{{p.rawit | filterAngkaRibuan}}</td>
                        <td>{{p.keriting | filterAngkaRibuan}}</td>
                        <td>{{p.besar | filterAngkaRibuan}}</td>
                        <td>{{p.total | filterAngkaRibuan}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
        <div v-if= "checkPemasok===null" class="row">
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
        //filter
        bulanFilter: moment().format('MM'), //DEFAULT BULAN YG AKTIF BERDASARKAN BULAN SAAT INI
        tahunFilter: moment().format('Y'), //DEFAULT TAHUN YG AKTIF BERDASARKAN TAHUN SAAT INI
        arrayTahun:"",

        rangePasokan : "",
        roleUser : "",
        pemasok : "",
        totalRawit : "",
        totalKeriting : "",
        totalBesar : "",

        //tabel
        pasokan : "",

        //download tabel
        columns : [
          {
              label: "Tanggal",
              field: "tanggal",
          },
          {
              label: "Cabai Rawit (Kg)",
              field: "rawit",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Cabai Keriting (Kg)",
              field: "keriting",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Cabai Besar (Kg)",
              field: "besar",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
          {
              label: "Jumlah Cabai (Kg)",
              field: "total",
              dataFormat: this.$options.filters.filterAngkaRibuan
          },
        ],
      };
    },
    mounted () {
      this.filterData()
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
      downloadChart(){
        /*get download button (tag: <a></a>) */
        var download = document.getElementById("download");
        /*Get image of canvas element*/
        var image = document.getElementById("chart").toDataURL("image/png");
        /*insert chart image url to download button (tag: <a></a>) */
        download.setAttribute("href", image);
        download.setAttribute('download', 'Grafik Penjualan '+ this.rangePasokan + '.png');
      },
      filterData() {
        axios
          .get("/getFilterPasokan")
          .then(response =>{
            // this.roleUser = response.data.roleUser;
            this.arrayTahun = response.data.tahun;
          })
          .catch(error => {});
      },
      fillData () {
        let bulanFilter = this.bulanFilter;
        let tahunFilter = this.tahunFilter;
        axios.get('/getPasokan/' + bulanFilter + '/' + tahunFilter).then(response=>{
          this.roleUser = response.data.roleUser;
          this.pemasok = response.data.pemasok;
          this.checkPemasok = response.data.checkPemasok;
          this.rangePasokan = response.data.rangePasokan;
          this.pasokan = response.data.pasokan;
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
              title:{
                display : true,
                fontSize : 16,
                fontColor : '#333',
                text : 'Pasokan Cabai ' + this.rangePasokan
              }, 
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
                    labelString : 'Kg'
                  },
                  stacked: true,
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes:[{
                  scaleLabel: {
                    display:false,
                    labelString : 'Pemasok'
                  },
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
