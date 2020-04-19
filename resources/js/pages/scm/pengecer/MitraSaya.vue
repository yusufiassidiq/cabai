<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengecer></headerPengecer>
    <!-- Main content -->
    <mitrasaya></mitrasaya>
  </div>
</template>
<script>
import headerPengecer from "../../../components/pengecer/HeaderMitraSaya";
import listMitraSaya from "../../../components/MitraSaya";

export default {
  components: {
    // component : source
    headerPengecer: headerPengecer,
    mitrasaya: listMitraSaya
  }
};
</script>