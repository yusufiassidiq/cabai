<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- /.content-header -->

    <!-- Main content -->
    <transaksiPemasok></transaksiPemasok>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderTransaksiPemasok";
import transaksiPemasok from "../../../components/TransaksiPemasok";
export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    transaksiPemasok: transaksiPemasok
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>