<template>
  <div class>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class ="custom-container">

        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <a href="/" class="navbar-brand">
            <img
                src="/dist/img/icon_cabai.png"
                class="brand-image"
            />
            <span class="brand-text font-weight-light">
              <b>CABAI</b>.id
            </span>
          </a>
          <!-- Left navbar links -->
          <ul class="navbar-nav">
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

            <li class="nav-item">
              <router-link to="/detail" class="nav-link">Detail</router-link>
            </li>
          </ul>

          <!-- SEARCH FORM -->
          <!-- <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input
                                class="form-control form-control-navbar"
                                type="search"
                                placeholder="Search"
                                aria-label="Search"
                            />
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
          </form>-->
        </div>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class>
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
                  <a href="#">Home</a>
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
                <router-link to="/detail" class="small-box-footer">
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
                  <h4 class="card-title">Mitra Aplikasi</h4>
                </div>
                <!-- /.card-header -->
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
                        <span class="progress-text">
                          Mitra di Kab/Kota
                        </span>
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
                
                <!-- ./card-body -->
                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-success">
                          <i class="fas fa-caret-up"></i> 17%
                        </span>
                        <h5 class="description-header">$35,210.43</h5>
                        <span class="description-text">TOTAL REVENUE</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-warning">
                          <i class="fas fa-caret-left"></i> 0%
                        </span>
                        <h5 class="description-header">$10,390.90</h5>
                        <span class="description-text">TOTAL COST</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <span class="description-percentage text-success">
                          <i class="fas fa-caret-up"></i> 20%
                        </span>
                        <h5 class="description-header">$24,813.53</h5>
                        <span class="description-text">TOTAL PROFIT</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <span class="description-percentage text-danger">
                          <i class="fas fa-caret-down"></i> 18%
                        </span>
                        <h5 class="description-header">1200</h5>
                        <span class="description-text">GOAL COMPLETIONS</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                  </div>
                  <!-- /.row -->
                </div>
                <router-link to="/detail" class="card-footer">
                  <span class="description-text">MORE INFO</span>
                  <i class="fas fa-arrow-circle-right"></i>
                </router-link>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
              
            </div>
            
            <!-- /.col -->
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>

                  <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                  </p>

                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>

              <div class="card card-primary card-outline">
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>

                  <p class="card-text">
                    Some quick example text to build on the card title and make up the bulk of the card's
                    content.
                  </p>
                  <a href="#" class="card-link">Card link</a>
                  <a href="#" class="card-link">Another link</a>
                </div>
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col-md-6 -->
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title">Special title treatment</h6>

                  <p
                    class="card-text"
                  >With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>

              <div class="card card-primary card-outline">
                <div class="card-header">
                  <h5 class="card-title m-0">Featured</h5>
                </div>
                <div class="card-body">
                  <h6 class="card-title">Special title treatment</h6>

                  <p
                    class="card-text"
                  >With supporting text below as a natural lead-in to additional content.</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
            </div>
            <!-- /.col-md-6 -->
          </div>
          <!-- /.row -->
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Harga Cabai Prov Jawa Barat berdasarkan Stakeholder</h4>

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
                  <div class="row">
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
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Rataan Kenaikan Harga Setiap Stakeholder</strong>
                      </p>
                        <table class="table ">
                          <thead>
                          <tr>
                            <th>Transaksi</th>
                            <th>Kenaikan</th>
                            <th>%</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                            <td>
                              <div class="row">
                                <div class="col-sm-2 bg-primary color-palette disabled"><span>&ensp;</span></div>
                                <span> - </span>
                                <div class="col-sm-2 bg-purple color-palette disabled"><span>&ensp;</span></div>
                              </div>
                            </td>
                            <td>$13 USD</td>
                            <td>
                              <small class="text-success mr-1">
                                <i class="fas fa-arrow-up"></i>
                                12%
                              </small>
                              12,000 Sold
                            </td>
                            
                          </tr>
                          <tr>
                            <td>
                              Pengepul - Grosir
                            </td>
                            <td>$29 USD</td>
                            <td>
                              <small class="text-warning mr-1">
                                <i class="fas fa-arrow-down"></i>
                                0.5%
                              </small>
                              123,234 Sold
                            </td>
                            
                          </tr>
                          <tr>
                            <td>
                              Grosir - Pengecer
                            </td>
                            <td>$1,230 USD</td>
                            <td>
                              <small class="text-danger mr-1">
                                <i class="fas fa-arrow-down"></i>
                                3%
                              </small>
                              198 Sold
                            </td>
                            
                          </tr>
                          <tr>
                            <td>
                              Pengecer - Konsumen
                            </td>
                            <td>$199 USD</td>
                            <td>
                              <small class="text-success mr-1">
                                <i class="fas fa-arrow-up"></i>
                                63%
                              </small>
                              87 Sold
                            </td>
                            
                          </tr>
                          </tbody>
                        </table>
                    </div>
                    <!-- /.card -->
                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Rataan Kenaikan Harga Setiap Stakeholder</strong>
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
                        <span class="progress-text">
                          Mitra di Kab/Kota
                        </span>
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
                
                <!-- ./card-body -->
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
    <!-- /.content-wrapper -->
  </div>
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
    import { Bar, Line } from 'vue-chartjs'
    
    export default{
      mounted() {
        axios.get('/getUserCount').then((response) => {
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: response.data.role_user,
                  datasets: [{
                      label               : '# of User',
                      data                : response.data.user,
                      borderWidth         : 1,
                      backgroundColor     : 'rgba(210, 100, 222, 1)',
                      borderColor         : 'rgba(210, 214, 222, 1)',
                  }]
              },
              options: {
                  maintainAspectRatio : false,
                  responsive : true,
                  legend: {
                    display: false
                  },
                  scales: {
                      xAxes: [{
                        gridLines : {
                          display : false,
                        }
                      }],
                      yAxes: [{
                          gridLines : {
                            display : false,
                          },
                          ticks: {
                              stepSize: 1,
                              beginAtZero: true,
                          }
                      }]
                  }
              }
          });
        }).catch(error => {
          console.log(error)
          this.errored = true
        });
        new Chart(document.getElementById("chart2"), {
          type: 'line',
          data: {
            labels: [ 'Jan','Feb','Mar','Apr','May','Jun',
                      'Jul','Aug','Sep','Oct',
                      'Nov','Dec'],
            datasets: [{ 
                data: [86,75,54,40],
                label: "Produsen - Pengepul",
                borderColor: "#3e95cd",
                fill: false
              }, { 
                data: [90,80,60,45],
                label: "Pengepul - Grosir",
                borderColor: "#8e5ea2",
                fill: false
              }, { 
                data: [93,82,65,48],
                label: "Grosir - Pengecer",
                borderColor: "#3cba9f",
                fill: false
              }, { 
                data: [95,85,68,50],
                label: "Pengecer - Konsumen",
                borderColor: "#e8c3b9",
                fill: false
              }
            ]
          },
          options: {
            responsive: true,
            tooltips: {
              mode: 'index',
              intersect: false,
            },
            hover: {
              mode: 'nearest',
              intersect: true
            },
            scales: {
              xAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Bulan'
                }
              }],
              yAxes: [{
                display: true,
                scaleLabel: {
                  display: true,
                  labelString: 'Harga (Rp 000)'
                },
                ticks: {
                    stepSize: 20,
                    beginAtZero: true,
                }
              }]
            }
          }
        });

        axios.get('/getAllUserLocation').then((response) => {
          var lokasi = response.data.lokasi;
          console.log(lokasi);
          console.log(response.data.status);
        })
      }
    }
</script>