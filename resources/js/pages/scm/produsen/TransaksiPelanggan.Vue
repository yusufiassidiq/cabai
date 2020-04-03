<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
    <!-- /.content-header -->

    <!-- Main content -->
    <transaksiPelanggan></transaksiPelanggan>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderTransaksiPelanggan";
import transaksiPelanggan from "../../../components/TransaksiPelanggan";
export default {
  data() {
    return {};
  },
  components: {
    headerProdusen: headerProdusen,
    transaksiPelanggan: transaksiPelanggan
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>