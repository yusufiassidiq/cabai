<template>
    
</template><template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengecer></headerPengecer>
    <!-- /.content-header -->

    <!-- Main content -->
    <inventaris></inventaris>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerPengecer from "../../../components/pengecer/HeaderInventaris";
import inventaris from "../../../components/Inventaris";
export default {
  data() {
    return {};
  },
  components: {
    headerPengecer: headerPengecer,
    inventaris: inventaris
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>