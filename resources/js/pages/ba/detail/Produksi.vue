<template>
<body>
  <!-- Navbar -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
      <h1 class="logo mr-auto">
        <a href="/">CabaiJabar</a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active">
            <a href="/">Home</a>
          </li>
        </ul>
      </nav>
      <!-- .nav-menu -->
      <router-link to="/login" class="get-started-btn">Login</router-link>
    </div>
  </header>

  <main id="main">
    <vue-progress-bar></vue-progress-bar>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Produksi Cabai di Jawa Barat</h2>
          <ol>
            <li>
              <a href="index.html">Home</a>
            </li>
            <li>Produksi Cabai</li>
          </ol>
        </div>
      </div>
    </section>
    <!-- End Breadcrumbs -->

    <section id="portfolio-details" class="portfolio-details">
      <div class="container" data-aos="fade-up">
        <div class="portfolio-details-container">
          <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6 form-group">
                  <label>Pilih Daerah</label>
                  <select class="form-control select2" @change="changeHandler" v-model="selectedDaerah" id="daerah" style="width: 100%;">
                    <option disabled value="">PILIH SENTRA PRODUKSI</option>
                    <option v-for="daerah in daerah" :key="daerah.id" v-bind:value="daerah.id">{{ daerah.name }}</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <div class="card" id="cardCabai" style="display: none;">
            <div class="card-header">
              <h5 class="card-title">GRAFIK PRODUKSI CABAI {{ kab.name }} </h5>
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
        </div>
      </div>
    </section>
  </main>

  <footer id="footer">
    <div class="container d-md-flex py-4">
      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          &copy; Copyright
          <strong>
            <span>OnePage</span>
          </strong>. All Rights Reserved
        </div>
        <div class="credits">
          <!-- All the links in the footer should remain intact. -->
          <!-- You can delete the links only if you purchased the pro version. -->
          <!-- Licensing information: https://bootstrapmade.com/license/ -->
          <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/ -->
          Designed by
          <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter">
          <i class="bx bxl-twitter"></i>
        </a>
        <a href="#" class="facebook">
          <i class="bx bxl-facebook"></i>
        </a>
        <a href="#" class="instagram">
          <i class="bx bxl-instagram"></i>
        </a>
        <a href="#" class="google-plus">
          <i class="bx bxl-skype"></i>
        </a>
        <a href="#" class="linkedin">
          <i class="bx bxl-linkedin"></i>
        </a>
      </div>
    </div>
  </footer>
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
      this.$Progress.start();
      axios
        .get("/getDaerah")
        .then(response =>{
          this.daerah = response.data.daerah;
          this.$Progress.finish();
        })
        .catch(error => {});
    },
    changeHandler() {
      this.$Progress.start();
      let selectedDaerah = this.selectedDaerah;
      axios.get('/getProduksi/'+ selectedDaerah)
        .then(response=>{
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
      })
        .catch(error => {
          console.log(error);
          this.errored = true;
      });
      axios.get('/getProduksiTabel/'+selectedDaerah)
        .then(response =>{
          this.data = response.data.data;
          $("#tabelCabai").show();
          this.$Progress.finish();
      }).catch(error => {
          console.log(error);
          this.errored = true;
      });
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