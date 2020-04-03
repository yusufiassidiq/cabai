<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>
    <!-- /.content-header -->

    <!-- Main content -->
    <inventaris></inventaris>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengepul from "../../../components/pengepul/HeaderInventaris";
import inventaris from "../../../components/Inventaris";
export default {
  data() {
    return {};
  },
  components: {
    headerPengepul: headerPengepul,
    inventaris: inventaris
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>