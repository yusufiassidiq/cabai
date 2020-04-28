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
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
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
            </li> -->
          </ul>
        </div>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="custom-container">
          <div class="row">
            <div class="col-6">
              <h2 class="text-dark">
                Harga Rataan Cabai
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
        <div class="custom-container">
          <div class="row">
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4>
                    <b>Cabai Rawit</b>
                  </h4>
                  <h4>Rp20000/kg</h4>

                  <p align="right">Harga Turun Rp1000</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag fas fa-angle-double-down"></i>
                </div>
                <router-link to="/harga" class="small-box-footer">
                  More info
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h4>
                    <b>Cabai Besar</b>
                  </h4>
                  <h4>Rp-/kg</h4>

                  <p align="right">Harga Tidak Diketahui</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag fas fa-times"></i>
                </div>
                <router-link to="/detail" class="small-box-footer">
                  More info
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h4>
                    <b>Cabai Keriting</b>
                  </h4>
                  <h4>Rp30000/kg</h4>

                  <p align="right">Harga Naik Rp3000</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag fas fa-angle-double-up"></i>
                </div>
                <router-link to="/detail" class="small-box-footer">
                  More info
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
            </div>
            <!-- ./col -->
          </div>
          
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Fluktuasi Harga Cabai Prov Jawa Barat berdasarkan Stakeholder</h4>

                  <!-- <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>-->
                </div>

                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Rataan Kenaikan Harga Setiap Stakeholder</strong>
                      </p>
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Transaksi</th>
                            <th>Kenaikan</th>
                            <th>Presentase</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Pengepul</td>
                            <td>Rp4000</td>
                            <td>2%</td>
                          </tr>
                          <tr>
                            <td>Grosir</td>
                            <td>Rp3000</td>
                            <td>1.5%</td>
                          </tr>
                          <tr>
                            <td>Pengecer</td>
                            <td>Rp3000</td>
                            <td>1.5%</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Perbandingan Harga per-Stakeholder Tahun 2020</strong>
                      </p>

                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="chart2" height="100" style="height: 100px;"></canvas>
                      </div>
                      <!-- /.chart-responsive -->
                    </div>

                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>

                <router-link to="/detail" class="card-footer">
                  <span class="description-text">MORE INFO</span>
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
                

                <!-- ./card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Mitra Aplikasi</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Jumlah Pengguna Berdasarkan Stakeholder</strong>
                      </p>

                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas ref="chart" height="180" style="height: 180px;"></canvas>
                        <!-- <canvas id="salesChart" height="180" style="height: 180px;"></canvas> -->
                      </div>
                      <!-- /.chart-responsive -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Goal Completion</strong>
                      </p>

                      <div class="progress-group">
                        Kemitraan Pengguna
                        <span class="float-right">
                          <b>4</b>/10
                        </span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-primary" style="width: 40%"></div>
                        </div>
                      </div>
                      <!-- /.progress-group -->

                      <div class="progress-group">
                        Transaksi Berhasil
                        <span class="float-right">
                          <b>12</b>/24
                        </span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: 50%"></div>
                        </div>
                      </div>

                      <!-- /.progress-group -->
                      <div class="progress-group">
                        <span class="progress-text">Mitra di Kab/Kota</span>
                        <span class="float-right">
                          <b>20</b>/27
                        </span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                      </div>

                      <!-- /.progress-group -->
                      <div class="progress-group">
                        Pencapaian Target
                        <span class="float-right">
                          <b>50%</b>
                        </span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: 50%"></div>
                        </div>
                      </div>
                      <!-- /.progress-group -->
                    </div>
                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                </div>
                <router-link to="/harga" class="card-footer">
                  <span class="description-text">MORE INFO</span>
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
              </div>
              <!-- /.card -->
            </div>
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

<style>
.custom-container {
  width: 97%;
  padding-right: 7.5px;
  padding-left: 7.5px;
  margin-right: auto;
  margin-left: auto;
}
</style>

<script>
import { Bar, Line } from "vue-chartjs";

export default {
  mounted() {
    axios
      .get("/getUserCount")
      .then(response => {
        var chart = this.$refs.chart;
        var ctx = chart.getContext("2d");
        var myChart = new Chart(ctx, {
          type: "bar",
          data: {
            labels: response.data.role_user,
            datasets: [
              {
                label: "# of User",
                data: response.data.user,
                borderWidth: 1,
                backgroundColor: ["rgba(255, 99, 132, 0.2)","rgba(255, 159, 64, 0.2)","rgba(255, 205, 86, 0.2)","rgba(75, 192, 192, 0.2)","rgba(54, 162, 235, 0.2)"],
                borderColor: "rgba(210, 214, 222, 1)"
              }
            ]
          },
          options: {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
              display: false
            },
            scales: {
              xAxes: [
                {
                  gridLines: {
                    display: false
                  }
                }
              ],
              yAxes: [
                {
                  gridLines: {
                    display: false
                  },
                  ticks: {
                    stepSize: 1,
                    beginAtZero: true
                  }
                }
              ]
            }
          }
        });
      })
      .catch(error => {
        console.log(error);
        this.errored = true;
      });
    new Chart(document.getElementById("chart2"), {
      type: "line",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "May",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec"
        ],
        datasets: [
          {
            data: [86, 75, 54, 40],
            label: "Produsen - Pengepul",
            borderColor: "#3e95cd",
            fill: false
          },
          {
            data: [90, 80, 60, 45],
            label: "Pengepul - Grosir",
            borderColor: "#8e5ea2",
            fill: false
          },
          {
            data: [93, 82, 65, 48],
            label: "Grosir - Pengecer",
            borderColor: "#3cba9f",
            fill: false
          },
          {
            data: [95, 85, 68, 50],
            label: "Pengecer - Konsumen",
            borderColor: "#e8c3b9",
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
        hover: {
          mode: "nearest",
          intersect: true
        },
        scales: {
          xAxes: [
            {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Bulan"
              }
            }
          ],
          yAxes: [
            {
              display: true,
              scaleLabel: {
                display: true,
                labelString: "Harga/kg (Rp .000)"
              },
              ticks: {
                stepSize: 20,
                beginAtZero: true
              }
            }
          ]
        }
      }
    });

    axios.get("/getAllUserLocation").then(response => {
      var lokasi = response.data.lokasi;
      console.log(lokasi);
      console.log(response.data.status);
    });
  }
};
</script>