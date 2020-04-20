<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Transaksi Pemasok</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Grosir</a>
              </li>
              <li class="breadcrumb-item active">Transaksi Pemasok</li>
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
    <transaksiPemasok></transaksiPemasok>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import transaksiPemasok from "../../../components/TransaksiPemasok";
export default {
  components: {
    transaksiPemasok: transaksiPemasok
  }
};
</script>