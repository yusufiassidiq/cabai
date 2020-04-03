<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- /.content-header -->

    <!-- Main content -->
    <daftarMitra></daftarMitra>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderDaftarMitra";
import daftarMitra from "../../../components/DaftarMitra";
export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    daftarMitra: daftarMitra
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>