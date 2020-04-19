<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengecer></headerPengecer>
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
                      id="custom-tabs-three-permintaan-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-permintaan"
                      role="tab"
                      aria-controls="custom-tabs-three-permintaan"
                      aria-selected="true"
                    >	Permintaan dari Pengguna Lain</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="custom-tabs-three-pengajuan-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-pengajuan"
                      role="tab"
                      aria-controls="custom-tabs-three-pengajuan"
                      aria-selected="false"
                    >Permintaan dari Saya</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <!-- content permintaan -->
                  <permintaan></permintaan>
                  <!-- content pengajuan -->
                  <pengajuan></pengajuan>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import headerPengecer from "../../../components/pengecer/HeaderPermintaanMitra";
import listPermintaan from "../../../components/PM_ListPermintaan";
import listPengajuan from "../../../components/PNM_ListPengajuan";
export default {
  components: {
    headerPengecer: headerPengecer,
    permintaan: listPermintaan,
    pengajuan: listPengajuan,
  }
};
</script>