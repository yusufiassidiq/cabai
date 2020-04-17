<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerGrosir></headerGrosir>
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card card-primary card-outline card-outline-tabs">
              <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="custom-tabs-three-pengepul-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-pengepul"
                      role="tab"
                      aria-controls="custom-tabs-three-pengepul"
                      aria-selected="true"
                    >Pengepul</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="custom-tabs-three-pengecer-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-pengecer"
                      role="tab"
                      aria-controls="custom-tabs-three-pengecer"
                      aria-selected="false"
                    >Pengecer</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <pengepul></pengepul>
                  <pengecer></pengecer>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
</template>
<script>
import headerGrosir from "../../../components/grosir/HeaderDaftarMitra";
import listpengepul from "../../../components/DM_ListPengepul";
import listPengecer from "../../../components/DM_ListPengecer";

export default {
  data() {
    return {};
  },
  components: {
    headerGrosir: headerGrosir,
    pengepul: listpengepul,
    pengecer: listPengecer,
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>