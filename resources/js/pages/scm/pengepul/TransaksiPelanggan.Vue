<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <transaksiPelanggan></transaksiPelanggan>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderTransaksiPelanggan";
import transaksiPelanggan from "../../../components/TransaksiPelanggan";
export default {
  data() {
    return {};
  },
  components: {
    headerPengepul: headerPengepul,
    transaksiPelanggan: transaksiPelanggan
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>