<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
    <!-- /.content-header -->

    <!-- Main content -->
    <daftarMitra></daftarMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderDaftarMitra";
import daftarMitra from "../../../components/DaftarMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerProdusen: headerProdusen,
    daftarMitra: daftarMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>