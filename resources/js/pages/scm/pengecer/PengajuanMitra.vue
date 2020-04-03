<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengecer></headerPengecer>
    <!-- /.content-header -->

    <!-- Main content -->
    <pengajuanMitra></pengajuanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengecer from "../../../components/pengecer/HeaderPengajuanMitra";
import pengajuanMitra from "../../../components/PengajuanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerPengecer: headerPengecer,
    pengajuanMitra: pengajuanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>