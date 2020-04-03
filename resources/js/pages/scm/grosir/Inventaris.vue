<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    <!-- /.content-header -->

    <!-- Main content -->
    <inventaris></inventaris>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderInventaris";
import inventaris from "../../../components/Inventaris";
export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    inventaris: inventaris
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>