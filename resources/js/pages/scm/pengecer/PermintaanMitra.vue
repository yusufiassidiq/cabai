<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengecer></headerPengecer>
    <!-- /.content-header -->

    <!-- Main content -->
    <permintaanMitra></permintaanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengecer from "../../../components/pengecer/HeaderPermintaanMitra";
import permintaanMitra from "../../../components/PermintaanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerPengecer: headerPengecer,
    permintaanMitra: permintaanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>