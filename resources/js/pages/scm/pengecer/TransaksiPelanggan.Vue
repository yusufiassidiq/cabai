<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- /.content-header -->

    <!-- Main content -->
    <transaksiPelanggan></transaksiPelanggan>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerGrosir from "../../../components/pengecer/HeaderTransaksiPelanggan";
import transaksiPelanggan from "../../../components/TransaksiPelanggan";
export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    transaksiPelanggan: transaksiPelanggan
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>