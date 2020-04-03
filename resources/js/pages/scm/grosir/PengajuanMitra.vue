<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- /.content-header -->

    <!-- Main content -->
    <pengajuanMitra></pengajuanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderPengajuanMitra";
import pengajuanMitra from "../../../components/PengajuanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    pengajuanMitra: pengajuanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>