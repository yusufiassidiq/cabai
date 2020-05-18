<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Riwayat Distribusi Cabai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Grosir</a>
              </li>
              <li class="breadcrumb-item active">Riwayat Distribusi Cabai</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
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
                    >Distribusi dengan pelanggan</a>
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
                    >Distribusi dengan pemasok</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <!-- riwayat transaksi pelanggan -->
                  <riwTransaksi></riwTransaksi>
                  <!-- riwayat transaksi pemasok -->
                  <riwTransaksiPemasok></riwTransaksiPemasok>
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
import riwayatdistribusiPelanggan from "../../../components/RiwTransaksiDgnPelanggan"
import riwayatdistribusiPemasok from './../../../components/RiwTransaksiDgnPemasok'
export default {
  components: {
    riwTransaksi: riwayatdistribusiPelanggan,
    riwTransaksiPemasok: riwayatdistribusiPemasok
  }
};
</script>