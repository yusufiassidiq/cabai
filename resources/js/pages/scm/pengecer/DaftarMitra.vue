<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengecer></headerPengecer>
    <!-- /.content-header -->

    <!-- Main content -->
    <daftarMitra></daftarMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengecer from "../../../components/pengecer/HeaderDaftarMitra";
import daftarMitra from "../../../components/DaftarMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerPengecer: headerPengecer,
    daftarMitra: daftarMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>