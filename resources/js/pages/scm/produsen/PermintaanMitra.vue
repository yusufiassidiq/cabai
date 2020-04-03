<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
    <!-- /.content-header -->

    <!-- Main content -->
    <permintaanMitra></permintaanMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderPermintaanMitra";
import permintaanMitra from "../../../components/PermintaanMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerProdusen: headerProdusen,
    permintaanMitra: permintaanMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>