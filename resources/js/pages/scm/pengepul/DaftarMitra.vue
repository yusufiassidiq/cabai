<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Mitra</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Pengepul</a>
              </li>
              <li class="breadcrumb-item active">Tambah Mitra</li>
            </ol>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>

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
                      id="custom-tabs-three-produsen-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-produsen"
                      role="tab"
                      aria-controls="custom-tabs-three-produsen"
                      aria-selected="true"
                    >Produsen</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="custom-tabs-three-grosir-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-grosir"
                      role="tab"
                      aria-controls="custom-tabs-three-grosir"
                      aria-selected="false"
                    >Grosir</a>
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
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="custom-tabs-three-konsumen-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-konsumen"
                      role="tab"
                      aria-controls="custom-tabs-three-konsumen"
                      aria-selected="false"
                    >Konsumen</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div
                    class="tab-pane fade active show"
                    id="custom-tabs-three-produsen"
                    role="tabpanel"
                    aria-labelledby="custom-tabs-three-produsen-tab"
                  >
                    <produsen></produsen>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="custom-tabs-three-grosir"
                    role="tabpanel"
                    aria-labelledby="custom-tabs-three-grosir-tab"
                  >
                    <grosir></grosir>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="custom-tabs-three-pengecer"
                    role="tabpanel"
                    aria-labelledby="custom-tabs-three-pengecer-tab"
                  >
                    <pengecer></pengecer>
                  </div>
                  <div
                    class="tab-pane fade"
                    id="custom-tabs-three-konsumen"
                    role="tabpanel"
                    aria-labelledby="custom-tabs-three-konsumen-tab"
                  >
                    <konsumen></konsumen>
                  </div>
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
import listprodusen from "../../../components/ListProdusen";
import listGrosir from "../../../components/ListGrosir";
import listPengecer from "../../../components/ListPengecer";
import listKonsumen from "../../../components/ListKonsumen";
export default {
  components: {
    produsen: listprodusen,
    grosir: listGrosir,
    pengecer:listPengecer,
    konsumen: listKonsumen,
  }
};
</script>