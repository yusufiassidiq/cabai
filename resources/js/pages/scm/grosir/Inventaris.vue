<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Stok</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Grosir</a>
            </li>
            <li class="breadcrumb-item active">Stok</li>
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
    <inventaris></inventaris>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import inventaris from "../../../components/Inventaris";
export default {
  components: {
    inventaris: inventaris
  }
};
</script>