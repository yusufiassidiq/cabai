<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <transaksiPemasok></transaksiPemasok>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderTransaksiPemasok";
import transaksiPemasok from "../../../components/TransaksiPemasok";
export default {
  data() {
    return {};
  },
  components: {
    headerPengepul: headerPengepul,
    transaksiPemasok: transaksiPemasok
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>