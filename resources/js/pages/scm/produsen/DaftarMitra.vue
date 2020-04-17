<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>
    <!-- /.content-header -->

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
                      id="custom-tabs-three-home-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-home"
                      role="tab"
                      aria-controls="custom-tabs-three-home"
                      aria-selected="true"
                    >Pengepul</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <listpengepul></listpengepul>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderDaftarMitra";
import listPengepul from "../../../components/DM_ListPengepul";

export default {
  components: {
    // component : source
    headerProdusen: headerProdusen,
    listpengepul: listPengepul
  }
};
</script>