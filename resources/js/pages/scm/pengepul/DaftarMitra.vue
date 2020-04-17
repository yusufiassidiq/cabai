<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerPengepul></headerPengepul>

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
                      class="nav-link"
                      id="custom-tabs-three-produsen-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-produsen"
                      role="tab"
                      aria-controls="custom-tabs-three-produsen"
                      aria-selected="false"
                    >Produsen</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link active"
                      id="custom-tabs-three-grosir-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-grosir"
                      role="tab"
                      aria-controls="custom-tabs-three-grosir"
                      aria-selected="true"
                    >Grosir</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <produsen></produsen>
                  <grosir></grosir>
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
import headerPengepul from "../../../components/pengepul/HeaderDaftarMitra";
import listprodusen from "../../../components/DM_ListProdusen";
import listGrosir from "../../../components/DM_ListGrosir";
export default {
  components: {
    headerPengepul: headerPengepul,
    produsen: listprodusen,
    grosir: listGrosir,
  },
};
</script>