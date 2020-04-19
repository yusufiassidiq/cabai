<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- Main content -->
    <mitrasaya></mitrasaya>
  </div>
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderMitraSaya";
import listMitraSaya from "../../../components/MitraSaya"

export default {
  components: {
    // component : source
    headerGrosir: headerGrosir,
    mitrasaya:listMitraSaya,
  }
};
</script>