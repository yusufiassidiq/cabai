<template>
<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a href="/" class="navbar-brand">
          <img src="/dist/img/icon_cabai.png" class="brand-image" />
          <span class="brand-text font-weight-light">
            <b>CABAI.id</b> - Monitoring Produksi dan Distribusi Cabai Jawa Barat
          </span>
        </a>
        <button
          class="navbar-toggler order-1"
          type="button"
          data-toggle="collapse"
          data-target="#navbarCollapse"
          aria-controls="navbarCollapse"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">
                Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <router-link to="/register" class="nav-link">Daftar</router-link>
            </li>
            <li class="nav-item">
              <router-link to="/login" class="nav-link">Masuk</router-link>
            </li>

            <!-- <li class="nav-item dropdown">
              <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Dropdown</a>
              <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="#" class="dropdown-item">Some action </a></li>
                <li><a href="#" class="dropdown-item">Some other action</a></li>
              </ul>
            </li>-->
          </ul>
        </div>
      </div>
    </nav>
    <!-- /.navbar -->
    
    <vue-progress-bar></vue-progress-bar>

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="custom-container">
          <div class="row">
            <div class="col-6">
              <h2 class="text-dark">
                Produksi
                <small>Provinsi Jawa Barat</small>
              </h2>
            </div>
            <!-- /.col -->
            <div class="col-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <router-link to="/">Home</router-link>
                </li>
                <li class="breadcrumb-item active">Dashboard Jawa Barat</li>
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
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <label>Pilih Daerah</label>
                      <select class="form-control select2" @change="changeHandler" v-model="selectedDaerah" id="daerah" style="width: 100%;">
                        <option disabled value="">PILIH DAERAH</option>
                        <option v-for="daerah in daerah" :key="daerah.id" v-bind:value="daerah.id">{{ daerah.name }}</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="card" id="cardCabai" style="display: none;">
                <div class="card-header">
                  <h5 class="card-title">GRAFIK PRODUKSI CABAI {{ kab.name }} </h5>
                  <!-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div> -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row justify-content-center">
                    <div class="col-md-12">
                      <p class="text-center">
                        <strong>Produksi Cabai Rawit 4 Minggu Terakhir</strong>
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

              <div class="card" id="tabelCabai" style="display: none;">
                <div class="card-header">
                  <h3 class="card-title">PRODUKSI CABAI BULANAN {{kab.name}} TAHUN 2020</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <!-- <th>No</th> -->
                        <!-- <th>ID </th> -->
                        <th>Bulan</th>
                        <!-- <th>Jenis Cabai</th> -->
                        <th>Cabai Rawit (Kg)</th>
                        <th>Cabai Keriting (Kg)</th>
                        <th>Cabai Besar (Kg)</th>
                        <th>Total (Kg)</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="transaksi in data" :key="transaksi.bulan">
                        <!-- <td></td> -->
                        <!-- <td>{{ data.id }}</td> -->
                        <td>{{transaksi.bulan}}</td>
                        <!-- <td>coba</td> -->
                        <td style="text-align:right">{{transaksi.rawit | filterAngkaRibuan}}</td>
                        <td style="text-align:right">{{transaksi.keriting | filterAngkaRibuan}}</td>
                        <td style="text-align:right">{{transaksi.besar | filterAngkaRibuan}}</td>
                        <td style="text-align:right">{{transaksi.total | filterAngkaRibuan}}</td>
                        
                      </tr>
                      <!-- end example data -->
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>


              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>

      <!-- /.content -->
    </div>
    <footer class="main-footer">
      <!-- To the right -->
      <div class="float-right d-none d-sm-inline">Cabai.id</div>
      <!-- Default to the left -->
      <strong>
        Copyright &copy; 2014-2019
        <a href="https://adminlte.io">AdminLTE.io</a>.
      </strong> All rights reserved.
    </footer>
  </div>
</body>
</template>
<script>
import { Line,Bar } from "vue-chartjs";

export default {
  data() {
    return {
      dateNow: {},
      date: {},
      selectedDaerah: '',
      daerah: {},
      kab: {},
      role: {},
      data: "",
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData(){
      axios
        .get("/getDaerah")
        .then(response =>{
          this.daerah = response.data.daerah;
        })
        .catch(error => {});
    },
    changeHandler() {
      let selectedDaerah = this.selectedDaerah;
      axios.get('/getProduksi/'+ selectedDaerah)
        .then(response=>{
          this.$Progress.start();
          console.log(response.data.produksiByDay);
          $("#cardCabai").show();
          this.dateNow = response.data.dateNow;
          this.date = response.data.date;
          this.kab = response.data.kabupaten;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
           
          var myChart = new Chart(ctx, {
            type: "bar",
            data: {
              labels: response.data.week,
              datasets: [
                {
                  label: "Cabai Rawit",
                  backgroundColor: "rgba(54, 162, 235, 1)",
                  borderColor: "rgba(54, 162, 235, 1)",
                  pointRadius: true,
                  pointColor: "rgba(54, 162, 235, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(54, 162, 235, 1)",
                  data: response.data.produksiRawitWeek,
                  pointStyle: "rect",
                  pointRadius: 7,
                  pointHoverRadius: 10,
                  fill: false
                },
                {
                  label: "Cabai Keriting",
                  backgroundColor: "rgba(254, 99, 131, 1)",
                  borderColor: "rgba(254, 99, 131, 1)",
                  pointRadius: true,
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(254, 99, 131, 1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(254, 99, 131, 1)",
                  data: response.data.produksiKeritingWeek,
                  pointStyle: "rect",
                  pointRadius: 7,
                  pointHoverRadius: 10,
                  fill: false
                },
                {
                  label: "Cabai Besar",
                  backgroundColor: "rgba(74, 192, 192, 1)",
                  borderColor: "rgba(74, 192, 192, 1)",
                  pointRadius: true,
                  pointColor: "#3b8bba",
                  pointStrokeColor: "rgba(74, 192, 192, 1)",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(74, 192, 192, 1)",
                  data: response.data.produksiBesarWeek,
                  pointStyle: "rect",
                  pointRadius: 7,
                  pointHoverRadius: 10,
                  fill: false
                }
              ]
            },
            options: {
              responsive: true,
              tooltips: {
                mode: "index",
                intersect: false
              },
              scales: {
                xAxes: [
                  {
                    // stacked: true,
                    gridLines: {
                      display: false
                    },
                    scaleLabel: {
                      display:true,
                      labelString : 'Minggu ke-'
                    },              
                  }
                ],
                yAxes: [
                  {
                    // stacked: true,
                    gridLines: {
                      display: false
                    },
                    ticks: {
                      beginAtZero: true
                    },
                    scaleLabel: {
                      display:true,
                      labelString : 'Jumlah Produksi (kg)'
                    },
                    
                  }
                ]
              },
              
            }
          });
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
          this.errored = true;
        });
      axios.get('/getProduksiTabel/'+selectedDaerah)
        .then(response =>{
          this.data = response.data.data;
          $("#tabelCabai").show();
      })
    }
  }
};
</script>


<style>
.custom-container {
  width: 97%;
  padding-right: 7.5px;
  padding-left: 7.5px;
  margin-right: auto;
  margin-left: auto;
}
</style>