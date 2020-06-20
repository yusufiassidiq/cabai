<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <vue-progress-bar></vue-progress-bar>
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pencapaian dan Target Produksi Cabai</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Admin</a>
              </li>
              <li class="breadcrumb-item active">Rekap Pencapaian</li>
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
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Pilih Jenis Cabai</label>
                        <select class="form-control select2" @change="changeHandler" v-model="selectedCabai" id="daerah" style="width: 100%;">
                            <option disabled value="">Pilih Jenis Cabai</option>
                            <option value="0">Cabai rawit</option>
                            <option value="1">Cabai keriting</option>
                            <option value="2">Cabai besar</option>
                        </select>
                    </div>
                    </div>
                </div>
            </div>  
            <div class="card" id="chartCapaian" style="display: none;">
              <div class="card-header">
                <h5 class="card-title">Grafik Target Pencapaian Produksi Cabai</h5>

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
                  <div class="col">
                    <p class="text-center">
                      <strong>Target dan Pencapaian Januari - Desember Tahun {{ year }}</strong>
                    </p>

                    <div class="chart">
                      <!-- Sales Chart Canvas -->
                      <canvas ref="chart" height="100" style="height: 100px;"></canvas>
                      <!-- <canvas id="salesChart" height="180" style="height: 180px;"></canvas> -->
                    </div>
                    <!-- /.chart-responsive -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- ./card-body -->
            </div>

            <div class="card" id="tabelCapaian" style="display: none;">
              <div class="card-header">
                <h3 class="card-title">Capaian TAHUN 2020</h3>
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
                      <th>Target (Kg)</th>
                      <th>Capaian (Kg)</th>
                      <th>Keterangan</th>
                      <th>Selisih (Kg)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="capaian in data" :key="capaian.bulan">
                      <!-- <td></td> -->
                      <!-- <td>{{ data.id }}</td> -->
                      <td>{{capaian.bulan}}</td>
                      <!-- <td>coba</td> -->
                      <td style="text-align:right">{{capaian.target  | numberWithDot}}</td>
                      <td style="text-align:right">{{capaian.capaian | numberWithDot}}</td>
                      <td style="text-align:right">
                        <span v-if="capaian.selisih >= 0 " class="badge bg-success">Tercapai</span>
                        <span v-else class="badge bg-danger">Belum Tercapai</span>
                      </td>
                      <td style="text-align:right">{{capaian.selisih | numberWithDot}}</td>
                      
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
    </section>
    <!-- /.content -->
  </div>
<!-- /.content-wrapper -->
</template>

<script>
  import { Bar } from 'vue-chartjs'

  export default{
    data(){
      return {
        editmode : false,
        datatarget :{},
        year: {},
        selectedCabai:'',
        data: "",
      };
    },
    methods:{
      loadTarget(){
        this.$Progress.start();
        axios.get('/readTargetAdmin').then(response =>{
          this.datatarget = response.data.data;
          this.year = response.data.tahun;
        });
        this.$Progress.finish();
      },
      changeHandler() {
        this.$Progress.start();
        let selectedCabai = this.selectedCabai;
        axios.get('/getPencapaian/'+ selectedCabai).then(response=>{
          console.log(response.data.target);
          $("#chartCapaian").show();
          $("#tabelCapaian").show();
          this.data = response.data.data;
          var chart = this.$refs.chart;
          var ctx = chart.getContext("2d");
          var myChart = new Chart(ctx, {
            type : 'bar',
            data:{
              labels:response.data.month,
              datasets:[
              {
                label : 'Target',
                backgroundColor     : 'rgba(255, 0, 0, 0.6)',
                borderColor         : 'rgba(255, 0, 0, 0.8)',
                pointRadius         : true,
                pointColor          : 'rgba(255, 0, 0, 0.8)',
                pointStrokeColor    : '#c1c7d1',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(255, 0, 0, 0.8)',
                data                : response.data.target,
                fill                : false,
              },
              {
                label : 'Pencapaian',
                backgroundColor     : 'rgba(11, 156, 49, 0.8)',
                borderColor         : 'rgba(11, 156, 49, 1)',
                pointRadius         : true,
                pointColor          : '#3b8bba',
                pointStrokeColor    : 'rgba(11, 156, 49, 1)',
                pointHighlightFill  : '#fff',
                pointHighlightStroke: 'rgba(11, 156, 49, 1)',
                data                : response.data.capaian,
                fill                : false,
              }]
            },
            options:{
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
                  gridLines : {
                    display : false,
                  }
                }],
                yAxes:[{
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
          toast.fire({
            icon: "success",
            title: "Tunggu sebentar, Data sedang dimuat"
          });
          this.$Progress.finish();
        }).catch(error => {
          console.log(error)
          this.errored= true
        });
      }
    },
    created(){
      this.loadTarget();
    },
    mounted() {
    this.fillData();
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.fillData();
      this.loadTarget();
    });
  }
};
</script>