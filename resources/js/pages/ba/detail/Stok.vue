<template>
<body>
  <vue-progress-bar></vue-progress-bar>

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
            <a href="index.html">Home</a>
          </li>
          <li>
            <a href="#about">About</a>
          </li>
          <li>
            <a href="#services">Services</a>
          </li>
          <li>
            <a href="#team">Team</a>
          </li>
        </ul>
      </nav>
      <!-- .nav-menu -->
      <router-link to="/login" class="get-started-btn">Login</router-link>
    </div>
  </header>

  <main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <h2>Stok Cabai di Jawa Barat</h2>
          <ol>
            <li>
              <a href="index.html">Home</a>
            </li>
            <li>Stok Cabai</li>
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
                    <option disabled value="">PILIH DAERAH</option>
                    <option v-for="daerah in daerah" :key="daerah.id" v-bind:value="daerah.id">{{ daerah.name }}</option>
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
                    <h3>{{stokRawit}} kg</h3>
                    <p>ketersediaan cabai rawit</p>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3>
                      {{stokKeriting}} kg
                    </h3>
                    <p>ketersediaan cabai keriting</p>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3>{{stokBesar}} kg</h3>
                    <p>ketersediaan cabai besar</p>
                  </div>
                </div>
              </div>
              <!-- ./col -->
              
            </div>
          </div>
          
          <div class="card" id="cardCabai">
            <div class="card-header">
              <h5 class="card-title">GRAFIK STOK CABAI JAWA BARAT </h5>
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
                    <strong>Stok Cabai Rawit 4 Minggu Terakhir</strong>
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

          <div class="card" id="tabelStok">
            <div class="card-header">
              <h3 class="card-title">STOK CABAI PER KABUPATEN</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table id="dataTable" class="table table-bordered table-hover" >
                <thead>
                  <tr>
                    <th @click="sort('kab')" aria-label="Kabupaten: activate to sort column ascending">Kabupaten</th>
                    <th @click="sort('rawit')">Cabai Rawit (Kg)</th>
                    <th @click="sort('keriting')">Cabai Keriting (Kg)</th>
                    <th @click="sort('besar')">Cabai Besar (Kg)</th>
                    <th @click="sort('total')">Total (Kg)</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="stok in sorted" :key="stok.kab">
                    <td>{{stok.kab}}</td>
                    <td style="text-align:right">{{stok.rawit  | numberWithDot}}</td>
                    <td style="text-align:right">{{stok.keriting | numberWithDot}}</td>
                    <td style="text-align:right">{{stok.besar | numberWithDot}}</td>
                    <td style="text-align:right">{{stok.total | numberWithDot}}</td>
                    
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
import { Bar } from "vue-chartjs";
export default {
  data() {
    return {
      dateNow: {},
      date: {},
      selectedDaerah: '',
      daerah: {},
      kab: {},
      stokRawit: {},
      stokKeriting: {},
      stokBesar: {},
      data: [],
      currentSort:'total',
      currentSortDir:'desc'
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
        })
        .catch(error => {
          console.log(error);
          this.errored = true;  
        });
      axios
        .get("/getAllStok").then(response=>{
          this.data = response.data.data;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var color = Chart.helpers.color;
          var myChart = new Chart(ctx, {
            type: "horizontalBar",
            data: {
              labels: response.data.kabupaten,
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
                  data: response.data.rawit,
                  pointStyle: "rect",
                  pointRadius: 7,
                  pointHoverRadius: 10,
                  fill: false
                },
                {
                  label: "Cabai Keriting",
                  backgroundColor: "rgba(75,181,67, 1)",
                  borderColor: "rgba(75,181,67, 1)",
                  pointRadius: true,
                  pointColor: "rgba(75,181,67, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(75,181,67, 1)",
                  data: response.data.keriting,
                  pointStyle: "rect",
                  pointRadius: 7,
                  pointHoverRadius: 10,
                  fill: false
                },
                {
                  label: "Cabai Besar",
                  backgroundColor: "rgba(179,58,58, 1)",
                  borderColor: "rgba(179,58,58, 1)",
                  pointRadius: true,
                  pointColor: "rgba(179,58,58, 1)",
                  pointStrokeColor: "#c1c7d1",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(179,58,58, 1)",
                  data: response.data.besar,
                  pointStyle: "rect",
                  pointRadius: 7,
                  pointHoverRadius: 10,
                  fill: false
                },
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
              },
              
            }
          });
          this.$Progress.finish();
        }).catch(error=>{
          console.log(error);
          this.errored = true;  
        });
    },
    changeHandler() {
      this.$Progress.start();
      let selectedDaerah = this.selectedDaerah;
      axios.get('/getStok/'+ selectedDaerah)
        .then(response=>{
          $("#summaryCabai").show();
          this.kab = response.data.kabupaten;
          this.stokRawit = response.data.stokRawit;
          this.stokKeriting = response.data.stokKeriting;
          this.stokBesar = response.data.stokBesar;
          this.$Progress.finish();
        })
        .catch(error => {
          console.log(error);
          this.errored = true;
        });
    
    },
    sort:function(s) {
      //if s == current sort, reverse
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
      }
      this.currentSort = s;
    },    
  },
  computed: {
    sorted:function() {
      return this.data.sort((a,b) => {
        let modifier = 1;
        if(this.currentSortDir === 'desc') modifier = -1;
        if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
        if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
        return 0;
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