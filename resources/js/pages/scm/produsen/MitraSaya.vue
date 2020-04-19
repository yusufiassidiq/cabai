<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
    <!-- /.content-header -->

    <!-- Main content -->
    <mitrasaya></mitrasaya>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderMitraSaya";
import listMitraSaya from "../../../components/MitraSaya"

export default {
  components: {
    // component : source
    headerProdusen: headerProdusen,
    mitrasaya:listMitraSaya,
  }
};
</script>