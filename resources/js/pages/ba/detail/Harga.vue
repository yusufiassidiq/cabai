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
  <!-- End Header -->

  <main id="main">
    <vue-progress-bar></vue-progress-bar>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Harga Cabai di Jawa Barat</h2>
          <ol>
            <li>
              <a href="index.html">Home</a>
            </li>
            <li>Harga Cabai</li>
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
                  <select
                    class="form-control select2"
                    @change="changeHandler"
                    v-model="selectedDaerah"
                    id="daerah"
                    style="width: 100%;"
                  >
                    <option value="0" disabled>PILIH SENTRA PRODUKSI</option>
                    <option
                      v-for="daerah in daerah"
                      :key="daerah.id"
                      v-bind:value="daerah.id"
                    >{{ daerah.name }}</option>
                  </select>
                </div>
                <div class="col-md-6 form-group">
                  <label>Harga di Tingkat</label>
                  <select
                    class="form-control select2"
                    @change="changeHandler"
                    v-model="selectedStakeholder"
                    id="daerah"
                    style="width: 100%;"
                  >
                    <option disabled value>Pilih Stakeholder</option>
                    <option value="2">PRODUSEN</option>
                    <option value="3">PENGEPUL</option>
                    <option value="4">GROSIR</option>
                    <option value="5">ECERAN</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <div class="card" id="summaryCabai" style="display: none;">
            <div class="row card-body">
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>Rp{{hargaNewRawit | numberWithDot}}</h3>
                    <p>Harga terbaru cabai rawit</p>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      Rp{{hargaNewKeriting | numberWithDot}}
                    </h3>
                    <p>Harga terbaru cabai keriting</p>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>Rp{{hargaNewBesar | numberWithDot}}</h3>
                    <p>Harga terbaru cabai besar</p>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              
            </div>
          </div>

          <div class="card" id="cardCabai" style="display: none;">
            <div class="card-header">
              <h5 class="card-title">GRAFIK HARGA CABAI {{ kab.name }} DI TINGKAT {{ role }}</h5>
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
                    <strong>Harga Cabai Rawit 15 Hari Terakhir</strong>
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
import { Line } from "vue-chartjs";

export default {
  data() {
    return {
      dateNow: {},
      date: {},
      selectedDaerah: "0",
      selectedStakeholder: "2",
      daerah: {},
      kab: {},
      role: {},
      hargaNewRawit: {},
      hargaNewKeriting: {},
      hargaNewBesar: {}
    };
  },
  mounted() {
    this.fillData();
    this.changeHandler();
  },
  methods: {
    fillData() {
      this.$Progress.start();
      axios
        .get("/getDaerah")
        .then(response => {
          this.daerah = response.data.daerah;
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
          this.errored = true;
        });
    },
    changeHandler() {
      this.$Progress.start();
      let selectedDaerah = this.selectedDaerah;
      let selectedStakeholder = this.selectedStakeholder;

      if (selectedDaerah == "0") {
        $("#cardCabai").hide();
        axios
          .get("/getHargaProvinsi/3")
          .then(response => {
            console.log(response.data.harga);
            this.$Progress.finish();
          })
          .catch(error => {
            console.log(error);
            this.errored = true;
          });
      } else
        axios
          .get("/getHarga/" + selectedDaerah + "/" + selectedStakeholder)
          .then(response => {
            console.log(response.data.hargaHarian);
            $("#cardCabai").show();
            $("#summaryCabai").show();
            console.log(selectedStakeholder);
            this.dateNow = response.data.dateNow;
            this.date = response.data.date;
            this.kab = response.data.kabupaten;
            this.role = response.data.role;
            this.hargaNewRawit = response.data.hargaNewRawit;
            this.hargaNewKeriting = response.data.hargaNewKeriting;
            this.hargaNewBesar = response.data.hargaNewBesar;
            var chart = this.$refs.chart;
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
              type: "line",
              data: {
                labels: response.data.date,
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
                    data: response.data.hargaHarianRawit,
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
                    data: response.data.hargaHarianKeriting,
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
                    data: response.data.hargaHarianBesar,
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
                      }
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
                      }
                    }
                  ]
                }
              }
            });
            this.$Progress.finish();
          })
          .catch(error => {
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