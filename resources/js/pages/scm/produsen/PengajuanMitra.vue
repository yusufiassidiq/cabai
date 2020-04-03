<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
    <!-- /.content-header -->

    <!-- Main content -->
    <pengajuanMitra></pengajuanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderPengajuanMitra";
import pengajuanMitra from "../../../components/PengajuanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerProdusen: headerProdusen,
    pengajuanMitra: pengajuanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>