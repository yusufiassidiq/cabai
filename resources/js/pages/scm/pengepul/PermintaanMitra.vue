<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <permintaanMitra></permintaanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderPermintaanMitra";
import permintaanMitra from "../../../components/PermintaanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerPengepul: headerPengepul,
    permintaanMitra: permintaanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>