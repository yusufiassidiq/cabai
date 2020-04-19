<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <mitrasaya></mitrasaya>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderMitraSaya";
import listMitraSaya from "../../../components/MitraSaya"

export default {
  components: {
    // component : source
    headerPengepul: headerPengepul,
    mitrasaya:listMitraSaya,
  }
};
</script>