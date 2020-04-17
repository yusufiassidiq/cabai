<template>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <headerProdusen></headerProdusen>

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
                    >Permintaan</a>
                  </li>
                  <li class="nav-item">
                    <a
                      class="nav-link"
                      id="custom-tabs-three-profile-tab"
                      data-toggle="pill"
                      href="#custom-tabs-three-profile"
                      role="tab"
                      aria-controls="custom-tabs-three-profile"
                      aria-selected="false"
                    >Riwayat</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <!-- content permintaan -->
                  <permintaan></permintaan>
                  <!-- content riwayat -->
                  <riwayat></riwayat>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>
<script>
import headerProdusen from "../../../components/produsen/HeaderPermintaanMitra";
import listPermintaan from "../../../components/PM_ListPermintaan";
import listRiwayat from "../../../components/PM_ListRiwayat";

export default {
  data() {
    return {};
  },
  components: {
    headerProdusen: headerProdusen,
    permintaan: listPermintaan,
    riwayat: listRiwayat,
  },
  methods: {},
  created() {},
  mounted() {}
};
</script>