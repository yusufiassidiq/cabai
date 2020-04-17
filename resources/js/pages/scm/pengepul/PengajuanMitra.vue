<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="custom-tabs-three-home-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-home"
                      role="tab"
                      aria-controls="custom-tabs-three-home"
                      aria-selected="true"
                    >Pengajuan</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="custom-tabs-three-profile-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-profile"
                      role="tab"
                      aria-controls="custom-tabs-three-profile"
                      aria-selected="false"
                    >Riwayat</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <!-- content pengajuan -->
                  <pengajuan></pengajuan>
                  <!-- content riwayat -->
                  <riwayat></riwayat>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderPengajuanMitra";
import listRiwayat from "../../../components/PNM_ListRiwayat";
import listPengajuan from "../../../components/PNM_ListPengajuan";
export default {
  components: {
    headerPengepul: headerPengepul,
    pengajuan: listPengajuan,
    riwayat: listRiwayat
  }
};
</script>