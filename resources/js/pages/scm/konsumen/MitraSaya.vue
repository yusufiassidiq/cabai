<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Mitra Saya</h1>
        </div>
        <!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Pengecer</a>
            </li>
            <li class="breadcrumb-item active">Mitra Saya</li>
          </ol>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
    <!-- Main content -->
    <mitrasaya></mitrasaya>
  </div>
</template>
<script>
import listMitraSaya from "../../../components/MitraSaya";

export default {
  components: {
    mitrasaya: listMitraSaya
  }
};
</script>