<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- /.content-header -->

    <!-- Main content -->
    <permintaanMitra></permintaanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderPermintaanMitra";
import permintaanMitra from "../../../components/PermintaanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    permintaanMitra: permintaanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>