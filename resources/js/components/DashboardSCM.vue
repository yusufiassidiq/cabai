<template>
     <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
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
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</template>
<script>
export default {
  data(){
    return{
      jml_cabai_rawit:"",
      jml_cabai_besar:"",
      jml_cabai_keriting:"",
      jml_mitra_dimiliki:"",
      jml_pengajuan_mitra:"",
      jml_permintaan_mitra:""
    }
  },
  methods:{
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
  mounted(){
    this.getInventaris()
    this.getInfoKemitraan()
    
    window.setInterval(() => {
      this.getInventaris()
      this.getInfoKemitraan()
    }, 1800000)
  }
}
</script>