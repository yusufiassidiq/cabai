<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <pengajuanMitra></pengajuanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderPengajuanMitra";
import pengajuanMitra from "../../../components/PengajuanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerPengepul: headerPengepul,
    pengajuanMitra: pengajuanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>