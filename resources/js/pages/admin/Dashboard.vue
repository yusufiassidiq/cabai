<template>
  <div class="wrapper">
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
            <!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <a href="#">Admin</a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
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
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{ total_user }}</h3>
                  <p>Total user</p>
                </div>
                <div class="icon">
                  <i class="fas fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">
                  <!-- Selengkapnya -->
                  <!-- <i class="fas fa-arrow-circle-right"></i> -->
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{ validated_user }}</h3>
                  <p>User Tervalidasi</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-check"></i>
                </div>
                <a href="#" class="small-box-footer">
                  <!-- Selengkapnya -->
                  <!-- <i class="fas fa-arrow-circle-right"></i> -->
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{ not_validate_user }}</h3>
                  <p>User Belum divalidasi</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-tie"></i>
                </div>
                <a href="#" class="small-box-footer">
                  <!-- Selengkapnya
                  <i class="fas fa-arrow-circle-right"></i> -->
                </a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{ditolak_user}}</h3>

                  <p>User Gagal validasi</p>
                </div>
                <div class="icon">
                  <i class="fas fa-user-times"></i>
                </div>
                <a href="#" class="small-box-footer">
                  <!-- Selengkapnya
                  <i class="fas fa-arrow-circle-right"></i> -->
                </a>
              </div>
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      total_user: 0,
      validated_user: 0,
      not_validate_user: 0,
      ditolak_user: 0
    };
  },
  created() {
    axios.get("/admindashboard").then(response => {
      // console.log(response.data.data);
      this.total_user = response.data.data.total_user;
      this.validated_user = response.data.data.validated_user;
      this.not_validate_user = response.data.data.not_validated_user;
      this.ditolak_user = response.data.data.rejected_user;
    });
  }
};
</script>